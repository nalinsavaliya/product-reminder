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

namespace ElRyan\ProductReminder\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use ElRyan\ProductReminder\Api\Data\ReminderInterface;

interface ReminderRepositoryInterface
{
    /**
     * Validate & Save Reminder.
     *
     * @param ReminderInterface $reminder
     * @return ReminderInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function saveCustomerReminder(ReminderInterface $reminder);

    /**
     * Save Reminder.
     *
     * @param ReminderInterface $reminder
     * @return ReminderInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(ReminderInterface $reminder);

    /**
     * Retrieve page.
     *
     * @param int $id
     * @return ReminderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById(int $id);

    /**
     * Delete Reminder.
     *
     * @param ReminderInterface $reminder
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(ReminderInterface $reminder);

    /**
     * Delete Reminder by ID.
     *
     * @param int $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $id);

    /**
     * Retrieve reminders for customer.
     *
     * @param int $customerId
     * @return \ElRyan\ProductReminder\Api\Data\ReminderSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getListByCustomerId(int $customerId);

    /**
     * Retrieve reminders matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \ElRyan\ProductReminder\Api\Data\ReminderSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
