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
include ("modules/" . $mod->module . "/includes/cat_counter.class.php");

$index_middle = breadcrumb();

$cat_id = set_id_int('catid');
$cat_counter = new cat_counter;

$view_cat = cat_perm($cat_id, groupview, $_COOKIE['cgroup']);
$mod->permission($view_cat);

// View subcategoris
$downloadColcount = $mod->setting('cat_per_row');
if ($downloadColcount < 1) $downloadColcount = 1;


// Set the array to count the topics and the comments in a category
$all_categories = $diy_db->query("select catid,parent,countopic,countcomm from diy_download_cat order by catid DESC");
while ($cat_array = $diy_db->dbarray($all_categories))
{
  $cateogries_array[] = array('catid' => $cat_array['catid'], 'parent' => $cat_array['parent'], 'countopic' => $cat_array['countopic'], 'countcomm' => $cat_array['countcomm']);
}


$result = $diy_db->query("SELECT * FROM diy_download_cat WHERE parent='$cat_id' ORDER BY cat_order ASC");
$index_middle .= "<center><table border='0' width='100%' align='center' cellpadding='" . $downloadColcount . "'><tr>";
while ($row = $diy_db->dbarray($result))
{
  extract($row);
  $imagefile = get_file_path("$catid.downloadcat");
  if (file_exists($imagefile))
  {
    $cat_image = "<img border=0 src=filemanager.php?action=getimage&info=$catid;downloadcat;download>";
  }
  else
  {
    $cat_image = '';
  }
  $title = format_data_out($title);
  $dsc = format_data_out($dsc);

  // count the number of topics and comment per category
  $topcis_comments = $cat_counter->Build($cateogries_array, $catid);
  $topics_comments = explode('=', $topcis_comments);
  $numrows = $countopic + $topics_comments['0'];
  $numcomment = $countcomm + $topics_comments['1'];

  $tdwidth = 100 / $downloadColcount;
  $index_middle .= "<td align=\"center\" width=\"" . $tdwidth . "%\"  valign=\"top\">";
  eval("\$index_middle .= \" " . $mod->gettemplate('download_index_cat') . "\";");
  $index_middle .= "</td>";
  $count++;
  if ($count == $downloadColcount)
  {
    $index_middle .= "</tr>";
    $count = 0;
  }
}
$index_middle .= "</tr></table><br>";
eval("\$index_middle .= \" " . $mod->gettemplate('download_cat_tools') . "\";");
// view the posts in this category
$posts_per_page = $mod->setting("posts_per_page");
$comments_per_page = $mod->setting("comments_per_page");
$sort_by = $mod->setting("sort_posts_by");
$getorder_by = $mod->setting("order_posts_by");

if ($getorder_by == "last_added")
{
  $order_by = '.date_added';
} elseif ($getorder_by == "last_added_comment")
{
  $order_by = '_comment.date_added';
} elseif ($getorder_by == "comments_number")
{
  $order_by = '.comments_no';
} elseif ($getorder_by == "readers")
{
  $order_by = '.readers';
}


if (!isset($_GET['start']))
{
  $start = '0';
}
else
{
  $start = $_GET['start'];
}


$files_number = $diy_db->dbnumquery("diy_download_files", "cat_id=$cat_id");

if ($start == 0)
{
  $result = $diy_db->query("SELECT diy_download_files.*,COUNT(diy_download_comments.downid) as numrows
                                FROM diy_download_files LEFT JOIN diy_download_comments
                                ON diy_download_files.downid = diy_download_comments.downid
                                WHERE diy_download_files.cat_id='$cat_id'
                                AND diy_download_files.allow = 'yes'
                                AND (diy_download_files.status = '1' OR diy_download_files.status = '12')
								
                                GROUP BY diy_download_files.downid
                                ORDER BY diy_download_files$order_by $sort_by");

  while ($row = $diy_db->dbarray($result))
  {
    extract($row);
    $title = format_data_out($title);
    $name = format_data_out($username);
    $pagenum = pagination_list($numrows, $comments_per_page, "mod.php?mod=download&modfile=viewpost&downid=$downid");
    $date = format_date($date_added);

    $list_type = $mod->setting("list_type");
    if (($list_type == 'title') && ($files_number > 0))
    {
      $title = " Stickey: " . $title;
      eval("\$list_row .= \" " . $mod->gettemplate('download_list_files_row') . "\";");
    }
    else
    {
      $title = " Stickey: " . $title;
      eval("\$index_middle .= \" " . $mod->gettemplate('download_list_title_desc_view') . "\";");
    }

  }

}

$result = $diy_db->query("SELECT diy_download_files.*,COUNT(diy_download_comments.downid) as numrows
                                FROM diy_download_files LEFT JOIN diy_download_comments
                                ON diy_download_files.downid = diy_download_comments.downid
                                WHERE diy_download_files.cat_id='$cat_id'
                                AND diy_download_files.allow = 'yes'
                                AND (diy_download_files.status != '1' AND diy_download_files.status != '12')
                                GROUP BY diy_download_files.downid
                                ORDER BY diy_download_files$order_by $sort_by
								LIMIT $start,$posts_per_page");

while ($row = $diy_db->dbarray($result))
{
  extract($row);
  $title = format_data_out($title);
  $name = format_data_out($username);
  $pagenum = pagination_list($numrows, $comments_per_page, "mod.php?mod=download&modfile=view_file&downid=$downid");
  $date = format_date($date_added);


  $list_type = $mod->setting("list_type");
  if (($list_type == 'title') && ($files_number > 0))
  {
    eval("\$list_row .= \" " . $mod->gettemplate('download_list_files_row') . "\";");
  }
  else
  {
    eval("\$index_middle .= \" " . $mod->gettemplate('download_list_title_desc_view') . "\";");
  }

}

if (($list_type == 'title') && ($files_number > 0))
{
  eval("\$index_middle .= \" " . $mod->gettemplate('download_list_files') . "\";");
}


$index_middle .= pagination($files_number, $posts_per_page, "mod.php?mod=download&modfile=list&catid=$cat_id");
echo $index_middle;

?>