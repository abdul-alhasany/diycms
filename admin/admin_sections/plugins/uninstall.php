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

$result = $diy_db->query("SELECT * FROM diy_plugins
							  WHERE plugin_name='$plugin'");

  $row = $diy_db->dbarray($result);
  
// if the uninstall file does not exist in the plugin folder then performe some queries to remove traces of the plugin from the database otherwise run the uninstall file
if (!file_exists($CONF['site_path']."/plugins/" . $plugin . "/uninstall.php"))
{
  $result = $diy_db->query("DELETE from diy_plugins
						WHERE plugin_name='$plugin'");
  $result = $diy_db->query("DELETE from diy_plugins_settings
						WHERE plugin_id='$row[plugin_id]'");


  if ($result)
  {
	cache_plugins();
    $content .= info_msg(lang('PLUGINS_UNINSTALL_SUCCESSFUL'), "sections.php?section=plugins&" . $auth->get_sess());
  }
  else
  {
    $content .= info_msg(lang('PLUGINS_UNINSTALL_UNSUCCESSFUL'), "sections.php?section=plugins&" . $auth->get_sess());
  }
}
else
{
  // check plugin set language and include the language file
  
  extract($row);
  if (file_exists($CONF['site_path']."/plugins/".$plugin."/lang/".$CONF['lang'].".lang.php"))
  {
    include ($CONF['site_path'] ."/plugins/".$plugin."/lang/".$CONF['lang'].".lang.php");
  }
  
	cache_plugins();
  $plugin_id = $row['plugin_id'];
  include ($CONF['site_path'] ."/plugins/" . $plugin . "/uninstall.php");
}

?>