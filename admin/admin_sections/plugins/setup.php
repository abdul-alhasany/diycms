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

// get plugin name
$plugin = $_GET['plugin'];


// assing admin session to a variable for later and easier use
$session = $auth->get_sess();

// check if there is any POST values and update database accordingly

if ($_POST['submit']) {
    extract($_POST);

    $plugin_usergroups = implode_data($plugin_usergroups);
    $plugin_modules   = implode_data($plugin_modules);
    
    $result = $diy_db->query("UPDATE diy_plugins SET plugin_modules='$plugin_modules',
                                               plugin_usergroups='$plugin_usergroups',
                                               plugin_status='$plugin_status'
                                               
                                               WHERE plugin_name='$plugin'");
    if ($result) {
		cache_plugins();
        echo info_msg(lang('PLUGINS_SETUP_SUCCESSFULL'), "sections.php?section=plugins&$session");
    }
}



// Build navigation
$nav_array = array(
    lang('PLUGINS_INDEX_TITLE') => "sections.php?section=plugins&$session",
    lang('PLUGINS_SETUP_TITLE')
);

// set navigation
echo $this->nav_bar($nav_array);



// get plugin settings and display them
$result = $diy_db->query("SELECT * FROM diy_plugins
						   WHERE plugin_name='$plugin'");
$row    = $diy_db->dbarray($result);
extract($row);

$radio_options = array(
    'enabled' => lang('YES'),
    'disabled' => lang('No')
);

$content .= form_radio_selection(lang('PLUGINS_SETUP_PLUGIN_ACTIVE'), 'plugin_status', $radio_options, $plugin_status);

$options = array();
$options['index'] = lang('PLUGINS_SETUP_PLUGIN_INDEX_PAGE');

// get menus deatails for any given plugin
$result = $diy_db->query("SELECT * FROM diy_modules
						   WHERE mod_sys='1'");
while ($row = $diy_db->dbarray($result)) {
    extract($row);
    $options[$id] = $mod_title;
}
$content .= form_checkbox_select(lang('PLUGINS_SETUP_SELECT_MODULES'), "plugin_modules" . "[]", $options, $plugin_modules);

// get groups deatails for a speicific plugin to detemine access permission
$result = $diy_db->query("SELECT * FROM diy_groups
							ORDER BY groupid ASC");
while ($row = $diy_db->dbarray($result)) {
    extract($row);
    $array[$groupid] = $grouptitle;
}

$content .= form_checkbox_select(lang('PLUGINS_SETUP_SELECT_GROUPS'), "plugin_usergroups" . "[]", $array, $plugin_usergroups);

// print form with all its deatiles
$form_array = array(
    "action" => "sections.php?section=plugins&file=setup&plugin=$plugin&$session",
    "title" => lang('PLUGINS_SETUP_TITLE'),
    "name" => 'setup',
    "content" => $content,
    "submit" => lang('SUBMIT')
);

$output = form_output($form_array);
echo $output;


?>