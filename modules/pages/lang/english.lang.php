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
  * This file is part of pages module
  * 
  * @package	Modules
  * @subpackage	Pages
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

$admin_lang = array(
'mod_title'  => "Pages",
'mod_ver'  => "1.0",
'mod_auth'  => "Khr2003",
'mod_desc'  => "This module enables you to add html pages to your website. It can be used for different html content such as making about us, contact us pages or any other kind of content.",
'mod_user'  => "1,2,3,4,5",
'right_menu'  => "0",
'left_menu'  => "1",
'menuid'  => "1,2,3,4,5,6,7,8,9,10,11,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30",


'INSTALL_MOUDLE' => "Installing Pages module version 1.0 for diycms",
'QUERY_ERROR' => "<b>Query Erorr: </b> in query No. $query_cid  because:.<br>\n",
'QUERY_TEXT' => "Query",
'SETUP_DONE_ERROR' => "Setup has completed. However, there were some errors. Please refer to the documentation or to the support forum.",
'SETUP_DONE' => "Setup was completed Successfuly.",
'BACK_TO_MAIN' => "Go back to the modules page.",


'UNINSTALL_MOUDLE' => "Uninstalling Pages module version 1.0 ",
'UNINSTALL_CONFIRM' => 'Are you sure you want to delete this module?<br> You will delete all the data related to it, such as articls, blocks or anything else.',
'QUERY_ERROR' => "<b>Query Erorr: </b> in query No. $query_cid  because:.<br>\n",
'QUERY_TEXT' => "Query",
'UNINSTALL_DONE_ERROR' => "Uninstall has completed. However, there were some errors. Please refer to the documentation or to the support forum.",
'UNINSTALL_DONE' => "Uninstall was completed Successfuly.",
'BACK_TO_MAIN' => "Go back to the modules page.",


'GENERAL_SETTINGS' => "General Settings",
'PERMISSIONS' => "Permissions",
'VIEW_PAGE'  => "Groups allowed to view current pages",
'ADD_PAGE'  => "Groups allowed to add a page",
'EDIT_PAGE'  => "Groups allowed to approve, edit and delete pages content",
'WAIT' => "Groups who will need their posted pages approved",
'MAX_LETTERS' => 'Maximum number of characters per page content',
'EDITOR_TYPE' => 'Editor Type',
'editor_type' => array('bbcode' => 'BBcode',
					   'html'=> 'Html Editor'),
'ALLOWED_HTML_TAGS' => 'Allowed Html Tags'
);

$lang = array(
'LANG_ERROR_VALIDATE' => "Please go back and fill all the required fields.",
'LANG_ERROR_VALIDATE_EMAIL' => "Please enter a valid email",
'LANG_ERROR_WAIT_SECONDS' => "Please wait few seconds before sending another post",
'LANG_ERROR_ADD_DB' => "There was an error inserting the data into the database.",

'ADD_PAGE' => "Add a Page",
'EDIT_PAGE' => "Edit Page's content",
'CONFIRM_DELETE' => "Do you want to remove the selected Pages?",
'DELETE' => "Delete",
'APPROVE' => "Approve",
'CHECK_ALL' => "Check All",
'UNCHECK_ALL' => "Uncheck All",
'PAGE_REMOVED' => "The selected pages(s) were removed.",
'NO_PAGES_SELECTED' => "You have not selected any pages.<br>Please select at least one page.",
'PAGES_APPROVED' => 'The selected Pages(s) were approved',
'PAGE_STATUS' => "Status",
'TITLE' => "Title",
'PAGE' => "Content",
'SUBMIT' => "Submit",
'ADMIN_PAGES' => "Manage Pages",
'NO_PAGES_TO_MANAGE' => "There are no pending pages to manage",
'PAGE_WAIT_APPROVAL' => "Page was added.<br>It has to be approved by the admin before it is posted.",
'PAGE_ADDED' => "The new page was added.",
'PAGE_EDITED' => "Page's content was edited successfully.",
'EDITPOST_NOT_ALLOWED' => "You are not allowed to delete this post.",
'PAGE_DELETED' => "Page was deleted successfully",

'PENDING_PAGES' => "Pending Pages"
);

?>