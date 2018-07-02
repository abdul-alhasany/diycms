<?php

// charset
define('NAV_WELCOME', "Welcome!");
define('NAV_CHECK', "Check");
define('NAV_DETAILS', "Info");
define('NAV_INSTALL', "Install");
define('NAV_DONE', "Done");

define('ERROR_CANNOT_INSTALL', "DiY-CMS can not be installed for security reasons");

// Date conversion class
define('STEP0_FORM', "<br><br><form action='index.php' method='get'><select name='lang'><option value='english'>English</option><option value='arabic'>Arabic</option></select> <input type='submit' value='Submit' name='submit'>");
define('MAIN_PAGE_TITLE', "DiY-CMS 1.1 Installation Wizard");
define('MAIN_TITLE', "DiY-CMS Installation Wizard");
define('STEP0_TEXT', "Welcome<br><br>The installation wizard will get you to perfome number of steps to install DiY-CMS on your website<br><br>Click on next to start or select your language first from the drop menu below". STEP0_FORM);
define('STEP_NEXT', "NEXT");
define('STEP1_TEXT', "Checking server Configurations:");
define('STEP1_CHMOD_UPLOAD_SUCCESS', "Upload folder has the right permissions");
define('STEP1_CHMOD_UPLOAD_FAIL', "Please chmod Upload folder to 777");
define('STEP1_PHP_SUCCESS', "Installed PHP version is compatible with DiY-CMS ");
define('STEP1_PHP_FAIL', "Installed PHP version is compatible with DiY-CMS. Please install version 5.0 or higher of PHP");
define('STEP1_ZIP_SUCCESS', "ZIP Libaray is installed");
define('STEP1_ZIP_FAIL', "ZIP Libaray is not installed. Please install it on the server for DiY-CMS to function correctly.");
define('STEP1_MEMORY_SUCCESS', "Allowed memory is more thatn 64MB");
define('STEP1_MEMORY_FAIL', "Allowed memory is less that 64MB. Please increase allowed memory for the website.");

define('STEP2_DETAILS_DATABASE_TITLE', "Database info");
define('STEP2_DETAILS_DATABASE_SERVER', "Database server");
define('STEP2_DETAILS_DATABASE_NAME', "Database name");
define('STEP2_DETAILS_DATABASE_USER', "Database user");
define('STEP2_DETAILS_DATABASE_PASSWORD', "Database password");

define('STEP2_DETAILS_FOLDER', "Website info");
define('STEP2_DETAILS_FOLDER_PATH', "Website folder path");
define('STEP2_DETAILS_FOLDER_UPLOAD_PATH', "Upload folder path");
define('STEP2_DETAILS_FOLDER_SITE_LINK', "Website domain");
define('STEP2_DETAILS_FOLDER_SITE_TITLE', "Website title");
define('STEP2_DETAILS_FOLDER_SITE_EMAIL', "Website email");

define('STEP2_DETAILS_COOKIES', "Cookies info");
define('STEP2_DETAILS_COOKIES_TITLE', "Cookies name");
define('STEP2_DETAILS_COOKIES_DOMAIN', "Cookies path");

define('STEP2_DETAILS_ADMIN', "Admin info");
define('STEP2_DETAILS_ADMIN_USERNAME', "Username");
define('STEP2_DETAILS_ADMIN_PASSWORD', "Password");


define('STEP3_TEXT_SERVER_FAIL', "Wizard could not connect to server.<br>Please check server info<br><a href='index.php?step=2&lang=$lang'><br>Go back</a>");
define('STEP3_TEXT_DATABASE_FAIL', "Wizard could not connect to server.<br>Please check databse info<br><a href='index.php?step=2&lang=$lang'><br>Go back</a>");
define('STEP3_TEXT_FILL_FIELDS', "Please fill username and password fields<br><a href='index.php?step=2&lang=$lang'><br>Go back</a>");
define('STEP3_TEXT_MYSQL_ERRORS', "Some errors occured during installation: ");
define('STEP3_TEXT_MYSQL_SUCCESS', "Database tables were created successfully.");
define('STEP3_TEXT_CONF_SUCCESS', "Configuration file was written successfully.<br>Please chmod it to 444 or 644 for security reasons.");
define('STEP3_TEXT_CONF_FAIL', "Please this text into: admin/conf.php <br>");
define('STEP3_TEXT_LOCK_CREATED', "Protection file was created successfully.<br>Please delete Install folder completely.");
define('STEP3_TEXT_LOCK_NOT_CREATED', "Protection file was not created.<br>Please delete Install folder completely.");


?>
