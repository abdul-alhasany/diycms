<?php
/*
+===============================================================================+
|      					DIY-CMS V1.0.0 Copyright © 2011   						|
|   	--------------------------------------------------------------   		|
|                    				BY                    						|
|              				ABDUL KAHHAR AL-HASANY            					|
|   																	   		|
|      					Web: http://www.diy-cms.com      						|
|   	--------------------------------------------------------------   		|
|	This file is part of DiY-CMS.												|
|   DiY-CMS is free software: you can redistribute it and/or modify				|
|   it under the terms of the GNU General Public License as published by		|
|   the Free Software Foundation, either version 3 of the License, or			|
|   (at your option) any later version.											|
|   DiY-CMS is distributed in the hope that it will be useful,					|
|   but WITHOUT ANY WARRANTY; without even the implied warranty of				|
|   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the				|
|   GNU General Public License for more details.								|
|   You should have received a copy of the GNU General Public License			|
|   along with DiY-CMS.  If not, see <http://www.gnu.org/licenses/>.			|
+===============================================================================+
*/

/**
  * This file is part of users module
  * 
  * @package	Modules
  * @subpackage	Users
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */
  
$admin_lang = array(
'mod_title'  => "Users",
'mod_ver'  => "1.0",
'mod_auth'  => "Khr2003",
'mod_desc'  => "This module controls all matters related to the members of your website.",
'mod_user'  => "1,2,3,4,5",
'right_menu'  => "0",
'left_menu'  => "1",
'menuid'  => "1,2,3,4,5,6,7,8,9,10,11,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30",


'INSTALL_MOUDLE' => "Installing Users module version 1.0 for diycms",
'QUERY_ERROR' => "<b>Query Erorr: </b> in query No. $query_cid  because:.<br>\n",
'QUERY_TEXT' => "Query",
'SETUP_DONE_ERROR' => "Setup has completed. However, there were some errors. Please refer to the documentation or to the support forum.",
'SETUP_DONE' => "Setup was completed Successfuly.",
'BACK_TO_MAIN' => "Go back to the modules page.",


'UNINSTALL_MOUDLE' => "Uninstalling Users module version 1.0 ",
'UNINSTALL_CONFIRM' => 'Are you sure you want to delete this module?<br> You will delete all the data related to it, such as articls, blocks or anything else.',
'QUERY_ERROR' => "<b>Query Erorr: </b> in query No. $query_cid  because:.<br>\n",
'QUERY_TEXT' => "Query",
'UNINSTALL_DONE_ERROR' => "Uninstall has completed. However, there were some errors. Please refer to the documentation or to the support forum.",
'UNINSTALL_DONE' => "Uninstall was completed Successfuly.",
'BACK_TO_MAIN' => "Go back to the modules page.",

'GENERAL_SETTINGS' => "General Settings",
'ALLOW_REGISTRATION' => "Allow registration in your website?",
'USERS_PER_PAGE' => "Number of users to view per page in the users list",
'REG_STATUS' => "Status of newly registerd users",
'reg_status' => array ( "approved" => "Approved",
                        "email_confirm" => "Confirmation through email",
                        "admin_confirm" => "Confirmation by admin"
                                     ),
'ALLOW_BBCODE' => "Allow BB code in users' signatures?",
'AVATAR_MAX_WIDTH' => "Maximum width for user's avatar",
'AVATAR_MAX_HEIGHT' => "Maximum height of user's avatar",
'MAXIMUM_MESSAGES' => "Maximum messages a user can keep in inbox",
'SIGNATURE_MAX_LETTERS' => "Maximum letters of user's signature",
'REG_CONDITIONS' => "Registration policy",
'PERMISSIONS' => "Permissions",
'VIEW_MEMBERS_LIST' => "Groups allowed to view members list",
'EDIT_MEMBER' => "Groups allowed to add, edit and delete users",
'APPROVE_NEW_MEMBERS' => "Groups allowed to approve newly registerd users",
'EMAIL_MEMBERS' => "Groups allowed to send bulk messages to users",
'EDIT_RANKS' => "Groups allowed to edit users' ranks",
'SEARCH_MEMBERS' => "Groups allowed to search the users",
'ALLOWED_PM' => "Group allowed to use the private messages system",
'ALERT_PM_TITLE' => "Email's title alerting the user of a private message",
'' => "",


);


