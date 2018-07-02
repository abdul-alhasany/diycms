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
  * This file is part of modules section
  * 
  * @package	Admin_sections
  * @subpackage	Modules
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

if (RUN_SECTION !== true)
{
  die("<center><h3>" . lang('ACCESS_NOT ALLOWED') . "</h3></center>");
}

// assing admin session to a variable for later and easier use
$session = $auth->get_sess();

// get module name
$module = $_GET['module'];
$modid = set_id_int('modid');

// Build navigation
$nav_array = array(lang('MODULES_INDEX_TITLE') => "sections.php?section=modules&$session", lang('MODULES_THEME_TITLE'));

// set navigation
$content = $this->nav_bar($nav_array);


// check if any data is posted
// check if new theme form is posted
if ($_POST['base_theme'])
{
  extract($_POST);
  $theme = $_POST['new_theme'];

  // check if theme name is empty
  if (empty($theme))
  {
    info_msg(lang('MODULES_THEME_NAME_REQURIRED'));
  }

  // make sure theme name contains no spaces
  $theme = str_replace(' ', '_', $theme);


  // if no base theme is selected
  $result = $diy_db->query("SELECT `themeid` FROM `diy_modules_templates`
							WHERE modid='$modid'
							ORDER BY `themeid` DESC limit 1;");
  $row = $diy_db->dbarray($result);
  extract($row);
  $new_themeid = $themeid + 1;

  $result = $diy_db->query("INSERT INTO diy_modules_templates VALUES ('', '1', '$new_themeid', '0','0', '$modid', '$module', '$theme', '', '');");



  if ($_POST['base_theme'] !== 'none')
  {
    // copy templates groups details
    $temp_group_result = $diy_db->query("SELECT * FROM diy_module_tempgroup
										  WHERE themeid ='$base_theme'
										  AND modid='$modid'");
    while ($group_row = $diy_db->dbarray($temp_group_result))
    {
      extract($group_row);

      $result = $diy_db->query("INSERT INTO diy_module_tempgroup VALUES ('', '$modid', '$new_themeid', '$title', '$desc');");


      // get the id of the last template group inserted (for reference to the included templates )
      $group_id = $diy_db->insertid();

      // copy templates details
      $temp_result = $diy_db->query("SELECT * FROM diy_modules_templates
											  WHERE parent = '$base_theme'
											  AND temp_groupid ='$groupid'");
      while ($temp_row = $diy_db->dbarray($temp_result))
      {
        extract($temp_row);
        
        $result = $diy_db->query("INSERT INTO diy_modules_templates VALUES ('', '0', '0', '$group_id', '$new_themeid', '$modid', '$module', '$theme', '$temp_title', '$template');");
      }
    }
    info_msg(lang('MODULES_THEME_ADDED_SUCCESSFULLY'), "sections.php?section=modules&file=theme&modid=$modid&module=$module&$session");
  }

}

// check if importing theme form is posted
$upload = $_FILES["theme_file"];
if ($upload)
{
  $theme = admin_format_data($_POST['import_theme']);

  // check if theme name is empty
  if (empty($theme))
  {
    info_msg(lang('MODULES_THEME_NAME_REQURIRED'));
  }

  // make sure theme name contains no spaces
  $theme = str_replace(' ', '_', $theme);

  $tmp_name = $upload["tmp_name"];
  if (is_uploaded_file($upload['tmp_name']))
  {
    $path = $CONF['upload_path'] . "/" . $upload['name'];
    if (move_uploaded_file($tmp_name, $path))
    {
      $themename = $path;
    }
  }
  else
  {
    info_msg(lang('MODULES_THEME_FILE_NOT_UPLOADED'));
  }
  // check if xml file is read successfully
  if (!$xml = simplexml_load_file($path))
  {
    trigger_error(lang('MODULES_THEME_ERORR_XML'), E_USER_ERROR);
  }

  // get the id of the last theme inserted and add the new theme
  $result = $diy_db->query("SELECT `themeid` FROM `diy_modules_templates`
							WHERE modid='$modid'
							ORDER BY `themeid` DESC limit 1;");
  $row = $diy_db->dbarray($result);
  extract($row);
  $themeid = $themeid + 1;
  $result = $diy_db->query("INSERT INTO diy_modules_templates VALUES ('', '1', '$themeid', '0', '0', '$modid', '$module', '$theme', '', '');");

  // loop through the tags of the XML file and insert into database each one to its relevant cell
  foreach ($xml->main_group as $child)
  {
    $title = base64_decode($child->group_title);
    $desc = base64_decode($child->group_desc);

    $diy_db->query("INSERT INTO diy_module_tempgroup VALUES ('', '$modid', '$themeid', '$title', '$desc');");
    $temp_groupid = $diy_db->insertid();
    foreach ($child->template as $line)
    {
      $temp_title = base64_decode($line->temp_title);
      $temp_content = base64_decode($line->temp_content);
      $temp_content = str_replace("'", "\'", $temp_content);
      $result = $diy_db->query("INSERT INTO diy_modules_templates VALUES ('', '0', '0', '$temp_groupid', '$themeid', '$modid', '$module', '', '$temp_title', '$temp_content');");
    }
  }

  // if everthying is successfull, remove the xml file and produce a message stating so
  if ($result)
  {
    @unlink($themename);
    info_msg(lang('MODULES_THEME_ADDED_SUCCESSFULLY'), "sections.php?section=modules&file=theme&modid=$modid&module=$module&$session");
  }
}

// retrive available themes
$result = $diy_db->query("SELECT * FROM diy_modules_templates
							WHERE modid='$modid'
							AND parent='0' ORDER BY id");

// loop through results and populate them
while ($row = $diy_db->dbarray($result))
{

  $temp_no = $diy_db->dbnumquery("diy_modules_templates", "modid='$modid' and parent ='$row[themeid]'");

  // Set array for template replacement
  $array = array('{MODID}' => $modid, '{MODULE}' => $module, '{SESSION}' => $session, '{TEMPLATES}' => $temp_no, '{THEME}' => $row['theme'], '{THEME_ID}' => $row['themeid']);

  // store results to this template to include it in the outer template
  $rows .= $admin_templates->get_template('modules_theme_row.tpl.php', $array);
}
// get the outer template, replace values and then print it
$content .= $admin_templates->get_template('modules_theme.tpl.php', array('{ROWS}' => $rows));


// adding new theme from
$form = form_inputform(lang('MODULES_THEME_NAME'), 'new_theme');

// retrive theme info for selection form
$theme_results = $diy_db->query("SELECT * FROM diy_modules_templates
								WHERE modid='$modid'
								AND parent =0
								ORDER BY id");
while ($theme_array = $diy_db->dbarray($theme_results))
{
  extract($theme_array);
  $themes_array[$themeid] = $theme;
}
$extra = "<option value='none' selected>None</option>";
$form .= form_selectform(lang('MODULES_THEME_BASE_THEME'), 'base_theme', $themes_array, '', $extra);

$form_array = array("action" => "sections.php?section=modules&file=theme&modid=$modid&module=$module&$session", "title" => lang('MODULES_THEME_CREATE_NEW'), "name" =>
  'new_theme_form', "content" => $form, "submit" => lang('SUBMIT'), );

$content .= form_output($form_array);

// import a theme for the module form
$import = form_inputform(lang('MODULES_THEME_NAME'), 'import_theme');
$import .= form_inputform(lang('MODULES_THEME_UPLOAD_FILE'), 'theme_file', '', '40', 'file');

$import_array = array("action" => "sections.php?section=modules&file=theme&modid=$modid&module=$module&$session", "title" => lang('MODULES_THEME_IMPORT_THEME'), "name" =>
  'import_theme_form', "content" => $import, "submit" => lang('SUBMIT'), );

$content .= form_output($import_array);



echo $content;

?>