<?php
/*
+===============================================================================+
|      	Some or all this file's contents were created by ArabPortal Team   		|
|						Web: http://www.arab-portal.info						|
|   	--------------------------------------------------------------   		|
|      					DIY-CMS V1.0.0 Copyright © 2011   						|
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
 * Manage sql queries cache
 * 
 * @package	Global
 * @subpackage	Classes
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	2011
 * @access 	public
 */
class mysql_cache
{
    var $cache_folder_path;

    function mysql_cache()
    {
        global $CONF;
        $this->cache_folder_path = $CONF['site_path']. '/cache';
	
        if (!is_dir($this->cache_folder_path)) {
            $create_dir = mkdir($this->cache_folder_path);
            
            if ($create_dir)
                @chmod($this->cache_folder_path, 0700);
            else
                error_message('Could not create cache directory');
        }
        
    }
    
    function create_query_cache_file($file_name, $contents)
    {
        $hashed_filename = md5(trim($file_name));
		
        if (is_array($contents))
            $contents = serialize($contents);
		
        $result = file_put_contents($this->cache_folder_path . '/' . $hashed_filename, $contents);
		
		return $result;
    }
    
    function check_query_cache_file($file_name)
    {
        if (file_exists($this->cache_folder_path.'/'.md5($file_name)))
        return true;
		else
		return false;
    }
	
	function get_query_cache_file($file_name)
    {
        
		$contents = file_get_contents($this->cache_folder_path . '/' . md5($file_name));
		$contents = unserialize($contents);

        return $contents;
    }
}