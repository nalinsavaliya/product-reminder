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

namespace ElRyan\ProductReminder\Model;

use ElRyan\ProductReminder\Api\Data\ReminderSearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use ElRyan\ProductReminder\Api\Data\ReminderInterface;
use ElRyan\ProductReminder\Api\ReminderRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

/**
 * Repository class for managing Product Reminder entities.
 */
class ReminderRepository implements ReminderRepositoryInterface
{
    /**
     * @var ResourceModel\Reminder
     */
    private $resource;

    /**
     * @var ReminderFactory
     */
    private $reminderFactory;

    /**
     * @var ReminderSearchResultsInterfaceFactory
     */
    private $reminderSearchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var ResourceModel\Reminder\CollectionFactory
     */
    private $reminderCollectionFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    /**
     * @var TimezoneInterface
     */
    private $timezone;

    /**
     * ReminderRepository constructor.
     * @param ReminderSearchResultsInterfaceFactory $reminderSearchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param ReminderFactory $reminderFactory
     * @param ResourceModel\Reminder $resource
     * @param ResourceModel\Reminder\CollectionFactory $reminderCollectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TimezoneInterface $timezone
     */
    public function __construct(
        ReminderSearchResultsInterfaceFactory  $reminderSearchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        ReminderFactory $reminderFactory,
        ResourceModel\Reminder $resource,
        ResourceModel\Reminder\CollectionFactory $reminderCollectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TimezoneInterface $timezone
    ) {
        $this->reminderSearchResultsFactory = $reminderSearchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->reminderFactory = $reminderFactory;
        $this->resource = $resource;
        $this->reminderCollectionFactory = $reminderCollectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->timezone = $timezone;
    }

    /**
     * @inheritdoc
     */
    public function saveCustomerReminder(ReminderInterface $reminder)
    {
        try {
            $currentDate = $this->timezone->date()->format('Y-m-d');
            if ($reminder->getReminderDate() <= $currentDate) {
                throw new LocalizedException(__('Please enter future reminder date'));
            }
            $this->resource->save($reminder);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $this->getById($reminder->getId());
    }

    /**
     * @inheritdoc
     */
    public function save(ReminderInterface $reminder)
    {
        try {
            $this->resource->save($reminder);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $this->getById($reminder->getId());
    }

    /**
     * @inheritdoc
     */
    public function getById(int $id)
    {
        $reminder = $this->reminderFactory->create();
        $this->resource->load($reminder, $id);
        if (!$reminder->getId()) {
            throw new NoSuchEntityException(__("Reminder with id '{$id}' doesn't exist."));
        }
        return $reminder;
    }

    /**
     * @inheritdoc
     */
    public function delete(ReminderInterface $reminder)
    {
        try {
            $this->resource->delete($reminder);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById(int $id)
    {
        return $this->delete($this->getById($id));
    }

    /**
     * @inheritdoc
     */
    public function getListByCustomerId(int $customerId)
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('customer_id', $customerId)
            ->create();

        return $this->getList($searchCriteria);
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->reminderCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->reminderSearchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        return $searchResult;
    }
}
