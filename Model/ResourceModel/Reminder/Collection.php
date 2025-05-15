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

namespace ElRyan\ProductReminder\Model\ResourceModel\Reminder;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use ElRyan\ProductReminder\Model\Reminder;
use ElRyan\ProductReminder\Model\ResourceModel\Reminder as ReminderFactory;

/**
 * Collection class for Product Reminder entities.
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Construct Resource Model
     */
    protected function _construct()
    {
        $this->_init(Reminder::class, ReminderFactory::class);
    }
}
