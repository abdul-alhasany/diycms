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

/**
 * edit_menu_settings()
 * 
 * @param mixed $theme_folder
 * @return
 */
function edit_theme_settings($settings, $theme_folder)
{
    global $auth, $CONF, $diy_db;
    
    // check if settings array exist
    if ($GLOBALS['theme_settings_array'] != '') {
        if (file_exists($CONF['site_path'] . "/themes/" . $theme_folder . "/settings.ini")) {
            $ini_array = parse_ini_file($CONF['site_path'] . "/themes/" . $theme_folder . "/settings.ini");
        }
        foreach ($settings as $settings_title => $settings_groups) {
            $form .= form_elements_group_seprator($settings_title);
            foreach ($settings_groups as $setting_var => $setting_array) {
                extract($setting_array);
                $value = (isset($ini_array[$setting_var])) ? $ini_array[$setting_var] : $default;
                switch ($type) {
                    case "0":
                    case "custom":
                        $form .= call_user_func($function, $title, $setting_var, $value);
                        break;
                    case "1":
                    case "checkbox":
                        $form .= form_checkbox_select($title, $setting_var . "[]", $options, $value);
                        break;
                    case "2":
                    case "drop_down":
                        $form .= form_selectform($title, $setting_var, $options, $value);
                        break;
                    case "3":
                    case "drop_down_numbers":
                        if (!isset($min_value))
                            $min_value = 1;
                        
                        for ($i = $min_value; $i <= $max_value; $i++) {
                            $list[$i] = $i;
                        }
                        $form .= form_selectform($title, $setting_var, $list, $value);
                        break;
                    case "4":
                    case "textarea":
                        $form .= form_textarea($title, $setting_var, $value);
                        break;
                    case "5":
                    case "radio":
                        $form .= form_radio_selection($title, $setting_var, '', $value);
                        break;
                    case "6":
                    case "input":
                        if (!isset($length))
                            $length = 50;
                        
                        $form .= form_inputform($title, $setting_var, $value, $length);
                        break;
                }
            }
        }
    }
    return $form;
}


function write_ini_file($assoc_arr, $path, $has_sections = FALSE)
{
    global $CONF;
    $content = "";
    if ($has_sections) {
        foreach ($assoc_arr as $key => $elem) {
            $content .= "[" . $key . "]\n";
            foreach ($elem as $key2 => $elem2) {
                if (is_array($elem2)) {
                    for ($i = 0; $i < count($elem2); $i++) {
                        $content .= $key2 . "[] = \"" . $elem2[$i] . "\"\n";
                    }
                } else if ($elem2 == "")
                    $content .= $key2 . " = \n";
                else
                    $content .= $key2 . " = \"" . $elem2 . "\"\n";
            }
        }
    } else {
        foreach ($assoc_arr as $key => $elem) {
            if (is_array($elem)) {
                for ($i = 0; $i < count($elem); $i++) {
                    $content .= $key2 . "[] = \"" . $elem[$i] . "\"\n";
                }
            } else if ($elem == "")
                $content .= $key2 . " = \n";
            else
                $content .= $key2 . " = \"" . $elem . "\"\n";
        }
    }
    
    file_put_contents($CONF['site_path'] . "/themes/" . $path, $content);
    
    return true;
}

function register_theme_settings($settings_array)
{
    $GLOBALS['theme_settings_array'] = $settings_array;
    return;
}

function proccess_theme_settings($themepath)
{
    foreach ($_POST as $key => $value) {
        $value = (is_array($value)) ? implode_data($value) : $value;
        
        if ($key != 'submit')
            $array['settings_array'][$key] = $value;
    }
    write_ini_file($array, $themepath . "/settings.ini", true);
    return;
}

function create_xml_file($file_path, $contents)
{
    file_put_contents($file_path, $contents);
    return;
}

