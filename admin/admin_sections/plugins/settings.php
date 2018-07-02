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

if (RUN_SECTION !== true) {
    die("<center><h3>" . lang('ACCESS_NOT ALLOWED') . "</h3></center>");
}
if($_POST)
{
cache_plugins_settings();
}

// get plugin name
$plugin = $_GET['plugin'];

// assing admin session to a variable for later and easier use
$session   = $auth->get_sess();


// Build navigation
$nav_array = array(
    lang('PLUGINS_INDEX_TITLE') => "sections.php?section=plugins&$session",
    lang('PLUGINS_SETTINGS_TITLE')
);

// set navigation
$content .= $this->nav_bar($nav_array);

//get setting file from the plugin folder
$setting_file = $CONF['site_path'] . "/plugins/" . $plugin . "/settings.php";

if (file_exists($setting_file)) {
    include($setting_file);
} else {
    $content .= info_msg(lang('PLUGINS_SETTING_NO_FILE'), "sections.php?section=plugins&$session");
}


echo $content;


?>