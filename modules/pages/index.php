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
  * This file is part of pages module
  * 
  * @package	Modules
  * @subpackage	Pages
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */    
    
    include("modules/" . $mod->module . "/settings.php");
    
    
    $index_middle = $mod->nav_bar();
    
    $add_perm = $mod->setting('add_page', $_COOKIE['cgroup']);
    if ($add_perm) {
            $add_page = "<a href=mod.php?mod=pages&modfile=add>$lang[ADD_PAGE]</a>";
    }
    
    $result = $diy_db->query("SELECT * FROM diycms_pages
						   WHERE allow='yes'
						   ORDER BY id DESC ");
    while ($row = $diy_db->dbarray($result)) {
			$row       = format_data_out($row);
            extract($row);

            eval("\$list .= \" " . $mod->gettemplate('pages_index_pages_list') . "\";");
    }
    
    eval("\$index_middle .= \" " . $mod->gettemplate('pages_index_pages') . "\";");
   
    
echo $index_middle;
?> 