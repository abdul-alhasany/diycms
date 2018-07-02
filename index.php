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
  * This is the index file which will be displayed to vistors once they view the cms
  * 
  * @package	Global
  * @subpackage	Files
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

// request the gobal.php file
require_once ('global.php');

$plugins = new plugins('index');

// intiate the menu class and check which menus are set to be viewed in the index page

$menu = new menu;
$menu->menuid = get_global_setting("index_menuid");
$right_menu = $menu->show_menus(1);
$left_menu = $menu->show_menus(2);
$middle_menu = $menu->middle_menu();
$action = $_GET['action'];

// Check what is set to be indeluded in the index page (a module or a template)
$main_module = get_global_setting("main_module");
// if the index_template is set then view it otherwise redierct to module page
// in the future an extra page will be added to each module to serve as a hook than can be included in index page directly without redirection
if ($main_module == 'index_template')
{
  // header information
  $index_middle .= diy_page_header("", get_global_setting("sitetitle"));
  $index_middle = $templates->display_template('index_template');
 
}
else
{
  // Check if an main_index file exists in the module to be included in the cms index page otherwise redirect to the module index page
  if (file_exists("modules/" . $main_module . "/main_index.php"))
  {
    // header information
    $index_middle .= diy_page_header("", get_global_setting("sitetitle"));

    // read and get the file contents
    ob_start();
    require_once ("modules/" . $main_module . "/main_index.php");
    $index_middle .= ob_get_contents();
    ob_end_clean();
  }
  else
  {
    header("Location: mod.php?mod=$main_module");
    exit();
  }
}

// echo the output with the menus set
$templates->page_output($right_menu, $left_menu);

// echo footer
diy_page_footer($pageft);

?>