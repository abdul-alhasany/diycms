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
 * 
 * 
 * @package	Admin
 * @subpackage	Functions
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	1.1
 * @access 	public
 */


/**
 * editsetting()
 * 
 * @param mixed $t
 * @param string $modul
 * @return
 */
function editsetting($t)
{
    global $diy_db, $lang;
    // Get settings from database
    $result = $diy_db->query("SELECT * FROM diy_settings
								WHERE settingtype='$t'
								ORDER BY id ASC");
    
    while ($row = $diy_db->dbarray($result)) {
        extract($row);
        // assign every settings to its relevant form bit
        // 1 = input form
        // 2 = select form
        // 3 = numrical select form
        // 4 = textarea
        // 5 = radio selections
        
        if ($variable == "dtimehour") {
            // set hours difference
            for ($i = -12; $i <= 12; $i++) {
                $hours[$i] = $i;
            }
            
            $content .= form_selectform(lang($title), $variable, $hours, $value);
        } elseif ($titletype == 1) {
            $content .= form_inputform(lang($title), $variable, $value, $options);
        } elseif ($titletype == 2) {
            $content .= form_selectform(lang($title), $variable, $options, $value);
        } elseif ($titletype == 3) {
            // set numeral list
            for ($i = 1; $i <= $options; $i++) {
                $list[$i] = $i;
            }
            $content .= form_selectform($lang[$title], $variable, $list, $value);
        } elseif ($titletype == 4) {
            $content .= form_textarea(lang($title), $variable, $value);
        } elseif ($titletype == 5) {
            $content .= form_radio_selection(lang($title), $variable, $options, $value);
        }
    }
    return $content;
}


/**
 * edit_module_settings()
 * 
 * @param mixed $module
 * @return
 */
function edit_module_settings($module)
{
    global $diy_db, $auth, $admin_lang, $CONF;
    $result = $diy_db->query("SELECT * FROM diy_modules
								WHERE mod_name='$module'
								ORDER BY id ASC LIMIT 1");
    
    $row = $diy_db->dbarray($result);
    extract($row);
    if (file_exists($CONF['site_path'] . "/modules/" . $mod_name . "/lang/" . $CONF['lang'] . ".lang.php")) {
        include($CONF['site_path'] . "/modules/" . $mod_name . "/lang/" . $CONF['lang'] . ".lang.php");
    }
    
    
    $result = $diy_db->query("SELECT * FROM diy_modules_settings
								WHERE set_mod='$module'
								AND set_type !='7'
								ORDER BY set_order ASC");
    
    if ($diy_db->dbnumrows($result) !== 0) {
        while ($row = $diy_db->dbarray($result)) {
            extract($row);
            switch ($set_type) {
                case "2":
                    $form .= form_selectform($admin_lang[$set_text], $set_var, $admin_lang[$set_var], $set_val);
                    break;
                case "3":
                    for ($i = 1; $i <= 20; $i++) {
                        $list[$i] = $i;
                    }
                    $form .= form_selectform($admin_lang[$set_text], $set_var, $list, $set_val);
                    break;
                case "4":
                    $form .= form_textarea($admin_lang[$set_text], $set_var, $set_val);
                    break;
                case "5":
                    $form .= form_radio_selection($admin_lang[$set_text], $set_var, '', $set_val);
                    break;
                case "6":
                    $form .= form_inputform($admin_lang[$set_text], $set_var, $set_val, 20);
                    break;
            }
        }
        
    }
    
    
    $perm .= form_module_permissions($module);
    
    
    $form_array = array(
        "action" => "sections.php?section=modules&file=settings&module=$module&" . $auth->get_sess(),
        "title" => lang('SETTINGS_TITLE'),
        "name" => 'settings',
        "content" => $form,
        "extra" => $perm,
        "submit" => lang('SUBMIT')
    );
    
    $output = form_output($form_array);
    return $output;
}


/**
 * edit_plugin_settings()
 * 
 * @param mixed $plugin_id
 * @return
 */
function edit_plugin_settings($plugin, $plugin_id)
{
    global $diy_db, $auth, $admin_plugin_lang, $CONF;
    
    if (file_exists($CONF['site_path'] . "/plugins/$plugin/lang/" . $CONF['lang'] . ".lang.php")) {
        include($CONF['site_path'] . "/plugins/$plugin/lang/" . $CONF['lang'] . ".lang.php");
    }
    $result = $diy_db->query("SELECT * FROM diy_plugins_settings
								WHERE plugin_id= '$plugin_id'
								AND type !='7'
								ORDER BY `order` ASC");
    
    if ($diy_db->dbnumrows($result) !== 0) {
        while ($row = $diy_db->dbarray($result)) {
            extract($row);
            switch ($type) {
                case "0":
                    $form .= call_user_func($custom, $admin_plugin_lang[$text], $variable, $value);
                    break;
                case "1":
                    $form .= form_checkbox_select($admin_plugin_lang[$text], $variable . "[]", $admin_plugin_lang[$variable], $value);
                    break;
                case "2":
                    $form .= form_selectform($admin_plugin_lang[$text], $variable, $admin_plugin_lang[$variable], $value);
                    break;
                case "3":
                    for ($i = 1; $i <= 20; $i++) {
                        $list[$i] = $i;
                    }
                    $form .= form_selectform($admin_plugin_lang[$text], $variable, $list, $value);
                    break;
                case "4":
                    $form .= form_textarea($admin_plugin_lang[$text], $variable, $value);
                    break;
                case "5":
                    $form .= form_radio_selection($admin_plugin_lang[$text], $variable, '', $value);
                    break;
                case "6":
                    $form .= form_inputform($admin_plugin_lang[$text], $variable, $value, 20);
                    break;
            }
        }
    }
    
    $perm_result = $diy_db->query("SELECT * FROM diy_plugins_settings
									WHERE plugin_id ='$plugin_id'
									AND type ='7'");
    // check that permission exist for the plugin
    if ($diy_db->dbnumrows($perm_result) !== 0) {
        $perm .= form_plugin_permissions($plugin_id);
    }
    
    $form_array = array(
        "action" => "sections.php?section=plugins&file=settings&plugin=$plugin&plugin_id=$plugin_id&" . $auth->get_sess(),
        "title" => lang('SETTINGS_TITLE'),
        "name" => 'settings',
        "content" => $form,
        "extra" => $perm,
        "submit" => lang('SUBMIT')
    );
    
    $output = form_output($form_array);
    return $output;
}
/**
 * lang()
 * 
 * @param mixed $text
 * @return
 */
function lang($text)
{
    global $lang;
	if(is_array($text))
	return $text;
	else
    return $lang[$text];
    
}

function proccess_lang_array($lang)
{
	if(is_array($lang))
	{
		$text = "<span class='form_desc_normal'>{$lang['normal']}</span>";
		$text .= "<span class='form_desc_short'>{$lang['short']}</span>";
	}
	else
	{
		$text = "<span class='form_desc_normal'>{$lang}</span>";
	}
	return $text;
}

/**
 * info_msg()
 * 
 * @param mixed $msg
 * @param string $url
 * @param string $seconds
 * @return
 */
function info_msg($msg, $url = '', $seconds = '')
{
    global $admin_templates;
    if (!$url)
        $url = $_SERVER['HTTP_REFERER'];
    if (!$seconds)
        $seconds = '3';
    
    $array = array(
        '{MSG}' => $msg,
        '{URL}' => $url,
        '{SECONDS}' => $seconds
    );
    
    $template = $admin_templates->get_template('functions_info_msg.tpl.php', $array);
    echo $template;
    exit;
}

/**
 * error_msg()
 * 
 * @param mixed $msg
 * @param string $url
 * @param string $seconds
 * @return
 */
function error_msg($msg, $url = '')
{
    global $admin_templates;
    if (!$url)
        $url = $_SERVER['HTTP_REFERER'];
    
    $array = array(
        '{MSG}' => $msg,
        '{URL}' => $url
    );
    
    $template = $admin_templates->get_template('functions_error_msg.tpl.php', $array);
    echo $template;
    exit;
}

/**
 * admin_format_data()
 * 
 * @param mixed $r
 * @return
 */
function admin_format_data($r)
{
    return mysql_real_escape_string(stripslashes(trim($r)));
}


/**
 * Output()
 * 
 * @param mixed $main_content
 * @param string $header
 * @param string $footer
 * @return
 */
function output($main_content, $header = '', $footer = '')
{
    extract($GLOBALS);
    if ($header !== false) {
        $output = "
		<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
   'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
   <!ENTITY % HTMLspecial PUBLIC '-//W3C//ENTITIES Special//EN//HTML'
   'http://www.w3.org/TR/REC-html40-971218/HTMLspecial.ent'>
		<HTML DIR={$CONF['dir']}>
              <head>
			  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
              <META content=\"DiyCMS\" name=keywords>
              <META content=\"DiyCMS , Powered by DiyCMS\" name=description>
			  <script type='text/javascript' src='admin_skin/default/jquery.js'></script>
			  <script type='text/javascript' src='admin_skin/default/sidemenu.js'></script>
              <link rel=\"stylesheet\" type=\"text/css\" href=\"admin_skin/default/{$CONF['dir']}.css\">
              <title> {$lang['ADMIN_CP']} </title>
			  </head>
               ";
    }
    
    
    $sidenav .= "<div id='side_menu_wrapper'><div id='side_menu'>";
    
    
    $main_dir = opendir($CONF['site_path'] . "/admin/admin_sections");
    while ($dir = readdir($main_dir)) {
        if (($dir != ".") && ($dir != "..")) {
            if (file_exists($CONF['site_path'] . "/admin/admin_sections/{$dir}/side_menu.php")) {
                include($CONF['site_path'] . "/admin/admin_sections/{$dir}/side_menu.php");
            }
        }
    }
    
    $nav_array = array(
        lang('SIDENAV_GLOBAL_SETTINGS') => array(
            lang('SIDENAV_GENERAL_CONFIGRATIONS') . '|link|sections.php?section=settings|image|sidenav_settings.png',
            lang('SIDENAV_CHECK_UPDATES') . '|link|sections.php?section=updates|image|sidenav_update.png'
        ),
        lang('SIDENAV_EXTENSIONS') => array(
            lang('SIDENAV_MODULES_MANAGMENT') . '|link|sections.php?section=modules|image|sidenav_modules.png',
            lang('SIDENAV_PLUGINS_MANAGMENT') . '|link|sections.php?section=plugins|image|sidenav_plugins.png'
        ),
        lang('SIDENAV_MENUS') => array(
            lang('SIDENAV_MENUS_MANAGEMENT') . '|link|sections.php?section=menus|image|sidenav_menus.png',
            lang('SIDENAV_CREATE_MENU') . '|link|sections.php?section=menus&file=add_menu|image|sidenav_add_menu.png',
            lang('SIDENAV_INDEX_MENUS') . '|link|sections.php?section=menus&file=index_menus|image|sidenav_index_menus.png'
        ),
        lang('SIDENAV_FEEL_LOOK') => array(
            lang('SIDENAV_THEMES_MANAGEMENT') . '|link|sections.php?section=themes|image|sidenav_themes.png',
            lang('SIDENAV_IMPORT_CREATE_IMPORT') . '|link|sections.php?section=themes&file=themes&action=create_import_theme|image|sidenav_add_theme.png'
        ),
        lang('SIDENAV_GROUPS') => array(
            lang('SIDENAV_MANAGE_GROUPS') . '|link|sections.php?section=groups|image|sidenav_groups.png',
            lang('SIDENAV_CREATE_GROUP') . '|link|sections.php?section=groups&file=add_group|image|sidenav_add_group.png'
        ),
        lang('SIDENAV_SMILES') => array(
            lang('SIDENAV_MANAGE_SMILS') . '|link|sections.php?section=smiles|image|sidenav_smiles.png',
            lang('SIDENAV_CREATE_SMILE') . '|link|sections.php?section=smiles&file=add_smile|image|sidenav_add_smile.png'
        )
    );
    
    $block = 0;
    $item  = 0;
    foreach ($nav_array as $block_title => $content) {
        $block++;
        $menu_block = "<ul class='menu_block' id='$block'>";
        $menu_block .= "<h1>{$block_title}";
        $menu_block .= "<span class='toggle_maxmize'></span><span class='toggle_minimize'></span></h1>";
        
        admin_check_knot_function("menu_block_start_$block", $menu_block);
        
        foreach ($content as $block_items) {
            $item++;
            $block_items = explode('|link|', $block_items);
            $title       = $block_items[0];
            $details     = explode('|image|', $block_items[1]);
            $url         = $details[0] . '&' . $auth->get_sess();
            $image       = $details[1];
            
            $menu_item = "<li><a href={$url}><img border='0' src=<#admin_images_path#>/$image> $title </a></li>";
            
            admin_check_knot_function("menu_item_$item", $menu_item);
            
            $menu_block .= $menu_item;
            
        }
        $menu_block .= '</ul>';
        
        admin_check_knot_function("menu_block_end_$block", $menu_block);
        
        $sidenav .= $menu_block;
    }
    
    admin_check_knot_function("last_block", $block);
    admin_check_knot_function("admin_sidenav", $sidenav);
    
    
    $sidenav .= "</div><div style='clear:both;'></div></div>";
    $content = "<table border=0 cellspacing= cellpadding=0 width=100%><tr><td>$main_content</td></tr></table>";
    
    if ($footer !== false) {
        $foot .= "<p align='center'><font face='Verdana' color='#000055' size='2'>Copyright© 2011 </font>
	   <font face='Verdana' size='2'><font face='Verdana' color='#000055' size='2'>Powered by</font> </font>
	   <a class='footer_link' target='_blank' href='http://www.diy-cms.com'><font color='#800000'><font face='Verdana'><span style='text-decoration: none'>DIYCMS</span></font><font face='Verdana' size='2'><span style='text-decoration: none'></span></font></font></a><font color='#800000' face='Verdana' size='2'> ".get_diycms_version()."</font></p>";
    }
    // set variables to be replaced in template
    $var_array = array(
        '{CONTENT}' => $content,
        '{SIDENAVE}' => "$sidenav",
        '{SESSION}' => $auth->get_sess(),
        '{FOOT}' => "$foot"
    );
    $output .= $admin_templates->get_template('temp.tpl.php', $var_array);
    
    echo $output;
}

/**
 * add_slashes()
 * 
 * @param mixed $values
 * @return
 */
function admin_add_slashes(&$values)
{
    if (is_array($values)) {
        foreach ($values as &$value) {
            $value = addslashes($value);
        }
    } else {
        $values = addslashes($values);
    }
}

/**
 * admin_dir_operation()
 * 
 * @param mixed $values
 * @return
 */
function admin_create_delete_dir($action, $dir_name, $path = '')
{
    global $CONF;
    if ($path == '')
        $path = $CONF['upload_path'];
    
    $dir = $path . "\\" . $dir_name;
    
    
    if ($action == 'create_directory') {
        if (!is_dir($dir))
            mkdir($dir);
    } elseif ($action == 'delete_directory') {
        $files = glob($dir . '/*.*', GLOB_MARK);
        foreach ($files as $file) {
            unlink($file);
        }
        if (is_dir($dir))
            rmdir($dir);
    }
}

?>