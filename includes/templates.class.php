<?php
/*
+===============================================================================+
|      					DIY-CMS V1.1.1 Copyright 2011   						|
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
 * This class handles login functions
 * 
 * @package	Global
 * @subpackage	Classes
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	2011
 * @access 	public
 */

class templates
{
    var $main_templates = array();
    var $theme_custom_settings = array();
    var $css = '';
    var $themeid = "";
    var $themepath;
    var $global_block_template;
    var $available_menus;
    
    
    /**
     * Constructor: load main settings array, default theme, main templates array, 
     * 
     * @return null	main settings array and main templates array
     */
    function templates()
    {
        global $diy_db, $CONF;
        
        check_hook_function('templates_constructor_start', $empty);
        
        // Check the themes selected by user if he is logged in	otherwise disblay the defualt theme
        $this->themeid = (isset($_COOKIE['ctheme'])) ? (int) $_COOKIE['ctheme'] : (int) get_global_setting('theme');
        check_hook_function('templates_themeid', $this->themeid);
        
        if (!isset($this->themeid))
            trigger_error('No Theme Avaibale', E_USER_ERROR);
        
        $cahce = $diy_db->check_query_cache_file('theme_templates_' . $this->themeid);
        if ($cahce) {
            $this->main_templates = $diy_db->get_query_cache_file('theme_templates_' . $this->themeid);
        } else {
            $result = $diy_db->query("SELECT * FROM diy_templates WHERE
                               themeid='" . $this->themeid . "'");
            while ($row = $diy_db->dbarray($result)) {
                $key                        = $row['name'];
                $value                      = $row['template'];
                $this->main_templates[$key] = $value;
            }
        }
        
        // get theme settings cache if available
        $cahce = $diy_db->check_query_cache_file('theme_settings_' . $this->themeid);
        if ($cahce) {
            $theme_settings = $diy_db->get_query_cache_file('theme_settings_' . $this->themeid);
        } else {
            $result         = $diy_db->query("SELECT * FROM diy_themes WHERE id='" . $this->themeid . "'");
            $theme_settings = $diy_db->dbarray($result);
        }
        
        $themepath                   = $theme_settings["themepath"];
        $this->available_menus       = $theme_settings["available_menus"];
        $this->global_block_template = $theme_settings["global_block_template"];
        $this->themepath             = $themepath;
        
        // load theme custom settings
        $setting_file = $CONF['site_path'] . '/themes/' . $themepath . '/settings.ini';
        if (file_exists($setting_file)) {
            $this->theme_custom_settings = parse_ini_file($setting_file, true);
        }
        
        check_hook_function('templates_constructor_end', $empty);
        //---------------------------------------------------
        //                       end theme
        //---------------------------------------------------
        
    }
    
    /**
     * retrive the spcified template from the main templates array
     * 
     * @param string $templatename	Template title
     * @return mixed 					Template content
     */
    function gettemplate($templatename)
    {
        check_hook_function('global_template_' . $templatename . '_start', $templatename);
        
        // $empty variable is an empty variable, since the second paramter is passed by refrence and can not be empty
        check_hook_function('global_template', $empty);
        
        $template_content = $this->main_templates[$templatename];
        $template         = replace_callback($template_content);
        $template         = str_replace('<#themepath#>', $this->themepath, $template);
        // $template = str_replace("\"", "\\\"", stripslashes($template));
        $template         = preg_replace_callback('@\[global_lang:(.+?)\]@', array(
            $this,
            'global_lang'
        ), $template);
        $template         = preg_replace_callback('@\[global_template:(.+?)\]@', array(
            $this,
            'include_global_template'
        ), $template);
        $template         = preg_replace_callback('@\{if(.+?)\?(.+?)\}@is', array(
            $this,
            'condition_statments'
        ), $template);
        
        check_hook_function('global_template_' . $templatename . '_end', $template);
        
        return $template;
    }
    
    /**
     * Proccess template inclusion whithen templates
     * 
     * @param string $templatename	Template name
     * @return mixed					Included template anme
     */
    function include_global_template($matches)
    {
        $template_content = $this->main_templates[$matches[1]];
        $template         = replace_callback($template_content);
        $template         = str_replace('<#themepath#>', $this->themepath, $template);
        //  $template = str_replace("\"", "\\\"", stripslashes($template));
        $template         = preg_replace_callback('@\[global_lang:(.+?)\]@', array(
            $this,
            'global_lang'
        ), $template);
        $template         = preg_replace_callback('@\[global_template:(.+?)\]@', array(
            $this,
            'include_global_template'
        ), $template);
        
        
        return $template;
    }
    
    
    /**
     * get globl lang
     * 
     * @param array $matches			match results
     * @return string					langeuage string
     */
    function global_lang($matches)
    {
        return constant($matches[1]);
    }
    
    /**
     * Proccess themes conditions
     * 
     * @param string $templatename	Template name
     * @return mixed					Included template anme
     */
    function condition_statments($matches)
    {
        check_hook_function('condition_statments_matches', $matches);
        
        $match = trim($matches[1]);
        
        switch ($match) {
            case '(right)':
                $return = (!empty($GLOBALS['right_menu'])) ? $matches[2] : $matches[3];
                break;
            
            case '(left)':
                $return = (!empty($GLOBALS['left_menu'])) ? $matches[2] : $matches[3];
                break;
            
            case '(noleft-noright)':
            case '(noright-noleft)':
                $return = (empty($GLOBALS[right_menu]) && empty($GLOBALS[left_menu])) ? $matches[2] : $matches[3];
                break;
            
            case '(right-noleft)':
            case '(noleft-right)':
                $return = (!empty($GLOBALS[right_menu]) && empty($GLOBALS[left_menu])) ? $matches[2] : $matches[3];
                break;
            
            case '(left-noright)':
            case '(noright-left)':
                $return = (empty($GLOBALS[right_menu]) && !empty($GLOBALS[left_menu])) ? $matches[2] : $matches[3];
                break;
            
            case '(left-right)':
            case '(right-left)':
                $return = (!empty($GLOBALS[right_menu]) && !empty($GLOBALS[left_menu])) ? $matches[2] : $matches[3];
                break;
        }
        
        check_hook_function('condition_statments_end', $return);
        
        
        return $return;
    }
    
    /**
     * This display the selected template
     * 
     * @param string $template_name	the name of the template to be displayed
     * @return template
     */
    function display_template($template_name, $array = '')
    {
        global $diy_db;
        
        (is_array($array)) ? extract($array) : extract($GLOBALS, EXTR_SKIP);
        
        $filename = "template://" . $template_name;
        ob_start();
        if (ini_get('safe_mode') == 1) {
            eval('?>' . implode('', file($filename)) . '<?php ');
        } else {
            require($filename);
        }
        $template = ob_get_contents();
        ob_end_clean();
        
        return $template;
    }
    
    /**
     * Get custom settings
     * 
     * @param string $template_name	the name of the template to be displayed
     * @return template
     */
    function get_setting($setting_name)
    {
        return $this->theme_custom_settings['settings_array'][$setting_name];
    }
    
    /**
     * This function outputs the main content of the website
     * 
     * @param integer $leftmenu
     * @param integer $rightmenu
     * @return
     */
    function page_output($leftmenu = '', $rightmenu = 1)
    {
        //  extract($GLOBALS);
        // $empty variable is an empty variable, since the second paramter is passed by refrence and can not be empty
        check_hook_function('page_output_start', $empty);
        
        $pagehd = $this->header;
        $pageft = $this->footer;
        
        $output .= $this->display_template('main_wrapper');
        
        check_hook_function('page_output_output', $output);
        
        if ($leftmenu == '') {
            $output    = str_replace("<!-- LeftStart -->", "<!--", $output);
            $output    = str_replace("<!-- LeftEnd -->", "-->", $output);
            $left_menu = null;
        }
        
        if ($rightmenu == 0) {
            $output     = str_replace("<!-- RightStart -->", "<!--", $output);
            $output     = str_replace("<!-- RightEnd -->", "-->", $output);
            $right_menu = null;
        }
        
        check_hook_function('page_output_end', $output);
        
        echo $output;
    }
    
}

?>