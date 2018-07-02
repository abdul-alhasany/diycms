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

echo $this->nav_bar(lang('PLUGINS_INDEX_TITLE'));

// make an array of both installed and not installed plugins to populate the table and the related option for each plugin
$result = $diy_db->query("SELECT * FROM diy_plugins ORDER BY plugin_id");
while ($row = $diy_db->dbarray($result)) {
    extract($row);
    $plugins[$plugin_name] = $plugin_status;
    $id_array[$plugin_name]  = $plugin_id;
}



$open = opendir($CONF['site_path'] . "/plugins");
while ($folder = readdir($open)) {
    if (($folder != ".") && ($folder != "..") && (is_dir($CONF['site_path'] . "/plugins/" . $folder))) {
        $folder = preg_replace("/[^a-zA-Z0-9\-\_]/", "", $folder);
        
        // make an array of the status of all plugins in order to loop through it later
        if ($plugins[$folder] == 'disabled') {
            $plugins_array[$folder] = array(
                'plugin_title' => $folder,
                'lang' => lang('PLUGINS_PLUGIN_INSTALLED_DISABLED'),
                'value' => '0',
                'plug_id' => $id_array[$folder]
            );
        } elseif ($plugins[$folder] == 'enabled') {
            $plugins_array[$folder] = array(
                'plugin_title' => $folder,
                'lang' => lang('PLUGINS_PLUGIN_INSTALLED_ENABLED'),
                'value' => '1',
                'plug_id' => $id_array[$folder]
            );
        } else {
            // null is for non-installed plugins
            $plugins_array[$folder] = array(
                'plugin_title' => $folder,
                'lang' => lang('PLUGINS_PLUGIN_NOT_INSTALLED'),
                'value' => 'null'
            );
        }
    }
}

//echo nl2br(print_r($plugin_array,1)); 
// fix bug, when no plugins are included in the array php will produce a warning. setting the value of $plugin_status to array will resolve this issue
if (empty($plugins_array))
    $plugins_array = array();

foreach ($plugins_array as $plugin => $plugin_info) {
    // check if plugin image is included in the plugin folder, otherwise include the default one
    $img_src = "./../plugins/" . $plugin . "/" . $plugin;
    
    if (file_exists("$img_src.gif")) {
        $image = "<img border=0 src= $img_src.gif>";
    } elseif (file_exists("$img_src.jpg")) {
        $image = "<img border=0 src=$img_src.jpg>";
    } elseif (file_exists("$img_src.png")) {
        $image = "<img border=0 src='$img_src.png'>";
    } else {
        $image = "<img border=0 src='<#admin_images_path#>/plugin.png'>";
    }
    
    // if there is a language file include it
    if (file_exists($CONF['site_path'] . "/plugins/" . $plugin . "/lang/" . $CONF['lang'] . ".lang.php")) {
        include($CONF['site_path'] . "/plugins/" . $plugin . "/lang/" . $CONF['lang'] . ".lang.php");
    }
    
    // start building contents and tables
    // get plugin details
    $details = lang('PLUGINS_INDEX_PLUGIN_TITLE') . $admin_plugin_lang['title'] . '<br>';
    $details .= lang('PLUGINS_INDEX_PLUGIN_VERSION') . $admin_plugin_lang['version'] . '<br>';
    $details .= lang('PLUGINS_INDEX_PLUGIN_AUTHOUR') . $admin_plugin_lang['author'] . '<br>';
    $details .= lang('PLUGINS_INDEX_PLUGIN_DESCR') . $admin_plugin_lang['desc'] . '<br>';
    
    // get plugin options
    // check if the plugin is installed or not and view the relevant icon
    $install_icon   = ($plugin_info['value'] == 'null') ? "<a href=sections.php?section=plugins&file=install&plugin=" . $plugin_info['plugin_title'] . "&" . $auth->get_sess() . " onClick=\"if (!confirm('Are you sure you want to install this plugin?')) return false;\"><img title='Install' border=0 src=<#admin_images_path#>/install.png></a>" : "<img border=0 src=<#admin_images_path#>/install_gray.png>";
    $uninstall_icon = ($plugin_info['value'] == '1' or $plugin_info['value'] == '0') ? "<a href=sections.php?section=plugins&file=uninstall&plugin=" . $plugin_info['plugin_title'] . "&plugin_id=" . $plugin_info['plug_id'] . "&" . $auth->get_sess() . " onClick=\"if (!confirm('Are you sure you want to uninstall this plugin?')) return false;\"><img title='Uninstall' border=0 src=<#admin_images_path#>/uninstall.png></a>" : "<img border=0 src=<#admin_images_path#>/uninstall_gray.png>";
    $settings       = ($plugin_info['value'] == '1' or $plugin_info['value'] == '0') ? "<a href=sections.php?section=plugins&file=settings&plugin=" . $plugin_info['plugin_title'] . "&plugin_id=" . $plugin_info['plug_id'] . "&" . $auth->get_sess() . "><img title='Settings' border=0 src=<#admin_images_path#>/settings.png></a>" : "<img border=0 src=<#admin_images_path#>/settings_gray.png></a>";
    $setup = ($plugin_info['value'] == '1' or $plugin_info['value'] == '0') ? "<a href=sections.php?section=plugins&file=setup&plugin=" . $plugin_info['plugin_title'] . "&plugin_id=" . $plugin_info['plug_id'] .
    "&" . $auth->get_sess() . "><img title='Setup' border=0 src=<#admin_images_path#>/setup.png></a>" : "<img border=0 src=<#admin_images_path#>/setup_gray.png></a>";
    
    // Set array for template replacement
    $array = array(
        '{IMAGE}' => $image,
        '{DETAILES}' => $details,
        '{STATUS}' => $plugin_info['lang'],
		'{SETUP}' => $setup,
        '{INSTALL}' => $install_icon,
        '{UNINSTALL}' => $uninstall_icon,
        '{SETTINGS}' => $settings,
    );
    
    // store results to this template to include it in the outer template
    $rows .= $admin_templates->get_template('plugins_index_row.tpl.php', $array);
    
}

// get the outer template, replace values and then print it
$content .= $admin_templates->get_template('plugins_index.tpl.php', array(
    '{ROWS}' => $rows
));

echo $content;

?>