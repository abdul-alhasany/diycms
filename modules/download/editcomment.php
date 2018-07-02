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

$downid    = set_id_int('downid');
$commentid = set_id_int('commentid');

$global_edit_perm   = $mod->setting('edit_all_posts', $_COOKIE['cgroup']);
$user_edit_perm     = $mod->setting('edit_own_post', $_COOKIE['cgroup']);
$approve_posts_perm = $mod->setting('approve_posts', $_COOKIE['cgroup']);


$post_detailes = $diy_db->query("SELECT * FROM diy_download_comments WHERE commentid='$commentid' AND downid='$downid' order by commentid");
$row           = $diy_db->dbarray($post_detailes);

$maximum_edit_time = get_group_setting('maximum_post_edit_time');
$edit_time         = check_edit_time($row['date_added'], $maximum_edit_time);

if (($global_edit_perm == '') && (($user_edit_perm == '') || ($edit_time != '1'))) {
	error_message($lang['EDITCOMMENT_EDIT_NOT_ALLOWED']);
}

$maximum_letters = get_group_setting('maximum_posts_letters');
$editor_type     = get_group_setting('editor_type');


$index_middle = $mod->nav_bar($lang['EDITCOMMENT_POST_HEAD']);

$submit = $_POST['submit'];
if ($submit) {
	extract($_POST);
	
	$fullarr = array(
		$post
	);
	
	if (!required_entries($fullarr)) {
		error_message($lang['LANG_ERROR_VALIDATE']);
	}
	
	
	if (!maximum_allowed($post, $maximum_letters)) {
		error_message($error_mxs);
	}
	
	$post = format_post($post);
	
	// Check if the comment delete checkbox is checked and delete the comment
	if ($delete_comment == "1") {
		if ($approve_posts_perm) {
			$comment_delete = $diy_db->query("DELETE FROM diy_download_comments
										  WHERE downid='$downid'
										  AND commentid ='$commentid'");
			
			info_message($lang['EDITCOMMENT_COMMENT_DELETED_SUCCESSFULLY'], "mod.php?mod=download&modfile=viewpost&downid=$downid");
			
		} else {
			info_message($lang['EDITCOMMENT_NOT_ALLOWED'], "mod.php?mod=download&modfile=viewpost&downid=$downid");
		}
	}
	
	
	$result = $diy_db->query("UPDATE diy_download_comments SET title = '$title',
                                                    comment = '$post',
                                                    allow = '$allow'
                                                    where commentid = '$commentid'
                                                    AND downid = '$downid'");
	
	
	if ($result) {
		$url = get_comment_url($downid, $commentid);
		info_message($lang['EDITCOMMENT_POST_EDITED_SUCCESSFULLY'], $url);
	} else {
		info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
	}
	
} else {
	$form = new form;
	
	if ($approve_posts_perm) {
		$edit_post .= $form->deleteform("delete_comment");
	}
	
	// extract $post_details query at the top of this page
	extract($row);
	
	$edit_post .= $form->inputform($lang['EDITCOMMENT_TITLE'], "text", "title", "*", "$title");
	
	$info = array(
		'smiles' => 'on',
		'count' => "$maximum_letters",
		'required' => 'yes',
		'editor' => "$editor_type"
	);
	$edit_post .= $form->textarea($lang['EDITCOMMENT_COMMENT'], "post", $comment, $info);
	
	
	if ($approve_posts_perm) {
		$admin_array = array(
			'yes' => "Yes",
			'no' => "No"
		);
		$edit_post .= $form->radio_selection($lang['EDITCOMMENT_ALLOW_POST'], "allow", $admin_array, "$allow");
	} else {
		$edit_post .= $form->hiddenform("allow", "$allow");
	}
	$edit_post .= $form->hiddenform("userid", "$userid");
	$form_array = array(
		"action" => "mod.php?mod=download&modfile=editcomment&downid=$downid&commentid=$commentid",
		"title" => "$lang[EDITCOMMENT_POST_HEAD]",
		"name" => 'editpost',
		"content" => $edit_post,
		"submit"	=>  LANG_FORM_ADD_BUTTON
	);
	
	$index_middle .= $form->form_table($form_array);
}
echo $index_middle;

?> 