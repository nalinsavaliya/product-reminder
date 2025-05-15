<?php
/**
 * ElRyan_ProductReminder extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License 3 License
 * that is bundled with this package in the file LICENSE
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.de.html
 *
 * @category  ElRyan
 * @package   ElRyan_ProductReminder
 * @copyright Copyright © ElRyan. All rights reserved.
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License 3 License
 * @author    mailto:info@elryan.com
 */

namespace ElRyan\ProductReminder\Cron;

use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use ElRyan\ProductReminder\Model\ResourceModel\Reminder\CollectionFactory;
use ElRyan\ProductReminder\Helper\Data as ReminderHelper;

class SendReminders
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var DateTime
     */
    protected $date;

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var ReminderHelper
     */
    protected $reminderHelper;

    /**
     * SendReminders constructor.
     * @param CollectionFactory $collectionFactory
     * @param TransportBuilder $transportBuilder
     * @param StoreManagerInterface $storeManager
     * @param LoggerInterface $logger
     * @param DateTime $date
     * @param CustomerRepositoryInterface $customerRepository
     * @param ReminderHelper $reminderHelper
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        LoggerInterface $logger,
        DateTime $date,
        CustomerRepositoryInterface $customerRepository,
        ReminderHelper $reminderHelper
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->logger = $logger;
        $this->date = $date;
        $this->customerRepository = $customerRepository;
        $this->reminderHelper = $reminderHelper;
    }

    /**
     * Process and send product reminder emails based on reminder date and status.
     *
     * Checks for pending reminders scheduled for today or 7 days ahead,
     * sends emails to customers, and updates status if sent.
     *
     * @return void
     */
    public function execute()
    {
        if (!$this->reminderHelper->isModuleEnabled()) {
            return;
        }

        $today = $this->date->date('Y-m-d'); // Get today's date
        $sevenDaysBefore = $this->date->date('Y-m-d', strtotime('+7 days')); // 7 days before

        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('status', 'pending');
        $collection->addFieldToFilter(
            ['reminder_date', 'reminder_date'],
            [
                ['eq' => $today],
                ['eq' => $sevenDaysBefore]
            ]
        );

        foreach ($collection as $reminder) {
            try {
                $customerId = $reminder->getCustomerId();
                $customer = $this->customerRepository->getById($customerId);

                $customerEmail = $customer->getEmail();
                $customerName = $customer->getFirstname() . ' ' . $customer->getLastname();

                // Fetch configuration values from helper
                $emailSender = $this->reminderHelper->getEmailSender();
                $reminderMessage = $this->reminderHelper->getReminderMessage();
                $reminderDate = $this->date->date('Y-m-d', strtotime($reminder->getReminderDate()));

                $subject = "Product Reminder: Don't Miss Out on Your Favorite Items!";
                if ($reminderDate != $today) {
                    $subject = "Upcoming Product Reminder: Don't Miss Out on Your Favorite Items!";
                }
                // Send email
                $transport = $this->transportBuilder
                    ->setTemplateIdentifier('reminder_email_template') // Set this in Marketing > Email Templates
                    ->setTemplateOptions([
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => $this->storeManager->getStore()->getId(),
                    ])
                    ->setTemplateVars([
                        'customer_name' => $customerName,
                        'reminder_message' => $reminderMessage,
                        'subject' => $subject
                    ])
                    ->setFromByScope($emailSender)
                    ->addTo($customerEmail, $customerName)
                    ->getTransport();

                $transport->sendMessage();

                // If reminder date is today, update status to Sent

                if ($reminderDate == $today) {
                    $reminder->setStatus('sent')->save();
                }

            } catch (\Exception $e) {
                $this->logger->error(__('Reminder Email Error: %1', $e->getMessage()));
            }
        }
    }
}
