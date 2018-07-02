<?php
/*
+===============================================================================+
|      	Some or all this file's contents were created by ArabPortal Team   		|
|						Web: http://www.arab-portal.info						|
|   	--------------------------------------------------------------   		|
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
 * This class is to display modules in DiY-CMS.
 * It manages modules files display, templates, settings, permissons and template inclusion
 * 
 * @package	Global
 * @subpackage	Classes
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	2010
 * @access 	public
 */
class module
{
    var $module = "";
    var $modfile = "index";
    var $dir;
    var $modInfo = array();
    var $settings = array();
    var $templates = array();
    var $language_array = array();
    
    /**
     * Constructor: load main functions, search for the main files and load templates
     *
     * First this function searches for the first parmater as the module to be loaded, if it is empty then $_GET['mod'] value will be loaded
     * otherwise redirect to the website's home page.
     * If $_GET['dir'] is speicifed and it is not the admin directory then assign its value to $this->dir otherwise assume it is the main module directory.
     * If the value of $_GET['file'] is not set the function will display the index.php page, otherwise dispaly the file
     * if the file does not exist then display an error message.
     * Lastly, the function will load the module templates and module settings into arrays to reduce page load and for later use by other functions
     *
     * @param 	string 	Module name, when not set it will get the value of $_GET['mod']
     * @return 	null 	templates array, settings array and module info will be loaded once the module name is known
     */
    function module($module_name = '')
    {
        global $templates, $diy_db, $lang, $plugins;
        
        check_hook_function('module_start', $module_name);
        
        $this->module = (!(empty($module_name))) ? $module_name : $this->module_name($_GET['mod']);
        
        if ($this->module == "") {
            header("Location: index.php");
            exit();
        }
        
		$this->load_module_info();
		
        if (isset($_GET['dir']) || $_GET['dir'] != 'admin') {
            $this->dir = $this->module_name($_GET['dir']);
            
            $this->modfile = ($_GET['modfile']) ? $this->module_name($_GET['modfile']) : "index";
            
            if (!@file_exists('modules/' . $this->module . '/' . $this->dir . '/' . $this->modfile . '.php')) {
                error_message(sprintf(LANG_MODULE_FILE_NOT_FOUND,$this->modfile));
            }
        } else {
            $this->modfile = ($_GET['modfile']) ? $this->module_name($_GET['modfile']) : "index";
            
            if (!@file_exists('modules/' . $this->module . '/' . $this->modfile . '.php')) {
                error_message(sprintf(LANG_MODULE_FILE_NOT_FOUND,$this->modfile));
            }
        }
        

        // chack cache and then load templates into an array for later use
        $cahce = $diy_db->check_query_cache_file('module_templates_' . $this->modInfo['id'] . '_' . $this->modInfo['themeid']);
        if ($cahce) {
            $this->templates = $diy_db->get_query_cache_file('module_templates_' . $this->modInfo['id'] . '_' . $this->modInfo['themeid']);
        } else {
            $result = $diy_db->query("SELECT temp_title, template FROM diy_modules_templates
							WHERE modid='" . $this->modInfo['id'] . "'
							AND parent='" . $this->modInfo['themeid'] . "'");
            while ($row = $diy_db->dbarray($result)) {
                $key                   = $row['temp_title'];
                $value                 = $row['template'];
                $this->templates[$key] = $value;
            }
        }
        
        // check cache and load settings into an array for later use
        $cahce = $diy_db->check_query_cache_file('module_settings_' . $this->module);
        if ($cahce) {
            $this->settings = $diy_db->get_query_cache_file('module_settings_' . $this->module);
        } else {
            $result = $diy_db->query("SELECT set_var,set_val,set_type FROM diy_modules_settings
							WHERE set_mod='" . $this->module . "'");
            while ($row = $diy_db->dbarray($result)) {
                $key                         = $row['set_var'];
                $type                        = $row['set_type'];
                $value                       = $row['set_val'];
                $this->settings[$key][$type] = $value;
            }
        }
        include("modules/" . $this->module . "/lang/" . $this->modInfo['mod_lang'] . ".lang.php");
        
        $this->language_array = $lang;
        
        $this->module_active();
        
        check_hook_function('module_end', $empty);
        
    }
    
    /**
     * This function gets the value of a specific setting of the loaded moudle.
     * The second paramater can be empty when the value of the settings is not based on a group permission which has type 7 in the database.
     * 
     * @use 	$mod->setting("value")
     * @use 	$mod->setting("value", $_COOKIE['cgroup'])
     * @param 	string 	$setting_value	setting to be queried
     * @param 	int 	$search			search for groupid in case setting is for group permission
     * @return 	string					the value of the setting
     */
    function setting($setting_value, $search = '')
    {
        check_hook_function('module_setting', $setting_value);
        
        $setting_array = $this->settings[$setting_value];
        foreach ($setting_array as $key => $value) {
            if ($key == 7) {
                $find = strpos($value, "$search");
                if ($find !== false)
                    return true;
            } else {
                return $value;
            }
        }
    }
    
    
    /**
     * retrive the template specificed for the loaded module
     * 
     * @param 	string $temp_title	the title of template to be retrived
     * @return 	string				module content
     */
    function gettemplate($temp_title, $slashes = true)
    {
        global $templates;
        
        check_hook_function('module_template_' . $temp_title . '_start', $empty);
        
        // $empty variable is an empty string, since the second paramter is passed by refrence and can not be empty
        check_hook_function('module_template', $empty);
        
        $template_content = $this->templates[$temp_title];
        
        $template = replace_callback($template_content);
        $template = str_replace('<#themepath#>', $templates->themepath, $template);
        $template = str_replace('<#mod_themepath#>', 'modules/' . $this->module . '/images', $template);
		
		if($slashes == true)
        $template = str_replace("\"", "\\\"", stripslashes($template));
		
        $template = preg_replace('/\[lang:(.+?)\]/', '$lang[\\1]', $template);
        $template = preg_replace_callback('@\[global_lang:(.+?)\]@', array(
            $templates,
            'global_lang'
        ), $template);
        $template = preg_replace_callback('@\[global_template:(.+?)\]@', array(
            $templates,
            'include_global_template'
        ), $template);
        $template = preg_replace_callback('/\[template:(.+?)\]/', array(
            $this,
            'include_module_template'
        ), $template);
        
        check_hook_function('module_template_' . $temp_title . '_end', $template);
        
        return $template;
    }
    
    /**
     * proccess template inclusion within loaded module.
     * if a template is included within a template then this function will proccess it as a template
     * , this function is dependent on $mod->setting()
     * 
     * @param 	string 	$temp_title 	the title of the template
     * @return	string					template content
     */
    function include_module_template($matches)
    {
        global $templates;
        
        $template_content = $this->templates[$matches[1]];
        $template         = replace_callback($template_content);
        $template         = str_replace('<#themepath#>', $templates->themepath, $template);
        $template         = str_replace('<#mod_themepath#>', 'modules/' . $this->module . '/images', $template);
        $template         = str_replace("\"", "\\\"", stripslashes($template));
        $template         = preg_replace('/\[lang:(.+?)\]/', '$lang[\\1]', $template);
        $template         = preg_replace_callback('@\[global_lang:(.+?)\]@', array(
            $templates,
            'global_lang'
        ), $template);
        $template         = preg_replace_callback('@\[global_template:(.+?)\]@', array(
            $templates,
            'include_global_template'
        ), $template);
        $template         = preg_replace_callback('/\[template:(.+?)\]/', array(
            $this,
            'include_module_template'
        ), $template);
        
        return $template;
    }
    
	  /**
     * This function differs from gettemplate() is that it accepts php code and there is no need to use eval
     * 
     * @param string $template_name	the name of the template to be displayed
     * @return template
     */
    function get_template_code($template_name, $array = '')
    {
        global $diy_db;
        
        (is_array($array)) ? extract($array) : extract($GLOBALS, EXTR_SKIP);
        
        ob_start();
        include("moduleTemplate://" . $template_name);
        $template .= ob_get_contents();
        ob_end_clean();
        return $template;
    }
	
	
    /**
     * check for for the value retrived from module::setting if a group setting was specified
     * 
     * @param 	string $info the value to be evaluated
     * @return	null 		 the function will return a login page
     */
    function permission($info)
    {
        global $templates;
        
        check_hook_function('permission_end', $info);
        
        if ($info == "") {
            diy_page_header(LANG_TITLE_LOG_IN);
            
            $msg = $templates->display_template('login_page');
            check_hook_function('permission_end', $msg);
            echo $msg;
            diy_page_footer();
            exit;
        }
    }
    
    /**
     * get loaded module detalies: name, groups allowed to view module, menus alignment .. etc.
     * 
     * @return	array array of module info
     */
    function load_module_info()
    {
        global $diy_db;
        
        check_hook_function('load_module_info_start', $empty);
        
        $cahce = $diy_db->check_query_cache_file('module_info' . $this->module);
        if ($cahce) {
            $result        = $diy_db->get_query_cache_file('module_info' . $this->module);
            $this->modInfo = $result;
            $num_row       = count($result);
        } else {
            $result        = $diy_db->query("SELECT * FROM diy_modules WHERE mod_name='" . $this->module . "'");
            $num_row       = $diy_db->dbnumrows($result);
            $this->modInfo = $diy_db->dbarray($result);
        }
        
        
        if ($num_row > "0") {
            $result = $this->modInfo;
        } else {
            $result = error_message(sprintf(LANG_MODULE_NOT_FOUND, $this->module));
        }
        	  
        check_hook_function('load_module_info_end', $result);
        
        return $result;
    }
    
    /**
     * output the module. Function checks if a page is set (within a directory or not) and then display it
     * 
     * @return mixed module output
     */
    function module_output()
    {
        global $mod, $diy_db, $CONF, $login;
        
        check_hook_function('module_output_start', $empty);
        
        if (!$this->modfile)
            return;
        
        ob_start();
        
        extract($this->modInfo, EXTR_IF_EXISTS);
        
        if ($_GET['dir']) {
            $this->dir = $this->module_name($_GET['dir']);
            
            require_once('modules/' . $this->module . '/' . $this->dir . '/' . $this->modfile . '.php');
        } else {
            require_once('modules/' . $this->module . '/' . $this->modfile . '.php');
        }
        
        
        $output = ob_get_contents();
        
        ob_end_clean();
        
        check_hook_function('module_output_end', $output);
        
        return $output;
    }
    
    /**
     * get module name and clean it
     * 
     * @param 	string 	$name 	module name
     * @return 	string 			cleaned module name
     */
    function module_name($name)
    {
        return preg_replace("/[^a-zA-Z0-9\-\_]/", "", $name);
    }
    
    /**
     * check if loaded module is enabled or disabled.
     * If it it is disabled then check if Admin is logged in and display it, otherwise display a login page
     * 
     * @return null 	login page
     */
    function module_active()
    {
        global $templates;
        check_hook_function('module_active', $empty);
        
        if (($_COOKIE['cgroup'] !== '1') and ($_COOKIE['cgroup'] !== '2')) {
            if ($this->modInfo[mod_sys] == 0) {
                error_message(_MOD_DISABLE);
            }
        }
        
        $groupid = $_COOKIE['cgroup'];
        $find    = strpos($this->modInfo['mod_user'], "$groupid");
        
        if ($find === false) {
            diy_page_header(LANG_TITLE_LOG_IN);
            print $templates->display_template('login_page');
            diy_page_footer($pageft);
            exit;
        }
    }
    
	/**
	* Retrive a string for language variable
	*
	*/
	function get_lang($var)
	{
		return $this->language_array[$var];
	}
	
    /**
     * This function get the navigation bar for the loaded module 
     * 
     * @param 	string 	$extra		to add any extra elements to the module navigation bar
     * @return	mixed				module navigation bar template
     */
    function nav_bar($extra = '')
    {
        global $themepath, $templates;
        
        check_hook_function('nav_bar_start', $extra);
        
        $sitetitle   = get_global_setting("sitetitle");
        $module_name = "<a href=mod.php?mod=" . $this->modInfo['mod_name'] . ">&nbsp;" . $this->modInfo['mod_title'] . "</a>";
        if (is_array($extra)) {
            foreach ($extra as $key => $value) {
                if (is_numeric($key)) {
                    $module_name .= "&nbsp; &raquo; $value";
                } else {
                    $module_name .= "&nbsp; &raquo; <a href=$value> $key</a>";
                }
            }
        } elseif (!empty($extra)) {
            $module_name .= " &raquo; $extra";
        }
        
        $template_array = array(
            'sitetitle' => $sitetitle,
            'module_name' => $module_name
        );
        $template .= $templates->display_template('module_nav_bar', $template_array);
        
        check_hook_function('nav_bar_end', $template);
        
        return $template;
    }
}

?>