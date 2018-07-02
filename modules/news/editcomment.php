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
include_once('includes/upload.class.php');
include_once('includes/module_post_management.class.php');

// set id
$catid     = set_id_int('cat_id');
$newsid    = set_id_int('newsid');
$commentid = set_id_int('commentid');

// create objects
$post_ops = new module_post_management;
$form     = new form;


$global_edit_perm   = $mod->setting('edit_all_posts', $_COOKIE['cgroup']);
$user_edit_perm     = $mod->setting('edit_own_post', $_COOKIE['cgroup']);
$approve_posts_perm = $mod->setting('approve_posts', $_COOKIE['cgroup']);


$row = $diy_db->dbfetch("SELECT * FROM diy_news_comments WHERE commentid='$commentid' LIMIT 1");

$maximum_edit_time = get_group_setting('maximum_post_edit_time');
$edit_time         = check_edit_time($row['date_added'], $maximum_edit_time);

if (($global_edit_perm == '') && (($user_edit_perm == '') || ($edit_time != '1'))) {
    Login();
}


$index_middle = $mod->nav_bar($lang['EDITCOMMENT_POST_HEAD']);

if ($_POST['submit']) {
    extract($_POST);
    
    // check required fields
    $post_ops->check_required_entries(array(
        $post
    ));
    
    // set content
    $post_ops->content = $post;
    
    
    // check maximum chars
    $post_ops->check_maximum_chars();
    
    $editor_type = get_group_setting('editor_type');
    // Check if the comment delete checkbox is checked and delete the comment
    if ($delete_comment == "1") {
        if ($approve_posts_perm) {
            $post_ops->delete_post('diy_news_comments', "commentid ='$commentid'");
            
            info_message($lang['EDITCOMMENT_COMMENT_DELETED_SUCCESSFULLY'], "mod.php?mod=news&modfile=viewpost&newsid=$newsid");
        } else {
            info_message($lang['EDITCOMMENT_NOT_ALLOWED'], "mod.php?mod=news&modfile=viewpost&newsid=$newsid");
        }
    }
    
    if (($post_ops->check_errors()) AND (empty($upload_check))) {
        // update post details
        $query = $post_ops->update_post('diy_news', "title = '$title', comment = '$post', allow = '$allow', editor_type = '$editor_type'", "commentid = '$commentid'");
        
        if ($query) {
            $url = get_comment_url($newsid, $commentid);
            info_message($lang['EDITCOMMENT_POST_EDITED_SUCCESSFULLY'], $url);
        } else {
            info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
        }
        
    }
}



// display errors if they exist
$errors .= $post_ops->inline_error_message();
$errors .= $upload_check;

if (!empty($errors)) {
    eval("\$index_middle .= \" " . $mod->gettemplate('news_errors_display') . "\";");
}


if ($approve_posts_perm) {
    $edit_post .= $form->deleteform("delete_comment");
}

// extract $post_details query at the top of this page
extract($row);

$edit_post .= $form->inputform($lang['EDITCOMMENT_TITLE'], "text", "title", "*", "$title");

$info = array(
    'smiles' => 'on',
    'count' => get_group_setting('maximum_posts_letters'),
    'required' => 'yes',
    'editor' => get_group_setting('editor_type')
);

$edit_post .= $form->textarea($lang['EDITCOMMENT_COMMENT'], "post", $comment, $info);

if ($approve_posts_perm) {
    $edit_post .= $form->radio_selection($lang['EDITCOMMENT_ALLOW_POST'], "allow", array(
        'yes' => LANG_YES,
        'no' => LANG_NO
    ), $allow);
} else {
    $edit_post .= $form->hiddenform("allow", "$allow");
}

$edit_post .= $form->hiddenform("userid", "$userid");
$form_array = array(
    "action" => "mod.php?mod=news&modfile=editcomment&cat_id=$catid&newsid=$newsid&commentid=$commentid",
    "title" => $lang['EDITCOMMENT_POST_HEAD'],
    "name" => 'editpost',
    "content" => $edit_post,
    "submit" => LANG_FORM_ADD_BUTTON
);

$index_middle .= $form->form_table($form_array);

echo $index_middle;
?> 