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
  * This file is part of menus section
  * 
  * @package	Admin_sections
  * @subpackage	Menus
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


// check if data is posted
if ($_POST['submit'])
{
  extract($_POST);

  $value = implode_data($menucheck);

  $result = $diy_db->query("UPDATE diy_settings SET value='$value' WHERE variable='index_menuid'");
  if ($result)
  {
	cache_index_menus();
    info_msg(lang('MENU_INDEXMENU_MENUS_UPDATED'), "sections.php?section=menus&$session");
  }
}
// get navigation
$nav = $this->nav_bar(lang('MENU_INDEXMENU_TITLE'));

// build edit menu form
$result = $diy_db->query("SELECT * FROM diy_menu WHERE menushow='1'");

while ($row = $diy_db->dbarray($result))
{
  $id_array[$row['menuid']] = $row['menuhead'];
}

$content .= form_checkbox_select(lang('MENU_INDEXMENU_MENUS'), 'menucheck[]', $id_array, get_global_setting("index_menuid"));

// print form with all its details
$form_array = array("action" => "sections.php?section=menus&file=index_menus&$session", "title" => lang('MENU_INDEXMENU_TITLE'), "name" => 'index_menus', "content" => $content,
  "submit" => lang('SUBMIT'), );

$output = form_output($form_array);

echo $nav;
echo $output;

?>