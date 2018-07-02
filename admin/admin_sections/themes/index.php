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

if (RUN_SECTION !== true)
{
  die("<center><h3>" . lang('ACCESS_NOT ALLOWED') . "</h3></center>");
}

// assing admin session to a variable for later and easier use
$session = $auth->get_sess();

// set navigation
$content = $this->nav_bar(lang('THEMES_INDEX_TITLE'));


// retrive available themes for the cms
$result = $diy_db->query("SELECT * FROM diy_themes
							ORDER BY id ASC");

// loop through results and populate them
while ($row = $diy_db->dbarray($result))
{
  extract($row);
  $temp_no = $diy_db->dbnumquery("diy_templates", " themeid='$id'");

  // Set array for template replacement
  $array = array('{SESSION}' => $session, '{TEMPLATES}' => $temp_no, '{THEME_ID}' => $id, '{THEME}' => $theme, );

  // store results to this template to include it in the outer template
  $rows .= $admin_templates->get_template('themes_index_row.tpl.php', $array);
}
// get the outer template, replace values and then print it
$content .= $admin_templates->get_template('themes_index.tpl.php', array('{ROWS}' => $rows));


echo $content;

?>