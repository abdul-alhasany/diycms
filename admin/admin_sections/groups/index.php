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
  * This file is part of groups section
  * 
  * @package	Admin_sections
  * @subpackage	Groups
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
// set nav
$content = $this->nav_bar(lang('GROUPS_INDEX_TITLE'));

// get the data of all groups
$result = $diy_db->query("SELECT * FROM diy_groups ORDER BY groupid ASC");
while ($row = $diy_db->dbarray($result)) {
    extract($row);
    // get the number of useres in each group
    $user_no = $diy_db->dbnumquery("diy_users", "groupid ='$groupid'");
    
    // check if the usergroup is deletable
    if (($deletble == 1))
        $delete = "<a href=sections.php?section=groups&file=delete_group&groupid=$groupid&$session><img border='0' title=" . lang('GROUPS_INDEX_DELETE') . " src=<#admin_images_path#>/delete_small.png></a>";
    else
        $delete = "<a href=\"javascript:alert('" . lang('GROUPS_INDEX_CANNOT_DELETE') . "')\"><img border='0' title=" . lang('GROUPS_INDEX_DELETE') . " src=<#admin_images_path#>/delete_small.png></a>";
    
    $edit = "<a href='sections.php?section=groups&file=edit_group&groupid=$groupid&$session'><img title='" . lang('GROUPS_INDEX_EDIT') . "' border='0' src='<#admin_images_path#>/edit.png'></a>";
    
    // Set array for template replacement
    $array = array(
        '{TITLE}' => $grouptitle,
        '{DELETE}' => $delete,
        '{EDIT}' => $edit,
        '{USERS_NO}' => $user_no,
        '{GROUPID}' => $groupid
    );
    
    // store results to this template to include it in the outer template
    $rows .= $admin_templates->get_template('groups_index_row.tpl.php', $array);
}

// get the outer template, replace values and then print it
$content .= $admin_templates->get_template('groups_index.tpl.php', array(
    '{ROWS}' => $rows
));

echo $content;

?>