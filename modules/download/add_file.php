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
 * @package		Modules
 * @subpackage	Download
 * @author 		Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	1.1
 * @access 		public
 */

include("modules/" . $mod->module . "/settings.php");
include("includes/upload.class.php");

$add_perm        = $mod->setting('add_post', $_COOKIE['cgroup']);
$maximum_letters = get_group_setting('maximum_posts_letters');
$editor_type     = get_group_setting('editor_type');
$mod->permission($add_perm);

$index_middle = $mod->nav_bar($lang['ADDFILE_HEAD']);

if ($_POST['submit']) {
	require_once('includes/email.class.php');
	extract($_POST);
	
	$fullarr = array(
		$title,
		$cat_id,
		$post
	);
	
	if (!required_entries($fullarr)) {
		error_message($lang['LANG_ERROR_VALIDATE']);
	}
	// check if the user is not registered
	if ($_COOKIE['cid'] == 0 or $_COOKIE['cid'] == $CONF['Guest_id']) {
		$name = $_POST['username'];
		if (!required_entries($name)) {
			error_message($lang['LANG_ERROR_VALIDATE']);
		}
	} else {
		$name = $_COOKIE['cname'];
	}
	
	// Check if the description exceeded the allowed limit.
	if (!maximum_allowed($post, $maximum_letters)) {
		error_message($error_mxs);
	}
	
	// Check if the uploading file and the file link are empty
	if (empty($_FILES["attachment"]["tmp_name"][0]) && (empty($file_link))) {
		error_message($lang['ADDFILE_EMPTY_SUBMISSION']);
	}
	
	$post = format_post($post);
	
	
	$allow = $mod->setting('wait', $_COOKIE['cgroup']);
	if ($allow)
		$allow_value = 'no';
	else
		$allow_value = 'yes';
	
	$upload = new handle_upload_files;
	$upload->check_upload_file('attachment');

	$userid    = $_COOKIE['cid'];
	$timestamp = time();
	$result    = $diy_db->query("INSERT INTO diy_download_files (userid,
                                                    cat_id,
                                                    username,
                                                    title,
													file_size,
													size_unit,
													file_link,
													date_added ,
                                                    post,
                                                    allow
												)
                                              values
                                                    ('$userid',
                                                    '$cat_id',
                                                    '$name',
                                                    '$title',
													'$file_size',
													'$size_unit',
													'$file_link',
													'$timestamp',
													'$post',
                                                    '$allow_value'
													)");
	
	if ($result) {
		$downid = $diy_db->insertid();
		
		$mail = new email;
		$mail->send_to_moderate($cat_id);
		
		$file_attachment = $upload->upload_files('attachment', $downid, 'post');
         if ($file_attachment) {
            $diy_db->query("UPDATE diy_download_files SET uploadfile=1 WHERE downid = '$downid'");
         }
		 
		$diy_db->query("UPDATE diy_download_cat SET countopic=countopic+1, lastpostid ='$downid' WHERE catid = '$cat_id'");
		$diy_db->query("UPDATE diy_users SET all_posts = all_posts+1 WHERE userid = '$userid'");
		
		
		if ($allow_value == 'no') {
			info_message($lang['ADDFILE_FILE_NEED_APPROVAL'], "mod.php?mod=download");
		} else {
			info_message($lang['ADDFILE_FILE_ADDED_SUCCESSFULLY'], "mod.php?mod=download&modfile=view_file&downid=$downid");
		}
		
	} else {
		info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
	}
	
} else {
	$form = new form;
	
	$result = $diy_db->query("SELECT * FROM diy_download_cat ORDER BY catid");
	while ($row = $diy_db->dbarray($result)) {
		$catid             = $row['catid'];
		$cat_title         = $row['cat_title'];
		$cat_array[$catid] = $cat_title;
	}
	$add_file .= $form->selectform($lang['ADDFILE_SELECT_CAT'], "cat_id", $cat_array, '', '*');
	if ($_COOKIE['cname'] == 'Guest') {
		$add_file .= $form->inputform($lang['ADDFILE_USERNAME'], "text", "username", "*");
	}
	$add_file .= $form->inputform($lang['ADDFILE_TITLE'], "text", "title", "*");
	$add_file .= $form->inputform($lang['ADDFILE_FILE_SIZE'], "text", "file_size", "*");
	
	$size_array = array(
		'BYTE' => 'BYTE',
		'KB' => 'KB',
		'MB' => 'MB',
		'GB' => 'GB'
	);
	
	$add_file .= $form->selectform($lang['ADDFILE_SIZE_UNIT'], "size_unit", $size_array, '', '*');
	$add_file .= $form->inputform($lang['ADDFILE_LINK'], "text", "file_link", "");
	$add_file .= $form->files_upload($lang['ADDFILE_UPLOAD_FILE'], "attachment[]", 1, 35);
	
	$info = array(
		'smiles' => 'on',
		'count' => "$maximum_letters",
		'required' => 'yes',
		'editor' => "$editor_type"
	);
	$add_file .= $form->textarea($lang['ADDFILE_DESC'], "post", "", $info);

	
	$form_array = array(
		"action" => "mod.php?mod=download&modfile=add_file",
		"title" => "$lang[ADDFILE_HEAD]",
		"name" => 'add_file',
		"content" => $add_file,
		"submit"	=>  LANG_FORM_ADD_BUTTON
	);
	
	$index_middle .= $form->form_table($form_array);
}
echo $index_middle;

?>