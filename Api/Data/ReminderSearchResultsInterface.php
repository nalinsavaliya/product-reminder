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

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for product reminder search results.
 */
interface ReminderSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get reminders list.
     *
     * @return \ElRyan\ProductReminder\Api\Data\ReminderInterface[]
     */
    public function getItems();

    /**
     * Set reminders list.
     *
     * @param \ElRyan\ProductReminder\Api\Data\ReminderInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
