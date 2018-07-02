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

 //---------------------------------------------------
 // Change the subscribtion status for the post
 //---------------------------------------------------
 
 function add_style($lang)
{
    global $mod;
	$dir = ($lang == 'arabic') ? 'rtl' : 'ltr';
	$style = '<link rel="stylesheet" type="text/css" href="modules/' . $mod->modInfo['mod_name'] . '/'.$dir.'.css">';
    
    return $style;
}

 
 //---------------------------------------------------
 // category jump menu
 //---------------------------------------------------
 
 /**
  * view_categories()
  * 
  * @return
  */
 function view_categories()
 {
     global $diy_db;
     require_once('cat_list.class.php');
     $result = $diy_db->query("SELECT catid,cat_title,parent FROM diy_forum_cat ORDER BY catid DESC");
     
     while ($row = $diy_db->dbarray($result)) {
         extract($row);
         $Master[] = array(
             'catid' => $catid,
             'cat_title' => "" . $cat_title . "",
             'parent' => $parent
         );
     }
     $list     = new category_list;
     $cat_list = $list->build_list($Master);
     unset($Master);
     return $cat_list;
 }
 
 //---------------------------------------------------
 // The navigation line located to the top of the forum module
 //---------------------------------------------------
 /**
  * breadcrumb()
  * 
  * @param string $cat_id
  * @param string $title
  * @return
  */
 function breadcrumb($cat_id = '', $title = '')
 {
     global $mod, $lang;
     include("modules/" . $mod->module . "/includes/breadcrumb.class.php");
     
     if ($cat_id == '') {
         $cat_id = intval($_GET['catid']);
     }
     
     $nav_bits = new nav_bits;
     $nav_bits = $nav_bits->create_nav_bits($cat_id);
     
     $sitetitle = get_global_setting("sitetitle");
     
     eval("\$template .=\"" . $mod->gettemplate('forum_breadcrumb') . "\";");
     return $template;
 }
 
 //------------------------------------------
 // This function gets the category permissions to view or to post
 // --------------------------------------------
 /**
  * cat_perm()
  * 
  * @param mixed $catid
  * @param mixed $type
  * @param mixed $value
  * @return
  */
 function cat_perm($catid, $type, $value)
 {
     global $diy_db;
     $result = $diy_db->query("SELECT groupview,grouppost FROM diy_forum_cat WHERE catid='$catid' ORDER BY cat_order ASC");
     $row    = $diy_db->dbarray($result);
     extract($row);
     
     if ($type == 'groupview') {
         $find = strpos($groupview, "$value");
     } else {
         $find = strpos($grouppost, "$value");
     }
     if ($find !== false)
         return true;
     else
         return false;
 }
 

 
 //---------------------------------------------------
 // This function retrives the attachment for a given post
 //----------------------------------------
 /**
  * get_attachment()
  * 
  * @param mixed $id
  * @param string $location
  * @return
  */
 function get_attachment($id, $location)
 {
     global $mod, $lang, $diy_db;
     $result = $diy_db->query("SELECT * FROM diy_upload
						WHERE module='forum'
						AND post_id='$id'
						AND location='$location'");
     
     if ($diy_db->dbnumrows($result) > 0) {
	 while($rowfile =$diy_db->dbarray($result))
        {
         extract($rowfile);
         $extension = strtolower($extension);
         $size    = format_Size($size);
		 
		 $i++;
		 $download .= "<tr><td><div class=\"article_info\">";
		 $download .= "<a href=\"mod.php?mod=forum&modfile=misc&action=attachment&upid=$upid&fullpage=1\">$name</a> ($size - $clicks)";
		 $download .= "</div></td></tr>";

     }
	  eval("\$attachment .=\"" . $mod->gettemplate('forum_view_attachment') . "\";");
	  return $attachment;
 }
 }
 
 
 //---------------------------------------------------
 // Admin and modertators jumb menu                  /
 //---------------------------------------------------
 /**
  * admin_jumpmenu()
  * 
  * @param mixed $threadid
  * @param mixed $status
  * @return
  */
 function admin_jumpmenu($threadid, $status)
 {
     global $lang;
     
     $Jump = "<table border='0'width='90%' cellspacing='0' cellpadding='0'>\n";
     $Jump .= "<tr>\n";
     $Jump .= "<td width='100%'  align='center'>\n";
     $Jump .= "<form name='Jump'>\n";
     $Jump .= "<font size=2>\n";
     $Jump .= "<b> {$lang['INCLUDES_FUNCTIONS_ADMIN_MENU']}</b>\n";
     $Jump .= "<select name='Menu' onChange='location=document.Jump.Menu.options[document.Jump.Menu.selectedIndex].value;' value='GO'>\n";
     $Jump .= "<option>{$lang['INCLUDES_FUNCTIONS_ADMIN_MENU_CHOOSE']}</option>\n";
     $Jump .= "<option value='mod.php?mod=forum&modfile=editpost&threadid=$threadid'>{$lang['INCLUDES_FUNCTIONS_ADMIN_MENU_EDIT']}</option>\n";
     
     
     // Check if the topic is closed or open
     if ($status == '2' || $status == '12') {
         $label = $lang['INCLUDES_FUNCTIONS_ADMIN_MENU_UNCLOSE'];
         $Jump .= "<option value='mod.php?mod=forum&modfile=misc&action=change_status&do=open_topic&threadid=$threadid'> $label </option>\n";
     } else {
         $label = $lang['INCLUDES_FUNCTIONS_ADMIN_MENU_CLOSE'];
         $Jump .= "<option value='mod.php?mod=forum&modfile=misc&action=change_status&do=close_topic&threadid=$threadid'> $label </option>\n";
     }
     
     // Check if the post is pinned or not
     if ($status == '1' || $status == '12') {
         $label = $lang['INCLUDES_FUNCTIONS_ADMIN_MENU_UNPIN'];
         $Jump .= "<option value='mod.php?mod=forum&modfile=misc&action=change_status&do=unpin_topic&threadid=$threadid'> $label </option>\n";
     } else {
         $label = $lang['INCLUDES_FUNCTIONS_ADMIN_MENU_PIN'];
         $Jump .= "<option value='mod.php?mod=forum&modfile=misc&action=change_status&do=pin_topic&threadid=$threadid'> $label </option>\n";
     }
     
     $Jump .= "</select>\n";
     $Jump .= "</font>\n";
     $Jump .= "</form>\n";
     $Jump .= "</td></tr></table>";
     return $Jump;
 }

 
 //-------------------------------------------------------------
 // This function gets the comment url in case it is edited  
 //-------------------------------------------------------------
 
 /**
  * get_comment_url()
  * 
  * @param mixed $threadid
  * @param mixed $comment_id
  * @return
  */
 function get_comment_url($threadid, $comment_id)
 {
     global $diy_db, $mod;
     
     $comments_per_page = $mod->setting("comments_per_page");
     $numrows           = $diy_db->dbnumquery("diy_forum_comments", "threadid ='$threadid' AND allow='yes'");
     
     $comment_results = $diy_db->query("SELECT * FROM diy_forum_comments
								WHERE threadid='$threadid'
								AND allow='yes'
								ORDER BY commentid ASC");
     while ($row = $diy_db->dbarray($comment_results)) {
         extract($row);
         $comment_array[] = $commentid;
     }
     
     
     foreach ($comment_array as $c_key => $c_value) {
         if ($c_value == $comment_id)
             $comment_key = $c_key;
     }
     
     if ($numrows > $comments_per_page) {
         $pages                  = ceil($numrows / $comments_per_page);
         $cpp                    = '0';
         $last_comments_per_page = $comments_per_page;
         for ($i = 0; $i < $pages; $i++) {
             $page_array[] = "$cpp,$last_comments_per_page";
             $cpp += $comments_per_page;
             $last_comments_per_page += $comments_per_page;
         }
         
         foreach ($page_array as $page_key => $page_value) {
             $after  = strstr($page_value, ',');
             $length = strlen($after);
             $before = substr($page_value, 0, -$length);
             $after  = substr($after, 1);
             
             if (($comment_key >= $before) && ($comment_key < $after)) {
                 $start    = $page_value;
                 $nextpage = $comments_per_page * ($pages - 1);
                 $page_key = $page_key + 1;
                 $url      = "mod.php?mod=forum&modfile=viewpost&threadid=$threadid&start=$before&page=$page_key#comment$comment_id";
                 
             }
             
         }
     } else {
         $url = "mod.php?mod=forum&modfile=viewpost&threadid=$threadid#comment$comment_id";
     }
     return $url;
 }
 
 /**
  * page_infomration()
  * 
  * @param mixed $title
  * @param mixed $post
  * @return
  */
 function page_infomration($title, $post)
	{
	global $function_contents;
	require_once("includes/keyword_generator.class.php");
	$params['content'] = $post;
	
	$keyword = new autokeyword($params);
	$autoKeywords = $keyword->get_keywords();
	
	
	$text = preg_replace('@<title>(.+?)</title>@i', "<title>$title - ". get_global_setting("sitetitle")."</title>", $function_contents['page_header']);
	$text = preg_replace('@</head>@i', "<META content=\"" . get_global_setting("keywords") . "," . $autoKeywords . "\" name=\"keywords\"></head>", $text);
	
	return $text;
	}

function get_most_read_threads($count_limit = 5,$text_limit = 20)
{
	global $diy_db, $lang;
	$threads = "<ul>";
	$result = $diy_db->query("SELECT * FROM diy_forum_threads ORDER BY readers DESC LIMIT 0,$count_limit");
	while($row =$diy_db->dbarray($result))
        {
			extract($row);
			$title = limit_text_view($title, $text_limit);
			$threads .= "<li title='{$lang['READERS']}$readers'><a href='mod.php?mod=forum&modfile=viewpost&threadid=$threadid'>$title</a></li>";
		}
	$threads .= "</ul>";
	return $threads;
}
	
function get_most_commented_threads($count_limit = 5,$text_limit = 20)
{
	global $diy_db, $lang;
	$comments = "<ul>";
	$result = $diy_db->query("SELECT * FROM diy_forum_threads ORDER BY comments_no DESC LIMIT 0,$count_limit");
	while($row = $diy_db->dbarray($result))
        {
			extract($row);
			$title = limit_text_view($title, $text_limit);
			$comments .= "<li title='{$lang['COMMENTS']}$comments_no'><a href='mod.php?mod=forum&modfile=viewpost&threadid=$threadid'>$title</a></li>";
		}
	$comments .= "</ul>";
	return $comments;
}

function get_top_users($count_limit = 5,$text_limit = 20)
{
	global $diy_db, $lang, $CONF;
	$users = "<ul>";
	$result = $diy_db->query("SELECT userid, username, count(*) as posts
							from (
							SELECT userid, username from diy_forum_threads
							union all
							SELECT userid, username from diy_forum_comments
							) as x
							WHERE userid != {$CONF['Guest_id']}
							GROUP BY username
							ORDER BY posts DESC
							LIMIT 0,$count_limit");
	while($row = $diy_db->dbarray($result))
        {
			extract($row);
			$username = limit_text_view($username, $text_limit);
			$users .= "<li title='{$lang['POSTS']}$posts'><a href='mod.php?mod=users&modfile=info&userid=$userid'>$username</a></li>";
		}
	$users .= "</ul>";
	return $users;
}

function get_active_catgories($count_limit = 5,$text_limit = 20)
{
	global $diy_db, $lang, $CONF;
	$categories = "<ul>";
	$result = $diy_db->query("SELECT catid, cat_title, sum(countopic+countcomm) as posts
							FROM diy_forum_cat
							GROUP BY catid
							ORDER BY posts DESC
							LIMIT 0,$count_limit");
	while($row = $diy_db->dbarray($result))
        {
			extract($row);
			$username = limit_text_view($username, $text_limit);
			$categories .= "<li title='{$lang['POSTS']}$posts'><a href='mod.php?mod=forum&modfile=list&catid=$catid'>$cat_title</a></li>";
		}
	$categories .= "</ul>";
	return $categories;
}

function get_last_threads($count_limit = 10, $text_limit = 40)
{
	global $diy_db, $lang, $CONF;
	$categories = "<ul>";
	$result = $diy_db->query("SELECT threadid, userid, username, title, date_added FROM `diy_forum_threads`
							ORDER BY date_added DESC
							LIMIT 0,$count_limit");
	while($row = $diy_db->dbarray($result))
        {
			extract($row);
			$title = limit_text_view($title, $text_limit);
			$date = format_date($date_added);
			$categories .= "<li><span class='title'><a href='mod.php?mod=forum&modfile=viewpost&threadid=$threadid'>$title</a></span>";
			$categories .= "<span class='username'><a href='mod.php?mod=users&modfile=info&userid=$userid'>$username</a></span>";
			$categories .= "<span class='time'>$date</span><div style='clear:both;'></div></li>";
		}
	$categories .= "</ul>";
	return $categories;
}
?>