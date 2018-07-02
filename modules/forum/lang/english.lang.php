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
  * This file is part of forum module
  * 
  * @package	Modules
  * @subpackage	Forum
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

$admin_lang = array(
'mod_title'  => "Forum",
'mod_ver'  => get_diycms_version(),
'mod_auth'  => "Khr2003",
'mod_desc'  => "This module adds a forum to your website.",
'mod_user'  => "1,2,3,4,5",
'right_menu'  => "0",
'left_menu'  => "0",
'menuid'  => "1,2,3,4,5,6,7,8,9,10,11,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30",


'INSTALL_MOUDLE' => "Installing Forum module version 1.0 for DIY-CMS",
'QUERY_ERROR' => "<b>Query Erorr: </b> in query No. $query_cid  because:.<br>\n",
'QUERY_TEXT' => "Query",
'SETUP_DONE_ERROR' => "Setup has completed. However, there were some errors. Please refer to the documentation or to the support forum.",
'SETUP_DONE' => "Setup was completed Successfuly.",
'BACK_TO_MAIN' => "Go back to the modules page.",


'UNINSTALL_MOUDLE' => "Uninstalling Forum module version 1.0 ",
'UNINSTALL_CONFIRM' => 'Are you sure you want to delete this module?<br> You will delete all the data related to it, such as articls, blocks or anything else.',
'QUERY_ERROR' => "<b>Query Erorr: </b> in query No. $query_cid  because:.<br>\n",
'QUERY_TEXT' => "Query",
'UNINSTALL_DONE_ERROR' => "Uninstall has completed. However, there were some errors. Please refer to the documentation or to go the support forum.",
'UNINSTALL_DONE' => "Uninstall was completed Successfuly.",
'BACK_TO_MAIN' => "Go back to the modules page.",

'GENERAL_SETTINGS' => "General Settings",
'PERMISSIONS' => 'Permissions',
'MAXIMUN_POST_LETTERS' => "Maximum letters for a post",
'POSTS_PER_PAGE' => "Number of articles to view in a category",
'COMMENTS_PER_PAGE' => "Number of comments to view in an article",
'CAT_PER_ROW' => "Number of horizental columns to view categories",
'ORDER_POSTS_BY' => "Order articles in a category by",
'order_posts_by' => array('last_added' => 'Last added article',
						'last_added_comment' => 'Last added comment',
						'comments_number' => 'Comments number',
						'readers' => 'Readers'),
'SORT_POSTS_BY' => "Sort articles in a category by",
'sort_posts_by' => array('DESC' => 'Descending',
						'ASC' => 'Ascending'),
'MANAGE_CAT' => "Groupd allowed to add, edit and delete categories",
'EDIT_ALL_POSTS' => "Groups allowed to edit all posts",
'ADD_POST' => "Groups allowed to add a post",
'EDIT_OWN_POST' => "Groups allowed to edit their own posts",
'APPROVE_POSTS' => "Groups allowed to approve posts",
'WAIT' => "Group who will need their posts approved",
'MAXIMUM_UPLOAD_WIDTH' => "Maximum upload width<br>used for uploaded images",
'MAXIMUM_UPLOAD_HEIGHT' => "Maximum upload height<br>used for uploaded images",
'MAXIMUN_POST_EDIT_TIME' => "Time after which users can not edit their posts<br>in minutes",
'SEARCH_POSTS' => 'Groups allowed to search posts',
);


