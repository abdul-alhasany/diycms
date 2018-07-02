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
  * This file handels moduels display
  * 
  * @package	Global
  * @subpackage	Files
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */


// call global file
require_once ('global.php');

check_hook_function('mod_file_start', $extra);

// RUN_MOULE should be used in every file in any module in order to prevent direct access to the module file
define('RUN_MODULE', true);

// some security checks
if (isset($_GET['mod']))
{
  if (eregi("http\:\/\/", $_GET['mod']))
  {
    error_message(_MOD_NOT_AUTH);
  }
}
// create an instance for module class
$mod = new module();

// intiatie plguins 
$mod_id = $mod->modInfo['id'];
$plugins = new plugins($mod_id);


if (!isset($_GET['fullpage']))
{

  ob_start();

  $index_middle = $mod->module_OutPut();
  if ($title == '')
  {
    diy_page_header($mod->modInfo['mod_title']);
  }
  else
  {
    diy_page_header($mod->modInfo['mod_title'] . "->" . $title);
  }
  ob_end_flush();

  // check menus set to be viewed in a module
  // if nothing is set display the module
  if ($mod->modInfo['mnueid'] == '')
  {
    $menu = new menu;
    $templates->page_output('', 0);

    // else display the menus
  }
  else
  {
    $menu = new menu;
    $menu->menuid = $mod->modInfo['mnueid'];
    if ($mod->modInfo['right_menu'] == 1)
    {
      $right_menu = $menu->show_menus(1);
    }

    if ($mod->modInfo['left_menu'] == 1)
    {
      $left_menu = $menu->show_menus(2);
    }

    if ($mod->modInfo['middle_menu'] == 1)
    {
      $middle_menu = $menu->middle_menu();
    }

    $templates->page_output($mod->modInfo['right_menu'], $left_menu);
    diy_page_footer($pageft);
  }
}
else
{
//-------------------------------------------------------
// Check if fullpage is set in the url
// If fullpage is set to 1 then do not display header or footer
// this is necessary when viewing a page for printing or downloading a file
//------------------------------------------------------

  // if fullpage is set to 1 then do not display header or footer
  $fullpage = set_id_int('fullpage');
  if ($fullpage == '1')
  {
    $index_middle = $mod->module_OutPut();
    echo $index_middle;
  }
}

?>