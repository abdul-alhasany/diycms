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


  $cat_id      = set_id_int('catid');
 include("modules/" . $mod->module . "/settings.php");
 include("modules/" . $mod->module . "/includes/cat_counter.class.php");
 
 
 
 // Display the login bar
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
$index_middle .= breadcrumb();

 $cat_counter = new cat_counter;
 
 $view_cat = cat_perm($cat_id, groupview, $_COOKIE['cgroup']);
 $mod->permission($view_cat);
 
 
 // Set the array to count the topics and the comments in a category
 $all_categories = $diy_db->query("SELECT catid,parent,countopic,countcomm
								FROM diy_forum_cat
								ORDER BY catid DESC");
								
 while ($cat_array = $diy_db->dbarray($all_categories)) {
     $cateogries_array[] = array(
         'catid' => $cat_array['catid'],
         'parent' => $cat_array['parent'],
         'countopic' => $cat_array['countopic'],
         'countcomm' => $cat_array['countcomm']
     );
 }
 
 
 // Check for sub categories

	
	   // Get the categories
	   $cat_result = $diy_db->query("SELECT diy_forum_cat.*,
						  diy_users.username as lastposter,
                          diy_users.userid as lastposterid,
                          diy_forum_threads.title as lasttitle,
						  diy_forum_threads.date_added as lastpostd
                          FROM diy_forum_cat
                          LEFT JOIN diy_forum_threads ON diy_forum_threads.threadid = diy_forum_cat.lastpostid
                          LEFT JOIN diy_users ON diy_users.userid = diy_forum_threads.lastuserid
                          WHERE diy_forum_cat.parent ='$cat_id' ORDER BY diy_forum_cat.cat_order ASC");
						  
			while($cat_row = $diy_db->dbarray($cat_result))
			{
			
			extract($cat_row);
        $cat_row         =  format_data_out($cat_row);
		
		// count the number of threads and replies per category
		$topcis_comments 	= $cat_counter->Build($cateogries_array,$catid);
		$topics_comments 	= explode('=',$topcis_comments);
        $threads_number     =  $countopic + $topics_comments['0'];
        $replies_number     =  $countcomm + $topics_comments['1'];
		
		// Check if the forum has new posts and show the relevant icon
		$cat_icon = ($lastpostd > $_COOKIE['lastvisit']) ? "new_posts.png" : "no_new_posts.png";
            
             $lastpostd     =   format_date($lastpostd)." ".format_time($lastpostd);
					
         eval("\$list_cat_row .= \" " . $mod->gettemplate ( 'forum_list_subcat_row' ) . "\";");
       }
	   $cat_no = $diy_db->dbnumquery("diy_forum_cat", "parent=$cat_id");
	   if($cat_no > 0)
	   {
	   eval("\$index_middle .= \" " . $mod->gettemplate ( 'forum_list_subcat_list' ) . "\";");
		}


 
 if (!isset($_GET['start'])) {
     $start = '0';
 } else {
     $start = $_GET['start'];
 }
 
 
 $topics_number = $diy_db->dbnumquery("diy_forum_threads", "cat_id=$cat_id");
 // Check if the this a category and not a forum
 
  $result = $diy_db->query("SELECT parent FROM diy_forum_cat WHERE catid='$cat_id'");
  $row = $diy_db->dbarray($result);
 	   if ($row['parent'] != 0) {
eval("\$index_middle .= \" " . $mod->gettemplate('forum_cat_tools') . "\";");

 // view the posts in this category
 $posts_per_page    = $mod->setting("posts_per_page");
 $comments_per_page = $mod->setting("comments_per_page");
 $sort_by           = $mod->setting("sort_posts_by");
 $getorder_by       = $mod->setting("order_posts_by");
 
 if ($getorder_by == "last_added") {
     $order_by = '.date_added';
 } elseif ($getorder_by == "last_added_comment") {
     $order_by = '_comment.date_added';
 } elseif ($getorder_by == "comments_number") {
     $order_by = '.comments_no';
 } elseif ($getorder_by == "readers") {
     $order_by = '.readers';
 }
 


     $result = $diy_db->query("SELECT diy_forum_threads.*,COUNT(diy_forum_comments.threadid) as numrows
                                FROM diy_forum_threads LEFT JOIN diy_forum_comments
                                ON diy_forum_threads.threadid = diy_forum_comments.threadid
                                WHERE diy_forum_threads.cat_id='$cat_id'
                                AND diy_forum_threads.allow = 'yes'
                                GROUP BY diy_forum_threads.threadid
                                ORDER BY diy_forum_threads.status, diy_forum_threads$order_by $sort_by");
     
     while ($row = $diy_db->dbarray($result)) {
         extract($row);
         $title   = format_data_out($title);
         $name    = format_data_out($username);
         $pagenum = pagination_list($numrows, $comments_per_page, "mod.php?mod=forum&modfile=viewpost&threadid=$threadid");
         $date    = format_date($date_added);
         
         
		if($closed == 1 AND $status == 0)
		{
		$title = $lang['CLOSED_TITLE'].$lang['STICKY'].$title;
		}elseif($closed == 1)
		{
		$title = $lang['CLOSED_TITLE'].$title;
		}elseif($status == 0)
		{
		$title = $lang['STICKY'].$title;
		}
		
        eval("\$list_row .= \" " . $mod->gettemplate('forum_list_threads_row') . "\";");
      
         
     }
     
 
 // check if there are topics in this forum to display the table
  if ($topics_number != 0) {
     eval("\$index_middle .= \" " . $mod->gettemplate('forum_list_threads') . "\";");
 }
 
 
 $index_middle .= pagination($topics_number, $posts_per_page, "mod.php?mod=forum&modfile=list&catid=$cat_id");
 }
 echo $index_middle;
 
?>