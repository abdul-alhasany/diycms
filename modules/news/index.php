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


// include required files
include("modules/".$mod->module."/settings.php");
include("modules/".$mod->module."/includes/cat_counter.class.php");

// Type the naviagation bar	
	$index_middle = $mod->nav_bar();
	// Number of columns per row
  // View subcategoris
 $newsColcount = $mod->setting('cat_per_row');
 if ($newsColcount < 1)
     $newsColcount = 1;
 
 
 $result = $diy_db->query("SELECT * FROM diy_news_cat WHERE parent='$cat_id' ORDER BY cat_order ASC");
 $index_middle .= "<div class='categories_row'>";
 while ($row = $diy_db->dbarray($result)) {
     extract($row);
	 $row = format_data_out($row);
     $imagefile = get_file_path("$catid.newscat");
     if (file_exists($imagefile))
         $cat_image = "<img border=0 src=filemanager.php?action=getimage&info=$catid;newscat;news>";
	
	 $count = count_posts_comments($catid);
	 
     // get the number of topics and comments count
     $numrows         = $count['topics_count'];
     $numcomment      = $count['comments_count'];
	 
     $tdwidth = 100 / $newsColcount;
   //  $index_middle .= "<td align=\"center\" width=\"" . $tdwidth . "%\"  valign=\"top\">";
     eval("\$index_middle .= \" " . $mod->gettemplate('news_index_cat') . "\";");
   //  $index_middle .= "</td>";
     $count++;
     if ($count == $newsColcount) {
         $index_middle .= "</div>";
         $count = 0;
     }
 }
 $index_middle .= "</div>";
eval("\$index_middle .= \" " . $mod->gettemplate('news_cat_tools') . "\";");
	
echo $index_middle;

                  
?>