$lang = array( 

'LANG_ERROR_VALIDATE' => "Please go back and fill all the required fields.",
'LANG_ERROR_ADD_DB' => "There was an error inserting the data into the database.",
'LANG_ERROR_URL' => "There was an error retriving the url.",

//index.php
'INDEX_LIST_REPLIES' => "Replies",
'INDEX_LIST_THREADS' => "Threads",
'INDEX_LIST_LAST_POST' => "Last Post",
'INDEX_LIST_FORUM' => "Forum",
'INDEX_LIST_BY' => "By:",

'INDEX_STAT' => "Forum Statistics",
'INDEX_STAT_THREADS' => "Threads",
'INDEX_STAT_REPLIES' => "Replies",
'INDEX_STAT_MEMBERS' => "Members",
'INDEX_ONLINE' => "Online",
'INDEX_ONLINE_GUESTS' => "Guests",
'INDEX_ONLINE_USERS' => "Members",
'INDEX_ONLINE_TODAY' => "Members who were online today:",
'INDEX_FORUM_NEW_POSTS' => "New posts",
'INDEX_FORUM_NO_NEW_POSTS' => "No new posts",
'INDEX_FORUM_LOCKED' => "Locked forum",
'INDEX_USER_CONTROL_PANEL' => "User Profile",
'INDEX_LOGOUT' => "Logout",
'INDEX_USER_PM' => "Private messages",
'INDEX_CONTROL_FORUM' => "Forum Control Panel",
'INDEX_LOGIN_BAR_USERNAME' => "Username",
'INDEX_LOGIN_BAR_PASSWORD' => "Password",
'INDEX_LOGIN_BAR_SUBMIT' => "Submit",
'INDEX_LOGIN_BAR_SEND_DETAILES' => "I forgot my details",


// list.php
'LIST_SUBCAT' => "Sub categories",
'LIST_TITLE' => "Title",
'LIST_AUTHOR' => "Author",
'LIST_DATE_ADDED' => "Date added",
'LIST_READERS' => "Readers",
'LIST_COMMENTS' => "Comments",

// addpost.php
'ADDPOST_POST_HEAD' => "Add a post",
'ADDPOST_USERNAME' => "Username",
'ADDPOST_TITLE' => "Title",
'ADDPOST_SELECT_CAT' => "Selete a category",
'ADDPOST_POST' => "Your post",
'ADDPOST_UPLOAD_FILE' => "Upload a file",
'ADDPOST_SUBSCRIBE' => "Subscribe to this post",
'ADDPOST_POST_ADDED_SUCCESSFULLY' => "Your post was added successfully",
'ADDPOST_POST_NEED_APPROVAL' => "Thank you for adding your post.<br>Your post has to be approved by the admin.",

// viewpost.php
'VIEWPOST_POST_BY' => "By:",
'VIEWPOST_POST_DATEADDED' => "Date Added:",
'VIEWPOST_USER_REGISTER_DATE' => "Register date:",
'VIEWPOST_POST_COMMENTS' => "Comments: ",
'VIEWPOST_POST_READERS' => "Readers: ",
'VIEWPOST_USER_ALLPOSTS' => "User's total posts:",
'VIEWPOST_USER_SIGNATURE' => "Signature",
'VIEWPOST_READERS' => "Readers:",
'VIEWPOST_COMMENTS' => "Comments:",

// editpost.php
'EDITPOST_EDIT_NOT_ALLOWED' => "You are not allowed to edit this post.",
'EDITPOST_POST_HEAD' => "Edit a post",
'EDITPOST_USERNAME' => "Username",
'EDITPOST_TITLE' => "Title",
'EDITPOST_SELECT_CAT' => "Selete a category",
'EDITPOST_POST' => "Post",
'EDITPOST_SUBSCRIBE' => "Subscribe to this post",
'EDITPOST_POST_ADDED_SUCCESSFULLY' => "Post was edited successfully",
'EDITPOST_ALLOW_POST' => "Allow this post",
'EDITPOST_UPLOAD_FILE' => "Upload an attachment",
'EDITPOST_COMMENT_DELETED_SUCCESSFULLY' => "Post was deleted sucessfully",
'EDITPOST_NOT_ALLOWED' => "You are not allowed to enter this section",

// addcomment.php
'ADDCOMMENT_COMMENT_HEAD' => "Add a comment",
'ADDCOMMENT_USERNAME' => "Username",
'ADDCOMMENT_TITLE' => "Title",
'ADDCOMMENT_COMMENT' => "Comment",
'ADDCOMMENT_UPLOAD_FILE' => "Upload a file",
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

// search.php language
'SEARCH_HEAD' => "Search",
'SEARCH_KEYWORD' => "Keyword",
'SEARCH_POSTS_PER_PAGE' => "Number of results per page ",
'SEARCH_ORDER_BY' => "Order results by",
'SEARCH_SORT_BY' => "Sort results by",
'SEARCH_SEARCH_BUTTON' => "Search",
'SEARCH_FILL_ALL_REQUIRED_FIELDS' => "Please fill all the required fields.",


// misc .php langauge
'MISC_UNPIN_OR_OPEN_NOT_ABLE' => "You can not unpin or open this topic since it is not pinned or closed.",
'MISC_PIN_OR_OPEN_NOT_ABLE' => "You can not pin or open this topic since it already pinned or opend.",
'MISC_UNPIN_OR_CLOSE_NOT_ABLE' => "You can not unpin or close this topic since it already unpinned or closed.",
'MISC_PIN_OR_CLOSE_NOT_ABLE' => "You can not pin or close this topic since it already pinned or closed.",
'MISC_NO_ACTIONS_SELECTED' => "You did not select any actions for this topic.<br>Please go back and select an action to perform on this topic",
'MISC_ACTIONS_PERFORMED_SUCCESSFLY' => "Your action was performed succussfully on the topic.",
'MISC_ATTACHMENT_NOT_ALLOWED' => "You are not allowed to view this attachment",

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


// blocks folder langauge //
// control.block.php 
'BLOCKS_CONTROL_FORUM' => "Forum control panel",
'BLOCKS_ADDCAT' => "Add a category",
'BLOCKS_VIEW_EDIT' => "View/edit a category",
'BLOCKS_UNAPPROVED_POSTS' => "Pending posts",
'BLOCKS_UNAPPROVED_COMMENTS' => "Pending comments",

// control folder langauge //
// index.php 
'CONTROL_FORUM' => "Control panel",


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

// edit.php language
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

// approve_posts.php
'APPROVE_POSTS_UNAPPROVED_POSTS' => "Unapproved posts",
'APPROVE_POSTS_TOPIC' => "Topic",
'APPROVE_POSTS_AUTHOR' => "Author",
'APPROVE_POSTS_OPTIONS' => "Options",
'APPROVE_POSTS_POSTS_LIST' => "Unapproved posts list",
'APPROVE_POSTS_SELECT_ALL' => "Select All",
'APPROVE_POSTS_DESELECT_ALL' => "Deselect All",
'APPROVE_POSTS_DELETE_SELECTED' => "Delete Selected",
'APPROVE_POSTS_CONFIRM_DELETE' => "Are you sure you want to delete the selected post(s)?",
'APPROVE_POSTS_APPROVE_SELECTED' => "Approve Selected",
'APPROVE_POSTS_CHOOSE_CAT' => "Choose a category",
'APPROVE_POSTS_MOVE' => "Move",
'APPROVE_POSTS_MOVE_TO' => "Move to:",
'APPROVE_POSTS_SELECTED_POSTS_APPROVED' => "The selected posts were approved.",
'APPROVE_POSTS_NO_POSTS_SELECTED' => "No posts were selected.<br>Please go back and select at least at lease a one post.",
'APPROVE_POSTS_SELECTED_POSTS_DELETED' => "The selected posts were deleted",
'APPROVE_POSTS_SELECTED_POSTS_MOVED' => "The selected posts were moved",


// approve_comments.php
'APPROVE_COMMENTS_UNAPPROVED_COMMENTS' => "Unapproved comments",
'APPROVE_COMMENTS_TOPIC' => "Topic",
'APPROVE_COMMENTS_AUTHOR' => "Author",
'APPROVE_COMMENTS_OPTIONS' => "Options",
'APPROVE_COMMENTS_COMMENTS_LIST' => "Unapproved comments list",
'APPROVE_COMMENTS_SELECT_ALL' => "Select All",
'APPROVE_COMMENTS_DESELECT_ALL' => "Deselect All",
'APPROVE_COMMENTS_DELETE_SELECTED' => "Delete Selected",
'APPROVE_COMMENTS_CONFIRM_DELETE' => "Are you sure you want to delete the selected commentt(s)?",
'APPROVE_COMMENTS_APPROVE_SELECTED' => "Approve Selected",
'APPROVE_COMMENTS_CHOOSE_CAT' => "Choose a category",
'APPROVE_COMMENTS_SELECTED_POSTS_APPROVED' => "The selected comment were approved.",
'APPROVE_COMMENTS_NO_POSTS_SELECTED' => "No comments were selected.<br>Please go back and select at least at lease a one post.",
'APPROVE_COMMENTS_SELECTED_POSTS_DELETED' => "The selected comments were deleted",



'CONTROL_CATEGORIES' => 'Forum categories',
'CONTROL_ADD_NEW_CAT' => 'Add a new category',
'CONTROL_EDIT_VIEW_CAT' => 'View/edit a category',
'CONTROL_PENDING_POSTS' => 'View Pending posts',
'CONTROL_PENDING_COMMENTS' => 'View Pending comments',

'FORUM' => 'Forum',
'STICKY' => 'Sticky: ',
'ADD_POST' => 'Add Post',
'ADD_COMMENT' => 'Add Comment',
'STAT' => 'Stat',
'LATEST_POSTS_RSS' => 'Latest RSS',
'USER_NAME' => 'User name',
'USER_GROUP' => 'User group',
'USER_RANK' => 'User rank',
'USER_POSTS_NO' => 'User posts number',
'USER_REG_DATE' => 'User register date',
'CLOSED' => 'Closed Topic',
'CLOSED_TITLE' => '<span style="color:red;"> (CLOSED) </span>',
'TOP_5_READ' => 'Top 5 Read threads',
'TOP_5_COMMENTED' => 'Top 5 Commented threads',
'TOP_5_USERS' => 'Top 5 contributors',
'TOP_5_CATEGORIES' => 'Most active categories',
'READERS' => 'Readers: ',
'COMMENTES' => 'Comments: ',
'POSTS' => 'Posts: ',
'LAST_10_POSTS' => 'Last 10 Posts',
);

?>