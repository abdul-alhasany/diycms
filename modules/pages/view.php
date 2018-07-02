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
    $page= $_GET['page'];
   
    $edit_perm = $mod->setting('edit_page', $_COOKIE['cgroup']);
    if ($edit_perm) {
            $edit_page = "<a href=mod.php?mod=pages&modfile=edit&page=$page>$lang[EDIT_PAGE]</a>";
    }

    $result = $diy_db->query("SELECT * FROM diycms_pages
						   WHERE title='$page'
						   AND allow='yes'
						   LIMIT 1");
    while ($row = $diy_db->dbarray($result)) {

            extract($row);
			$row       = format_data_out($row);
			$content	= post_output($content, 'html');
            eval("\$index_middle .= \" " . $mod->gettemplate('pages_view_page') . "\";");
    }
    
   
    
echo $index_middle;
?>