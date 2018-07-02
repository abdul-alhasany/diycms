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

// include required files
include ("modules/" . $mod->module . "/settings.php");
include ("modules/" . $mod->module . "/includes/cat_counter.class.php");

// Type the naviagation bar
$index_middle = $mod->nav_bar();
// Number of columns per row
$downloadColcount = $mod->setting('cat_per_row');
$cat_counter = new cat_counter;

// Set the array to count the topics and the comments in a category
$all_categories = $diy_db->query("SELECT catid,parent,countopic,countcomm
									  FROM diy_download_cat
									  ORDER BY catid DESC");
while ($cat_array = $diy_db->dbarray($all_categories))
{
  $cateogries_array[] = array('catid' => $cat_array['catid'], 'parent' => $cat_array['parent'], 'countopic' => $cat_array['countopic'], 'countcomm' => $cat_array['countcomm']);
}



if ($downloadColcount < 1) $downloadColcount = 1;
$result = $diy_db->query("SELECT * FROM diy_download_cat WHERE parent=0 ORDER BY cat_order ASC");
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
    unset($cat_image);
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
unset($cateogries_array);

echo $index_middle;

?>