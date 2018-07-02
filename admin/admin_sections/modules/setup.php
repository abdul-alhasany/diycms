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

// get module name
$module = $_GET['module'];

// assing admin session to a variable for later and easier use
$session = $auth->get_sess();

// check if there is any POST values and update database accordingly

if ($_POST['submit'])
{
  extract($_POST);
  $mod_user = implode_data($mod_user);
  $mnueid = implode_data($mnueid);

  $result = $diy_db->query("UPDATE diy_modules SET mod_title='$mod_title',
                                               mod_user='$mod_user',
                                               mod_sys='$mod_sys',
                                               left_menu='$left_menu',
                                               right_menu='$right_menu',
                                               middle_menu='$middle_menu',
                                               mnueid='$mnueid',
                                               themeid='$themeid',
                                               mod_lang='$mod_lang'
                                               WHERE mod_name='$module'");
  if ($result)
  {
	cache_module_info($module);
    echo info_msg(lang('MODULES_SETUP_UPDATED_SUCCESSFUL'), "sections.php?section=modules&$session");
  }
}


// Build navigation
$nav_array = array(lang('MODULES_INDEX_TITLE') => "sections.php?section=modules&$session", lang('MODULES_SETUP_TITLE'));

// assign navigation to a var
echo $this->nav_bar($nav_array);


// get module settings and display them
$result = $diy_db->query("SELECT * FROM diy_modules
						   WHERE mod_name='$module'");
$row = $diy_db->dbarray($result);
extract($row);

$content .= form_inputform(lang('MODULE_SETUP_MODULE_NAME'), 'mod_title', $mod_title);
$content .= form_radio_selection(lang('MODULE_SETUP_MODULE_ACTIVE'), 'mod_sys', '', $mod_sys);

// build module theme array
$modtheme = $diy_db->query("SELECT * FROM diy_modules_templates
							WHERE modname='$module'
							AND parent='0'
							ORDER BY themeid");
while ($rowtheme = $diy_db->dbarray($modtheme))
{
  extract($rowtheme);
  $theme_array[$themeid] = $theme;
}

$content .= form_selectform(lang('MODULE_SETUP_THEME'), 'themeid', $theme_array, $row['themeid']);

// get available langauges for the module and build an array
$open = @opendir("./../modules/$module/lang");
while ($folder = @readdir($open))
{
  if (($folder != ".") && ($folder != ".."))
  {
    $search = preg_match("/.lang.php/i", $folder);
    if ($search)
    {
      $file = preg_replace("/.lang.php/i", "", $folder);
      $lang_array[$file] = $file;
    }
  }
}

$content .= form_selectform(lang('MODULE_SETUP_LANG'), 'mod_lang', $lang_array, $mod_lang);

// print module menu options
$content .= form_radio_selection(lang('MODULE_SETUP_RIGHT_MENUS'), 'left_menu', '', $left_menu);
$content .= form_radio_selection(lang('MODULE_SETUP_LEFT_MENUS'), 'right_menu', '', $right_menu);
$content .= form_radio_selection(lang('MODULE_SETUP_MIDDLE_MENUS'), 'middle_menu', '', $middle_menu);

// get menus deatails for any given module
$result = $diy_db->query("SELECT * FROM diy_menu
						   WHERE menushow='1'");
while ($row = $diy_db->dbarray($result))
{
  extract($row);
  $options[$menuid] = $title;
}
$content .= form_checkbox_select(lang('MODULE_SETUP_SELECT_MENUS'), "mnueid" . "[]", $options, $mnueid);

// get groups deatails for a speicific module to detemine access permission
$result = $diy_db->query("SELECT * FROM diy_groups
							ORDER BY groupid ASC");
while ($row = $diy_db->dbarray($result))
{
  extract($row);
  $array[$groupid] = $grouptitle;
}

$content .= form_checkbox_select(lang('MODULE_SETUP_SELECT_GROUPS'), "mod_user" . "[]", $array, $mod_user);

// print form with all its deatiles
$form_array = array("action" => "sections.php?section=modules&file=setup&module=$module&$session", "title" => lang('MODULES_SETUP_TITLE'), "name" => 'setup', "content" => $content,
  "submit" => lang('SUBMIT'), );

$output = form_output($form_array);

echo $output;

?>