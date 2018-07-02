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

if (RUN_SECTION !== true) {
    die("<center><h3>" . lang('ACCESS_NOT ALLOWED') . "</h3></center>");
}

echo $this->nav_bar(lang('MODULES_INDEX_TITLE'));

// make an array of both installed and not installed modules to populate the table and the related option for each module
$result = $diy_db->query("SELECT * FROM diy_modules ORDER BY id");
while ($row = $diy_db->dbarray($result)) {
    extract($row);
    $mod_array[$mod_name] = $mod_sys;
    $id_array[$mod_name]  = $id;
}

$open = opendir("./../modules");
while ($folder = readdir($open)) {
    if (($folder != ".") && ($folder != "..") && (is_dir("./../modules/$folder"))) {
        $folder = preg_replace("/[^a-zA-Z0-9\-\_]/", "", $folder);
        
        // make an array of the status of all modules in order to loop through it later
        if ($mod_array[$folder] == '0') {
            // zero is for installed but disabled modules
            $mod_status[$folder] = array(
                'mod_title' => $folder,
                'lang' => lang('MODULES_MODULE_INSTALLED_DISABLED'),
                'value' => '0',
                'mod_id' => $id_array[$folder]
            );
            // 1 is for installed and enabled module
        } elseif ($mod_array[$folder] == '1') {
            $mod_status[$folder] = array(
                'mod_title' => $folder,
                'lang' => lang('MODULES_MODULE_INSTALLED_ENABLED'),
                'value' => '1',
                'mod_id' => $id_array[$folder]
            );
        } else {
            // null is for non-installed modules
            $mod_status[$folder] = array(
                'mod_title' => $folder,
                'lang' => lang('MODULES_MODULE_NOT_INSTALLED'),
                'value' => 'null'
            );
        }
    }
}

foreach ($mod_status as $module => $module_info) {
    // check if module image is included in the module folder, otherwise include the default one
    $img_src = "./../modules/$module/admin/$module";
    if (file_exists("$img_src.gif")) {
        $image = "<img border=0 src= $img_src.gif>";
    } elseif (file_exists("$img_src.jpg")) {
        $image = "<img border=0 src=$img_src.jpg>";
    } elseif (file_exists("$img_src.png")) {
        $image = "<img border=0 src='$img_src.png'>";
    } else {
        $image = "<img border=0 src='images/mod.gif'>";
    }
    
    
	    if (file_exists($CONF['site_path'] . "/modules/" . $module . "/lang/" . $CONF['lang'] . ".lang.php")) {
        include($CONF['site_path'] . "/modules/" . $module . "/lang/" . $CONF['lang'] . ".lang.php");
    }
	
    // start building contents and tables
    // get module details
    $details = lang('MODULES_INDEX_MODULE_TITLE') . $admin_lang[mod_title] . '<br>';
    $details .= lang('MODULES_INDEX_MODULE_VERSION') . $admin_lang[mod_ver] . '<br>';
    $details .= lang('MODULES_INDEX_MODULE_AUTHOUR') . $admin_lang[mod_auth] . '<br>';
    $details .= lang('MODULES_INDEX_MODULE_DESCR') . $admin_lang[mod_desc] . '<br>';
    
    // get module options
    // check if the module is installed or not and view the relevant icon
    $install_icon   = ($module_info['value'] == 'null') ? "<a href=sections.php?section=modules&file=install&module=" . $module_info['mod_title'] . "&" . $auth->get_sess() . " onClick=\"if (!confirm('".lang('MODULES_INDEX_MODULE_CONFIRM_INSTALL')."')) return false;\"><img title='".lang('MODULES_INDEX_MODULE_INSTALL')."' border=0 src=<#admin_images_path#>/install.png></a>" : "<img border=0 src=<#admin_images_path#>/install_gray.png>";
    $uninstall_icon = ($module_info['value'] == '1' or $module_info['value'] == '0') ? "<a href=sections.php?section=modules&file=uninstall&module=" . $module_info['mod_title'] . "&modid=" . $module_info['mod_id'] . "&" . $auth->get_sess() . " onClick=\"if (!confirm('".lang('MODULES_INDEX_MODULE_CONFIRM_UNINSTALL')."')) return false;\"><img title='".lang('MODULES_INDEX_MODULE_UNINSTALL')."' border=0 src=<#admin_images_path#>/uninstall.png></a>" : "<img border=0 src=<#admin_images_path#>/uninstall_gray.png>";
    $setup          = ($module_info['value'] == '1' or $module_info['value'] == '0') ? "<a href=sections.php?section=modules&file=setup&module=" . $module_info['mod_title'] . "&modid=" . $module_info['mod_id'] . "&" . $auth->get_sess() . "><img title='".lang('MODULES_INDEX_MODULE_SETUP')."' border=0 src=<#admin_images_path#>/setup.png></a>" : "<img border=0 src=<#admin_images_path#>/setup_gray.png></a>";
    $settings       = ($module_info['value'] == '1' or $module_info['value'] == '0') ? "<a href=sections.php?section=modules&file=settings&module=" . $module_info['mod_title'] . "&modid=" . $module_info['mod_id'] . "&" . $auth->get_sess() . "><img title='".lang('MODULES_INDEX_MODULE_SETTINGS')."' border=0 src=<#admin_images_path#>/settings.png></a>" : "<img border=0 src=<#admin_images_path#>/settings_gray.png></a>";
    $view           = ($module_info['value'] == '1' or $module_info['value'] == '0') ? "<a target='_blank' href=./../mod.php?mod=" . $module_info['mod_title'] . "&modid=" . $module_info['mod_id'] . "&" . $auth->get_sess() . "><img border=0 title='".lang('MODULES_INDEX_MODULE_VIEW')."' src=\"<#admin_images_path#>/view.png\"></a>" : "<img border=0 src=\"<#admin_images_path#>/view_gray.png\"></a>";
    $style          = ($module_info['value'] == '1' or $module_info['value'] == '0') ? "<a href=sections.php?section=modules&file=theme&module=" . $module_info['mod_title'] . "&modid=" . $module_info['mod_id'] . "&" . $auth->get_sess() . "><img title='".lang('MODULES_INDEX_MODULE_STYLE')."' border=0 src=\"<#admin_images_path#>/style.png\"></a>" : "<img border=0 src=\"<#admin_images_path#>/style_gray.png\"></a>";
    
    // Set array for template replacement
    $array = array(
        '{IMAGE}' => $image,
        '{DETAILES}' => $details,
        '{STATUS}' => $module_info['lang'],
        '{INSTALL}' => $install_icon,
        '{UNINSTALL}' => $uninstall_icon,
        '{SETUP}' => $setup,
        '{SETTINGS}' => $settings,
        '{VIEW}' => $view,
        '{STYLE}' => $style
    );
    
    // store results to this template to include it in the outer template
    $rows .= $admin_templates->get_template('modules_index_row.tpl.php', $array);
    
}

// get the outer template, replace values and then print it
$content .= $admin_templates->get_template('modules_index.tpl.php', array(
    '{ROWS}' => $rows
));

echo $content;

?>