function zip_theme_folder($theme_folder)
{
    global $CONF;
    // increase script timeout value
    ini_set("max_execution_time", 300);
    
    $destination = $CONF['upload_path'] . "/{$theme_folder}.zip";
    // create object
    $zip         = new ZipArchive();
    // open archive
    if ($zip->open($destination, ZIPARCHIVE::CREATE) !== TRUE) {
        die("Could not open archive");
    }
    // initialize an iterator
    // pass it the directory to be processed
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($CONF['site_path'] . "/themes/" . $theme_folder . "/", FilesystemIterator::UNIX_PATHS));
    
	// iterate over the directory
    // add each file found to the archive
    foreach ($iterator as $key => $value) {
        $name = $value->getFilename();
        if ($name !== 'Thumbs.db') {
            $current_path = $iterator->getSubPath();
            if (!empty($current_path))
                $name = $iterator->getSubPath() . '/' . $value->getFilename();
            $zip->addFile($key, $theme_folder . '/' . $name) or die("ERROR: Could not add file: $key");
        }
        
    }
	$zip->setArchiveComment($theme_folder);
    // close and save archive
    $zip->close();
    
    return $destination;
}

function proccess_zip_file($path)
{
    global $CONF;

    $zip = new ZipArchive;
    if ($zip->open($path) === TRUE) {
        $zip->extractTo($CONF['site_path'] . "/themes/");
		$theme_folder = $zip->getArchiveComment();
        $zip->close();
    } else {
        trigger_error(lang('THEMES_THEME_ZIP_FAIL'), E_USER_ERROR);
    }
	
	$xml_file = $CONF['site_path'] . "/themes/{$theme_folder}/{$theme_folder}.xml";
	if(file_exists($xml_file))
	{
		$result = proccess_xml_file($xml_file);
	}
	return $result;
}

function proccess_xml_file($path)
{
    global $diy_db;
    // check if xml file is read successfully
    if (!$xml = simplexml_load_file($path)) {
        trigger_error(lang('THEMES_THEMES_ERORR_XML'), E_USER_ERROR);
    }
    
    // loop through the tags of the XML file and insert into database each one to its relevant cell
    // first loop through theme details
    foreach ($xml->theme_detailes as $child) {
        if (empty($theme))
            $theme = base64_decode($child->theme_name);
        
        $random_number   = rand('5', '1500');
        $exist           = $diy_db->query("SELECT * FROM diy_themes WHERE (theme='$theme' OR theme='$theme.$random_number')");
        $check_existence = $diy_db->dbnumrows($exist);
        if ($check_existence > 0) {
            $theme = $theme . $random_number;
        }
        $user_theme = base64_decode($child->user_theme);
        $theme_path = base64_decode($child->theme_path);
    }
    
    // Insert theme details
    $result = $diy_db->query("INSERT INTO diy_themes
                                                    (theme,
                                                     usertheme,
                                                     themepath
  )
                                              values
                                                     ('$theme',
                                                     '$user_theme',
                                                     '$theme_path')");
    
    // get the id of the last theme inserted (for reference to the included templates group and templates)
    $theme_id = $diy_db->insertid();
    
    // get the data of each templates group and insert it
    foreach ($xml->theme_templates as $child) {
        foreach ($child->templates_group as $temp_group) {
            $title = base64_decode($temp_group->group_title);
            $desc  = base64_decode($temp_group->group_desc);
            
            $diy_db->query("INSERT INTO diy_temptype VALUES ('', '$title', '$desc','$theme_id');");
            // get the id of the last templates group inserted (for reference to the included templates)
            $temp_groupid = $diy_db->insertid();
            
            // loop through the templates and insert them as appropiate
            foreach ($temp_group->template_content as $templates) {
                $temp_title   = base64_decode($templates->template_name);
                $temp_content = base64_decode($templates->template);
                $temp_content = str_replace("'", "\'", $temp_content);
                $result       = $diy_db->query("INSERT INTO diy_templates VALUES ('', '$theme_id', '$theme', '$temp_title', '$temp_groupid', '$temp_content');");
            }
        }
    }
    return $result;
}
?>