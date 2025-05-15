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

use ElRyan\ProductReminder\Api\Data\ReminderInterface;
use Magento\Framework\Model\AbstractModel;
use ElRyan\ProductReminder\Model\ResourceModel\Reminder as ReminderFactory;

/**
 * Model class for Product Reminder entity.
 */
class Reminder extends AbstractModel implements ReminderInterface
{

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'reminder';

    /**
     * Parameter name in event
     *
     * @var string
     */
    protected $_eventObject = 'reminder';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::REMINDER_ID);
    }

    /**
     * Get Customer ID
     *
     * @return int|null
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * Get Product ID
     *
     * @return int|null
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * Get Reminder status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Get reminder date
     *
     * @return string|null
     */
    public function getReminderDate()
    {
        return $this->getData(self::REMINDER_DATE);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return ReminderInterface
     */
    public function setId($id)
    {
        return $this->setData(self::REMINDER_ID, $id);
    }

    /**
     * Set Customer ID
     *
     * @param int $customerId
     * @return ReminderInterface
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Set Product ID
     *
     * @param int $productId
     * @return ReminderInterface
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * Set reminder status
     *
     * @param string $status
     * @return ReminderInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Set reminder date
     *
     * @param string $reminderDate
     * @return ReminderInterface
     */
    public function setReminderDate($reminderDate)
    {
        return $this->setData(self::REMINDER_DATE, $reminderDate);
    }

    /**
     * Construct
     */
    protected function _construct()
    {
        $this->_init(ReminderFactory::class);
    }
}
