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

// check if settings are updated and update the cache files
if($_POST)
{
cache_module_settings($module);
}

// assing admin session to a variable for later and easier use
$session = $auth->get_sess();
// Build navigation
$nav_array = array(lang('MODULES_INDEX_TITLE') => "sections.php?section=modules&$session", lang('MODULES_SETTINGS_TITLE'));

// set navigation
$content = $this->nav_bar($nav_array);



//get setting file from the module folder
$inc_mod = "./../modules/" . $module . "/admin/index.php";
if (file_exists($inc_mod))
{
  include ($inc_mod);
}
else
{
  $content .= info_msg(lang('MODULES_SETTINGS_NO_SETTINGS_EXIST'), "$PHP_SELF?act=manag&$session");

}
// output the content
echo $content;

?>