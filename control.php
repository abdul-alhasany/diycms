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
  * You can control cms modules through this file.
  * 
  * @package	Global
  * @subpackage	Files
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

// request the gobal.php file
require_once('global.php');

if ($_COOKIE['cgroup'] !== '1')
{
checkcookie();
}
// intiate the menu class and check which menus are set to be viewed in the index page
$menu         = new menu;
$menu->menuid = get_global_setting("index_menuid");
$right_menu   = $menu->show_menus(1);
$left_menu    = $menu->show_menus(2);
$middle_menu  = $menu->middle_menu();

$action = $_GET['action'];

$templates = new templates;

$plugins = new plugins;
$plugins->plugins('index'); 

$index_middle = display_nav_bar();
$index_middle .= diy_page_header("Welcome", get_global_setting("sitetitle"));
$index_middle .= "<center><table border='0' width='100%' align='center' cellpadding='4'><tr>";
$total_modules = $diy_db->dbnumquery("diy_modules", "mod_sys='1'");
$result        = $diy_db->query("SELECT * FROM diy_modules WHERE mod_sys=1 ORDER BY mod_name ASC");

while ($row = $diy_db->dbarray($result)) {
    // check if module image is included in the module folder, otherwise include the default one
    $img_src = "modules/" . $row['mod_name'] . "/admin/" . $row['mod_name'];
    if (file_exists("$img_src.gif")) {
        $image = "<img border=0 src= $img_src.gif>";
    } elseif (file_exists("$img_src.jpg")) {
        $image = "<img border=0 src=$img_src.jpg>";
    } elseif (file_exists("$img_src.png")) {
        $image = "<img border=0 src='$img_src.png'>";
    } else {
        $image = "<img border=0 src='images/mod.gif'>";
    }
    
    $tdwidth = 100 / 4;
    $index_middle .= "<td align=\"center\" width=\"" . $tdwidth . "%\"  valign=\"top\"><a target=_blank href=mod.php?mod=" . $row['mod_name'] . "&dir=control>" . $image . "</a>";
    $index_middle .= "</td>";
    $title_array[$row['mod_name']] .= $row['mod_title'];
    $total_count++;
    $count++;
    $remainder = $total_modules - $total_count;
    
    if (($count == '4') || ($remainder == 0)) {
        $index_middle .= "</tr><tr>";
        foreach ($title_array as $key => $value) {
            $index_middle .= "<td><center><a target=_blank href=mod.php?mod=$key&dir=control>$value</a></center><br></td>";
        }
        $title_array = array();
        $index_middle .= "</tr>";
        $count = 0;
    }
    
}
$index_middle .= "</tr></table><br>";

// echo the output with the menus set
$templates->page_output($right_menu, $left_menu);

// echo footer
diy_page_footer($pageft);

?>