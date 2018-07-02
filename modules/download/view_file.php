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


include ("modules/" . $mod->module . "/settings.php");

if (!isset($_GET['start']))
{
  $start = '0';
}
else
{
  $start = $_GET['start'];
}

$downid = set_id_int('downid');
$row = $diy_db->dbfetch("SELECT diy_download_files.*,diy_users.userid,diy_users.username,
                                 diy_users.register_date,diy_users.all_posts,diy_users.signature,
                                 diy_users.website,diy_users.avatar,diy_users.groupid
								 FROM diy_download_files,diy_users
                                 WHERE allow='yes'
								 AND downid='$downid'
								 AND diy_download_files.userid = diy_users.userid
								 LIMIT 1");

if (empty($row)) error_message($lang['LANG_ERROR_URL']);
extract($row);

// Check if the user belonges to a group that is allowed to view the category
$view_cat = cat_perm($cat_id, groupview, $_COOKIE['cgroup']);
$mod->permission($view_cat);

// Build user groups array
$usergroup = $diy_db->query("SELECT groupid,grouptitle FROM diy_groups ");
while ($groups_row = $diy_db->dbarray($usergroup))
{
  $gid = $groups_row['groupid'];
  $group_array[$gid] = $groups_row['grouptitle'];
}

// build user ranks array
$userranks = $diy_db->query("SELECT * FROM diy_userranks");
while ($user_ranks = $diy_db->dbarray($userranks))
{
  extract($user_ranks);
  $rank_array[$posts_no][$rank_title] = $repetition;
}

// add the breadcrumb
$index_middle .= breadcrumb($cat_id, $cat_title);
$row = format_data_out($row);

$post = replace_censored_words($post);
$post = post_output($post, get_group_setting('editor_type'));
$post = replace_smile_images($post);
$post = highlight_words($post);

$diy_db->query("UPDATE diy_download_files SET readers = readers+1 WHERE downid = '$downid'");

if ($start == 0)
{
  $userrank = get_user_rank($rank_array, $all_posts);
  $usergroup = get_user_group($group_array, $groupid);
  if (($userid == 0) || ($userid == $CONF['Guest_id']))
  {
    $usertitle = $username;
    $username = format_data_out($username);
    $date_added = format_date($date_added);
    $allposts = 1;
  }
  else
  {
    $username = format_data_out($username);
    $website = add_to_url($website);
    $signature = format_data_out($signature);

    $avatarfile = get_file_path("$userid.avatar", 'users');
    if (file_exists($avatarfile))
    {
      $avatar_pic = "<img src=filemanager.php?action=avatar&userid=" . $userid . "><br>";
    }
    else
    {
      $avatar_pic = '';
    }

  }

  $date = format_date($date_added) . " " . format_time($date_added);
  $rating = @ceil($rating_total / $ratings);
  $rating_avg = rating_avg($rating);

  eval("\$index_middle .= \" " . $mod->gettemplate('download_viewfile_file') . "\";");



  $edit_perm = $mod->setting('edit_all_posts', $_COOKIE['cgroup']);
  if ($edit_perm)
  {
    $index_middle .= admin_jumpmenu($downid, $status);
  }
}

// check whether the post is closed or not
if ($status == '2' || $status == '12')
{

  eval("\$replay_img = \"" . $mod->gettemplate('download_viewfile_reply_close') . "\";");
}
else
{
  eval("\$replay_img = \"" . $mod->gettemplate('download_viewfile_reply_open') . "\";");
}



// Check if the post has comments or not
if ($comments_no > 0)
{
  $comments_per_page = $mod->setting("comments_per_page");
  $numrows = $diy_db->dbnumquery("diy_download_comments", "downid='$downid' AND allow='yes'", "commentid");
  $pagenum = pagination($numrows, $comments_per_page, "mod.php?mod=download&modfile=view_file&downid=$downid");
  eval("\$index_middle .=\" " . $mod->gettemplate('post_tools') . "\";");

  $result = $diy_db->query("SELECT diy_download_comments.*,diy_users.userid,diy_users.username,
                                 diy_users.register_date,diy_users.all_posts,diy_users.signature,
                                 diy_users.website,diy_users.avatar,diy_users.groupid
								 FROM diy_download_comments,diy_users
                                 WHERE downid='$downid'
								 AND allow='yes'
								 AND diy_download_comments.userid = diy_users.userid
								 ORDER BY commentid ASC
                                 LIMIT $start,$comments_per_page");

  while ($row = $diy_db->dbarray($result))
  {
    extract($row);
    $row = format_data_out($row);
    if (($userid == 0) || ($userid == $CONF['Guest_id']))
    {
      $usergroup = get_user_group($group_array, $groupid);
      $usertitle = $username;
      $datetime = format_date($register_date);
      $allposts = 1;
      $userrank = get_user_rank($rank_array, '1');
    }
    else
    {
      $userrank = get_user_rank($rank_array, $all_posts);
      $usergroup = get_user_group($group_array, $groupid);
      $datetime = format_date($register_date);
      $signature = format_data_out($signature);
    }

    $comment = replace_censored_words($comment);
    $comment = post_output($comment, get_group_setting('editor_type'));
    //$comment = $bbcode->format_bbcode($comment);
    $comment = replace_smile_images($comment);
    $comment = highlight_words($comment);
    $date = format_date($date_added) . " " . format_time($date_added);

    $avatarfile = get_file_path("$userid.avatar", 'users');
    if (file_exists($avatarfile))
    {
      $avatar_pic = "<img src=filemanager.php?action=avatar&userid=" . $userid . "><br>";
    }
    else
    {
      $avatar_pic = '';
    }

    
    // check whether the post is closed or not
    if ($status == '2' || $status == '12')
    {

      eval("\$replay_img = \"" . $mod->gettemplate('download_viewfile_reply_close') . "\";");
    }
    else
    {
      eval("\$replay_img = \"" . $mod->gettemplate('download_viewfile_reply_open') . "\";");
    }

  }

  eval("\$index_middle .= \" " . $mod->gettemplate('download_post_tools') . "\";");
}
else
{
  eval("\$index_middle .= \" " . $mod->gettemplate('download_post_tools') . "\";");
}

echo $index_middle;

?>