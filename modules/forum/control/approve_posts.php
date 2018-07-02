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
  
 if (RUN_MODULE !== true) {
     die("<center><h3>Not Allowed!</h3></center>");
 }
 
 include("modules/" . $mod->module . "/settings.php");
 	
if(( $_COOKIE['cid'] == 0) || ($_COOKIE['cid'] == $CONF['Guest_id']))
{
  eval("\$index_middle .=\" " . $mod->gettemplate ( 'forum_login_bar' ) . "\";");
}
else
{
    $userid = $_COOKIE['cid'];
	$pmumrows = $diy_db->dbnumquery("diy_messages","msgbox='1' and userid='".$_COOKIE['cid']."' AND msgisread ='1'");
	 $perm1 = $mod->setting('manage_cat', $_COOKIE['cgroup']);
	 $perm2 = $mod->setting('approve_posts', $_COOKIE['cgroup']);
	 
	 if(($perm1) && ($perm2))
	 {
        $isadmin = " | <a href=mod.php?mod=forum&dir=control>{$lang['INDEX_CONTROL_FORUM']}</b></font></a>";
	 }
  eval("\$index_middle .=\" " . $mod->gettemplate ( 'forum_tools_bar' ) . "\";");
}

 $index_middle .= $mod->nav_bar($lang['CONTROL_PENDING_POSTS']);
 
 $perm = $mod->setting('approve_posts', $_COOKIE['cgroup']);
 $mod->permission($perm);
 
 
 if (!isset($_GET['start'])) {
     $start = '0';
 } else {
     $start = $_GET['start'];
 }
 // Check if there is any action taken
 // First check if the posts are approved
 $approve = $_POST['approve'];
 if ($approve) {
     if (count($_POST['select']) > 0) {
         foreach ($_POST['select'] as $threadid) {
             $result = $diy_db->query("UPDATE diy_forum_threads set allow = 'yes' where threadid='$threadid'");
         }
         if ($result)
             $numrows = $diy_db->dbnumquery("diy_forum_threads", "allow != 'yes'", "threadid");
         info_message($lang['APPROVE_POSTS_SELECTED_POSTS_APPROVED'], "mod.php?mod=forum&dir=control&modfile=approve_posts");
     } else {
         info_message($lang['APPROVE_POSTS_NO_POSTS_SELECTED'], "mod.php?mod=forum&dir=control&modfile=approve_posts");
     }
 }
 
 // Check if the posts are deleted	
 $delete = $_POST['delete'];
 if ($delete) {
     if (count($_POST['select']) > 0) {
         foreach ($_POST['select'] as $threadid) {
             $result = $diy_db->query("DELETE from diy_forum_threads where threadid='$threadid'");
         }
         if ($result)
             $filename = get_file_path("$threadid"."_0.forum");
         @unlink($filename);
         
         $numrows = $diy_db->dbnumquery("diy_forum_threads", "allow != 'yes'", "threadid");
         
         info_message($lang['APPROVE_POSTS_SELECTED_POSTS_DELETED'], "mod.php?mod=forum&dir=control&modfile=approve_posts");
     } else {
         info_message($lang['APPROVE_POSTS_NO_POSTS_SELECTED'], "&dir=control&modfile=approve_posts");
     }
 }

 // Check if the posts are moved to a new category	
 $move = $_POST['move'];
 if ($move) {
     if (count($_POST['select']) > 0) {
         foreach ($_POST['select'] as $threadid) {
             $result = $diy_db->query("UPDATE diy_forum_threads SET cat_id='$new_catid' WHERE threadid='$threadid'");
         }
         if ($result)
             $numrows = $diy_db->dbnumquery("diy_forum_threads", "cat_id='$cat_id'");
         $result = $diy_db->query("UPDATE diy_forum_cat SET countopic='$numrows' where catid='$cat_id'");
         
         info_message($lang['APPROVE_POSTS_SELECTED_POSTS_MOVED'], "mod.php?mod=forum&dir=control&modfile=approve_posts");
     } else {
         info_message($lang['APPROVE_POSTS_NO_POSTS_SELECTED'], "mod.php?mod=forum&dir=control&modfile=approve_posts");
     }
 }
 
 $perpage = 50;
 $result  = $diy_db->query("SELECT * FROM diy_forum_threads WHERE
                                allow != 'yes' ORDER BY threadid DESC
                                LIMIT  $start,$perpage");
 
 while ($row = $diy_db->dbarray($result)) {
     extract($row);
     
     eval("\$approve_posts_row .= \" " . $mod->gettemplate('forum_control_pending_posts_row') . "\";");
 }
 
 
 $category = $diy_db->query("SELECT * FROM diy_forum_cat ORDER BY catid");
 while ($category_list = $diy_db->dbarray($category)) {
     $catid     = $category_list['catid'];
     $cat_title = $category_list['cat_title'];
     $options .= "<option value='$catid'>$cat_title</option>";
 }
 
 eval("\$index_middle .= \" " . $mod->gettemplate('forum_control_pending_posts') . "\";");
 
 
 
 $numrows = $diy_db->dbnumquery("diy_forum_threads", "allow != 'yes'");
 $index_middle .= pagination($numrows, $perpage, "mod.php?mod=forum&dir=control&modfile=approve_posts");
 echo $index_middle;
 
?>