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

namespace ElRyan\ProductReminder\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\ScopeInterface;

class Data extends AbstractHelper
{
    /**
     * XML path to check if the Product Reminder module is enabled
     */
    protected const XML_PATH_MODULE_ENABLED = 'product_reminder/general/enabled';

    /**
     * XML path for the email sender identity
     */
    protected const XML_PATH_EMAIL_IDENTITY = 'product_reminder/general/email_identity';

    /**
     * XML path for the reminder message content
     */
    protected const XML_PATH_REMINDER_MESSAGE = 'product_reminder/general/message';

    /**
     * Check if the module is enabled
     *
     * @return bool
     */
    public function isModuleEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_MODULE_ENABLED, ScopeInterface::SCOPE_DEFAULT);
    }

    /**
     * Get the email sender from configuration
     *
     * @return mixed
     */
    public function getEmailSender()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_EMAIL_IDENTITY, ScopeInterface::SCOPE_DEFAULT);
    }

    /**
     * Get the reminder message from configuration
     *
     * @return mixed
     */
    public function getReminderMessage()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_REMINDER_MESSAGE, ScopeInterface::SCOPE_DEFAULT);
    }
}
