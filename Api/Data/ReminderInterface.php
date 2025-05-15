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

namespace ElRyan\ProductReminder\Api\Data;

interface ReminderInterface
{
    /**
     * Reminder ID field key
     */
    public const REMINDER_ID = 'id';

    /**
     * Customer ID field key
     */
    public const CUSTOMER_ID = 'customer_id';

    /**
     * Product ID field key
     */
    public const PRODUCT_ID = 'product_id';

    /**
     * Reminder date field key
     */
    public const REMINDER_DATE = 'reminder_date';

    /**
     * Reminder status field key
     */
    public const STATUS = 'status';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get Customer ID
     *
     * @return int|null
     */
    public function getCustomerId();

    /**
     * Get Product ID
     *
     * @return int|null
     */
    public function getProductId();

    /**
     * Get Reminder status
     *
     * @return string|null
     */
    public function getStatus();

    /**
     * Get reminder date
     *
     * @return string|null
     */
    public function getReminderDate();

    /**
     * Set ID
     *
     * @param int $id
     * @return ReminderInterface
     */
    public function setId($id);

    /**
     * Set Customer ID
     *
     * @param int $customerId
     * @return ReminderInterface
     */
    public function setCustomerId($customerId);

    /**
     * Set Product ID
     *
     * @param int $productId
     * @return ReminderInterface
     */
    public function setProductId($productId);

    /**
     * Set reminder status
     *
     * @param string $status
     * @return ReminderInterface
     */
    public function setStatus($status);

    /**
     * Set reminder date
     *
     * @param string $reminderDate
     * @return ReminderInterface
     */
    public function setReminderDate($reminderDate);
}
