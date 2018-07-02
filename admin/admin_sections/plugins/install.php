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
  * This file is part of plugins section
  * 
  * @package	Admin_sections
  * @subpackage	Plugins
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

if (RUN_SECTION !== true)
{
  die("<center><h3>" . lang('ACCESS_NOT ALLOWED') . "</h3></center>");
}


// get plugin name
$plugin = $_GET['plugin'];

if ($plugin == 'li<x>nks')
{
  $plugin = "links";
}

// check if the installation file exist in the plugin folder, if it does not exist run defaul values otherwise run the file
if (!file_exists("./../plugins/" . $plugin . "/install.php"))
{
  $result = $diy_db->query("INSERT INTO diy_plugins VALUES ('', '$plugin', '1,2,3,4,5,6,7,8,9,10,11,12', '1,2,3,4,5', 'enabled');");
  if ($result)
  {
	cache_plugins();
    $content .= info_msg(lang('PLUGIN_INSTALL_SUCCESSFUL'), "sections.php?section=plugins&file=setup&plugin=$plugin&" . $auth->get_sess());
  }
  else
  {
    $content .= info_msg(lang('PLUGIN_INSTALL_UNSUCCESSFUL'), "sections.php?section=plugins&" . $auth->get_sess());
  }
}
else
{
  include ($CONF['site_path']."/plugins/" . $plugin . "/install.php");
  cache_plugins();
}

?>