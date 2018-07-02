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

$downid = set_id_int('downid');
$cat_id = set_id_int('cat_id');

// Check if the post is closed
$row = $diy_db->dbfetch("SELECT status
						FROM diy_download_files
						WHERE allow= 'yes'
						AND downid='$downid'
						LIMIT 1");

extract($row);

if (($row['status'] == '2') or ($row['status'] == '12')) {
	error_message("You can not add a comment to this file");
}

$add_perm        = $mod->setting('add_post', $_COOKIE['cgroup']);
$maximum_letters = get_group_setting('maximum_posts_letters');
$editor_type     = get_group_setting('editor_type');
$mod->permission($add_perm);

$index_middle = $mod->nav_bar($lang[ADDCOMMENT_COMMENT_HEAD]);


if ($_POST['submit']) {
	require_once('includes/email.class.php');
	extract($_POST);
	
	if ($CONF['mach_ip'] == 1) {
		$this_url = explode('/', $_SERVER['HTTP_HOST']);
		$reff_url = explode('/', $_SERVER['HTTP_REFERER']);
		
		if ($this_url[0] !== $reff_url[2])
			info_message('You can not add comment from outside our website', "index.php");
	}
	
	$fullarr = array(
		$post
	);
	
	if (!required_entries($fullarr)) {
		error_message($lang['LANG_ERROR_VALIDATE']);
	}
	
	if ($_COOKIE['cid'] == 0 or $_COOKIE['cid'] == $CONF['Guest_id']) {
		$name = $_POST['username'];
		if (!required_entries($name)) {
			error_message($lang['LANG_ERROR_VALIDATE']);
		}
	} else {
		$name = $_COOKIE['cname'];
	}
	
	if (!maximum_allowed($post, $maximum_letters)) {
		error_message($error_mxs);
	}
	
	$post = format_post($post);
	
	$allow = $mod->setting('wait', $_COOKIE['cgroup']);
	if ($allow)
		$allow_value = 'no';
	else
		$allow_value = 'yes';
	
	
	$userid    = $_COOKIE['cid'];
	$timestamp = time();
	$result    = $diy_db->query("INSERT INTO diy_download_comments (downid,
													userid,
                                                    cat_id,
                                                    username,
                                                    title,
													date_added ,
                                                    comment,
                                                    allow
												)
                                              values
                                                    ('$downid',
													'$userid',
                                                    '$cat_id',
                                                    '$name',
                                                    '$title',
													'$timestamp',
													'$post',
                                                    '$allow_value'
													)");
	
	if ($result) {
		$commentid = $diy_db->insertid();
		
		$diy_db->query("UPDATE diy_download_cat SET countcomm=countcomm+1, lastpostid ='$downid' WHERE catid = '$cat_id'");
		$diy_db->query("UPDATE diy_download_files SET comments_no=comments_no+1, lastuserid ='$userid' WHERE downid = '$downid'");
		$diy_db->query("UPDATE diy_users SET all_posts = all_posts+1 WHERE userid = '$userid'");
		
		if ($allow_value == 'no') {
			info_message($lang['ADDCOMMENT_COMMENT_NEED_APPROVAL'], "mod.php?mod=download");
		} else {
			info_message($lang['ADDCOMMENT_POST_ADDED_SUCCESSFULLY'], "mod.php?mod=download&modfile=view_file&downid=$downid");
		}
		
	} else {
		info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
	}
	
} else {
	$form = new form;
	
	
	if ($_COOKIE['cname'] == 'Guest') {
		$add_comment .= $form->inputform($lang['ADDCOMMENT_USERNAME'], "text", "username", "*");
	}
	$add_comment .= $form->inputform($lang['ADDCOMMENT_TITLE'], "text", "title");
	
	if (isset($_GET['qoute'])) {
		$qoute     = intval($_GET['qoute']);
		$result    = $diy_db->query("SELECT username,comment FROM diy_download_comments WHERE commentid='$qoute'");
		$row       = $diy_db->dbarray($result);
		$post_text = "  [QUOTE]BY :" . $row['username'] . "\n" . $row['comment'] . "[/QUOTE] \n";
	}
	
	
	$info = array(
		'smiles' => 'on',
		'count' => "$maximum_letters",
		'required' => 'yes',
		'editor' => "$editor_type"
	);
	$add_comment .= $form->textarea($lang['ADDCOMMENT_COMMENT'], "post", "$post_text", $info);
	
	
	$form_array = array(
		"action" => "mod.php?mod=download&modfile=addcomment&downid=$downid&cat_id=$cat_id",
		"title" => "$lang[ADDCOMMENT_COMMENT_HEAD]",
		"name" => 'add_comment',
		"content" => $add_comment,
		"submit"	=>  LANG_FORM_ADD_BUTTON
	);
	
	$index_middle .= $form->form_table($form_array);
}
echo $index_middle;

?>