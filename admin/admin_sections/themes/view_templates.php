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
  * This file is part of themes section
  * 
  * @package	Admin_sections
  * @subpackage	Themes
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

if (RUN_SECTION !== true) {
    die("<center><h3>" . lang('ACCESS_NOT ALLOWED') . "</h3></center>");
}

// assing admin session to a variable for later and easier use
$session = $auth->get_sess();

// get some ids and info
$themeid = set_id_int('themeid');


// Build navigation
$nav_array = array(
    lang('THEMES_INDEX_TITLE') => "sections.php?section=themes&$session",
    lang('THEMES_TEMPLATES_TITLE')
);

// set navigation
$content .= $this->nav_bar($nav_array);

$temp_group_result = $diy_db->query("SELECT * FROM diy_temptype
									WHERE themeid='$themeid'
									ORDER BY tempid ASC");

while ($temp_group_array = $diy_db->dbarray($temp_group_result)) {
    extract($temp_group_array);
    
    $result = $diy_db->query("SELECT * FROM diy_templates
							WHERE themeid='$themeid'
							AND temptype='$tempid'
							ORDER BY name ASC");
    
    // unset rows so its value will not add up every time the main query loops
    unset($rows);
    
    while ($row = $diy_db->dbarray($result)) {
        extract($row);
        
        // Set array for template replacement
        $array = array(
            '{TEMP_TITLE}' => $name,
            '{SESSION}' => $session,
            '{THEME_ID}' => $themeid,
            '{TEMP_ID}' => $id,
            '{GROUP_ID}' => $tempid
        );
        
        // store results to this template to include it in the outer template
        $rows .= $admin_templates->get_template('themes_view_templates_row.tpl.php', $array);
        
    }
    
    // get the outer template, replace values and then print it
    $array = array(
        '{ROWS}' => $rows,
        '{TEMP_GROUP}' => $temptypetitle
    );
    
    $content .= $admin_templates->get_template('themes_view_templates.tpl.php', $array);
}
echo $content;

?>