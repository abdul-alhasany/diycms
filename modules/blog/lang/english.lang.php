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

$admin_lang = array(
'mod_title'  => "Blog",
'mod_ver'  => "1.0",
'mod_auth'  => "Khr2003",
'mod_desc'  => "This module adds the ability of posting blogs on your website",
'mod_user'  => "1,2,3,4,5",
'right_menu'  => "0",
'left_menu'  => "1",
'menuid'  => "1,2,3,4,5,6,7,8,9,10,11,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30",

'BLOG_CONTROL' => "Blog Control",
'BLOG_CATEGORIES' => "Blog categories",
'BLOG_TAGS_CLOUD' => "Blog Tags Cloud",
'BLOG_ARCHIVE' => "Blog Archive",

'INSTALL_MOUDLE' => "Installing Blog module version 1.0 for diycms",
'QUERY_ERROR' => "<b>Query Erorr: </b> in query No. $query_cid  because:.<br>\n",
'QUERY_TEXT' => "Query",
'SETUP_DONE_ERROR' => "Setup has completed. However, there were some errors. Please refer to the documentation or to the support forum.",
'SETUP_DONE' => "Setup was completed Successfuly.",
'BACK_TO_MAIN' => "Go back to the modules page.",


'UNINSTALL_MOUDLE' => "Uninstalling Blog module version 1.0 ",
'UNINSTALL_CONFIRM' => 'Are you sure you want to delete this module?<br> You will delete all the data related to it, such as articls, blocks or anything else.',
'QUERY_ERROR' => "<b>Query Erorr: </b> in query No. $query_cid  because:.<br>\n",
'QUERY_TEXT' => "Query",
'UNINSTALL_DONE_ERROR' => "Uninstall has completed. However, there were some errors. Please refer to the documentation or to go the support forum.",
'UNINSTALL_DONE' => "Uninstall was completed Successfuly.",
'BACK_TO_MAIN' => "Go back to the modules page.",

'GENERAL_SETTINGS' => "General Settings",
'PERMISSIONS' => 'Permissions',
'POST_HEAD_LETTERS' => "Number of letters for the blog's head<br>You can type '-1' for unlimited number",
'POSTS_PER_PAGE' => "Number of blogs to view in a category",
'COMMENTS_PER_PAGE' => "Number of comments to view in an blog",
'EMAIL_NOTIFICATION' => "Send new comments notifications to this email<br>Leave empty if you do not want to receive notifications",
'CAT_PER_ROW' => "Number of horizental columns to view categories",
'ORDER_POSTS_BY' => "Order articles in a category by",
'order_posts_by' => array('last_added' => 'Last added blog',
						'last_added_comment' => 'Last added comment',
						'comments_number' => 'Comments number',
						'readers' => 'Readers'),
'SORT_POSTS_BY' => "Sort articles in a category by",
'sort_posts_by' => array('DESC' => 'Descending',
						'ASC' => 'Ascending'),
						
						
'MANAGE_CAT' => "Groupd allowed to add, edit and delete categories",
'EDIT_ALL_POSTS' => "Groups allowed to edit all posts",
'ADD_POST' => "Groups allowed to add a blog",
'ADD_COMMENT' => "Groups allowed to add a comment",
'EDIT_OWN_POST' => "Groups allowed to edit their own comments",
'APPROVE_POSTS' => "Groups allowed to approve comment",
'WAIT' => "Group who will need their comments approved",

);


