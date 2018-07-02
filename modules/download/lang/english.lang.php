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
  * This file is part of download module
  * 
  * @package	Modules
  * @subpackage	Download
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */


$admin_lang = array(
'mod_title' => "Download",
'mod_ver' => "1.0",
'mod_auth' => "Khr2003",
'mod_desc' => "This module adds a donwload center to your website.",
'mod_user' => "1,2,3,4,5",
'right_menu' => "0",
'left_menu' => "1",
'INSTALL_MOUDLE' => "Installing Download module version 1.0 for diycms",
'QUERY_ERROR' => "<b>Query Erorr: </b> in query No. $query_cid  because:.<br>\n",
'QUERY_TEXT' => "Query",
'SETUP_DONE_ERROR' => "Setup has completed. However, there were some errors. Please refer to the documentation or to the support forum.",
'SETUP_DONE' => "Setup was completed Successfuly.",
'BACK_TO_MAIN' => "Go back to the modules page.",
'UNINSTALL_MOUDLE' => "Uninstalling Download module version 1.0 ",
'UNINSTALL_CONFIRM' => 'Are you sure you want to delete this module?<br> You will delete all the data related to it, such as articls, blocks or anything else.',
'QUERY_ERROR' => "<b>Query Erorr: </b> in query No. $query_cid  because:.<br>\n",
'QUERY_TEXT' => "Query",
'UNINSTALL_DONE_ERROR' => "Uninstall has completed. However, there were some errors. Please refer to the documentation or to go the support forum.",
'UNINSTALL_DONE' => "Uninstall was completed Successfuly.",
'BACK_TO_MAIN' => "Go back to the modules page.",
'GENERAL_SETTINGS' => "General Settings",
'PERMISSIONS' => 'Permissions',
'LIST_TYPE' => "Listing type in a category",
'list_type' => array(
'title' => "Title only",
'title_desc' => "Title and description"
),
'MAXIMUN_POST_LETTERS' => "Maximum letters for a post",
'POSTS_PER_PAGE' => "Number of articles to view in a category",
'COMMENTS_PER_PAGE' => "Number of comments to view in an article",
'ALLOWED_FILES' => "Allow these files for upload",
'MAXIMUM_UPLOAD_SIZE' => "Maximun upload size",
'CAT_PER_ROW' => "Number of horizental columns to view categories",
'ORDER_POSTS_BY' => "Order articles in a category by",
'order_posts_by' => array(
'last_added' => 'Last added article',
'last_added_comment' => 'Last added comment',
'comments_number' => 'Comments number',
'readers' => 'Readers'
),
'SORT_POSTS_BY' => "Sort articles in a category by",
'sort_posts_by' => array(
'DESC' => 'Descending',
'ASC' => 'Ascending'
),
'MANAGE_CAT' => "Groupd allowed to add, edit and delete categories",
'EDIT_ALL_POSTS' => "Groups allowed to edit all posts",
'ADD_POST' => "Groups allowed to add a post",
'EDIT_OWN_POST' => "Groups allowed to edit their own posts",
'APPROVE_FILES' => "Groups allowed to approve submissions",
'WAIT' => "Group who will need their posts approved",
'ALLOW_DOWNLOAD' => "Groups allowed to download files",
'MAXIMUN_POST_EDIT_TIME' => "Time after which users can not edit their posts<br>in minutes"
);


