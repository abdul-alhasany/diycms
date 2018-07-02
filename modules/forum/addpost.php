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
 
 $cat_id      = set_id_int('catid');
 
 $add_perm        = $mod->setting('add_post', $_COOKIE['cgroup']);
 $maximum_letters = get_group_setting('maximum_posts_letters');
 $editor_type     = get_group_setting('editor_type');
 $mod->permission($add_perm);
 
 $index_middle = $mod->nav_bar($lang['ADDPOST_POST_HEAD']);
 
 if ($_POST['submit']) {
     require_once('includes/email.class.php');
     extract($_POST);
     
     $fullarr = array(
         $title,
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
     $result    = $diy_db->query("INSERT INTO diy_forum_threads (userid,
                                                    cat_id,
                                                    username,
                                                    title,
													date_added ,
                                                    post,
                                                    allow
												)
                                              values
                                                    ('$userid',
                                                    '$cat_id',
                                                    '$name',
                                                    '$title',
													'$timestamp',
													'$post',
                                                    '$allow_value'
													)");
     
     if ($result) {
         $threadid = $diy_db->insertid();
         
         $mail = new email;
         $mail->send_to_moderate($cat_id);
         
        
       $file_attachment = $upload->upload_files('attachment', $threadid, 'post');
         if ($file_attachment) {
            $diy_db->query("UPDATE diy_forum_threads SET uploadfile=1 WHERE threadid = '$threadid'");
         }
             
           
         $diy_db->query("UPDATE diy_forum_cat SET countopic=countopic+1, lastpostid ='$threadid' WHERE catid = '$cat_id'");
         $diy_db->query("UPDATE diy_users SET all_posts = all_posts+1 WHERE userid = '$userid'");
         if ($subscribe == '1') {
             $diy_db->query("INSERT INTO diy_subscriptions values ('', '$userid', '$threadid', 'no','forum')");
         }
         
         if ($allow_value == 'no') {
             info_message($lang['ADDPOST_POST_NEED_APPROVAL'], "mod.php?mod=forum&modfile=list&catid=$cat_id");
         } else {
             info_message($lang['ADDPOST_POST_ADDED_SUCCESSFULLY'], "mod.php?mod=forum&modfile=viewpost&threadid=$threadid");
         }
         
     } else {
         info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
     }
     
 } else {
     $form = new form;
     
     if ($_COOKIE['cname'] == 'Guest') {
         $add_post .= $form->inputform($lang['ADDPOST_USERNAME'], "text", "username", "*");
     }
     $add_post .= $form->inputform($lang['ADDPOST_TITLE'], "text", "title", "*");
   
     
     
     $info = array(
         'smiles' => 'on',
         'count' => "$maximum_letters",
         'required' => 'yes',
         'editor' => "$editor_type"
     );
     $add_post .= $form->textarea($lang['ADDPOST_POST'], "post", "", $info);
     
     $add_post .= $form->files_upload($lang['ADDPOST_UPLOAD_FILE'], "attachment[]");
     $add_post .= $form->radio_selection($lang['ADDPOST_SUBSCRIBE'], "subscribe");
     
     $form_array = array(
         "action" => "mod.php?mod=forum&modfile=addpost&catid=$cat_id",
         "title" => "$lang[ADDPOST_POST_HEAD]",
         "name" => 'add_cat',
         "content" => $add_post,
         "submit"	=>  LANG_FORM_ADD_BUTTON
     );
     
     $index_middle .= $form->form_table($form_array);
 }
 echo $index_middle;
?>