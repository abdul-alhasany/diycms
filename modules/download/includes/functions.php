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


if (RUN_MODULE !== true)
{
  die("<center><h3>Not Allowed!</h3></center>");
}

//---------------------------------------------------
// Change the subscribtion status for the post
//---------------------------------------------------

/**
 * alert_status()
 * 
 * @param mixed $id
 * @return
 */
/**
 * alert_status()
 * 
 * @param mixed $id
 * @return
 */
function alert_status($id)
{
  global $diy_db;
  if (isset($_COOKIE['cid']))
  {
    $result = $diy_db->query("SELECT * FROM diy_subscriptions
                                       WHERE postid='$id' AND module ='download' AND
                                       userid='" . $_COOKIE['cid'] . "' LIMIT 1");

    if ($diy_db->dbnumrows($result) > 0)
    {
      $diy_db->query("UPDATE diy_subscriptions SET alert_sent='no'
                                            WHERE postid='$id' AND module ='download' AND
                                            userid='" . $_COOKIE['cid'] . "'");
    }
  }
}

//---------------------------------------------------
// category jump menu
//---------------------------------------------------

/**
 * view_categories()
 * 
 * @return
 */
/**
 * view_categories()
 * 
 * @return
 */
function view_categories()
{
  global $diy_db, $mod;
  require_once ('cat_list.class.php');
  $result = $diy_db->query("SELECT catid,cat_title,parent FROM diy_download_cat ORDER BY catid DESC");

  while ($row = $diy_db->dbarray($result))
  {
    extract($row);
    $Master[] = array('catid' => $catid, 'cat_title' => "" . $cat_title . "", 'parent' => $parent);
  }
  $list = new category_list;
  $cat_list = $list->build_list($Master);
  unset($Master);
  return $cat_list;
}

//---------------------------------------------------
// The navigation line located to the top of the download module
//---------------------------------------------------
/**
 * breadcrumb()
 * 
 * @param string $cat_id
 * @param string $title
 * @return
 */
/**
 * breadcrumb()
 * 
 * @param string $cat_id
 * @param string $title
 * @return
 */
function breadcrumb($cat_id = '', $title = '')
{
  global $mod;
  include ("modules/" . $mod->module . "/includes/breadcrumb.class.php");

  if ($cat_id == '')
  {
    $cat_id = intval($_GET['catid']);
  }

  $nav_bits = new nav_bits;
  $nav_bits = $nav_bits->create_nav_bits($cat_id);

  $sitetitle = get_global_setting("sitetitle");

  eval("\$template .=\"" . $mod->gettemplate('download_breadcrumb') . "\";");
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
  $result = $diy_db->query("SELECT groupview,grouppost FROM diy_download_cat WHERE catid='$catid' ORDER BY cat_order ASC");
  $row = $diy_db->dbarray($result);
  extract($row);

  if ($type == 'groupview')
  {
    $find = strpos($groupview, "$value");
  }
  else
  {
    $find = strpos($grouppost, "$value");
  }
  if ($find !== false) return true;
  else  return false;
}


//---------------------------------------------------
// Admin and modertators jumb menu                  /
//---------------------------------------------------
/**
 * admin_jumpmenu()
 * 
 * @param mixed $downid
 * @param mixed $status
 * @return
 */
/**
 * admin_jumpmenu()
 * 
 * @param mixed $downid
 * @param mixed $status
 * @return
 */
function admin_jumpmenu($downid, $status)
{
  global $mod, $lang;

  $Jump = "<table border='0'width='90%' cellspacing='0' cellpadding='0'>\n";
  $Jump .= "<tr>\n";
  $Jump .= "<td width='100%'  align='center'>\n";
  $Jump .= "<form name='Jump'>\n";
  $Jump .= "<font size=2>\n";
  $Jump .= "<b> {$lang['INCLUDES_FUNCTIONS_ADMIN_MENU']}</b>\n";
  $Jump .= "<select name='Menu' onChange='location=document.Jump.Menu.options[document.Jump.Menu.selectedIndex].value;' value='GO'>\n";
  $Jump .= "<option>{$lang['INCLUDES_FUNCTIONS_ADMIN_MENU_CHOOSE']}</option>\n";
  $Jump .= "<option value='mod.php?mod=download&modfile=edit_file&downid=$downid'>{$mod->language_array['INCLUDES_FUNCTIONS_ADMIN_MENU_EDIT']}</option>\n";


  // Check if the topic is closed or open
  if ($status == '2' || $status == '12')
  {
    $label = $lang['INCLUDES_FUNCTIONS_ADMIN_MENU_UNCLOSE'];
    $Jump .= "<option value='mod.php?mod=download&modfile=misc&action=change_status&do=open_topic&downid=$downid'> $label </option>\n";
  }
  else
  {
    $label = $lang['INCLUDES_FUNCTIONS_ADMIN_MENU_CLOSE'];
    $Jump .= "<option value='mod.php?mod=download&modfile=misc&action=change_status&do=close_topic&downid=$downid'> $label </option>\n";
  }

  // Check if the post is pinned or not
  if ($status == '1' || $status == '12')
  {
    $label = $lang['INCLUDES_FUNCTIONS_ADMIN_MENU_UNPIN'];
    $Jump .= "<option value='mod.php?mod=download&modfile=misc&action=change_status&do=unpin_topic&downid=$downid'> $label </option>\n";
  }
  else
  {
    $label = $lang['INCLUDES_FUNCTIONS_ADMIN_MENU_PIN'];
    $Jump .= "<option value='mod.php?mod=download&modfile=misc&action=change_status&do=pin_topic&downid=$downid'> $label </option>\n";
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
 * @param mixed $downid
 * @param mixed $comment_id
 * @return
 */
/**
 * get_comment_url()
 * 
 * @param mixed $downid
 * @param mixed $comment_id
 * @return
 */
function get_comment_url($downid, $comment_id)
{
  global $diy_db, $mod;

  $comments_per_page = $mod->setting("comments_per_page");
  $numrows = $diy_db->dbnumquery("diy_download_comments", "downid ='$downid' AND allow='yes'");

  $comment_results = $diy_db->query("SELECT * FROM diy_download_comments
								WHERE downid='$downid'
								AND allow='yes'
								ORDER BY commentid ASC");
  while ($row = $diy_db->dbarray($comment_results))
  {
    extract($row);
    $comment_array[] = $commentid;
  }


  foreach ($comment_array as $c_key => $c_value)
  {
    if ($c_value == $comment_id) $comment_key = $c_key;
  }

  if ($numrows > $comments_per_page)
  {
    $pages = ceil($numrows / $comments_per_page);
    $cpp = '0';
    $last_comments_per_page = $comments_per_page;
    for ($i = 0; $i < $pages; $i++)
    {
      $page_array[] = "$cpp,$last_comments_per_page";
      $cpp += $comments_per_page;
      $last_comments_per_page += $comments_per_page;
    }

    foreach ($page_array as $page_key => $page_value)
    {
      $after = strstr($page_value, ',');
      $length = strlen($after);
      $before = substr($page_value, 0, -$length);
      $after = substr($after, 1);

      if (($comment_key >= $before) && ($comment_key < $after))
      {
        $start = $page_value;
        $nextpage = $comments_per_page * ($pages - 1);
        $page_key = $page_key + 1;
        $url = "mod.php?mod=download&modfile=view_file&downid=$downid&start=$before&page=$page_key#comment$comment_id";

      }

    }
  }
  else
  {
    $url = "mod.php?mod=download&modfile=view_file&downid=$downid#comment$comment_id";
  }
  return $url;
}

//---------------------------------------------------
  // This function handles upload field
  //---------------------------------------------------
  /**
   * handles editing file upload, paritcularly attachments
   * 
   * @param string $field_name			name of the input
   * @param string $attachment_name		name of attachment to be edited
   * @return mixed						template with edit upload form field
   */
  function edit_upload($input_name, $post_id, $location, $replace = 'uploaded_file[]')
  {
    global $templates, $diy_db;
	$file_query = $diy_db->query("SELECT * FROM diy_upload
				WHERE post_id = '$post_id'
				AND location = '$location'");
     while ($files = $diy_db->dbarray($file_query))
       {
		$attachment .= "
		<div class='fontablt'>
		<fieldset style=\"padding: 10px; width:60%\"><legend> $files[name]</legend>
		<table><tr><td><div class='fontablt'>";
		$attachment .= "<input type=\"hidden\" name=\"upload_id[]\" value=\"$files[upid]\">";
		
		$attachment .= "Replace File<br>
		<input type='file' size='30' name='$replace'></div></td>
		<td width='120'><div class='fontablt'><input type=\"checkbox\" value=\"$files[upid]\" name=\"$delete\"><label>Delete File</label></div></td>
		</tr></table>
		</fieldset></div><br>";
		}
	$form_array = array('input_name' => $input_name,
						'attachment' => $attachment);
	$form = $templates->display_template('form_edit_upload', $form_array);	
    return $form;
  }

//------------------------------------------------------
//  Replace rating with starts image           //
//------------------------------------------------------

/**
 * rating_avg()
 * 
 * @param mixed $r
 * @return
 */
/**
 * rating_avg()
 * 
 * @param mixed $r
 * @return
 */
function rating_avg($r)
{
  $r = str_replace("0", "<img src=images/rate_0.gif border=0>", $r);
  $r = str_replace("1", "<img src=images/rate_1.gif border=0>", $r);
  $r = str_replace("2", "<img src=images/rate_2.gif border=0>", $r);
  $r = str_replace("3", "<img src=images/rate_3.gif border=0>", $r);
  $r = str_replace("4", "<img src=images/rate_4.gif border=0>", $r);
  $r = str_replace("5", "<img src=images/rate_5.gif border=0>", $r);

  return $r;

}

?>