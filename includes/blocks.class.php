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
 * This class handels menu (blocks) viewed in cms whether on the sides or in the middle
 * 
 * @package	Global
 * @subpackage	Classes
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	2010
 * @access 	public
 */

class menu
{
    var $menuhead = '';
    var $menucenter = '';
    var $menuid = '';
    var $block_template = '';
    
    /**
     * Main function. it is used to retrive menus used in a certain module or part of the cms
     * 
     * @param int $align	menu align
     * @return mixed	list of all blocks included in the index page (if it is the index page) or in a given module (if it was loaded).
     */
    function show_menus($align)
    {
        global $templates, $diy_db, $mod;
        
        check_hook_function('show_menus_start', $align);
        
        $query = "SELECT * FROM diy_menu WHERE menushow = '1' and menualign = '$align'";
        
		// check if theme global menu settings is set
		$id = (!empty($templates->available_menus)) ? $templates->available_menus : $this->menuid;
        
        if ((isset($id)) && ($id != '')) {
            $query .= " and menuid in($id)";
        }
        
        $query .= " ORDER BY menuorder ASC";
        
		// check if cache file exists
		$module = (isset($mod)) ? $mod->module : 'index';
		
        $cahce = $diy_db->check_query_cache_file('menus_'.$module);
        if ($cahce) {
            $block_array = $diy_db->get_query_cache_file('menus_'.$module);
        } else {
            $result = $diy_db->query($query);
            while ($row = $diy_db->dbarray($result)) {
                extract($row);
            //    echo serialize($menucenter)."<br>";
                $block_array[$align][$menuid] = array(
                    'block_template' => $block_template,
                    'menucenter' => $menucenter,
                    'menuhead' => $menuhead,
                    'checkuser' => $checkuser
                );
            }
        }

		// loop through results
        foreach ($block_array[$align] as $id => $block) {
		// check if global block template is set
		
			if($templates->global_block_template != 'none')
			{
				$this->block_template = $templates->global_block_template;
			}
			else
			{
				$this->block_template = ($block['block_template'] != null) ? $block['block_template'] : 'standard_menu';
			}
			
            $this->menuhead = str_replace("\"", "\\\"", stripslashes($block['menuhead']));
			
            $groupid = $_COOKIE['cgroup'];
            $find    = strpos($block['checkuser'], "$groupid");
            if (($find !== false)) {
                $this->menucenter = replace_callback($block['menucenter']);
                $menus .= $this->get_block($this->menuhead, $this->menucenter);
            }
        }
        check_hook_function('show_menus_end', $menus);
        
        return $menus;
    }
    
    //---------------------------------------------------
    // 
    //---------------------------------------------------
    
    /**
     * This function proccess and displays middle menus
     * 
     * @return mixed 	list of all middle menus
     */
    function middle_menu()
    {
        // $empty variable is an empty variable, since the second paramter is passed by refrence and can not be empty
        check_hook_function('middle_menu_start', $empty);
        
        $middle_menu_count = get_global_setting("count_middle_menu");
        $middle_menu       = "<table border=0 cellpadding=0 cellspacing=0 width=100%><tr valign=top>";
        $middle_menus      = $this->show_menus(3);
        $ex                = @explode('<!-- BLOCK END -->', $middle_menus);
        $m                 = 0;
        foreach ($ex as $amenu) {
            $middle_menu .= '<td width=50% valign=top>' . $amenu . '</td>';
            $m++;
            if ($m == $middle_menu_count) {
                $middle_menu .= "</tr>";
                $m = 0;
            }
        }
        $middle_menu .= "</tr></table><br>";
        
        check_hook_function('middle_menu_end', $middle_menu);
        
        return $middle_menu;
    }
    
    // 
    
    /**
     * Get template of each menu
     * 
     * @param string $head	value of the head part of the menu
     * @param string $center	value of center part of the menu
     * @return mixed			formatted and ready to display menu
     */
    function get_block($head, $center)
    {
        global $templates;
        
        check_hook_function('middle_menu_head', $head);
        check_hook_function('middle_menu_center', $center);
        
        $menu = $templates->display_template($this->block_template);
        
        $menu = str_replace("{block_head}", $head, $menu);
        $menu = str_replace("{block_center}", $center, $menu);
        
        check_hook_function('middle_menu_end', $menu);
        
        return $menu;
    }
    
} // End class


?>