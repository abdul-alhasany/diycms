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
 
 
 $view_cat = cat_perm($cat_id, groupview, $_COOKIE['cgroup']);
 $mod->permission($view_cat);
 

	$rss = '<?xml version="1.0" encoding="utf-8" ?>
			<rss version="2.0"><channel>
			<title>'.get_global_setting("sitetitle").'</title>
			<link>'.get_global_setting("siteURL").'/mod.php?mod=forum</link>
			<description>'.get_global_setting("Description").'</description>';

     $result = $diy_db->query("SELECT * FROM diy_forum_threads
                                WHERE cat_id='$cat_id'
                                ORDER BY date_added DESC LIMIT 0,10");
     
     while ($row = $diy_db->dbarray($result)) {
         extract($row);
         $title   = format_data_out($title);
		 $post = format_data_out($post);
		 $desc = limit_text_view($post, 250);
		$rss .= "<item>
		<title>{$title}</title>
		<link>".get_global_setting("siteURL")."/mod.php?mod=forum</link>
		<description>{$desc}</description>
		</item>";
     }
     $rss .= '</channel></rss>';
 
 
 echo $rss;
 
?>