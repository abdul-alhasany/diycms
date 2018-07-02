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

// include required files
include_once('modules/' . $mod->module . '/settings.php');
include_once('includes/module_post_management.class.php');
include_once('includes/upload.class.php');

// instantiate objects
$upload = new handle_upload_files;
$post_ops = new module_post_management;
$form = new form;

// check permissions to add a post
$add_perm = $mod->setting('add_post', $_COOKIE['cgroup']);
$mod->permission($add_perm);

// display nav bar
$index_middle = $mod->nav_bar($lang['ADDPOST_POST_HEAD']);

// check if data is posted
if ($_POST['submit']) {
    extract($_POST);
    
    // set content
    $post_ops->content = $post;
    
    // check required fields
    $post_ops->check_required_entries(array($title, $cat_id, $post));
    
    // check username
    $username = $post_ops->check_user_name($username);
    
    // check maximum chars
    $post_ops->check_maximum_chars();
    
    // check uploaded files
    $upload_check = $upload->check_upload_file('attachment');
    
	// check post submitting setting 
    $allow_value = ($mod->setting('wait', $_COOKIE['cgroup'])) ? 'no' : 'yes';
	
    // insert post into database if there are no errors
    if(($post_ops->check_errors()) AND (empty($upload_check)))
	{
	$userid = $_COOKIE['cid'];
	$timestamp = time();
	$editor_type = get_group_setting('editor_type');
	
	// insert post details
	$post_ops->query_keys = 'userid,cat_id,username,title,date_added, post, allow, editor_type';
	$post_ops->query_values = "'$userid','$cat_id','$username','$title','$timestamp','$post','$allow_value', '$editor_type'";
	
    $query = $post_ops->insert_post('diy_news');
	
    if ($query) {
        $post_id = $diy_db->insertid();
        
		// update attachment detailes
        $file_attachment = $upload->upload_files('attachment', $post_id, 'post');
        if ($file_attachment) {
			$post_ops->update_post('diy_news', "uploadfile=1", "newsid = '$post_id'");
        }
        
		// update counters
		$post_ops->update_post('diy_news_cat', "countopic=countopic+1, lastpostid ='$post_id'", "catid = '$cat_id'");
		$post_ops->update_post('diy_users', "all_posts = all_posts+1", "userid = '$userid'");
		
		// check post status and redirect accrodingly
        $post_ops->check_post_status($allow_value, "mod.php?mod=news", "mod.php?mod=news&modfile=viewpost&newsid=$post_id");
        
    } else {
        info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
    }
	}
    
} // end $_POST

	// display errors if they exist
	$errors .= $post_ops->inline_error_message();
	$errors .= $upload_check;
	
	if(!empty($errors))
	{
	eval("\$index_middle .= \" " . $mod->gettemplate ( 'news_errors_display' ) . "\";");
	}

// get categories array
$cat_array = $post_ops->get_category_array("SELECT * FROM diy_news_cat ORDER BY catid");

// set post array
$info = array(
    'smiles' => 'on',
    'count' => get_group_setting('maximum_posts_letters'),
    'required' => 'yes',
    'editor' => get_group_setting('editor_type')
);

// build form
if ($_COOKIE['cname'] == 'Guest') {
    $add_post .= $form->inputform($lang['ADDPOST_USERNAME'], "text", "username", "*", $_POST['username']);
}
$add_post .= $form->inputform($lang['ADDPOST_TITLE'], "text", "title", "*", $_POST['title']);
$add_post .= $form->selectform($lang['ADDPOST_SELECT_CAT'], "cat_id", $cat_array, $_POST['cat_id'], '*');
$add_post .= $form->textarea($lang['ADDPOST_POST'], "post", $_POST['post'], $info);
$add_post .= $form->files_upload($lang['ADDPOST_UPLOAD_FILE'], "attachment[]");


$form_array = array(
    "action" => "mod.php?mod=news&modfile=addpost",
    "title" => $lang['ADDPOST_POST_HEAD'],
    "name" => 'add_post',
    "content" => $add_post,
    "submit" => LANG_FORM_ADD_BUTTON
);

$index_middle .= $form->form_table($form_array);

// ouput form
echo $index_middle;
?>