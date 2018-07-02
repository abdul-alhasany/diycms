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
  * This file is part of modules section
  * 
  * @package	Admin_sections
  * @subpackage	Modules
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

if (RUN_SECTION !== true)
{
  die("<center><h3>" . lang('ACCESS_NOT ALLOWED') . "</h3></center>");
}

// get module name
$module = $_GET['module'];

if ($module == 'li<x>nks')
{
  $module = "links";
}

// set some variables
$title = $module;
$mod_user = 0;
$left_menu = 0;
$right_menu = 1;
$middle_menu = 0;
$menuid = '1,2,3,4,6,7,8,9,10,11,14,15,16,17,18,19';
$themeid = 1;
$lang = 'english';


// check if the installation file exist in the module folder, if it does not exist run defaulf values otherwise run the file
if (!file_exists("./../modules/" . $module . "/admin/install.php"))
{
  $result = $diy_db->query("INSERT INTO diy_modules VALUES ('', '$module', '$title', '$mod_user', 1, '$left_menu', '$right_menu', '$middle_menu','$menuid','$themeid','$lang');");
  if ($result)
  {
    $content .= info_msg(lang('MODULE_INSTALL_SUCCESSFUL'), "sections.php?section=modules&file=setup&module=$module&" . $auth->get_sess());
  }
  else
  {
    $content .= info_msg(lang('MODULE_INSTALL_UNSUCCESSFUL'), "sections.php?section=modules&" . $auth->get_sess());
  }
}
else
{
  include ("./../modules/" . $module . "/admin/install.php");
}

?>