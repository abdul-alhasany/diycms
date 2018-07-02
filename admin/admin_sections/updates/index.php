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
 * This file is part of settings section
 * 
 * @package	Admin_sections
 * @subpackage	Settings
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	1.1
 * @access 	public
 */

if (RUN_SECTION !== true) {
    die("<center><h3>" . lang('ACCESS_NOT_ALLOWED') . "</h3></center>");
}

$html = @get_contents("http://www.diy-cms.com/updates/" . $CONF['lang'] . "/index.php?min_version=1.1&max_version=1.2");

$html = json_decode($html, true);

// make an array of all files in the databse in order to decided to display them or not
$result = $diy_db->query("SELECT * FROM diy_updates");
while ($row = $diy_db->dbarray($result)) {
    extract($row);
    $updated_file_array[$file_name] = $timestamp;
}

if (!$html)
    $html = array();
	
foreach ($html as $item) {
    $dependency_array = $item['dependency_array'];
    
    foreach ($item as $id => $details) {
        if (strpos($details['file_name'], ".file")) {
            $filename = str_replace('#', '/', $details['file_name']);
            $filename = str_replace('.file', '.php', $filename);
            $process  = 'update';
        } elseif (strpos($details['file_name'], ".database")) {
            $filename = str_replace('#', ' => ', $details['file_name']);
   //	   $filename = str_replace('.database', '', $filename);
            $process  = 'sql';
        } elseif (strpos($details['file_name'], ".zip")) {
            $filename = $details['file_name'];
            $process  = 'zip';
        }
        
        
        // check if the file has dependancies
        if ((@array_key_exists($details['dependancy_filename'], $updated_file_array)) OR $details['dependancy_id'] == 0) {
            // check if the file has been updated before, if it has, then check the time
            if (@array_key_exists($details['file_name'], $updated_file_array)) {
                if ($updated_file_array[$details['file_name']] < $details['timestamp']) {
                    // Set array for template replacement
                    $array = array(
                        '{ID}' => $details['id'],
                        '{FILE}' => $filename,
                        '{ISSUE}' => $details['desc'],
                        '{DOWNLOAD}' => "sections.php?section=updates&file=$process&id=$id&" . $auth->get_sess()
                    );
                    
                    // store results to this template to include it in the outer template
                    $rows .= $admin_templates->get_template('updates_index_table_row.tpl.php', $array);
                }
            } else {
                $array = array(
                    '{ID}' => $details['id'],
                    '{FILE}' => $filename,
                    '{ISSUE}' => $details['desc'],
                    '{DOWNLOAD}' => "sections.php?section=updates&file=$process&id=$id&" . $auth->get_sess()
                );
                
                // store results to this template to include it in the outer template
                $rows .= $admin_templates->get_template('updates_index_table_row.tpl.php', $array);
            }
        }
    }
}

// get the outer template, replace values and then print it
$content .= $admin_templates->get_template('updates_index_table.tpl.php', array(
    '{ROWS}' => $rows
));

echo $content;

?>