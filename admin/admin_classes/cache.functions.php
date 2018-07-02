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
 * handles cache functions in diy-cms
 * 
 * @package	Admin
 * @subpackage	Functions
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	1.1
 * @access 	public
 */

  function cache_global_settings()
  {
	global $diy_db;
	$query_result = $diy_db->query("SELECT variable,value FROM diy_settings");
    
		while ($row = $diy_db->dbarray($query_result)) {
        $key         = $row['variable'];
        $array[$key] = $row['value'];
		}

	  $diy_db->create_query_cache_file('global_settings', $array);
	  return;
  }
  
// cahce results for better performance
function cache_templates($theme_id)
{
    global $diy_db;
    $query_result = $diy_db->query("SELECT name,template FROM diy_templates WHERE
                               themeid='$theme_id'");
    while ($row = $diy_db->dbarray($query_result)) {
        extract($row);
        $array[$name] = $template;
    }
    
    $diy_db->create_query_cache_file('theme_templates_' . $theme_id, $array);
    return;
}

// cahce results for better performance
function cache_smiles()
{
    global $diy_db;
    $query_result = $diy_db->query("SELECT * FROM diy_smileys ORDER BY id");
    while ($row = $diy_db->dbarray($query_result)) {
        extract($row);
        $smiles[$code] = $smile;
    }
    
    $diy_db->create_query_cache_file('smile_images', $smiles);
    return;
}

// cahce results for better performance
function cache_plugins()
{
    global $diy_db;
    $query_result = $diy_db->query("SELECT * FROM diy_plugins
							WHERE plugin_status ='enabled'");
    while ($row = $diy_db->dbarray($query_result)) {
        extract($row);
        $plugins[$plugin_name] = array(
            $plugin_modules,
            $plugin_usergroups,
            $plugin_status
        );
    }
    
    $diy_db->create_query_cache_file('plugins', $plugins);
    return;
}

function cache_plugins_settings()
{
    global $diy_db;
    $result = $diy_db->query("SELECT diy_plugins.*,diy_plugins_settings.*
								FROM diy_plugins,diy_plugins_settings
                                 WHERE plugin_status ='enabled'
								 AND diy_plugins.plugin_id = diy_plugins_settings.plugin_id");
    while ($row = $diy_db->dbarray($result)) {
        extract($row);
        $plugin_settings_array[$plugin_name][$variable][$type] = $value;
    }
    
    $diy_db->create_query_cache_file('plugins_settings', $plugin_settings_array);
    return;
}

function cache_module_templates($module_id, $themeid)
{
    global $diy_db;
    $result = $diy_db->query("SELECT temp_title, template FROM diy_modules_templates
							WHERE modid='" . $module_id . "'
							AND parent='" . $themeid . "'");
    while ($row = $diy_db->dbarray($result)) {
        $key             = $row['temp_title'];
        $value           = $row['template'];
        $templates[$key] = $value;
    }
    
    $diy_db->create_query_cache_file('module_templates_' . $module_id . '_' . $themeid, $templates);
    return;
}

function cache_module_info($module)
{
    global $diy_db;
    
    $info = $diy_db->dbfetch("SELECT * FROM diy_modules WHERE mod_name='" . $module . "'");
    
    $diy_db->create_query_cache_file('module_info' . $module, $info);
	
	// update menu info as well
	cache_menus();
    return;
}

function cache_module_settings($module)
{
    global $diy_db;
    $result = $diy_db->query("SELECT set_var,set_val,set_type FROM diy_modules_settings
							WHERE set_mod='" . $module . "'");
    while ($row = $diy_db->dbarray($result)) {
        $key                   = $row['set_var'];
        $type                  = $row['set_type'];
        $value                 = $row['set_val'];
        $settings[$key][$type] = $value;
    }
    
    $diy_db->create_query_cache_file('module_settings_' . $module, $settings);
    return;
}

// cahce menuus
function cache_menus()
{
    global $diy_db;
    $module_query_result = $diy_db->query("SELECT mod_name, mnueid 	
										FROM diy_modules
										ORDER BY id ASC");
    while ($module_row = $diy_db->dbarray($module_query_result)) {
		unset($block_array);
		$mnueid = $module_row['mnueid'];
        $query_result = $diy_db->query("SELECT menuid,block_template,menuhead,menucenter,menualign,checkuser
										FROM diy_menu
										WHERE menushow = '1'
										AND menuid in($mnueid)
										ORDER BY menuorder ASC");
        while ($row = $diy_db->dbarray($query_result)) {
            extract($row);
            $block_array[$menualign][$menuid] = array(
                'block_template' => $block_template,
                'menucenter' => $menucenter,
                'menuhead' => $menuhead,
                'checkuser' => $checkuser
            );
        }
       
        $diy_db->create_query_cache_file('menus_' . $module_row['mod_name'], $block_array);
    }
    return;
}

// cahce index menus
function cache_index_menus()
{
    global $diy_db;
		cache_global_settings();
		$diy_global_settings_array = diy_global_settings_array();
	
		$mnueid = $diy_global_settings_array["index_menuid"];
		if(empty($mnueid))
		$mnueid = 0;
		
		
        $query_result = $diy_db->query("SELECT menuid,block_template,menuhead,menucenter,menualign,checkuser
										FROM diy_menu
										WHERE menushow = '1'
										AND menuid in($mnueid)
										ORDER BY menuorder ASC");
        while ($row = $diy_db->dbarray($query_result)) {
            extract($row);
            $block_array[$menualign][$menuid] = array(
                'block_template' => $block_template,
                'menucenter' => $menucenter,
                'menuhead' => $menuhead,
                'checkuser' => $checkuser
            );
        }

        $diy_db->create_query_cache_file('menus_index', $block_array);
    return;
}
?>