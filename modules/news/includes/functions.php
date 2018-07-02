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
    global $diy_db, $mod;
    require_once('cat_list.class.php');
    $result = $diy_db->query("SELECT catid,cat_title,parent FROM diy_news_cat ORDER BY catid DESC");
    
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

function add_style($lang)
{
    global $mod;
	$dir = ($lang == 'arabic') ? 'rtl' : 'ltr';
	
	$style = '<link rel="stylesheet" type="text/css" href="modules/' . $mod->modInfo['mod_name'] . '/'.$dir.'.css">';
    
    return $style;
}

/**
 * get the posts and comments number for a certain category
 * 
 * @param string $cat_id
 * @return
 */
function count_posts_comments($cat_id)
{
    global $mod, $diy_db;
    
    // query database
    $query = $diy_db->dbfetch("SELECT 
		 zero_level.countopic         AS zero_countopic     ,
         zero_level.countcomm         AS zero_countcomm  ,
         1st_level.countopic          AS first_countopic    ,
         1st_level.countcomm          AS first_countcomm ,
         2nd_level.countopic          AS second_countopic   ,
         2nd_level.countcomm          AS second_countcomm,
         3rd_level.countopic          AS third_countopic    ,
         3rd_level.countcomm          AS third_countcomm
FROM   diy_news_cat    					AS zero_level
       LEFT OUTER JOIN diy_news_cat 	AS 1st_level
       ON     1st_level.parent = zero_level.catid
       LEFT OUTER JOIN diy_news_cat AS 2nd_level
       ON     2nd_level.parent = 1st_level.catid
       LEFT OUTER JOIN diy_news_cat AS 3rd_level
       ON     3rd_level.parent = 2nd_level.catid
WHERE  zero_level.catid       = $cat_id", 'ASSOC');
    
    extract($query);
    
    // sum all values
    $count['topics_count']   = $zero_countopic + $first_countopic + $second_countopic + $third_countopic;
    $count['comments_count'] = $zero_countcomm + $first_countcomm + $second_countcomm + $third_countcomm;
    
    
    return $count;
}

/**
 * The navigation line located to the top of the module
 * 
 * @param string $cat_id
 * @param string $title
 * @return
 */
function breadcrumb($cat_id)
{
    global $mod, $diy_db;
    
    // query database
    $query = $diy_db->dbfetch("SELECT 
		zero_level.catid             AS zero_id     ,
         zero_level.cat_title         AS zero_title  ,
         1st_level.catid              AS first_id    ,
         1st_level.cat_title          AS first_title ,
         2nd_level.catid              AS second_id   ,
         2nd_level.cat_title          AS second_title,
         3rd_level.catid              AS third_id    ,
         3rd_level.cat_title          AS third_title
		 
FROM     diy_news_cat                 AS zero_level
         LEFT OUTER JOIN
			diy_news_cat AS 1st_level
         ON
			1st_level.catid = zero_level.parent
			LEFT OUTER JOIN
			diy_news_cat AS 2nd_level
         ON
			2nd_level.catid = 1st_level.parent
         LEFT OUTER JOIN
			diy_news_cat AS 3rd_level
         ON
			3rd_level.catid = 2nd_level.parent			
WHERE zero_level.catid = $cat_id
ORDER BY zero_title ASC", 'ASSOC');
    
    extract($query);
    
    $nav_array[$zero_title]   = $zero_id;
    $nav_array[$first_title]  = $first_id;
    $nav_array[$second_title] = $second_id;
    $nav_array[$third_title]  = $third_id;
    
    foreach ($nav_array as $key => $value) {
        if (!empty($key))
            $nav_array[$key] = "mod.php?mod=news&modfile=list&catid={$value}";
        else
        // remove empty elements
            unset($nav_array[$key]);
    }
    
    // reverse array so it displays correctly
    $nav_array = array_reverse($nav_array);
    
    $nav_bar = $mod->nav_bar($nav_array);
    return $nav_bar;
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
    $result = $diy_db->query("SELECT groupview, grouppost FROM diy_news_cat WHERE catid='$catid' ORDER BY cat_order ASC");
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
 * @param string $parentid
 * @return
 */
function get_attachment($id, $location)
{
    global $mod, $lang, $diy_db;
    $result = $diy_db->query("SELECT * FROM diy_upload
						WHERE module='news'
						AND post_id='$id'
						AND location='$location'");
    
    if ($diy_db->dbnumrows($result) > 0) {
        while ($rowfile = $diy_db->dbarray($result)) {
            extract($rowfile);
            $extension = strtolower($extension);
            $size      = format_Size($size);
            
            $i++;
            $download .= "<tr><td><div id='post_attachment'>";
            $download .= "<a href=\"mod.php?mod=news&modfile=misc&action=attachment&upid=$upid&fullpage=1\">$name</a> ($size - $clicks)";
            $download .= "</div></td></tr>";
            
        }
        eval("\$attachment .=\"" . $mod->gettemplate('news_view_attachment') . "\";");
        return $attachment;
    }
}


//---------------------------------------------------
// Admin and modertators jumb menu                  /
//---------------------------------------------------

/**
 * admin_jumpmenu()
 * 
 * @param mixed $newsid
 * @param mixed $status
 * @return
 */
function admin_jumpmenu($newsid, $cat_id, $status, $closed)
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
    $Jump .= "<option value='mod.php?mod=news&modfile=editpost&newsid=$newsid&cat_id=$cat_id'>{$lang['INCLUDES_FUNCTIONS_ADMIN_MENU_EDIT']}</option>\n";
    
    
    // Check if the topic is closed or open
    if ($closed == '1') {
        $label = $lang['INCLUDES_FUNCTIONS_ADMIN_MENU_UNCLOSE'];
        $Jump .= "<option value='mod.php?mod=news&modfile=misc&action=change_status&do=open_topic&newsid=$newsid'> $label </option>\n";
    } else {
        $label = $lang['INCLUDES_FUNCTIONS_ADMIN_MENU_CLOSE'];
        $Jump .= "<option value='mod.php?mod=news&modfile=misc&action=change_status&do=close_topic&newsid=$newsid'> $label </option>\n";
    }
    
    // Check if the post is pinned or not
    if ($status == '0') {
        $label = $lang['INCLUDES_FUNCTIONS_ADMIN_MENU_UNPIN'];
        $Jump .= "<option value='mod.php?mod=news&modfile=misc&action=change_status&do=unpin_topic&newsid=$newsid'> $label </option>\n";
    } else {
        $label = $lang['INCLUDES_FUNCTIONS_ADMIN_MENU_PIN'];
        $Jump .= "<option value='mod.php?mod=news&modfile=misc&action=change_status&do=pin_topic&newsid=$newsid'> $label </option>\n";
    }
    
    $Jump .= "</select>\n";
    $Jump .= "</font>\n";
    $Jump .= "</form>\n";
    $Jump .= "</td></tr></table>";
    return $Jump;
}




/**
 * This function gets the comment url in case it is edited
 * 
 * @param mixed $comment_id
 * @return
 */
function get_comment_url($newsid, $comment_id)
{
    global $diy_db, $mod;
    
    $comments_per_page = $mod->setting("comments_per_page");
    $numrows           = $diy_db->dbnumquery("diy_news_comments", "newsid ='$newsid' AND allow='yes'");
	
	if($numrows > $comments_per_page)
	{
     $start = $numrows - $comments_per_page;
	 if($start%2 != 0)
	 $start += 1;
	 
	 $page   = round($numrows / $comments_per_page);
	 
     $url      = "mod.php?mod=news&modfile=viewpost&newsid=$newsid&start=$start&page=$page#comment-$comment_id";
	}
	else
	{
		$url      = "mod.php?mod=news&modfile=viewpost&newsid=$newsid#comment-$comment_id";
	}
    return $url;
}



?>