$lang = array(
'DOWNLOADS' => "Downloads",
'CHECK_ALL' => "Check All",
'UNCHECK_ALL' => "Uncheck all",
'DELETE' => "Delete",
'LANG_ERROR_VALIDATE' => "Please go back and fill all the required fields.",
'LANG_ERROR_ADD_DB' => "There was an error inserting the data into the database.",
'LANG_ERROR_URL' => "There was an error retriving the url.",
'LANG_MSG_NOT_VIEW_ATTACHMENTS' => "You can not view this attachment",

// list.php
'LIST_TITLE' => "Title",
'LIST_AUTHOR' => "Author",
'LIST_DATE_ADDED' => "Date added",
'LIST_READERS' => "Readers",
'LIST_COMMENTS' => "Comments",

// add_file.php
'ADDFILE_HEAD' => "Add a file",
'ADDFILE_USERNAME' => "Username",
'ADDFILE_TITLE' => "Title",
'ADDFILE_SELECT_CAT' => "Selete a category",
'ADDFILE_DESC' => "File description",
'ADDFILE_UPLOAD_FILE' => "OR upload a file",
'ADDFILE_SUBSCRIBE' => "Subscribe to this post",
'ADDFILE_FILE_ADDED_SUCCESSFULLY' => "File was added successfully",
'ADDFILE_FILE_NEED_APPROVAL' => "Thank you for adding this post.<br>It has to be approved by the admin.",
'ADDFILE_FILE_SIZE' => "File size",
'ADDFILE_SIZE_UNIT' => "Size unit",
'ADDFILE_LINK' => "Enter link to the file",
'ADDFILE_IMAGE_LINK' => "File image",
'ADDFILE_EMPTY_SUBMISSION' => "You have to either enter a link to the file or upload the file",

// view_file.php
'VIEWFILE_FILE_DETAILS' => "File detailes",
'VIEWFILE_FILE_BY' => "By:",
'VIEWFILE_FILE_NAME' => "File name:",
'VIEWFILE_FILE_SIZE' => "Size:",
'VIEWFILE_FILE_CLICKS' => "Clicks:",
'VIEWFILE_FILE_VOTES' => "Votes:",
'VIEWFILE_FILE_RATING' => "Ratings:",
'VIEWFILE_DATE_ADDED' => "Date added:",
'VIEWFILE_FILE_DESC' => "Description:",
'VIEWFILE_READERS' => "Readers:",

// edit_file.php
'EDITFILE_EDIT_NOT_ALLOWED' => "You are not allowed to edit this post.",
'EDITFILE_FILE_HEAD' => "Edit a file",
'EDITFILE_USERNAME' => "Username",
'EDITFILE_TITLE' => "Title",
'EDITFILE_SELECT_CAT' => "Selete a category",
'EDITFILE_DESC' => "Description",
'EDITFILE_SUBSCRIBE' => "Subscribe to this post",
'EDITFILE_FILE_ADDED_SUCCESSFULLY' => "File was edited successfully",
'EDITFILE_ALLOW_FILE' => "Allow this file",
'EDITFILE_UPLOAD_FILE' => "Upload a file",
'EDITFILE_FILE_DELETED_SUCCESSFULLY' => "File was deleted sucessfully",
'EDITFILE_NOT_ALLOWED' => "You are not allowed to enter this section",
'EDITFILE_EMPTY_LINK_NOT_ALLOWED' => "You have to enter a link if you deleted the uploaded file",

// addcomment.php
'ADDCOMMENT_COMMENT_HEAD' => "Add a comment",
'ADDCOMMENT_USERNAME' => "Username",
'ADDCOMMENT_TITLE' => "Title",
'ADDCOMMENT_COMMENT' => "Comment",
'ADDCOMMENT_UPLOAD_FILE' => "Add an attachment",
'ADDCOMMENT_SUBSCRIBE' => "Subscribe to this comment",
'ADDCOMMENT_POST_ADDED_SUCCESSFULLY' => "Your comment was added successfully",
'ADDCOMMENT_POST_NEED_APPROVAL' => "Thank you for adding your comment.<br>Your comment has to be approved by the admin.",

// editcomment.php
'EDITCOMMENT_EDIT_NOT_ALLOWED' => "You are not allowed to edit this post.",
'EDITCOMMENT_POST_HEAD' => "Edit a comment",
'EDITCOMMENT_USERNAME' => "Username",
'EDITCOMMENT_TITLE' => "Title",
'EDITCOMMENT_COMMENT' => "Comment",
'EDITCOMMENT_POST_EDITED_SUCCESSFULLY' => "Post was edited successfully",
'EDITCOMMENT_ALLOW_POST' => "Allow this post",
'EDITCOMMENT_UPLOAD_FILE' => "Add an attchment",
'EDITCOMMENT_COMMENT_DELETED_SUCCESSFULLY' => "Comment was deleted successfully.",
'EDITCOMMENT_NOT_ALLOWED' => "You are not allowed to performe this action.",

// misc.php langauge
'MISC_UNPIN_OR_OPEN_NOT_ABLE' => "You can not unpin or open this file since it is not pinned or closed.",
'MISC_PIN_OR_OPEN_NOT_ABLE' => "You can not pin or open this file since it already pinned or opend.",
'MISC_UNPIN_OR_CLOSE_NOT_ABLE' => "You can not unpin or close this file since it already unpinned or closed.",
'MISC_PIN_OR_CLOSE_NOT_ABLE' => "You can not pin or close this file since it already pinned or closed.",
'MISC_NO_ACTIONS_SELECTED' => "You did not select any actions for this file.<br>Please go back and select an action to perform on this file",
'MISC_ACTIONS_PERFORMED_SUCCESSFLY' => "Your action was performed succussfully on the file.",
'MISC_RATE_FILE' => "Please select a rating for this file.<br> 5 is a high rating while 1 is a low rating.",
'MISC_RATE_FILE_RATE_ADDED' => "Your rating has been added successfully.",


// Includes folder langauge //
// functions.php
'INCLUDES_FUNCTIONS_ADMIN_MENU' => "Admin Menu:",
'INCLUDES_FUNCTIONS_ADMIN_MENU_CHOOSE' => "Choose one these options:",
'INCLUDES_FUNCTIONS_ADMIN_MENU_EDIT' => "Edit this post",
'INCLUDES_FUNCTIONS_ADMIN_MENU_PIN' => "Pin this post",
'INCLUDES_FUNCTIONS_ADMIN_MENU_UNPIN' => "Unpin this post",
'INCLUDES_FUNCTIONS_ADMIN_MENU_CLOSE' => "Close this post",
'INCLUDES_FUNCTIONS_ADMIN_MENU_UNCLOSE' => "Open this post",
'INCLUDES_FUNCTIONS_ATTACHMENT' => "Attachment",
'INCLUDES_FUNCTIONS_ATTACHMENT_SIZE' => "Size:",
'INCLUDES_FUNCTIONS_ATTACHMENT_NAME' => "Attachment name:",
'INCLUDES_FUNCTIONS_ATTACHMENT_CLICKS' => "Clicks",
'INCLUDES_FUNCTIONS_FILE' => 'Uploaded file',
'INCLUDES_FUNCTIONS_KEEP_FILE' => 'Keep file',
'INCLUDES_FUNCTIONS_REPLACE_FILE' => 'Replace file',
'INCLUDES_FUNCTIONS_REMOVE_FILE' => 'Remove file',


// blocks folder langauge //
// control.block.php
'BLOCKS_CONTROL_DOWNLOAD' => "Download Control Panel",
'BLOCKS_ADDCAT' => "Add a category",
'BLOCKS_VIEW_EDIT' => "View/edit a category",
'BLOCKS_PENDING_FILES' => "Pending files",
'BLOCKS_PENDING_COMMENTS' => "Pending comments",


// control folder langauge //
// index.php
'CONTROL_DOWNLOAD' => "Control panel",
'CONTROL_ADD_CATEGORY' => "Add a new category",
'CONTROL_EDIT_CATEGORY' => "View/edit a category",



// Addcat.php language
'CONTROL_ADDCAT' => "Add a category",
'CONTROL_ADDCAT_TITLE' => "Title",
'CONTROL_ADDCAT_ORDER' => "Order",
'CONTROL_ADDCAT_PARENT_CAT' => "Parent category",
'CONTROL_ADDCAT_DESC' => "Description",
'CONTROL_ADDCAT_CAT_EMAIL' => "New posts notfications email",
'CONTROL_ADDCAT_CAT_IMAGE' => "Category image",
'CONTROL_ADDCAT_ALLOW_VIEW' => "Groups allowed to view <br>this category",
'CONTROL_ADDCAT_ALLOW_POST' => "Groups allowed to add <br>posts to this category",
'CONTROL_ADDCAT_CLOSED' => "Close this category?<br>(Archive only)",
'CONTROL_ADDCAT_SUCCESSFUL' => "Category was added successfully.",
'CONTROL_ADDCAT_WRONG_EMAIL' => "The email you entered is not valid.<br>please go back and enter a valid email",



// edit_cat.php language
'CONTROL_EDITCAT' => "Edit a category",
'CONTROL_EDITCAT_TITLE' => "Title",
'CONTROL_EDITCAT_ORDER' => "Order",
'CONTROL_EDITCAT_PARENT_CAT' => "Parent category",
'CONTROL_EDITCAT_DESC' => "Description",
'CONTROL_EDITCAT_CAT_EMAIL' => "New posts notfication email",
'CONTROL_EDITCAT_CAT_IMAGE' => "Category image",
'CONTROL_EDITCAT_ALLOW_VIEW' => "Groups allowed to view <br>this category",
'CONTROL_EDITCAT_ALLOW_POST' => "Groups allowed to add <br>posts to this category",
'CONTROL_EDITCAT_CLOSED' => "Close this category?<br>(Archive only)",
'CONTROL_EDITCAT_SUCCESSFUL' => "Category was edited successfully.",
'CONTROL_EDITCAT_WRONG_EMAIL' => "The email you entered is not valid.<br>please go back and enter a valid email",
'CONTROL_EDITCAT_CAT_CURRENT_IMAGE' => "Current category image:",
'CONTROL_EDITCAT_CAT_REPLACE_IMAGE' => "Add/replace a category image",



// viewcat.php langauge
'CONTROL_VIEWCAT' => "View categories",
'CONTROL_VIEWCAT_TITLE' => "Title",
'CONTROL_VIEWCAT_OPTIONS' => "Options", 




// misc.php lanauge
'MISC_DELETE_CAT_IMAGE_UNSUCCESSFUL' => "Image was not deleted.",
'MISC_DELETE_CAT_IMAGE_SUCCESSFUL' => "Image was deleted successfully.",
'MISC_DELETE_CAT_CHOOSE' => "Choose one of these options:",
'MISC_DELETE_CAT_DELETE_ALL' => "Delete all category's posts and their relative comments or attachments",
'MISC_DELETE_CAT_MOVE_DELETE' => "Delete the category but move the posts to this category",
'MISC_DELETE_CAT_CHOOSE_CAT' => "Choose the new category",
'MISC_DELETE_CAT' => "Delete category",
'MISC_DELETE_CAT_SUCCESSFUL' => "The selected category was deleted successfully.",
'MISC_DELETE_CAT_UNSUCCESSFUL' => "Category removal was unsuccessful.",
'MISC_DELETE_CAT_CONTAIN_SUBCAT' => "You can not remove this category because it contains sub-categories.<br>Please remove the sub cateogries first before removing this one.",
'MISC_DELETE_POST_SUCCESSFUL' => "Post was deleted successfully.",
'MISC_DELETE_POST_NOT_ALLOWED' => "You are not allowed to delete this post",




// approve_submissions.php
'APPROVE_FILES_PENDING_FILES' => "Pending files",
'APPROVE_FILES_TOPIC' => "Topic",
'APPROVE_FILES_AUTHOR' => "Author",
'APPROVE_FILES_OPTIONS' => "Options",
'APPROVE_FILES_POSTS_LIST' => "Pending files list",
'APPROVE_FILES_SELECT_ALL' => "Select All",
'APPROVE_FILES_DESELECT_ALL' => "Deselect All",
'APPROVE_FILES_DELETE_SELECTED' => "Delete Selected",
'APPROVE_FILES_CONFIRM_DELETE' => "Are you sure you want to delete the selected post(s)?",
'APPROVE_FILES_APPROVE_SELECTED' => "Approve Selected",
'APPROVE_FILES_CHOOSE_CAT' => "Choose a category",
'APPROVE_FILES_MOVE' => "Move",
'APPROVE_FILES_MOVE_TO' => "Move to:",
'APPROVE_FILES_SELECTED_POSTS_APPROVED' => "The selected posts were approved.",
'APPROVE_FILES_NO_POSTS_SELECTED' => "No posts were selected.<br>Please go back and select at least at lease a one post.",
'APPROVE_FILES_SELECTED_POSTS_DELETED' => "The selected posts were deleted",
'APPROVE_FILES_SELECTED_POSTS_MOVED' => "The selected posts were moved",



// approve_comments.php
'APPROVE_COMMENTS_PENDING_COMMENTS' => "Pending comments",
'APPROVE_COMMENTS_TOPIC' => "Topic",
'APPROVE_COMMENTS_AUTHOR' => "Author",
'APPROVE_COMMENTS_OPTIONS' => "Options",
'APPROVE_COMMENTS_COMMENTS_LIST' => "Pending comments list",
'APPROVE_COMMENTS_SELECT_ALL' => "Select All",
'APPROVE_COMMENTS_DESELECT_ALL' => "Deselect All",
'APPROVE_COMMENTS_DELETE_SELECTED' => "Delete Selected",
'APPROVE_COMMENTS_CONFIRM_DELETE' => "Are you sure you want to delete the selected comment(s)?",
'APPROVE_COMMENTS_APPROVE_SELECTED' => "Approve Selected",
'APPROVE_COMMENTS_CHOOSE_CAT' => "Choose a category",
'APPROVE_COMMENTS_SELECTED_POSTS_APPROVED' => "The selected comment were approved.",
'APPROVE_COMMENTS_NO_POSTS_SELECTED' => "No comments were selected.<br>Please go back and select at least at lease a one post.",
'APPROVE_COMMENTS_SELECTED_POSTS_DELETED' => "The selected comments were deleted",



'CONTROL_CATEGORIES' => 'Download categories',
'CONTROL_ADD_NEW_CAT' => 'Add a new category',
'CONTROL_EDIT_VIEW_CAT' => 'View/edit a category',
'CONTROL_PENDING_POSTS' => 'View Pending posts',
'CONTROL_PENDING_COMMENTS' => 'View Pending comments',
);

?>