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
 
 $mod = new module('forum');
 define('RUN_MODULE', true);
 echo '<link rel="stylesheet" type="text/css" href="modules/'.$mod->module.'/ltr.css">';
 // include required files
include("modules/" . $mod->module . "/settings.php");
include("modules/" . $mod->module . "/includes/cat_counter.class.php");

// get the naviagation bar	
$index_middle .= $mod->nav_bar();

if (($_COOKIE['cid'] == 0) || ($_COOKIE['cid'] == $CONF['Guest_id'])) {
    eval("\$index_middle .=\" " . $mod->gettemplate('forum_login_bar') . "\";");
} else {
    $userid   = $_COOKIE['cid'];
    $pmumrows = $diy_db->dbnumquery("diy_messages", "msgbox='1' and userid='" . $_COOKIE['cid'] . "' AND msgisread ='1'");
    $perm1    = $mod->setting('manage_cat', $_COOKIE['cgroup']);
    $perm2    = $mod->setting('approve_posts', $_COOKIE['cgroup']);
    
    if (($perm1) && ($perm2)) {
        $isadmin = " | <a href=mod.php?mod=forum&dir=control>{$lang['INDEX_CONTROL_FORUM']}</b></font></a>";
    }
    eval("\$index_middle .=\" " . $mod->gettemplate('forum_tools_bar') . "\";");
}

$cat_counter = new cat_counter;

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


$result = $diy_db->query("SELECT * FROM diy_forum_cat
							WHERE parent='0' ORDER BY cat_order ASC");

while ($row = $diy_db->dbarray($result)) {
    $cat_id     = $row['catid'];
    // Get the categories
    $cat_result = $diy_db->query("SELECT diy_forum_cat.*,
						  diy_users.username as lastposter,
                          diy_users.userid as lastposterid,
                          diy_forum_threads.title as lasttitle,
						  diy_forum_threads.date_added as lastpostd
                          FROM diy_forum_cat
                          LEFT JOIN diy_forum_threads ON diy_forum_threads.threadid = diy_forum_cat.lastpostid
                          LEFT JOIN diy_users ON diy_users.userid = diy_forum_threads.userid
                          WHERE diy_forum_cat.parent ='$row[catid]' ORDER BY diy_forum_cat.cat_order ASC");
    
    while ($cat_row = $diy_db->dbarray($cat_result)) {
        extract($cat_row);
        $cat_row = format_data_out($cat_row);
        
        // count the number of threads and replies per category
        $topcis_comments = $cat_counter->Build($cateogries_array, $catid);
        $topics_comments = explode('=', $topcis_comments);
        $threads_number  = $countopic + $topics_comments['0'];
        $replies_number  = $countcomm + $topics_comments['1'];
        
        // Check if the forum has new posts and show the relevant icon
        $cat_icon  = ($lastpostd > $_COOKIE['lastvisit']) ? "new_posts.png" : "no_new_posts.png";
        $lastpostd = format_date($lastpostd) . " " . format_time($lastpostd);
        
        eval("\$list_cat_row['$row[catid]'] .= \" " . $mod->gettemplate('forum_index_cat_row') . "\";");
    }
    eval("\$index_middle .= \" " . $mod->gettemplate('forum_index_list_cat') . "\";");
}

$count_limit = 5;
$text_limit = 50;

$most_read = get_most_read_threads($count_limit, $text_limit);
$most_commented = get_most_commented_threads($count_limit, $text_limit);
$top_users = get_top_users($count_limit, $text_limit);
$active_categories = get_active_catgories($count_limit, $text_limit);
$last_10 = get_last_threads();

eval("\$index_middle .= \" " . $mod->gettemplate('forum_index_bottom') . "\";");

unset($cateogries_array);


?>