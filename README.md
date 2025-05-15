
# Magento 2 Product Reminder

Magento 2 Product Reminder allows customers to set product reminders and receive automated email notifications. Admins can configure default behavior, and developers can interact with reminder records through a REST API. The module supports reminder scheduling, automatic email notifications, and cleanup of reminders for deleted products.

## Features 👌

	Easy installation and management.

	
- ✅ Enable/disable module via Admin Panel  

- ✉️ Email notification on reminder date  

- 📅 Cron-based reminder processing  

- 🧾 Admin-configurable default message and sender 

- 🔐 ACL support for Admin  

- 🔄 Automatically deletes reminders when products are removed  

- 📡 Fully REST API driven reminder operations  

- ⚠️ Pre-reminder email notification 7 days in advance  

## Requirements

- PHP >= 8.1
- Magento >= 2.4.6

## Installation

- ### Via composer (recommended)

  Please go to the Magento2 root directory and run the following commands in the shell:

  composer require elryan/magento-2-product-reminder
  bin/magento setup:upgrade
  bin/magento module:enable ElRyan_ProductReminder

- ### Manually

  Please create the directory _app/code/ElRyan/ProductReminder_ and copy the files from this repository to the created directory. Then run the following commands in the shell:

  bin/magento setup:upgrade
  bin/magento module:enable ElRyan_ProductReminder

## Support

If you encounter any problems or bugs, please contact us at info@elryan.com for assistance.

## Developer

ElRyan Team

- Website: [www.elryan.com]

## Maintainer

- @elryan


## Copyright

© Manahil El Ryan LTD