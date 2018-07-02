<?php
/*
+===============================================================================+
|      					DIY-CMS V1.1 Copyright © 2011   						|
|   	--------------------------------------------------------------   		|
|                    				BY                    						|
|              				ABDUL KAHHAR AL-HASANY            					|
|   																	   		|
|      					Web: http://www.diy-cms.com      						|
|   	--------------------------------------------------------------   		|
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR	|
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,		|
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE	|
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER		|
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING		|
* FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS	|
* IN THE SOFTWARE.																|
+===============================================================================+
*/


$lang = array( //general
 
 "SUBMIT" => "Submit",
 "ADD" => "Add",
 "UPDATE" => "Update",
 "EDIT" => "Edit",
 'ACCESS_NOT_ALLOWED' => "You are not allowed to access this file directly",
 'INFO_MESSAGE' => "Message",
 'INFO_MESSAGE_REDIRECT' => "Page will be redirected in %s seconds",
  'ERROR_MESSAGE' => "Error",
 'ERROR_MESSAGE_REDIRECT' => "Go Back",
 /*----------------------------
 index.php
 -----------------------------*/
 'INDEX_CONTROL_PANEL_WELCOME' => "Weclome",
 'INDEX_ADMIN_NOTE_DESC' => "Enter your comments here",
 'INDEX_ADMIN_NOTE_TITLE' => array('short' => 'Enter any comments or notes you would like to remember later', 'norma' => 'Your comments here'),
 'INDEX_INFO' => "Information about your hosting server",
 'INDEX_DIY_VERSION' => "DiyCMS Version",
 'INDEX_PHP_VERSION' => "PHP Version",
 'INDEX_MYSQL_VERSION' => "Mysql Version",
 'INDEX_ZEND_VERSION' => "Zend Engine Version",
 'INDEX_GD_LIBRARY' => "GD Library",
 'INDEX_DISABLED' => "Disabled",
 'INDEX_ENABLED' => "Enabled",
 'INDEX_MAGIC_QOUTES' => "magic_quotes_gpc",
 'INDEX_PHP_INI_PATH' => "php.ini path",
 'INDEX_MEMORY_LIMIT' => "Memory Limit",
 'INDEX_MEMORY_PEAK_USAGE' => "Memory Peak Usage",
 'INDEX_ERROR_DISPLAY' => "Display Erros",
 'INDEX_ZLIP_LIBRARY' => "Zlip Library",
 'INDEX_XML_LIBRARY' => "XML Library",
 'INDEX_MYSQLI_LIBRARY' => "Mysqli Library",
 'INDEX_ZIP_LIBRARY' => "ZIP Library",
 'INDEX_PDF_LIBRARY' => "PDF Library",
 'INDEX_PEAR_LIBRARY' => "PEAR Package",
 'INDEX_CURL_LIBRARY' => "cURL Extension",
 'INDEX_OS' => "Opertaing System",
 'INDEX_MOD_REWRITE' => "Mod Rewrite",
'INDEX_LOG_ERRORS' => "Log Errors",
'INDEX_SAFE_MODE' => "Safe Mode",
 /*----------------------------
 admin_func.class.php
 -----------------------------*/
 // Side_navigation
 'SIDENAV_GLOBAL_SETTINGS' => "Global Settings",
 'SIDENAV_CHECK_UPDATES' => "New updates",
 'SIDENAV_GENERAL_CONFIGRATIONS' => "General Configrations",
 'SIDENAV_SEO_TOOLS' => "SEO Tools",
 'SIDENAV_EXTENSIONS' => "Extensions",
 'SIDENAV_MODULES_MANAGMENT' => "Modules",
 'SIDENAV_PLUGINS_MANAGMENT' => "Plug-ins",
 'SIDENAV_MENUS' => "Menus",
 'SIDENAV_MENUS_MANAGEMENT' => "Menus Management",
 'SIDENAV_CREATE_MENU' => "Create a Menu",
 'SIDENAV_INDEX_MENUS' => "Set Index Menus",
 'SIDENAV_FEEL_LOOK' => "Feel & Look",
 'SIDENAV_THEMES_MANAGEMENT' => "Themes Managemet",
 'SIDENAV_IMPORT_CREATE_IMPORT' => "Create & Import Themes",
 'SIDENAV_GROUPS' => "Users Groups",
 'SIDENAV_MANAGE_GROUPS' => "Manage Users Groups",
 'SIDENAV_CREATE_GROUP' => "Create a Group",
 'SIDENAV_SMILES' => "Smiles",
 'SIDENAV_MANAGE_SMILS' => "Manage Smiles",
 'SIDENAV_CREATE_SMILE' => "Create a Smile",
 "ADMIN_CP" => "Control Panel",
 
 /*----------------------------
 admin_login.class.php
 -----------------------------*/
 'ADMIN_LOGIN' => "Administrator Login",
 'ADMIN_LOGIN_LOGIN_DONE' => "You have logged in successfully.",
 'ADMIN_LOGIN_LOGOUT_DONE' => "You logged out successfully.",
 'ADMIN_LOGIN_USERNAME' => "Username",
 'ADMIN_LOGIN_PASSWORD' => "Password",
 'ADMIN_LOGIN_LOGOUT' => "Logout",
 'ADMIN_LOGIN_LOGIN' => "Login",
 'ADMIN_LOGIN_WRONG_USER_PASS' => "Username or password or both are not correct.",
 'ADMIN_LOGIN_NO_POST_INFO' => "Please fill all the reuqired fields.",
 'ADMIN_LOGIN_LOGIN_ERROR' => "There was an error logining in.",
 'ADMIN_LOGIN_MANY_ATTEMPTS' => 'There were %s login attempts.<br> Please wait %s minute(s) before trying to login again',
 
 /*----------------------------
 admin_sections.class.php
 -----------------------------*/
 'ADMIN_SECTION_FILE_NOT_FOUND' => "File could not be found",
 'ADMIN_LOGIN_LOGOUT_DONE' => "You logged out successfully.",
 
 /* Settings Section */
 // index.php
 "SETTINGS_CENSORED_WORDS" => "Censorship<br>Write evey word in a single line",
 "SETTINGS_BANED_IP" => "Banned IPs<br>Write every IP in a single line",
 "SETTINGS_TURN_OFF" => "Turn off website",
 "SETTINGS_TURN_OFF_MSG" => "Message to be shown when the website is turned off",
 "SETTINGS_KEYWORDS" => "Website's keywords",
 "SETTINGS_DESCRIPTION" => "Website description",
 "SETTINGS_SITE_TITLE" => "Website name",
 "SETTINGS_ADMIN_EMAIL" => "Admin Email",
 "SETTINGS_HOURS_GM" => "Hours difference",
 "SETTINGS_SITE_URL" => "Site URL",
 "SETTINGS_TURN_OFF" => "Turn off website?",
 "SETTINGS_SERVER_TIME" => "Server time",
 "SETTINGS_TITLE" => "Settings",
 "SETTINGS_DATE_TYPE" => "Date Type",
 "SETTINGS_SELECT_THEME" => "Select the defualt Theme",
 "SETTINGS_DATE_GREOGRIAN" => "Gregorian",
 "SETTINGS_HIJRI" => "Hijri",
 
 /*modules section */
 // index.php
 "MODULES_INDEX_TITLE" => "Modules Managment",
 "MODULES_MODULE_INSTALLED_ENABLED" => "Installed & Enabled",
 "MODULES_MODULE_INSTALLED_DISABLED" => "Installed & Disabled",
 "MODULES_MODULE_NOT_INSTALLED" => "Not Installed",
 "MODULES_INDEX_TABLE_MODULE" => "Module",
 "MODULES_INDEX_TABLE_STATUS" => "Status",
 "MODULES_INDEX_TABLE_OPTIONS" => "Options",
 "MODULES_INDEX_MODULE_TITLE" => "<b>Name: </b>",
 "MODULES_INDEX_MODULE_VERSION" => "<b>Version: </b>",
 "MODULES_INDEX_MODULE_AUTHOUR" => "<b>Authour: </b>",
 "MODULES_INDEX_MODULE_DESCR" => "<b>Description: </b>",
 "MODULES_SETTINGS_TITLE" => "Modify Module Settings",
 "MODULES_INDEX_MODULE_INSTALL" => "Install",
 "MODULES_INDEX_MODULE_UNINSTALL" => "Uninstall",
 "MODULES_INDEX_MODULE_SETUP" => "Setup",
 "MODULES_INDEX_MODULE_SETTINGS" => "Settings",
 "MODULES_INDEX_MODULE_VIEW" => "View",
 "MODULES_INDEX_MODULE_STYLE" => "Style",
 "MODULES_INDEX_MODULE_CONFIRM_INSTALL" => "Are you sure you want to install this module?",
 "MODULES_INDEX_MODULE_CONFIRM_UNINSTALL" => "Are you sure you want to uninstall this module?",
 "" => "",
 "" => "",
 
 // setup.php
 "MODULES_SETUP_TITLE" => "Module Setup",
 "MODULE_SETUP_MODULE_NAME" => "Module name",
 "MODULE_SETUP_MODULE_ACTIVE" => "Enable this module?",
 "MODULE_SETUP_THEME" => "Theme",
 "MODULE_SETUP_LANG" => "Langauge",
 "MODULE_SETUP_RIGHT_MENUS" => "Show right menus?",
 "MODULE_SETUP_LEFT_MENUS" => "Show left menus?",
 "MODULE_SETUP_MIDDLE_MENUS" => "Show middle menus?",
 "MODULE_SETUP_SELECT_MENUS" => "Select menus to be shown",
 "MODULE_SETUP_SELECT_GROUPS" => "Groups allowed to view the module",
 "MODULES_SETTINGS_UPDATED_SUCCESSFULLY" => "Modules settings were updated successfully", // install.php
 "MODULE_INSTALL_SUCCESSFUL" => "Module was installed successfully",
 "MODULE_INSTALL_UNSUCCESSFUL" => "Module was not installed successfully due to some errors",
 "MODULE_UNINSTALL_SUCCESSFUL" => "Module was successfully uninstalled",
 "MODULE_UNINSTALL_UNSUCCESSFUL" => "Module was not removed successfully due to some errors", //theme.php
 'MODULES_THEME_TITLE' => "Manage Themes",
 'MODULES_THEME_CREATE_NEW' => "Create a new theme",
 'MODULES_THEME_NAME' => "Theme name",
 'MODULES_THEME_BASE_THEME' => "Select a theme to base your new theme on<br>Choose none if you want to create an empty theme",
 'MODULES_THEME_NAME_REQURIRED' => "Please enter the name of the theme to be created",
 'MODULES_THEME_ADDED_SUCCESSFULLY' => "Theme was created successfully",
 'MODULES_THEME_UPLOAD_FILE' => "Upload a theme file",
 'MODULES_THEME_IMPORT_THEME' => "Import a theme",
 'MODULES_THEME_FILE_NOT_UPLOADED' => "Theme file could not be uploaded",
 'MODULES_THEME_ERORR_XML' => "Error uploading XML file",
 'MODULES_THEME_AVAILABLE_THEMES' => "Available Themes",
 'MODULES_THEME_TEMPLATES_NO' => "Templates Number: ",
 'MODULES_THEME_VIEW_TEMPLATES' => "View Theme Templates",
 'MODULES_THEME_ADD_TEMPLATE_GROUP' => "Add Templates Group",
 'MODULES_THEME_ADD_TEMPLATE' => "Add a Template",
 'MODULES_THEME_EXPORT' => "Export Theme",
 'MODULES_THEME_DELETE' => "Delete theme",
 'MODULES_THEME_CONFIRM_DELETE' => "Are you sure you want to delete this theme?",
 
 // templates.php
 'MODULES_TEMPLATES_TITLE' => "Templates Management",
 'MODULES_TEMPLATES_VIEW_TEMPLATE' => "View Template",
 'MODULES_TEMPLATES_EDIT_TEMPLATE' => "Edit Template",
 'MODULES_TEMPLATES_DELETE_TEMPLATE' => "Delete Template",
 'MODULES_TEMPLATES_CONFIRM_DELETE_TEMPLATE' => "Are you sure you want to delete this template?",
 'MODULES_TEMPLATES_TEMP_GROUP' => "Group [ {TEMP_GROUP} ] in [ {MODULE} ] Module ",
 'MODULES_TEMPLATES_GROUP_TITLE' => "Group title",
 'MODULES_TEMPLATES_TEMPLATE' => "Template Code",
 'MODULES_TEMPLATES_EDIT_TEMPLATE' => "Edit Template",
 'MODULES_TEMPLATES_TEMP_TITLE' => "Template Title",
 'MODULES_TEMPLATES_UPDATE_SUCCESSFULL' => "Template was updated successfully.",
 'MODULES_TEMPLATES_DELETE_SUCCESSFULL' => "Template was deleted successfully.",
 'MODULES_TEMPLATES_EDIT_GROUP' => "Edit a template group",
 'MODULES_TEMPLATES_GROUP_TITLE' => "Group Title",
 'MODULES_TEMPLATES_GROUP_DESC' => "Description",
 'MODULES_TEMPLATES_GROUP_UPDATE_SUCCESSFULL' => "Group was edited successfully.",
 'MODULES_TEMPLATES_GROUP_DELETE_SUCCESSFULL' => "Group was deleted successfully",
 'MODULES_TEMPLATES_TEMPLATE_GROUP_NEEDED' => "You have to add at least one templates group in order to add a template",
 'MODULES_TEMPLATES_ADD_SUCCESSFULL' => "Template was added successfully",
 'MODULES_TEMPLATES_ADD_TEMPLATE' => "Add a Template",
 'MODULES_TEMPLATES_TEMP_GROUP_TITLE' => "Group title",
 'MODULES_TEMPLATES_GROUP_DESCRIPTION' => "Group Description",
 'MODULES_TEMPLATES_ADD_TEMPLATE_GROUP' => "Add a templates group",
 'MODULES_TEMPLATES_GROUP_ADD_SUCCESSFULL' => "Templates Group was added successfully",
 'MODULES_TEMPLATES_CANNOT_DELETE_DEFAULT' => "You can not delete a default theme.<br>Please go to the module setup and change the default theme",
 'MODULES_TEMPLATES_CANNOT_DELETE_SINGLE' => "You can not delete this theme since it is the only theme this module has.<br>Please create another theme or modify this one.",
 'MODULES_TEMPLATES_THEME_DELETE_SUCCESSFULL' => "Theme was deleted successfully",
 
 /* MENUS SECTION */
 
 // index.php
 'MENUS_INDEX_TITLE' => "Menus mangement",
 'MENUS_INDEX_SHOW_MENU' => "Show",
 'MENUS_INDEX_HIDE_MENU' => "Hide",
 'MENUS_INDEX_LEFT' => "Left",
 'MENUS_INDEX_MIDDLE' => "Middle",
 'MENUS_INDEX_RIGHT' => "Right",
 'MENUS_INDEX_MENU_TITLE' => "Title",
 'MENUS_INDEX_MENU_ORDER' => "Order",
 'MENUS_INDEX_MENU_STAUTS' => "Status",
 'MENUS_INDEX_MENU_SIDE' => "Side",
 'MENUS_INDEX_MENU_OPTIONS' => "Options",
 'MENUS_INDEX_EDIT_MENU' => "Edit Menu",
 'MENUS_INDEX_DELETE_MENU' => "Delete Menu",
 'MENUS_INDEX_CONFIRM_DELETE_MENU' => "Are you sure you want to delete this menu?",
 
 // edit_menu.php
 'MENU_EDITMENU_TITLE' => "Edit a Menu",
 'MENU_EDITMENU_MENU_TITLE' => "Title",
 'MENU_EDITMENU_TEMPLATE' => "Template",
 'MENU_EDITMENU_ORDER' => "Order",
 'MENUS_EDITMENU_LEFT' => "Left",
 'MENUS_EDITMENU_MIDDLE' => "Middle",
 'MENUS_EDITMENU_RIGHT' => "Right",
 'MENU_EDITMENU_SIDE' => "Side",
 'MENU_EDITMENU_HEAD' => "Head<br>You can use Html",
 'MENU_EDITMENU_CONTENT' => "Or insert content here",
 'MENU_EDITMENU_SHOW_HIDE' => "Show this menu?",
 'MENU_EDITMENU_GROUP_ACCESS' => "Groups allowed to view this menu",
 'MENU_EDITMENU_FILE' => "Select the file you want to include in the menu",
 'MENU_EDITMENU_MENU_EDITED' => "Menu was edited successfully",
 
 // add_menu.php
 'MENU_ADDMENU_TITLE' => "Add a Menu",
 'MENU_ADDMENU_MENU_TITLE' => "Title",
 'MENU_ADDMENU_TEMPLATE' => "Template",
 'MENU_ADDMENU_ORDER' => "Order",
 'MENUS_ADDMENU_LEFT' => "Left",
 'MENUS_ADDMENU_MIDDLE' => "Middle",
 'MENUS_ADDMENU_RIGHT' => "Right",
 'MENU_ADDMENU_SIDE' => "Side",
 'MENU_ADDMENU_HEAD' => "Head<br>You can use Html",
 'MENU_ADDMENU_CONTENT' => "Or insert content here",
 'MENU_ADDMENU_SHOW_HIDE' => "Show this menu?",
 'MENU_ADDMENU_GROUP_ACCESS' => "Groups allowed to view this menu",
 'MENU_ADDMENU_FILE' => "Select the file you want to include in the menu",
 'MENU_ADDMENU_MENU_ADDED' => "Menu was added successfully",
 
 // delete_menu.php
 'MENU_ADDMENU_MENU_DELETED' => "Menu was deleted successfully",
 
 // index_menus.php
 'MENU_INDEXMENU_TITLE' => "Set Index Menus",
 'MENU_INDEXMENU_MENUS' => "Select Index Page Menus",
 'MENU_INDEXMENU_MENUS_UPDATED' => "Index menus were updated successfully",
 
 
 /* GROUPS SECTION */

 // index.php
 'GROUPS_INDEX_TITLE' => "Manage Users Groups",
 'GROUPS_INDEX_EDIT' => "Edit group",
 'GROUPS_INDEX_DELETE' => "Delete group",
 'GROUPS_INDEX_CANNOT_DELETE' => "This group can not be deleted since it is a main group",
 'GROUPS_INDEX_USERS_NO' => "Number of users in this group: {USERS_NO}",
 'GROUPS_INDEX_GROUP_TITLE' => "Group",
 'GROUPS_INDEX_GROUP_OPTIONS' => "Options",
 
  // add_group.php
 'GROUPS_ADDGROUP_TITLE' => "Add Usergroup",
 'GROUPS_ADDGROUP_GROUP_ADDED' => "User Group was added successfully",
 'GROUPS_ADDGROUP_TITLE_REQUIRED' => "Group title can not be empty",
 
 // edit_group.php
 'GROUPS_EDITGROUP_TITLE' => "Edit Usergroup",
 'GROUPS_EDITGROUP_GROUP_UPDATED' => "User Group was updated successfully",
 
 // privileges (this is not a file, it is used to skip duplicate in add_group.php and edit_group.php strings)
 'GROUPS_PRIVILEGES_GROUP_TITLE' => 'Title',
 'GROUPS_PRIVILEGES_VIEW_OFFLINE' => 'View website when it is set to offline?',
 'GROUPS_PRIVILEGES_MAXIMUM_LETTERS' => 'Maximum letters for a post',
 'GROUPS_PRIVILEGES_MAXIMUM_EDIT_TIME' => 'Time after which users can not edit their posts<br>in minutes',
 'GROUPS_PRIVILEGES_ALLOWED_FILES_UPLOAD' => 'Allow these files for upload<br>Seprate with a comma \',\' ',
 'GROUPS_PRIVILEGES_MAXIMUM_UPLOAD_SIZE' => 'Maximun upload size<br>in KB',
 'GROUPS_PRIVILEGES_MAXIMUM_UPLOAD_WIDTH' => 'Maximum upload width<br>used for uploaded images',
 'GROUPS_PRIVILEGES_MAXIMUM_UPLOAD_HEIGHT' => 'Maximum upload height<br>used for uploaded images',
 'GROUPS_PRIVILEGES_ALLOWED_HTML_TAGS' => 'Allowed html tags',
 'GROUPS_PRIVILEGES_EDITOR_TYPE' => 'Editor type',
 'GROUPS_PRIVILEGES_EDITOR_DISABLED' => 'Disabled',
 'GROUPS_PRIVILEGES_EDITOR_BBCODE' => 'BBCode',
 'GROUPS_PRIVILEGES_EDITOR_HTML' => 'WYSIWYG',

 // delete_group.php
 'GROUPS_DELETEGROUP_TITLE' => "Delete Usergroup",
 'GROUPS_DELETEGROUP_GROUP_TITLE' => "Title",
 'GROUPS_DELETEGROUP_GROUP_DELETED' => "User Group was deleted successfully",
 'GROUPS_DELETEGROUP_GROUP' => "Select a group to which users whill be transfterd to<br>Select none if you want the users under this group deleted",
 
 /* SMILES SECTION */
 // index.php
 'SMILES_INDEX_TITLE' => "Smiles Management",
 'SMILES_INDEX_IMAGE' => "Image",
 'SMILES_INDEX_NAME' => "Name",
 'SMILES_INDEX_CODE' => "Code",
 'SMILES_INDEX_OPTIONS' => "Options",
 'SMILES_INDEX_EDIT_SMILE' => "Edit smile",
 'SMILES_INDEX_DELETE_SMILE' => "Delete smile",
 'SMILES_INDEX_CONFIRM_DELETE_SMILE' => "Are you sure you want to delete this smile?",
 
 // add_smile.php
 'SMILES_ADDSMILE_TITLE' => "Add Smile",
 'SMILES_ADDSMILE_SMILE_NAME' => "Name",
 'SMILES_ADDSMILE_SMILE_CODE' => "Code",
 'SMILES_ADDSMILE_SMILE_FILENAME' => "Enter a file name",
 'SMILES_ADDSMILE_UPLOAD_SMILE' => "Or upload a smile<br>Smiles folder must have 777 access",
 'SMILES_ADDSMILE_SMILE_ADDED' => "Smile was added successfully",
 
 // edit_smile.php
 'SMILES_EDITSMILE_TITLE' => "Add Smile",
 'SMILES_EDITSMILE_SMILE_NAME' => "Name",
 'SMILES_EDITSMILE_SMILE_CODE' => "Code",
 'SMILES_EDITSMILE_SMILE_FILENAME' => "Enter a file name",
 'SMILES_EDITSMILE_SMILE_EDITED' => "Smile was edited successfully",
 // delete_smile.php
 'SMILES_DELETESMILE_SMILE_DELETED' => "Smile was deleted successfully",
 
 
 /*-------------------
 Thmes section
 --------------------*/
 // index.php
 'THEMES_INDEX_TITLE' => "Themes Management",
 'THEMES_INDEX_AVAILABLE_THEMES' => "Available themes",
 'THEMES_INDEX_TEMP_NO' => "Templates Number: ",
 'THEMES_INDEX_VIEW_TEMPLATES' => "View Templates",
 'THEMES_INDEX_ADD_TEMPLATE_GROUP' => "Add Templates Group",
 'THEMES_INDEX_ADD_TEMPLATE' => "Add Template",
 'THEMES_INDEX_EDIT_CSS' => "Edit Header, Footer and Style Sheet",
 'THEMES_INDEX_EDIT_THEME_SETTINGS' => "Edit theme settings",
 'THEMES_INDEX_EXPORT_THEME' => "Export Theme",
 'THEMES_INDEX_DELETE_THEME' => "Delete Theme",
 'THEMES_INDEX_CONFIRM_DELETE_THEME' => "Are you sure you want to delete this theme?\n All template groups and templates under this theme will be deleted.",
 'THEMES_TEMPLATES_TEMPLATE_GROUP_NEEDED' => "You have to add at least one templates group in order to add a template",
 
 // view_templates.php
 'THEMES_TEMPLATES_TITLE' => "Templates Management",
 'THEMES_TEMPLATES_VIEW_TEMPLATE' => "View Template",
 'THEMES_TEMPLATES_EDIT_TEMPLATE' => "Edit Template",
 'THEMES_TEMPLATES_DELETE_TEMPLATE' => "Delete Template",
 'THEMES_TEMPLATES_CONFIRM_DELETE_TEMPLATE' => "Are you sure you want to delete this template?",
 
 // templates.php
 'THEMES_TEMPLATES_TEMPLATE' => "Template Code",
 'THEMES_TEMPLATES_TEMP_TITLE' => "Template Title",
 'THEMES_TEMPLATES_ADD_SUCCESSFULL' => "Template was added successfully",
 'THEMES_TEMPLATES_ADD_TEMPLATE' => "Add a Template",
 'THEMES_TEMPLATES_EDIT_TEMPLATE' => "Edit Template",
 'THEMES_TEMPLATES_UPDATE_SUCCESSFULL' => "Template was updated successfully.",
 'THEMES_TEMPLATES_DELETE_SUCCESSFULL' => "Template was deleted successfully.",
 'THEMES_TEMPLATES_GROUP_TITLE' => "Templates Group",
 
 // templates_group.php
 'THEMES_TEMPGROUP_ADD_TEMPLATE_GROUP' => "Add Templates Group",
 'THEMES_TEMPGROUP_GROUP_TITLE' => "Group title",
 'THEMES_TEMPGROUP_GROUP_DESCRIPTION' => "Description",
 'THEMES_TEMPGROUP_GROUP_ADDED' => "Group was added successfully",
 'THEMES_TEMPGROUP_EDIT_GROUP' => "Edit Templates Group",
 'THEMES_TEMPGROUP_GROUP_TITLE' => "Title",
 'THEMES_TEMPGROUP_GROUP_DESC' => "Description",
 'THEMES_TEMPGROUP_GROUP_UPDATED' => "Templates group was updated successfully",
 'THEMES_TEMPGROUP_DELETE_SUCCESSFULL' => "Templates group and the related templates were deleted successfully", 
 
 // themes.php
 'THEMES_THEMES_CANNOT_DELETE_DEFAULT' => "You can not delete a default theme.<br>Please go to settings section and change the default theme",
 'THEMES_THEMES_CANNOT_DELETE_SINGLE' => "You can not delete this theme since it is the only theme the CMS have.<br>Create another theme in order to delete this one or modify it",
 'THEMES_THEMES_NAME' => "Name",
 'THEMES_THEMES_IMPORT_NAME' => "Name<br>leave it blank if you want to use the default name",
 'THEMES_THEMES_CREATE_NEW' => "Create a new theme",
 'THEMES_THEMES_UPLOAD_FILE' => "Select a file to import",
 'MODULES_THEME_IMPORT_THEME' => "Import a theme",
 'THEMES_CREATE_IMPORT_THEMS' => "Create & Import themes",
 'THEMES_THEMES_FILE_NOT_UPLOADED' => "Theme file could not be uploaded",
 'THEMES_THEMES_ERORR_XML' => "Server could not read the XML file.<br>It is possible that it is a corrupt XML file.",
 'THEMES_THEMES_CSS_NOT_UPLOADED' => ">Theme installation was not completed.<br>make sure that the folder html/css is chomded to 777",
 'THEMES_THEMES_IMPORT_SUCCESSFULL' => "Theme was imported successfully.",
 'THEMES_THEMES_DELETE_SUCCESSFULL' => "Theme and all related templates were deleted successfully",
 'THEMES_THEMES_BASE_THEME' => "Select a theme to base your new theme on<br>Choose none if you want to create an empty theme",
 'THEMES_THEMES_NO_TITLE' => "Please enter the title for the new theme",
 'THEMES_THEMES_CREATE_SUCCESSFULL' => "A new theme was created successfully",
 'THEMES_THEMES_NO_ACTION_SELECTED' => "No action was selected.",
 'THEMES_THEMES_ZIP_FAIL' => "Theme was not imported",
 'THEMES_THEMES_FILE_NOT_SUPPORTED' => "File type is not supported",
 
 // theme_settings.php
 'THEMES_SETTINGS_TITLE' => "Edit theme settings",
 'THEMES_SETTINGS_THEME_NAME' => "Theme name",
 'THEMES_SETTINGS_THEME_WIDHT' => "Theme width",
 'THEMES_SETTINGS_IMAGE_PATH' => "Images path",
 'THEMES_SETTINGS_ALLOW_USE' => "Available for users?",
 'THEMES_SETTINGS_NO_TITLE' => "Theme title can not be empty",
 'THEMES_SETTINGS_EDIT_SUCCESSFULL' => "Settings have been edited successfully.",
 'THEMES_SETTINGS_GLOBAL_TEMPLATE' => "Select global block template<br>If set to 'none' default template will be used",
 'THEMES_SETTINGS_SELECT_MENUS' => "Select menus to appear in this theme",
 
 // edit_css.php
 'THEMES_CSS_TITLE' => "Edit theme css, header & footer",
 'THEMES_CSS_STYLE_SHEET' => "Style Sheet",
 'THEMES_CSS_THEME_HEADER' => "Header",
 'THEMES_CSS_THEME_FOOTER' => "Footer",
 'THEMES_CSS_EDIT_SUCCESSFULL' => "Theme has been edited successfully",
 
 
 /* UPDATES SECTION */
 'UPDATES_INDEX' => 'Please Note: Backup the relevant files or databse tables before attempting to update them through this area.',
 'UPDATES_INDEX_TABLE_TITLE' => 'New Updates',
 'UPDATES_INDEX_TABLE_FILE' => 'File Path or Database Table',
 'UPDATES_INDEX_TABLE_ISSUE' => 'Issue',
 'UPDATES_INDEX_TABLE_DOWNLOAD' => 'Download',
 'UPDATES_INDEX_TABLE_UPDATE' => 'UPDATE',
 
 
 /*plugin section */
 // index.php
 "PLUGINS_INDEX_TITLE" => "Plguins Managment",
 "PLUGINS_PLUGIN_INSTALLED_ENABLED" => "Installed & Enabled",
 "PLUGINS_PLUGIN_INSTALLED_DISABLED" => "Installed & Disabled",
 "PLUGINS_PLUGIN_NOT_INSTALLED" => "Not Installed",
 "PLUGINS_INDEX_TABLE_PLUGIN" => "Plugin",
 "PLUGINS_INDEX_TABLE_STATUS" => "Status",
 "PLUGINS_INDEX_TABLE_OPTIONS" => "Options",
 "PLUGINS_INDEX_PLUGIN_TITLE" => "<b>Name: </b>",
 "PLUGINS_INDEX_PLUGIN_VERSION" => "<b>Version: </b>",
 "PLUGINS_INDEX_PLUGIN_AUTHOUR" => "<b>Authour: </b>",
 "PLUGINS_INDEX_PLUGIN_DESCR" => "<b>Description: </b>",
 
  
 // settings.php
 "PLUGINS_SETTINGS_TITLE" => "Modify Plguin Settings",
 "PLUGINS_SETTING_NO_FILE" => "<b>This plugin does not have a setting file.</b>",
 
 // setup.php
 "PLUGINS_SETUP_TITLE" => "Plugin Setup",
 "PLUGINS_SETUP_PLUGIN_ACTIVE" => "Enable this plugin?",
 "PLUGINS_SETUP_SELECT_MODULES" => "Modules to which this plugin will apply",
 "PLUGINS_SETUP_SELECT_GROUPS" => "Groups to which this plugin will apply",
 "PLUGINS_SETUP_SUCCESSFULL" => "Plugin was set up successfully",
 "PLUGINS_SETTINGS_UPDATED_SUCCESSFULLY" => "Plugin settings were updated successfully",
 "PLUGINS_SETUP_PLUGIN_INDEX_PAGE" => "Index Page",
 
 // install.php
 "PLUGIN_INSTALL_SUCCESSFUL" => "Plugin was installed successfully",
 "PLUGIN_INSTALL_UNSUCCESSFUL" => "Plugin was not installed successfully due to some errors",
 "PLUGIN_UNINSTALL_SUCCESSFUL" => "Plugin was successfully uninstalled",
 "PLUGIN_UNINSTALL_UNSUCCESSFUL" => "Plugin was not removed successfully due to some errors",

 'TEMP_HEAD_TITLE' => "Do It Yourself CMS - Control Panel",
 'TEMP_MAIN_WEBSITE' => "Main Website",
 'TEMP_LOGOUT' => "Logout",
 'TEMP_SUPPORT_FORUMS' => "Support Forums",
 'TEMP_SUPPORT_FORUMS_LINK' => "http://wwww.diy-cms.com/mod.php?mod=forum",
 'TEMP_DIY_WEBSITE' => "DiY-CMS Website",
 'TEMP_DIY_LINK' => "http://wwww.diy-cms.com/",
 
 'YES' => "Yes",
 'NO' => "No",
 'SETTINGS_DISPLAY_MAIN_PAGE' => "Display in main page:",
 'SETTINGS_SETTINGS_UPDATED_SUCCESSFULLY' => "Settings were updated successfully",
 'MODULES_SETTINGS_NO_SETTINGS_EXIST' => "<b>Settings file for this module does not exist.</b>",
 'MODULES_SETUP_UPDATED_SUCCESSFUL' => "Module settings were updated",
 'FORM_MODULE_PERMISSION' => "Permissions", 
 'MENUS_INDEX_UPDATE_SUCCESSFULL' => 'Menus were updated', 
);

?>