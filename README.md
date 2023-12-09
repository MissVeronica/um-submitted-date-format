# UM Submitted Date Format
Extension to Ultimate Member for custom formatting of dates submitted during registration in the admin notification email.

## UM Settings -> Email ->  New User Notification
1. Submitted Date Format - meta_key:PHP Date/Time formats - Formatting the content of <code>{submitted_registration}</code> with: meta_key and PHP date format separated with colon and one format per line. Example <code>birth_date : F j, Y</code>

## WP Settings -> General -> Date Format/Time Format
1. <code>user_registered</code> and <code>use_gdpr_agreement</code> meta_keys are excluded from formattng by this plugin. UM is using the WP date/time settings.

## PHP Date Formats
1. https://wordpress.org/documentation/article/customize-date-and-time-format/
2. https://www.php.net/manual/en/datetime.format.php

## Translations or Text changes
1. Use the "Say What?" plugin with text domain ultimate-member
2. https://wordpress.org/plugins/say-what/

## Updates
None

## Installation
1. Install by downloading the plugin ZIP file and install as a new Plugin, which you upload in WordPress -> Plugins -> Add New -> Upload Plugin.
2. Activate the Plugin: Ultimate Member - Submitted Date Format
