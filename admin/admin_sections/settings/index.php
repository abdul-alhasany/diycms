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

$nav = $this->nav_bar(lang('SETTINGS_TITLE'));

if ($_POST['submit']) {
   while (list($key, $value) = each($_POST)) {
      $result = $diy_db->query("UPDATE diy_settings SET value='$value' WHERE variable='$key'");
   }
   if ($result) {
	  // cahce results for better performance
	  cache_global_settings();
	
	  // display info message
      info_msg(lang('SETTINGS_SETTINGS_UPDATED_SUCCESSFULLY'));
   }
}

$output .= editsetting('1');
$result = $diy_db->dbfetch("SELECT variable,value FROM diy_settings WHERE variable='turn_off'");
$output .= form_radio_selection(lang('SETTINGS_TURN_OFF'), 'turn_off', '', $result['value']);

$output .= editsetting('7');

$output .= editsetting('4');
$output .= editsetting('5');
$output .= editsetting('6');


$selected_theme = get_global_setting("theme");
$result         = $diy_db->query("SELECT * FROM diy_themes ORDER BY id");
while ($row = $diy_db->dbarray($result)) {
   extract($row);
   $theme_array[$id] = $theme;
}
$output .= form_selectform(lang('SETTINGS_SELECT_THEME'), 'theme', $theme_array, $selected_theme);



$main_mod                    = get_global_setting("main_module");
$mod_array['index_template'] = "Index Page Template";
$result                      = $diy_db->query("SELECT mod_name,mod_title FROM diy_modules ORDER BY id");
while ($row = $diy_db->dbarray($result)) {
   extract($row);
   $mod_array[$mod_name] .= $mod_title;
}

$output .= form_selectform(lang('SETTINGS_DISPLAY_MAIN_PAGE'), 'main_module', $mod_array, $main_mod);
$form_array = array(
   "action" => "sections.php?section=settings&" . $auth->get_sess(),
   "title" => lang('SETTINGS_TITLE'),
   "name" => 'settings',
   "content" => $output,
   "submit" => lang('SUBMIT')
);

$output = form_output($form_array);

echo $nav;
echo $output;

?>