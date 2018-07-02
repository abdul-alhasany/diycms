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
 
 include("modules/" . $mod->module . "/settings.php");
 include("includes/upload.class.php");
 
 $threadid = set_id_int('threadid');
 $cat_id = set_id_int('cat_id');
 
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
     
    $upload = new handle_upload_files;
	$upload->check_upload_file('attachment');  
	
     $userid    = $_COOKIE['cid'];
     $timestamp = time();
     $result    = $diy_db->query("INSERT INTO diy_forum_comments (threadid,
													userid,
                                                    cat_id,
                                                    username,
                                                    title,
													date_added ,
                                                    comment,
                                                    allow
												)
                                              values
                                                    ('$threadid',
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
       $file_attachment = $upload->upload_files('attachment', $commentid, 'comment');
         if ($file_attachment) {
           $diy_db->query("UPDATE diy_forum_comments SET uploadfile=1 WHERE commentid = '$commentid'");
         }
             
             
         
         $diy_db->query("UPDATE diy_forum_cat SET countcomm=countcomm+1, lastpostid ='$threadid' WHERE catid = '$cat_id'");
         $diy_db->query("UPDATE diy_forum_threads SET comments_no=comments_no+1, lastuserid ='$userid' WHERE threadid = '$threadid'");
         $diy_db->query("UPDATE diy_users SET all_posts = all_posts+1 WHERE userid = '$userid'");
         
         $mail = new email;
         $mail->send_to_users('forum', $userid, $threadid, $url, $H);
         
         if ($allow_value == 'no') {
             info_message($lang['ADDCOMMENT_POST_NEED_APPROVAL'], "mod.php?mod=forum");
         } else {
             info_message($lang['ADDCOMMENT_POST_ADDED_SUCCESSFULLY'], "mod.php?mod=forum&modfile=viewpost&threadid=$threadid");
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
         $result    = $diy_db->query("SELECT username,comment FROM diy_forum_comments WHERE commentid='$qoute'");
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
	 $add_comment .= $form->files_upload($lang['ADDCOMMENT_UPLOAD_FILE'], "attachment[]");
     
     $form_array = array(
         "action" => "mod.php?mod=forum&modfile=addcomment&threadid=$threadid&cat_id=$cat_id",
         "title" => $lang['ADDCOMMENT_COMMENT_HEAD'],
         "name" => 'add_comment',
         "content" => $add_comment,
         "submit"	=>  LANG_FORM_ADD_BUTTON
     );
     
     $index_middle .= $form->form_table($form_array);
 }
 echo $index_middle;
?>