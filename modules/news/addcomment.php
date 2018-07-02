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
  * This file is part of news module
  * 
  * @package	Modules
  * @subpackage	News
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */
 
 
include_once('modules/' . $mod->module . '/settings.php');
include_once ('includes/module_post_management.class.php');

 $newsid = set_id_int('newsid');
 $cat_id = set_id_int('cat_id');
 
 $post_ops = new module_post_management;
 $form = new form;
  
 $add_perm        = $mod->setting('add_post', $_COOKIE['cgroup']);
 $mod->permission($add_perm);
 
 $index_middle .= $mod->nav_bar($lang['ADDCOMMENT_COMMENT_HEAD']);
 
 if ($_POST['submit']) {
     extract($_POST);
     
    // check required fields
    $post_ops->check_required_entries(array($post));
    
	// set content
    $post_ops->content = $post;
	
    // check username
    $username = $post_ops->check_user_name($username);
	
	// check maximum chars
    $post_ops->check_maximum_chars();

     // check post submitting setting 
    $allow_value = ($mod->setting('wait', $_COOKIE['cgroup'])) ? 'no' : 'yes';
 
	
	// insert post into database if there are no errors
    if(($post_ops->check_errors()) AND (empty($upload_check)))
	{
     $userid    = $_COOKIE['cid'];
     $timestamp = time();
	
	$editor_type = get_group_setting('editor_type');
	
	// insert post details
	$post_ops->query_keys = 'newsid,userid,cat_id,username,title,date_added ,comment,allow, editor_type';
	$post_ops->query_values = "'$newsid','$userid','$cat_id','$username','$title','$timestamp','$post','$allow_value', '$editor_type'";
	
    $query = $post_ops->insert_post('diy_news_comments');
	
     
     if ($query) {
         $commentid = $diy_db->insertid();

		// update counters
		$post_ops->update_post('diy_news_cat', "countopic=countopic+1, lastpostid ='$newsid'", "catid = '$cat_id'");
		$post_ops->update_post('diy_news', "comments_no=comments_no+1, lastuserid ='$userid'", "newsid = '$newsid'");
		$post_ops->update_post('diy_users', "all_posts = all_posts+1", "userid = '$userid'");
	
		// check post status and redirect accrodingly
		$get_comment_url = get_comment_url($newsid, $commentid);
        $post_ops->check_post_status($allow_value, "mod.php?mod=news", $get_comment_url);
		
         
     } else {
         info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
     }
     }
 } // End $_POST
 

	// display errors if they exist
	$errors .= $post_ops->inline_error_message();
	$errors .= $upload_check;
	
	if(!empty($errors))
	{
	eval("\$index_middle .= \" " . $mod->gettemplate ( 'news_errors_display' ) . "\";");
	}
	
     if ($_COOKIE['cname'] == 'Guest') {
         $add_comment .= $form->inputform($lang['ADDCOMMENT_USERNAME'], "text", "username", "*", $_POST['username']);
     }
     $add_comment .= $form->inputform($lang['ADDCOMMENT_TITLE'], "text", "title", $_POST['title']);
     
     if (isset($_GET['qoute'])) {
         $qoute     = intval($_GET['qoute']);
         $row    = $diy_db->dbfetch("SELECT username,comment FROM diy_news_comments WHERE commentid='$qoute'");
         $post_text = "  [QUOTE]BY :" . $row['username'] . "\n" . $row['comment'] . "[/QUOTE] \n";
     }
     
     
     $info = array(
         'smiles' => 'on',
         'count' => get_group_setting('maximum_posts_letters'),
         'required' => 'yes',
         'editor' => get_group_setting('editor_type')
     );
     $add_comment .= $form->textarea($lang['ADDCOMMENT_COMMENT'], "post", $post_text.$_POST['post'], $info);
     
     $form_array = array(
         "action" => "mod.php?mod=news&modfile=addcomment&newsid=$newsid&cat_id=$cat_id",
         "title" => $lang['ADDCOMMENT_COMMENT_HEAD'],
         "name" => 'add_comment',
         "content" => $add_comment,
         "submit"	=>  LANG_FORM_ADD_BUTTON
     );
     
     $index_middle .= $form->form_table($form_array);
 
 echo $index_middle;
?>