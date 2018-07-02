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

 if (RUN_MODULE !== true) {
     die("<center><h3>Not Allowed!</h3></center>");
 }
 
 include("modules/" . $mod->module . "/settings.php");
 
 $index_middle = $mod->nav_bar($lang['APPROVE_COMMENTS_UNAPPROVED_COMMENTS']);
 
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
         foreach ($_POST['select'] as $commentid) {
			 $result = $diy_db->query("UPDATE diy_news_comments set allow = 'yes' where commentid='$commentid'");
         }
         if ($result)
             $numrows = $diy_db->dbnumquery("diy_news_comments", "allow != 'yes'", "commentid");
         info_message($lang['APPROVE_COMMENTS_SELECTED_POSTS_APPROVED'], "mod.php?mod=news&dir=control&modfile=approve_comments");
     } else {
         error_message($lang['APPROVE_COMMENTS_NO_POSTS_SELECTED'], "mod.php?mod=news&dir=control&modfile=approve_comments");
     }
 }
 
 // Check if the posts are deleted	
 $delete = $_POST['delete'];
 if ($delete) {
   
     if (count($_POST['select']) > 0) {
         foreach ($_POST['select'] as $commentid) {
             $result = $diy_db->query("DELETE FROM diy_news_comments WHERE commentid='$commentid'");
         }
         if ($result)
             $filename = get_file_path("$commentid.newscomment");
         @unlink($filename);
         
         $numrows = $diy_db->dbnumquery("diy_news_comments", "allow != 'yes'", "commentid");
         
         info_message($lang['APPROVE_COMMENTS_SELECTED_POSTS_DELETED'], "mod.php?mod=news&dir=control&modfile=approve_comments");
     } else {
         info_message($lang['APPROVE_COMMENTS_NO_POSTS_SELECTED'], "mod.php?mod=news&dir=control&modfile=approve_comments");
     }
 }

 $perpage = 50;
 $result  = $diy_db->query("SELECT * FROM diy_news_comments WHERE
                                allow != 'yes' ORDER BY commentid DESC
                                LIMIT  $start,$perpage");
 
 while ($row = $diy_db->dbarray($result)) {
     extract($row);
     
     eval("\$approve_posts_row .= \" " . $mod->gettemplate('news_control_unapproved_comments_row') . "\";");
 }
 
 
 eval("\$index_middle .= \" " . $mod->gettemplate('news_control_unapproved_comments') . "\";");
 
 
 
 $numrows = $diy_db->dbnumquery("diy_news_comments", "allow != 'yes'");
 $index_middle .= pagination($numrows, $perpage, "mod.php?mod=news&dir=control&modfile=approve_comments");
 echo $index_middle;
 
?>