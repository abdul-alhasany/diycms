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


include("modules/" . $mod->module . "/settings.php");
include("includes/upload.class.php");

$downid = set_id_int('downid');

$global_edit_perm   = $mod->setting('edit_all_posts', $_COOKIE['cgroup']);
$user_edit_perm     = $mod->setting('edit_own_post', $_COOKIE['cgroup']);
$approve_posts_perm = $mod->setting('approve_files', $_COOKIE['cgroup']);

$post_detailes = $diy_db->query("SELECT * FROM diy_download_files where downid='$downid' order by downid");
$row           = $diy_db->dbarray($post_detailes);

$maximum_edit_time = get_group_setting('maximum_post_edit_time');
$edit_time         = check_edit_time($row['date_added'], $maximum_edit_time);

if (($global_edit_perm == '') && (($user_edit_perm == '') || ($edit_time != '1'))) {
	error_message($lang['EDITFILE_EDIT_NOT_ALLOWED']);
}

$maximum_letters = get_group_setting('maximum_posts_letters');
$editor_type     = get_group_setting('editor_type');


$index_middle = $mod->nav_bar($lang['EDITFILE_FILE_HEAD']);

if ($_POST['submit']) {
	extract($_POST);
	$fullarr = array(
		$title,
		$cat_id,
		$post
	);
	
	if (!required_entries($fullarr)) {
		error_message($lang['LANG_ERROR_VALIDATE']);
	}
	
	
	if (!maximum_allowed($post, $maximum_letters)) {
		error_message($error_mxs);
	}
	
	$post = format_post($post);

	
	$upload = new handle_upload_files;
	$upload->check_upload_file('file_uploaded');
	
	// Check if the post is to be deleted
	if ($delete_post == "1") {
		$diy_db->query("DELETE FROM diy_download_files WHERE downid='$downid'");
		$diy_db->query("DELETE FROM diy_download_comments WHERE downid='$downid'");
		
		info_message($lang['EDITFILE_COMMENT_DELETED_SUCCESSFULLY'], "mod.php?mod=download");
	}
	
	
	// Check if the post has been moved in order to update all the comments of the post
	
	$cat_result = $diy_db->query("SELECT cat_id,comments_no FROM diy_download_files WHERE downid = '$downid'");
	while ($cat_row = $diy_db->dbarray($cat_result)); {
		$diy_db->query("UPDATE diy_download_comments set cat_id='$cat_id' WHERE downid = '$downid'");
	}
	
	$result = $diy_db->query("UPDATE diy_download_files SET
							cat_id = '$cat_id',
                            title = '$title',
							file_size = '$file_size',
							size_unit = '$size_unit',
							file_link = '$file_link',
                            post = '$post',
                            allow = '$allow'
							WHERE downid = '$downid'");
	
	
	if ($result) {
		$upload->edit_uploaded_files($upload_id, 'file_uploaded', 'delete', 'attachment', $downid, 'post');
		
		$check_files = $upload->check_existing_upload($downid, 'post');
	    if($check_files)
		$diy_db->query("UPDATE diy_download_files SET uploadfile=1 WHERE downid = '$downid'");
		
		if ($subscribe == '0') {
			$diy_db->query("DELETE FROM diy_subscriptions where postid='$downid' AND module = 'download'");
		} else {
			$alert_query = $diy_db->query("SELECT * FROM diy_subscriptions where postid='$downid' AND module = 'download'");
			if ($diy_db->dbnumrows($alert_query) == 0) {
				$diy_db->query("INSERT INTO diy_subscriptions values ('', '$userid', '$downid', 'no','download')");
			}
		}
		
		
		info_message($lang['EDITFILE_FILE_ADDED_SUCCESSFULLY'], "mod.php?mod=download&modfile=view_file&downid=$downid");
		
		
	} else {
		info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
	}
	
} else {
	$form = new form;
	
	if ($approve_posts_perm) {
		$edit_post .= $form->deleteform("delete_post");
	}
	
	$cat_result = $diy_db->query("SELECT * FROM diy_download_cat ORDER BY catid");
	while ($cat_row = $diy_db->dbarray($cat_result)) {
		$catid             = $cat_row['catid'];
		$cat_title         = $cat_row['cat_title'];
		$cat_array[$catid] = $cat_title;
	}
	
	// extract $post_detalis query in the top of this page
	extract($row);
	$edit_file .= $form->selectform($lang['EDITFILE_SELECT_CAT'], "cat_id", $cat_array, $cat_id, '*');
	$edit_file .= $form->inputform($lang['EDITFILE_TITLE'], "text", "title", "*", $title);
	
	$edit_file .= $form->inputform($lang['ADDFILE_FILE_SIZE'], "text", "file_size", "*", $file_size);
	
	$size_array = array(
		'BYTE' => 'BYTE',
		'KB' => 'KB',
		'MB' => 'MB',
		'GB' => 'GB'
	);
	
	$edit_file .= $form->selectform($lang['ADDFILE_SIZE_UNIT'], "size_unit", $size_array, $size_unit, '*');
	
	$edit_file .= $form->inputform($lang['ADDFILE_LINK'], "text", "file_link", "", $file_link);
	if ($uploadfile !== '0') {
		$edit_file .= edit_upload($lang['EDITFILE_UPLOAD_FILE'], $downid, 'post', 'file_uploaded[]');
	} else {
		$edit_file .= $form->inputform($lang['EDITFILE_UPLOAD_FILE'], "file", "file_uploaded");
	}
	
	
	$info = array(
		'smiles' => 'on',
		'count' => "$maximum_letters",
		'required' => 'yes',
		'editor' => "$editor_type"
	);
	$edit_file .= $form->textarea($lang['EDITFILE_DESC'], "post", $post, $info);
	
	$admin_array = array(
		'yes' => "Yes",
		'no' => "No"
	);
	$edit_file .= $form->radio_selection($lang['EDITFILE_ALLOW_FILE'], "allow", $admin_array, "$allow");
	$edit_file .= $form->radio_selection($lang['EDITFILE_SUBSCRIBE'], "subscribe");
	$edit_file .= $form->hiddenform("userid", "$userid");
	$form_array = array(
		"action" => "mod.php?mod=download&modfile=edit_file&downid=$downid",
		"title" => $lang['EDITFILE_FILE_HEAD'],
		"name" => 'edit_file',
		"content" => $edit_file,
		"submit"	=>  LANG_FORM_ADD_BUTTON
	);
	
	$index_middle .= $form->form_table($form_array);
}
echo $index_middle;

?>