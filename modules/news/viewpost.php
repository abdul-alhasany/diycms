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

include("modules/" . $mod->module . "/settings.php");
require_once ('includes/module_templates_stream.class.php');

$edit_perm = $mod->setting('edit_all_posts', $_COOKIE['cgroup']);

$newsid = set_id_int('newsid');
$row    = $diy_db->dbfetch("SELECT diy_news.*,diy_users.userid,diy_users.username,
                                 diy_users.register_date,diy_users.all_posts,diy_users.signature,
                                 diy_users.website,diy_users.avatar,diy_users.groupid
								 FROM diy_news,diy_users
                                 WHERE allow='yes'
								 AND newsid='$newsid'
								 AND diy_news.userid = diy_users.userid
								 LIMIT 1");

// check if the post existed
if (!$edit_perm) {
    if (empty($row))
        error_message(LANG_ERROR_URL);
}

extract($row);
$row = format_data_out($row);

$post_catid = $cat_id;


// Check if the user belonges to a group that is allowed to view the category	
$view_cat = cat_perm($cat_id, groupview, $_COOKIE['cgroup']);
$mod->permission($view_cat);

$index_middle .= breadcrumb($cat_id, $cat_title);

$bbcode = new bbcode;
$post   = replace_censored_words($post);
$post   = post_output($post, $editor_type);
$post   = replace_smile_images($post);
$post   = highlight_words($post);

$diy_db->query("UPDATE diy_news SET readers = readers+1 WHERE newsid = '$newsid'");

$date = format_date($date_added) . " " . format_time($date_added);

// Check if an attachment exists
if ($uploadfile) {
    $attachment = get_attachment($newsid, 'post');
}

eval("\$index_middle .= \" " . $mod->gettemplate('news_viewpost_post') . "\";");

if ($edit_perm) {
    $index_middle .= admin_jumpmenu($newsid, $cat_id, $status, $closed);
}

$comments_per_page = $mod->setting("comments_per_page");
	
// Check if the post has comments or not
if ($comments_no > 0) {

    $result = $diy_db->query("SELECT diy_news_comments.*,diy_users.userid,diy_users.username,
                                 diy_users.register_date,diy_users.all_posts,diy_users.signature,
                                 diy_users.website,diy_users.avatar,diy_users.groupid
								 FROM diy_news_comments,diy_users
                                 WHERE newsid='$newsid'
								 AND allow='yes'
								 AND diy_news_comments.userid = diy_users.userid
								 ORDER BY commentid ASC
                                 LIMIT $start,$comments_per_page");
    
    while ($row = $diy_db->dbarray($result)) {
        extract($row);
        $row = format_data_out($row);
        
        $comment = replace_censored_words($comment);
        $comment = post_output($comment, get_group_setting('editor_type'));
        $comment = replace_smile_images($comment);
        $comment = highlight_words($comment);
        $date    = format_date($date_added) . " " . format_time($date_added);
        
        if (!$edit_perm) {
            $style = 'display:none;';
        }
		$comments_variable = array('author' => $row[4], 'comment' => $comment, 'date' => $date, 'newsid' => $newsid, 'cat_id' => $cat_id, 'commentid' => $commentid, 'edit_perm' => $edit_perm);
		
        $index_middle .= $mod->get_template_code('news_view_comment', $comments_variable);
    }
    
}

eval("\$index_middle .= \" " . $mod->gettemplate('news_post_tools') . "\";");

$index_middle .= pagination($comments_no, $comments_per_page, "mod.php?mod=news&modfile=viewpost&newsid=$newsid");
echo $index_middle;

?>