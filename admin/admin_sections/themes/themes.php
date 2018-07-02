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
  
  include('functions.php');
  include('zip_archive.class.php');
  
  // assing admin session to a variable for later and easier use
  $session = $auth->get_sess();
  
  // get some ids and info
  $themeid = $_GET['themeid'];
  
  
  // get action value and switch it to the relevant value
  $action = $_GET['action'];
  switch ($action) {
     case 'export_theme';
        
        // get theme info
        $result = $diy_db->query("SELECT * FROM diy_themes
                            WHERE id='$themeid'");
        $row    = $diy_db->dbarray($result);
        
		// replace spaces in theme name
		$row['theme'] = str_replace(' ', '_', $row['theme']);

		$theme_folder = $row['themepath'];

        // base64_encode all the data so no errors occurs because of speical charchters, quotes or slashed
        foreach ($row as $key => &$value) {
           $value = base64_encode($value);
        }
        extract($row);
        
        // set file header and get theme details (name, header, footer ... etc)
        $style = "<?xml version=\"1.0\"?>\n";
        $style .= "<style_data>\n";
        $style .= "<theme_detailes>";
        $style .= "<theme_name><![CDATA[$theme]]></theme_name>\n";
        $style .= "<user_theme><![CDATA[$usertheme]]></user_theme>\n";
        $style .= "<theme_path><![CDATA[$themepath]]></theme_path>\n";
        $style .= "</theme_detailes>";
        
        
        $style .= "<theme_templates>\n";
        // get templates groups for each theme
        $group_result = $diy_db->query("SELECT * FROM diy_temptype
                            WHERE themeid='$themeid'
                            ORDER BY tempid");
        
        while ($group_row = $diy_db->dbarray($group_result)) {
           // base64_encode all the data so no errors occurs because of speical charchters, quotes or slashes
           foreach ($group_row as $key => &$value) {
              $value = base64_encode($value);
           }
           extract($group_row);
           $style .= "<templates_group>\n";
           $style .= "<group_title><![CDATA[$temptypetitle]]></group_title>\n";
           $style .= "<group_desc><![CDATA[$tempdsc]]></group_desc>\n";
          
           $tempid = base64_decode($tempid);
          
           // get templates for each templates group
           $templates_result = $diy_db->query("SELECT * FROM diy_templates
                            WHERE temptype ='$tempid'");
          
           while ($templates_rows = $diy_db->dbarray($templates_result)) {
              foreach ($templates_rows as $key => &$value) {
                 $value = base64_encode($value);
              }
              
              extract($templates_rows);
              $style .= "<template_content>\n";
              $style .= "<template_name><![CDATA[$name]]></template_name>\n";
              $style .= "<template><![CDATA[$template]]></template>\n";
              $style .= "</template_content>\n";
           }
          
           $style .= "</templates_group>\n";
        }
        $style .= "</theme_templates>\n";
        $style .= "</style_data>\n";
		
		// create theme file
		create_xml_file($CONF['site_path']."/themes/{$theme_folder}/{$theme_folder}.xml", $style);
				

		$zip_file = zip_theme_folder($theme_folder);

	// set headers to output the file to the browser
	header('Content-Description: File Transfer');
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename='.basename($zip_file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($zip_file));
    ob_clean();
    flush();
    readfile($zip_file);
	
	// remove file
	unlink($zip_file);
        break;
    
    
     case 'delete_theme';
        
        // check if the theme to be deleted is selected as a default theme
        $theme     = get_global_setting('theme');
        $get_theme = $_GET['themeid'];
        if ($get_theme == $theme) {
           info_msg(lang('THEMES_THEMES_CANNOT_DELETE_DEFAULT'), "sections.php?section=themes&$session");
        }
        
        //check if this theme is the only theme the cms has
        $themes      = $diy_db->query("SELECT * FROM diy_themes");
        $check_count = $diy_db->dbnumrows($themes);
        if ($check_count == '1') {
           info_msg(lang('THEMES_THEMES_CANNOT_DELETE_SINGLE'), "sections.php?section=themes&$session");
        }
        
        // delete theme, css, templates groups and templates realted to this theme
        $result = $diy_db->query("DELETE FROM diy_themes WHERE id='$themeid'");
        $result = $diy_db->query("DELETE FROM diy_temptype WHERE themeid='$themeid'");
        $result = $diy_db->query("DELETE FROM diy_templates WHERE themeid='$themeid'");
        @unlink("../html/css/" . $get_theme . ".css");
        if ($result) {
           info_msg(lang('THEMES_THEMES_DELETE_SUCCESSFULL'), "sections.php?section=themes&$session");
        }
        break;
    
    
    
     case 'create_import_theme';
        
        // set navigation
        $content = $this->nav_bar(lang('THEMES_CREATE_IMPORT_THEMS'));
        
        // adding new theme from
        $form = form_inputform(lang('THEMES_THEMES_NAME'), 'theme_name');
        
        // retrive theme info for selecttion form
        $theme_results = $diy_db->query("SELECT * FROM diy_themes
                                  ORDER BY id");
        while ($theme_array = $diy_db->dbarray($theme_results)) {
           extract($theme_array);
           $array[$id] = $theme;
        }
        
        $extra = "<option value='none' selected>None</option>";
        $form .= form_selectform(lang('THEMES_THEMES_BASE_THEME'), 'base_theme', $array, '', $extra);
        
        $form_array = array(
           "action" => "sections.php?section=themes&file=themes&action=create_theme&$session",
           "title" => lang('THEMES_THEMES_CREATE_NEW'),
           "name" => 'new_theme',
           "content" => $form,
           "submit" => lang('SUBMIT')
        );
        
        $content .= form_output($form_array);
        
        // import a theme form
        $import = form_inputform(lang('THEMES_THEMES_IMPORT_NAME'), 'import_theme');
        $import .= form_inputform(lang('THEMES_THEMES_UPLOAD_FILE'), 'theme_file', '', '40', 'file');
        
        $import_array = array(
           "action" => "sections.php?section=themes&file=themes&action=import_theme&$session",
           "title" => lang('MODULES_THEME_IMPORT_THEME'),
           "name" => 'new_theme',
           "content" => $import,
           "submit" => lang('SUBMIT')
        );
        
        $content .= form_output($import_array);
        break;
    
    
     case 'import_theme';
        // check if a file has been uploaded
        $upload = $_FILES["theme_file"];
        if ($upload) {
           $theme = $_POST['import_theme'];
          
           $tmp_name = $upload["tmp_name"];
           if (is_uploaded_file($upload['tmp_name'])) {
              $path = $CONF['upload_path'] . "/" . $upload['name'];
              if (move_uploaded_file($tmp_name, $path)) {
                 $themename = $path;
              }
           } else {
              info_msg(lang('THEMES_THEMES_FILE_NOT_UPLOADED'));
           }
		   
		   $file_info = pathinfo($path);
		  if($file_info['extension'] == 'xml')
		  {
			$result = proccess_xml_file($path);
		  }
		  elseif($file_info['extension'] == 'zip')
		  {
			$result = proccess_zip_file($path);
		  }
		  else
		  {
			error_msg(lang('THEMES_THEMES_FILE_NOT_SUPPORTED'));
		  }
          
           // if everthying is successfull, remove the xml file and produce a message stating so
           if ($result) {
              unlink($themename);
              info_msg(lang('THEMES_THEMES_IMPORT_SUCCESSFULL'), "sections.php?section=themes&$session");
           }
        }
        
        break;
    
    
    
     case 'create_theme';
        // check the posted data and display relevant messages
        extract($_POST);
        
        // check if name field is filled
        if (!required_entries($theme_name)) {
           info_msg(lang('THEMES_THEMES_NO_TITLE'), "sections.php?section=themes&file=themes&action=create_import_theme&themeid=$themeid&$session");
        }
        
        
        // if no base theme is selected
        if ($_POST['base_theme'] == 'none') {
           $result = $diy_db->query("INSERT INTO diy_themes VALUES ('', '$theme_name', '0', '', '','','','');");
        }
        // else if base theme is selected
        elseif ($_POST['base_theme'] !== 'none') {
           // copy theme details
           $result = $diy_db->query("SELECT * FROM diy_themes
                               WHERE id='$base_theme'");
           $row    = $diy_db->dbarray($result);
           extract($row);
          
        
           $result = $diy_db->query("INSERT INTO diy_themes VALUES ('', '$theme_name', '$usertheme', '', '$themepath', '', '', '');");
          
          
           // get the id of the last theme inserted (for reference to the included templates group and templates)
           $theme_id = $diy_db->insertid();
          
           // copy templates groups details
           $temp_group_result = $diy_db->query("SELECT * FROM diy_temptype
                                          WHERE themeid='$row[id]'");
           while ($group_row = $diy_db->dbarray($temp_group_result)) {
              extract($group_row);
              $result = $diy_db->query("INSERT INTO diy_temptype VALUES ('', '$temptypetitle', '$tempdsc', '$theme_id');");
              
              // get the id of the last template group inserted (for reference to the included templates )
              $group_id = $diy_db->insertid();
              
              // copy templates details
              $temp_result = $diy_db->query("SELECT * FROM diy_templates
                                              WHERE themeid='$row[id]'
                                              AND temptype = '$tempid'");
              while ($temp_row = $diy_db->dbarray($temp_result)) {
                 extract($temp_row);
                 $template = admin_format_data($template);
                 $result   = $diy_db->query("INSERT INTO diy_templates VALUES ('', '$theme_id', '$theme_name', '$name', '$group_id', '$template');");
              }
           }
          
        } else {
           info_msg(lang('THEMES_THEMES_NO_ACTION_SELECTED'), "sections.php?section=themes&file=themes&action=create_import_theme&$session");
        }
        
        // if everything is successfull display a message
        info_msg(lang('THEMES_THEMES_CREATE_SUCCESSFULL'), "sections.php?section=themes&$session");
        
        break;
  }
  echo $content;
  
?>