$lang = array( 
'LANG_ERROR_VALIDATE' => "Please go back and fill all the required fields.",
'LANG_ERROR_ADD_DB' => "There was an error inserting the data into the database.",
'LANG_ERROR_SCOPE_SEARCH' => "Please select a member to search",
'LANG_MSG_LOGED_IN' => "You have logged in ",
'LANG_MSG_LOGED_OUT' => "You have logged out",
'LANG_ERROR_PM_URL' => "There was an error retriving the url.",
'LANG_ERROR_PM_FULL' => "User's inbox is full.",

'ID' => "ID",
'NAME' => "Username",
'ALL_POSTS' => "Posts",
'REGISTRATION_DATE' => "Registration date",
'HOTMAIL' => "Hotmail",
'YAHOO' => "Yahoo",
'OTHER' => "Other",
'USERSEARCH' => "Search users",
'SEARCH' => "Search",
'USER_GROUP' => "Usergroup",
'REG_DATE' => "Registration",
'DESC' => "DESC",
'ASC' => "ASC",
'ORDER' => "ORDER",
'ORDER_LIST' => "Order list by",

	
//signup file language
'REGISTERATION_CLOSED' => "Registration is closed. Please try again later.",
'SIGNUP' => "Signup",
'USERNAME' => "Desired username",
'PASSWORD' => "Password",
'PASSWORD2' => "Confirm Password",
'EMAIL' => "Email",
'EMAIL2' => "Confirm Email",
'WEBSITE' => "Website",
'SHOW_EMAIL' => "Allow public to view your email?",
'GENDER' => "Gender",
'BIRTHDATE' => "Date of birth<br>use this format (dd/mm/yyyy)",
'LOCATION' => "Location",
'YAHOO' => "Yahoo Email",
'HOTMAIL' => "MSN email",
'ICQ' => "ICQ",
'AIM' => "AIM",
'UPLOAD_AVATAR'=> "Upload an avatar",
'CURRENT_AVATAR'=> "Avatar",
'THEME' => "Select a theme",
'SIGNATURE' => "Enter Signature",
'OPTIONAL' => "Optional",
'TITLE_REGISTRATION' => "Rigestration",
'USER_ALREADY' => "It seems that you are already registered in our website.",
'EMAIL_CONFIRMATION' => "Registration form has been sent. You have to confirm your registration through email.",
'ADMIN_CONFIRMATION' => "Your registration will be confirmed by the administrator.",
'SUCCESSFUL_REGISTRATION' => "You have been registered successfully.",
'ERROR_VALIDATE' => "Please fill all the required fields.",
'ERROR_USERNAME_MUST_BE' => "Username should consists only of letters and numbers",
'ERROR_USERNAME_MUST_MORE' => "Username must be more than 3 characters",
'ERROR_USERNAME_EXISTED' => "The username you entered already exists in the database.",
'ERROR_PASS_MUST_MORE' => "Password must be more than 3 characters",
'ERROR_PASS_EQUAL' => "Password fields are not identical.",
'ERROR_VALID_EMIAL' => "Please enter a valid email.",
'ERROR_EMAIL_EQUAL' => "Email fields are not identical.",
'ERROR_EMIAL_EXISTED' => "The email your entered already exists in the database.",
'ERROR_LETTER_MAX' => "Your signature exceeded the maximum characters allowed.",
'ERROR_LOGIN' => "Username, password or both is not correct. Please go back and make sure you enter the right details.",
'ERROR_NOT_ACTIVATED' => "Your membership is not activated yet.",

// Info page language
'USER_INFO' => "User details",
'INFO_REGISTER_DATE' => "Registeration date",
'INFO_USER_RANK' => "User rank",
'INFO_USER_EMAIL' => "User email",
'INFO_USER_WEBSITE' => "Website",
'INFO_USER_CONTACT' => "Contact",
'INFO_USER_ALLPOSTS' => "All posts",
'INFO_USER_AVATAR' => "Avatar",
'INFO_ADDITIONAL_INFORMATION' => "Additional information",
'INFO_USER_BIRTHDATE' => "Birthdate",
'INFO_USER_YAHOO' => "Yahoo",
'INFO_USER_HOTMAIL' => "Hotmail",
'INFO_USER_ICQ' => "ICQ",
'INFO_USER_AIM' => "AIM",
'INFO_USER_SIGNATURE' => "User's signautre",
'INFO_EDIT_USER' => "Edit",
'INFO_DEL_USER' => "Delete",


// EDIT FILE LANGUAGE
'EDIT_NOT_ALLOWED' => "You are not allowed to access this area.",
'EDIT_PROFILE' => "Edit profile",
'EDIT_SUCCESSFUL' => "Profile was edited successfully.",
'EDIT_DELETED_SUCCESSFULY' => "User had been deleted successfully.",
'EDIT_CHANGE_PASSWORD' => "Change your password",
'EDIT_CURRENT_PASSWORD' => "Enter your current password",
'EDIT_NEW_PASSWORD' => "Enter your new password",
'EDIT_CONFIRM_PASSWORD' => "Confirm new password",
'EDIT_ERROR_PASSWORD_SHORT' => "The new password had to be more than 4 characters. ",
'EDIT_ERROR_PASSWORD_NOT_IDENTICAL' => "The charcters you entered in the new password fields are not identical.",
'EDIT_PASSWORD_CHANGED_SUCCESSFULLY' => "Password has been changed successfully.",
'EDIT_ERROR_PASSWORD_NOT_CORRECT' => "The password you entered is not correct.",


// MISC file language
'MISC_DELETE_UNSUCCESSFUL' => "Avatar was not deleted.",
'MISC_DELETE_SUCCESSFUL' => "Avatar was deleted succssfully.",

// Control folder langauge //

//Index file
'CONTROL_USERS' => "Control Panel",
'CONTROL_NEWUSER_ADD_USER' => "Add new user",
'CONTROL_PENDING_USERS' => "Pending users",
'CONTROL_EMAIL_USERS' => 'Send Bulk Messages',
'CONTROL_USER_RANKS' => 'User Ranks',
'CONTROL_CONFIRM_DELETE_RANK' => 'Are you sure you want to delete this rank: ',

// newusers.php language
'CONTROL_CONFIRM_DELETE' => "Do you want to remove the selected signatures?",
'CONTROL_DELETE' => "Delete",
'CONTROL_APPROVE' => "Approve",
'CONTROL_CHECK_ALL' => "Check All",
'CONTROL_UNCHECK_ALL' => "Uncheck All",
'CONTROL_EDIT_USER' => "Edit",
'CONTROL_DELETE_USER' => "Delete",
'CONTROL_NO_USERS_SELECTED' => "No user selected.<br>Please select at least one user.",
'CONTROL_USERS_REMOVED' => "The selected users were removed.",
'CONTROL_USERS_APPROVED' => "The selected usere were approved.",

//userranks.php language
'CONTROL_USERRANKS_ADD_RANK' => "Add a user rank",
'CONTROL_USERRANKS_TITLE' => "Rank title",
'CONTROL_USERRANKS_POSTS_NUMBER' => "Number of posts to attain this rank",
'CONTROL_USERRANKS_ICON_NUMBER' => "Number of icons representing the rank",
'CONTROL_USERRANKS_RANK_ADDED' => "The user rank has been added.",
'CONTROL_USERRANKS_VIEW_RANKS' => "Current ranks",
'CONTROL_USERRANKS_RANKAVATAR' => "Rank Avatar",
'CONTROL_USERRANKS_RANK_REMOVED' => "User rank is removed.",
'CONTROL_USERRANKS_RANK_NOT_REMOVED' => "User rank is not removed due to some errors.",
'CONTROL_USERRANKS_REPLACE_RANKAVATAR' => "Replace current rank avatar:<br>Leave blank to keep current avatar",
'CONTROL_USERRANKS_EDIT_RANK' => "Edit a user rank",
'CONTROL_USERRANKS_RANK_EDITED' => "User rank is edited",

// BLOCKS FOLDER LANGUAGE //
// control.block.php

'BLOCKS_CONTROL_USERS' => "Control Panel",
'BLOCKS_ADDUSER' => "Add a new user",
'BLOCKS_SEND_BULK_MESSAGES' => "Send bulk messages",
'BLOCKS_PENDING_USERS' => "Pending Users",
'BLOCKS_EDIT_RANKS' => "Edit Ranks",


// PM FOLDER LANGUAGE //

// index.php language
'PM_INBOX' => "Inbox",
'PM_OUTBOX' => "Outbox",
'PM_SAVE_BOX' => "Saved messages",
'PM_MSG_TITLE' => "Message title",
'PM_MSG_DATE' => "Message date",
'PM_MSG_OPTIONS' => "Message options",
'PM_MSG_OPTIONS_CHOOSE' => "Choose from the list:",
'PM_MSG_OPTIONS_SAVE' => "Save messages",
'PM_MSG_OPTIONS_DELETE' => "Delete messages",
'PM_MSG_OPTIONS_EXPORT' => "Export messages",
'PM_MSG_OPTIONS_MARK_READ' => "Mark as read",
'PM_MSG_OPTIONS_MARK_UNREAD' => "Mark as unread",
'PM_MSG_OPTIONS_DO' => "Select",
'PM_MSG_OPTIONS_SELECTALL' => "Select all",
'PM_MSG_OPTIONS_UNSELECT' => "Unselect all",
'PM_MSG_READ' => "Read messages",
'PM_MSG_UNREAD' => "Unread messages",
'PM_MSG_REPLIED' => "Replied messages",
'PM_FROM' => "From",
'PM_TO' => "To",
'PM_BY' => "By",
'VIEW_MESSAGE' => "View message",

//sendpm.php langauge 
'PM_SENDPM_SENDTO' => "Send to",
'PM_SENDPM_MSG_TITLE' => "Message title",
'PM_SENDPM_MSG_TEXT' => "Message",
'PM_SENDPM_SENDPM' => "Send a private message",
'PM_SENDPM_USERNAME_NOT_EXIST' => "The username does not exist in our databse",
'PM_SENDPM_USER_INBOX_FULL' => "User's inbox is full and can not receive this message",
'PM_SENDPM_YOUR_OUTBOX_FULL' => "You outbox is full, please delete any messages you no longer need in order to send this message to the designated user.",
'PM_SENDPM_MSG_IS_SENT' => "The private message is sent.",
'PM_SENDPM_MSG_IS_NOT_SENT' => "Message is not sent due to some errors",
'PM_MSG_SENDER' => "Username",
'PM_REG_DATE' => "Regisration",
'PM_SENDER_POSTS' => "Posts",

// manage.php lanauge
'MANAGE_MESSAGE_IS_SAVED' => "Messages has been saved.",
'MANAGE_MESSAGE_IS_DELETED' => "Messages has been deleted.",
'MANAGE_MESSAGE_IS_NOT_SELECTED' => "You did not select any meessages. Please select at least one message.",
'MANAGE_SELECTED_MESSAGES_SENT' => "The selected messages have been sent.",
'MANAGE_SELECTED_MESSAGES_ALREADY_SAVED' => "The selected messages are already saved.",
'MANAGE_SELECTED_MESSAGES_DELETED' => "The selected messages were deleted.",
'MANAGE_SELECTED_MESSAGES_MARKED_READ' => "The selected messages were marked as read.",
'MANAGE_SELECTED_MESSAGES_MARKED_UNREAD' => "The selected messages were marked as unread.",
'MANAGE_NO_ACTIONS_SELECTED' => "You did no select any action to perform on selected messages.",

// reply.php language
'REPLY_PRIVATE_MESSAGE' => "Reply a private message",
'REPLY_MSG_REPLY' => "Re",
'REPLY_SEND_TO' => "Send to",
'REPLY_MSG_TITLE' => "Message title",
'REPLY_MSG_TEXT' => "Message",


'MESSAGE_SENT_SUCCESSFUL' => "Message was sent successfully",
'USERS_DELETE_CURRENT_AVATAR' => "Delete Current Avatar",
'USERS_NO_AVATAR' => "Avatar Does not exist",
'REPLY' => "reply",
'USAGE' => "You used %d messages out of %d",
'PERCENTAGE' => "Percentage",
'CONTROL_EMAILUSERS_ALL_GROUPS' => "All Groups",
'CONTROL_EMAILUSERS_SELECT_GROUPS' => "Select a group",
'CONTROL_EMAILUSERS_MSG_TITLE' => "Message Title",
'CONTROL_EMAILUSERS_MSG_POST' => "Message",

'PM' => 'PM',
'EDIT_PROFILE' => 'Edit profile',
'CHANGE_PASSWORD' => 'Change password',
'PROFILE' => 'Profile',
'NONE' => 'None',
'MALE' => 'Male',
'FEMALE' => 'Female',
'SEND_PM' => 'Send Private Message',
'HIDDEN' => '(Hidden) ',
'SEND_PM' => 'Send PM',
'REGISTER_POLICY' => 'Register Policy',
'REMIND_ME' => "Remind me",
'ACTIVATION' => "Activation",
'ACTIVATION_SUCCESSFUL' => "Your account has been activated",
'ACTIVATION_SUBJECT' => "Account Activation at {sitetitle}",
'ACTIVATION_MSG' => 'Welcome: <b>{username}</b><br><br>We would like to thank you for registering in our website<br><br>We require all newly-regiester members to take this step. It is important to prevent spam registration.<br><br>To activate your account please click on the link below:
<br><br>{url}<br><br>If you have any problems please contact us at this email: <b>{sitemail}</b><br><br>Kind Regards<br><br>{sitetitle} Website',
'EMAIL_DOES_NOT_EXIST' => "The email that you entered does not exist or your membership is not activated yet",
'REMIND_ME_EMAIL' => "Hello<br><br>You have requested your login information at {sitetitle}<br><br>Here they are:<br><br>Username: {username}<br>Temporary Password: {password}<br><br>{sitetitle}",
'REMIND_ME_SUBJECT' => "Membership details at {sitetitle}",
'REMIND_ME_SUCCESSFUL' => "Details were sent to your email",
'PAGE_DOES_NOT_EXIST' => "The Page your requested does not exist",
'MESSAGE_NOTIFICATION' => "Hello<br><br><b>{name}</b> has sent you a private message.<br><br>To view this message please go to this link<br><br>{url}<br><br>Kind regards<br><br>{sitetitle} Website<br>",
'MESSAGE_REPLY_NOTIFICATION' => "Hello<br><br><b>{name}</b> has sent you a reply to your private message.<br><br>To view the reply please go to this link<br><br>{url}<br><br>Kind regards<br><br>{sitetitle} Website<br>",
'NEW_SIGNUP' => "Hello Admin<br><br>A new user signed up and your permission is requried to grant him activation.<br><br>Please go to this link: {url} and login to review the user information.",
'NEW_SIGNUP_SUBJICT' => "A new user signed up",
'RANK_DESC' => 'Desc',
'RANK_POST_NO' => 'umber of posts',
'RANK_ICONS' => 'Icons',
'RANK_IMAGE' => 'Image',
'RANK_RANK_IMAGE' => 'Rank Image',
'RANK_OPTIONS' => 'Options',
);

$letters = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
?>