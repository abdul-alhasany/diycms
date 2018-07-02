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
  
  // assing admin session to a variable for later and easier use
  $session = $auth->get_sess();
  
  // get some ids and info
  $themeid = set_id_int('themeid');
  
  // check if any data is posted
  if ($_POST['submit']) {
      extract($_POST);
      if (!required_entries($theme_name)) {
          info_msg(lang('THEMES_SETTINGS_NO_TITLE'), "sections.php?section=themes&file=theme_settings&themeid=$themeid&$session");
      }
      $available_menus = implode_data($available_menus);
      
      $result = $diy_db->query("UPDATE diy_themes SET theme='$theme_name',
													available_menus='$available_menus',
													themepath ='$images_path',
													usertheme ='$allow_users',
													global_block_template ='$global_block_template'
													WHERE id = '$themeid'
							  ");
      if ($result) {
          $query_result = $diy_db->dbfetch("SELECT * FROM diy_themes WHERE id='$themeid'");
          $diy_db->create_query_cache_file('theme_settings_' . $themeid, $query_result);
          
		  // update theme settings
		  proccess_theme_settings($images_path);
          info_msg(lang('THEMES_SETTINGS_EDIT_SUCCESSFULL'), "sections.php?section=themes&$session");
      }
  }
  
  // Build navigation
  $nav_array = array(
      lang('THEMES_INDEX_TITLE') => "sections.php?section=themes&$session",
      lang('THEMES_SETTINGS_TITLE')
  );
  
  // set navigation
  $content .= $this->nav_bar($nav_array);
  
  // retrive theme info
  $theme_results = $diy_db->query("SELECT * FROM diy_themes
						   WHERE id= '$themeid'
						   LIMIT 1");
  
  $theme_array = $diy_db->dbarray($theme_results);
  extract($theme_array);
  
  // build form
  $form = form_inputform(lang('THEMES_SETTINGS_THEME_NAME'), 'theme_name', $theme);
  $form .= form_inputform(lang('THEMES_SETTINGS_IMAGE_PATH'), 'images_path', $themepath);
  $form .= form_radio_selection(lang('THEMES_SETTINGS_ALLOW_USE'), 'allow_users', '', $usertheme);
  
  // get templates list for the selected theme
  $block_templates['none'] = 'None';
  $result                  = $diy_db->query("SELECT id,name FROM diy_templates
                           WHERE themeid='$themeid'");
  
  while ($row = $diy_db->dbarray($result)) {
      extract($row);
      $block_templates[$name] = $name;
  }
  
  $form .= form_selectform(lang('THEMES_SETTINGS_GLOBAL_TEMPLATE'), 'global_block_template', $block_templates, $global_block_template);
  
  
  // get menus deatails for the selected theme
  $result = $diy_db->query("SELECT * FROM diy_menu
						   WHERE menushow='1'");
  while ($row = $diy_db->dbarray($result)) {
      extract($row);
      $options[$menuid] = $title;
  }
  $form .= form_checkbox_select(lang('THEMES_SETTINGS_SELECT_MENUS'), "available_menus" . "[]", $options, $available_menus);
  
  // add form to globals so we can register theme settings array to it
  //$GLOBALS['form'] = $form;
  
  if (file_exists($CONF['site_path'] . '/themes/' . $themepath . '/settings.php'))
  {
      include($CONF['site_path'] . '/themes/' . $themepath . '/settings.php');
	  $form .= edit_theme_settings($GLOBALS['theme_settings_array'], $themepath);
	}
  
  // output form
  $form_array = array(
      "action" => "sections.php?section=themes&file=theme_settings&themeid=$themeid&$session",
      "title" => lang('THEMES_SETTINGS_TITLE'),
      "name" => 'edit_theme_settings',
      "content" => $form,
      "submit" => lang('EDIT')
  );
  $content .= form_output($form_array);
  
  echo $content;
  
?>