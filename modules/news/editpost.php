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

include_once("modules/" . $mod->module . "/settings.php");
include_once('includes/module_post_management.class.php');
include_once("includes/upload.class.php");

// instantiate objects
$upload   = new handle_upload_files;
$post_ops = new module_post_management;
$form     = new form;


$newsid = set_id_int('newsid');
$catid  = set_id_int('cat_id');

// get permissions
$global_edit_perm   = $mod->setting('edit_all_posts', $_COOKIE['cgroup']);
$user_edit_perm     = $mod->setting('edit_own_post', $_COOKIE['cgroup']);
$approve_posts_perm = $mod->setting('approve_posts', $_COOKIE['cgroup']);

// Get post information
$row = $diy_db->dbfetch("SELECT * FROM diy_news WHERE newsid='$newsid' ORDER BY newsid");

// check maximum edit time
$maximum_edit_time = get_group_setting('maximum_post_edit_time');
$edit_time         = check_edit_time($row['date_added'], $maximum_edit_time);

// check if user has the right permissions
if (($global_edit_perm == '') && (($user_edit_perm == '') || ($edit_time != '1'))) {
    Login();
}

// get navbar
$index_middle = $mod->nav_bar($lang['EDITPOST_POST_HEAD']);

// check if data is submitted
if ($_POST['submit']) {
    extract($_POST);
    
    // set content
    $post_ops->content = $post;
    
    // check required fields
    $post_ops->check_required_entries(array(
        $title,
        $cat_id,
        $post
    ));
    
    // check maximum chars
    $post_ops->check_maximum_chars();
    
    
    $post = format_post($post);
    
    // check uploaded files
    $upload_check .= $upload->check_upload_file('attachment');
    $upload_check .= $upload->check_upload_file('replace');
    
    
    // Check if the post is to be deleted	
    if ($delete_post == "1") {
        if ($approve_posts_perm) {
            // delete post, comments and related attachments
            $post_ops->delete_post('diy_news', "newsid='$newsid'");
            $post_ops->delete_post('diy_news_comments', "newsid='$newsid'");
            $post_ops->delete_uploaded_file("post_id ='$newsid' AND module = 'news'");
            
            info_message($lang['EDITPOST_COMMENT_DELETED_SUCCESSFULLY'], "mod.php?mod=news");
        } else {
            info_message($lang['EDITPOST_NOT_ALLOWED'], "mod.php?mod=news&modfile=viewpost&newsid=$newsid");
        }
    }
    
    if (($post_ops->check_errors()) AND (empty($upload_check))) {
        // Check if the post has been moved in order to update all the comments of the post including the attachments
        if ($catid != $cat_id) {
            $post_ops->update_post('diy_news_comments', "cat_id='$cat_id'", "newsid = '$newsid'");
        }
        
        $editor_type = get_group_setting('editor_type');
        
        // update post details
        $result = $post_ops->update_post('diy_news', "cat_id = '$cat_id', title = '$title', post = '$post', allow = '$allow', editor_type = '$editor_type'", "newsid = '$newsid'");
        
        if ($result) {
            // check uploaded files
            $upload->edit_uploaded_files($upload_id, 'replace', $delete, $attachment, $newsid, 'post');
            
            // check if files are uploaded
            $check_files = $upload->check_existing_upload($newsid, 'post');
            
            if ($check_files)
                $post_ops->update_post('diy_news', "uploadfile=1", "newsid = '$newsid'");
            
            info_message($lang['EDITPOST_POST_ADDED_SUCCESSFULLY'], "mod.php?mod=news&modfile=viewpost&newsid=$newsid");
        } else {
            info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
        }
    }
} // end post

// display errors if they exist
$errors .= $post_ops->inline_error_message();
$errors .= $upload_check;

if (!empty($errors)) {
    eval("\$index_middle .= \" " . $mod->gettemplate('news_errors_display') . "\";");
}

// check if user has deleting permissions
if ($approve_posts_perm) {
    $edit_post .= $form->deleteform("delete_post");
}

// get categories array
$cat_array = $post_ops->get_category_array("SELECT * FROM diy_news_cat ORDER BY catid");

// extract $post_detalis query in the top of this page
extract($row);

// build form
$edit_post .= $form->inputform($lang['EDITPOST_TITLE'], "text", "title", "*", "$title");
$edit_post .= $form->selectform($lang['EDITPOST_SELECT_CAT'], "cat_id", $cat_array, "$cat_id", '*');


$info = array(
    'smiles' => 'on',
    'count' => get_group_setting('maximum_posts_letters'),
    'required' => 'yes',
    'editor' => get_group_setting('editor_type')
);

// edit uploaded files if they exist
$edit_post .= $form->textarea($lang['EDITPOST_POST'], "post", "$post", $info);
if ($uploadfile !== '0') {
    $edit_post .= $form->edit_upload("Attachments", $newsid, 'post');
} else {
    $edit_post .= $form->files_upload($lang['EDITPOST_UPLOAD_FILE'], "attachment[]");
}


$edit_post .= $form->radio_selection($lang['EDITPOST_ALLOW_POST'], "allow", array(
    'yes' => LANG_YES,
    'no' => LANG_NO
), $allow);
$edit_post .= $form->hiddenform("userid", "$userid");

// create form
$form_array = array(
    "action" => "mod.php?mod=news&modfile=editpost&newsid=$newsid&cat_id=$catid",
    "title" => $lang['EDITPOST_POST_HEAD'],
    "name" => 'editpost',
    "content" => $edit_post,
    "submit" => LANG_FORM_EDIT_BUTTON
);

$index_middle .= $form->form_table($form_array);

echo $index_middle;
?>