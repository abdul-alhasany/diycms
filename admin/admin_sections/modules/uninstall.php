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

// if the uninstall file does not exist in the module folder then performe some queries to remove traces of the module from the database otherwise run the uninstall file
if (!file_exists("./../modules/" . $module . "/admin/uninstall.php"))
{
  $result = $diy_db->query("DELETE from diy_modules_settings
						WHERE set_mod='$module'");
  $result = $diy_db->query("DELETE from diy_modules_templates
						WHERE modname='$module'");
  $result = $diy_db->query("DELETE from diy_modules
						WHERE mod_name='$module'");

  if ($result)
  {
    $content .= info_msg(lang('MODULE_UNINSTALL_SUCCESSFUL'), "sections.php?section=modules&" . $auth->get_sess());
  }
  else
  {
    $content .= info_msg(lang('MODULE_UNINSTALL_UNSUCCESSFUL'), "sections.php?section=modules&" . $auth->get_sess());
  }
}
else
{
  // check module set language and include the language file
  $result = $diy_db->query("SELECT * FROM diy_modules
							  WHERE mod_name='$module'
							  ORDER BY id ASC LIMIT 1");

  $row = $diy_db->dbarray($result);
  extract($row);
  if (file_exists("./../modules/$mod_name/lang/$mod_lang.lang.php"))
  {
    include ("./../modules/$mod_name/lang/$mod_lang.lang.php");
  }

  $modid = $row[modid];
  include ("./../modules/" . $module . "/admin/uninstall.php");
}

?>