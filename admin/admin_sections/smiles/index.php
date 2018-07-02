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
  * This file is part of smiles section
  * 
  * @package	Admin_sections
  * @subpackage	Smiles
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

// set nav
$content = $this->nav_bar(lang('SMILES_INDEX_TITLE'));

// get the data of all smiles
$result = $diy_db->query("SELECT * FROM diy_smileys ORDER BY id");
while ($row = $diy_db->dbarray($result))
{
  extract($row);

  $image = "<img src=\"../images/smiles/$smile\" alt=\"$smilename\" border=\"0\">";

  // Set array for template replacement
  $array = array('{SMILEID}' => $id, '{IMAGE}' => $image, '{NAME}' => $smilename, '{CODE}' => $code, '{SESSION}' => $session, );

  // store results to this template to include it in the outer template
  $rows .= $admin_templates->get_template('smiles_index_row.tpl.php', $array);
}

// get the outer template, replace values and then print it
$content .= $admin_templates->get_template('smiles_index.tpl.php', array('{ROWS}' => $rows));

echo $content;

?>