$lang = array( 
'LANG_ERROR_VALIDATE' => "Please go back and fill all the required fields.",
'LANG_ERROR_ADD_DB' => "There was an error inserting the data into the database.",
'LANG_ERROR_URL' => "There was an error retriving the url.",
'LANG_MSG_NOT_VIEW_ATTACHMENTS' => "You can not view this attachment",
'CHECK_ALL' => "Check All",
'UNCHECK_ALL' => "Uncheck all",
'DELETE' => "Delete",

//archive.php
'ARCHIVE_NO_MONTH_SPECIFIED' => "Month is not set",
'ARCHIVE_NO_YEAR_SPECIFIED' => "Year is not set",

// addpost.php
'ADDPOST_POST_HEAD' => "Add a post",
'ADDPOST_USERNAME' => "Username",
'ADDPOST_TITLE' => "Title",
'ADDPOST_SELECT_CAT' => "Selete a category",
'ADDPOST_POST' => "Your post",
'ADDPOST_TAGS' => "Blog Tags<br>Seperate tags by a comma ',' ",
'ADDPOST_UPLOAD_FILE' => "Upload a file",
'ADDPOST_ALLOW_COMMENTS' => "Allow comment to this blog",
'ADDPOST_SAVE_DRAFT' => "Save as a draft",
'ADDPOST_SUBSCRIBE' => "Subscribe to this post",
'ADDPOST_POST_ADDED_SUCCESSFULLY' => "Your post was added successfully",
'ADDPOST_POST_NEED_APPROVAL' => "Thank you for adding your post.<br>Your post has to be approved by the admin.",

// viewpost.php
'VIEWPOST_ARTICLE_BY' => "By:",
'VIEWPOST_ARTICLE_DATEADDED' => "Date Added:",
'VIEWPOST_READERS' => "Readers:",
'VIEWPOST_COMMENTS' => "Comments:",

// editpost.php
'EDITPOST_EDIT_NOT_ALLOWED' => "You are not allowed to edit this blog.",
'EDITPOST_POST_HEAD' => "Edit a blog",
'EDITPOST_USERNAME' => "Username",
'EDITPOST_TITLE' => "Title",
'EDITPOST_SELECT_CAT' => "Selete a category",
'EDITPOST_POST' => "Blog",
'EDITPOST_SUBSCRIBE' => "Subscribe to this blog",
'EDITPOST_POST_EDITED_SUCCESSFULLY' => "Blog was edited successfully",
'EDITPOST_ALLOW_COMMENTS' => "Allow comments on this blog",
'EDITPOST_UPLOAD_FILE' => "Upload an attachment",
'EDITPOST_COMMENT_DELETED_SUCCESSFULLY' => "Blog was deleted sucessfully",
'EDITPOST_NOT_ALLOWED' => "You are not allowed to enter this section",
'EDITPOST_SAVE_DRAFT' => "Save as a draft",
'EDITPOST_TAGS' => "Blog Tags<br>Seperate tags by a comma ',' ",

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

// misc .php langauge
'MISC_UNPIN_OR_OPEN_NOT_ABLE' => "You can not unpin or open this topic since it is not pinned or closed.",
'MISC_PIN_OR_OPEN_NOT_ABLE' => "You can not pin or open this topic since it already pinned or opend.",
'MISC_UNPIN_OR_CLOSE_NOT_ABLE' => "You can not unpin or close this topic since it already unpinned or closed.",
'MISC_PIN_OR_CLOSE_NOT_ABLE' => "You can not pin or close this topic since it already pinned or closed.",
'MISC_NO_ACTIONS_SELECTED' => "You did not select any actions for this topic.<br>Please go back and select an action to perform on this topic",
'MISC_ACTIONS_PERFORMED_SUCCESSFLY' => "Your action was performed succussfully on the topic.",

// Includes folder langauge //
// functions.php
'INCLUDES_FUNCTIONS_ADMIN_MENU' => "Admin Menu:",
'INCLUDES_FUNCTIONS_ADMIN_MENU_CHOOSE' => "Choose one these options:",
'INCLUDES_FUNCTIONS_ADMIN_MENU_EDIT' => "Edit this post",
'INCLUDES_FUNCTIONS_ADMIN_MENU_CLOSE' => "Close this post",
'INCLUDES_FUNCTIONS_ADMIN_MENU_UNCLOSE' => "Open this post",
'INCLUDES_FUNCTIONS_ATTACHMENT' => "Attachment",
'INCLUDES_FUNCTIONS_ATTACHMENT_SIZE' => "Size:",
'INCLUDES_FUNCTIONS_ATTACHMENT_NAME' => "Attachment name:",
'INCLUDES_FUNCTIONS_ATTACHMENT_CLICKS' => "Clicks",


// blocks folder langauge //
// control.block.php 
'BLOCKS_CONTROL_BLOG' => "Blog Control Panel",
'BLOCKS_ADDCAT' => "Add a category",
'BLOCKS_VIEW_EDIT' => "View/edit a category",
'BLOCKS_UNAPPROVED_POSTS' => "Unapproved posts",
'BLOCKS_UNAPPROVED_COMMENTS' => "Unapproved comments",

// control folder langauge //
// index.php 
'CONTROL_NEWS' => "Control panel",


// Addcat.php language
'CONTROL_ADDCAT' => "Add a category",
'CONTROL_ADDCAT_TITLE' => "Title",
'CONTROL_ADDCAT_ORDER' => "Order",
'CONTROL_ADDCAT_SUCCESSFUL' => "Category was added successfully.",

// edit.php language
'CONTROL_EDITCAT' => "Edit a category",
'CONTROL_EDITCAT_TITLE' => "Title",
'CONTROL_EDITCAT_ORDER' => "Order",
'CONTROL_EDITCAT_SUCCESSFUL' => "Category was edited successfully.",

// viewcat.php langauge
'CONTROL_VIEWCAT' => "View categories",
'CONTROL_VIEWCAT_TITLE' => "Title",
'CONTROL_VIEWCAT_OPTIONS' => "Options",

// misc.php lanauge
'MISC_DELETE_CAT_IMAGE_UNSUCCESSFUL' => "Image was not deleted.",
'MISC_DELETE_CAT_IMAGE_SUCCESSFUL' => "Image was deleted successfully.",

'MISC_DELETE_CAT_CHOOSE' => "Choose one of these options:",
'MISC_DELETE_CAT_DELETE_ALL' => "Delete all category's blogs and their relative comments ",
'MISC_DELETE_CAT_MOVE_DELETE' => "Delete the category but move blogs to this category",
'MISC_DELETE_CAT_CHOOSE_CAT' => "Choose the new category",
'MISC_DELETE_CAT' => "Delete category",
'MISC_DELETE_CAT_SUCCESSFUL' => "The selected category was deleted successfully.",
'MISC_DELETE_CAT_UNSUCCESSFUL' => "Category removal was unsuccessful.",
'MISC_DELETE_POST_SUCCESSFUL' => "Post was deleted successfully.",
'MISC_DELETE_POST_NOT_ALLOWED' => "You are not allowed to delete blogs",

// approve_posts.php
'APPROVE_POSTS_UNAPPROVED_POSTS' => "Draft blogs",
'APPROVE_POSTS_TOPIC' => "Topic",
'APPROVE_POSTS_AUTHOR' => "Author",
'APPROVE_POSTS_OPTIONS' => "Options",
'APPROVE_POSTS_POSTS_LIST' => "Draft blogs list",
'APPROVE_POSTS_SELECT_ALL' => "Select All",
'APPROVE_POSTS_DESELECT_ALL' => "Deselect All",
'APPROVE_POSTS_DELETE_SELECTED' => "Delete Selected",
'APPROVE_POSTS_CONFIRM_DELETE' => "Are you sure you want to delete the selected post(s)?",
'APPROVE_POSTS_APPROVE_SELECTED' => "Approve Selected",
'APPROVE_POSTS_CHOOSE_CAT' => "Choose a category",
'APPROVE_POSTS_MOVE' => "Move",
'APPROVE_POSTS_MOVE_TO' => "Move to:",
'APPROVE_POSTS_SELECTED_POSTS_APPROVED' => "The selected blogs were approved.",
'APPROVE_POSTS_NO_POSTS_SELECTED' => "No blogs were selected.<br>Please go back and select at least at lease a one post.",
'APPROVE_POSTS_SELECTED_POSTS_DELETED' => "The selected blogs were deleted",
'APPROVE_POSTS_SELECTED_POSTS_MOVED' => "The selected blogs were moved",


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


'LIST_TITLE' => "Title",
'LIST_AUTHOR' => "Author",
'LIST_DATE_ADDED' => "Date added",
'LIST_READERS' => "Readers",
'LIST_COMMENTS' => "Comments",

'CONTROL_CATEGORIES' => 'Blog categories',
'CONTROL_ADD_NEW_CAT' => 'Add a new category',
'CONTROL_EDIT_VIEW_CAT' => 'View/edit a category',
'CONTROL_PENDING_POSTS' => 'View Pending posts',
'CONTROL_PENDING_COMMENTS' => 'View Pending comments',
);

 
?>