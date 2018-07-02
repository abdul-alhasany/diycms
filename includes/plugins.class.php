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
 * Manages plugins in DiY-CMS
 * 
 * @package	Global
 * @subpackage	Classes
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	2010
 * @access 	public
 */
class plugins
{
    var $plugins_list = array();
    var $plugin_settings_array = array();
    var $modid = '';
	
    function plugins($modid = '')
    {
        global $diy_db, $CONF, $templates;
		
        if (!empty($modid)) {
			$this->modid = $modid;
        }
		
		// cache plugins for better performance
		$cahce = $diy_db->check_query_cache_file('plugins' . $this->themeid);
		if ($cahce) {
            $this->plugins_list = $diy_db->get_query_cache_file('plugins' . $this->themeid);
        }
		else
		{
        $result = $diy_db->query("SELECT * FROM diy_plugins
							WHERE plugin_status ='enabled'");
							
        while ($row = $diy_db->dbarray($result)) {
            extract($row);
            $this->plugins_list[$plugin_name] = array(
                $plugin_modules,
                $plugin_usergroups,
                $plugin_status
            );
        }
       }
	   
	   $cahce = $diy_db->check_query_cache_file('plugins_settings');
		if ($cahce) {
            $this->plugin_settings_array = $diy_db->get_query_cache_file('plugins_settings');
        }
		else
		{
        $result = $diy_db->query("SELECT diy_plugins.*,diy_plugins_settings.*
								FROM diy_plugins,diy_plugins_settings
                                 WHERE plugin_status ='enabled'
								 AND diy_plugins.plugin_id = diy_plugins_settings.plugin_id");
        while ($row = $diy_db->dbarray($result)) {
            extract($row);
            $this->plugin_settings_array[$plugin_name][$variable][$type] = $value;
        }
        }
        
        foreach ($this->plugins_list as $plugin => $details) {
            $check_user   = $this->check_user($details['1']);
            $check_module = $this->check_module($details['0']);
            if ($check_user && $check_module) {
                include('plugins/' . $plugin . '/index.php');
            }
        }
        
    }
    
    public function get_plugin_setting($plugin_name, $setting_name, $search = '')
    {
        $plugin_setting_array = $this->plugin_settings_array[$plugin_name][$setting_name];
        
        foreach ($plugin_setting_array as $key => $value) {
            if ($key == 7) {
                $find = strpos($value, "$search");
                if ($find !== false)
                    return true;
            } else {
                return $value;
            }
        }
    }
    
    
    function check_user($usergroups)
    {
        $groupid = $_COOKIE['cgroup'];
        $find    = strpos($usergroups, "$groupid");
        if (($find !== false)) {
            return true;
        }
    }
    
    function check_module($plugin_modules)
    {
        global $diy_db;
        $module      = $_GET['mod'];
		if(empty($this->modid))
		{
        $module_info = $diy_db->dbfetch("SELECT id FROM diy_modules WHERE mod_name ='$module' LIMIT 1");
        $find        = strpos($plugin_modules, $module_info['id']);
		}else
		{
			$find        = strpos($plugin_modules, $this->modid);
		}
        if (($find !== false)) {
            return true;
        }
    }
    
    
}

?>