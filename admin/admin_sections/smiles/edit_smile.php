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

// get smile id
$smileid = set_id_int('smileid');

// check if any data is posted
if ($_POST['submit'])
{
  extract($_POST);

  $diy_db->query("UPDATE diy_smileys SET smilename='$smilename',
                                        code='$code',
                                        smile='$smile'
                                        where id='$smileid'");

	cache_smiles();
	info_msg(lang('SMILES_EDITSMILE_SMILE_EDITED'), "sections.php?section=smiles&$session");

}

// set navigation
$nav_array = array(lang('SMILES_INDEX_TITLE') => "sections.php?section=smiles&$session", lang('SMILES_EDITSMILE_TITLE'));
$nav = $this->nav_bar($nav_array);

// get the data of the selected smile
$result = $diy_db->query("SELECT * from diy_smileys
						   WHERE id='$smileid' LIMIT 1");
$row = $diy_db->dbarray($result);
extract($row);

// build form
$content .= form_inputform(lang('SMILES_EDITSMILE_SMILE_NAME'), 'smilename', $smilename);
$content .= form_inputform(lang('SMILES_EDITSMILE_SMILE_CODE'), 'code', $code);
$content .= form_inputform(lang('SMILES_EDITSMILE_SMILE_FILENAME'), 'smile', $smile);


// get form array
$form_array = array("action" => "sections.php?section=smiles&file=edit_smile&smileid=$smileid&$session", "title" => lang('SMILES_EDITSMILE_TITLE'), "name" => 'edit_smile',
  "content" => $content, "submit" => lang('SUBMIT'), );

$output = form_output($form_array);
echo $nav;
echo $output;

?>