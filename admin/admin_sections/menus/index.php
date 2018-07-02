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

if (RUN_SECTION !== true) {
    die("<center><h3>" . lang('ACCESS_NOT ALLOWED') . "</h3></center>");
}

// assing admin session to a variable for later and easier use
$session = $auth->get_sess();

// check if data is posted
if ($_POST['submit']) {
    extract($_POST);
    
    // get the value of the menuid from the hidden input and update all the field according to its array key
    foreach ($menu_array as $menuid) {
        $result = $diy_db->query("UPDATE diy_menu SET menuorder='$order[$menuid]',
                                                  menualign='$align[$menuid]',
                                                  menushow='$status[$menuid]'
                                                  WHERE menuid=$menuid limit 1;");
    }
    if ($result) {
		cache_menus();
        info_msg(lang('MENUS_INDEX_UPDATE_SUCCESSFULL'), "sections.php?section=menus&$session");
    }
}
$content = $this->nav_bar(lang('MENUS_INDEX_TITLE'));

// get the data of all menus and display them in one big form
$result = $diy_db->query("SELECT * FROM diy_menu ORDER BY menuorder ASC");
while ($row = $diy_db->dbarray($result)) {
    extract($row);
    
    // check menus' status and display it
    $status = ($menushow == '1') ? "<input type='radio' name=status[$menuid] value='1' checked>" . lang('MENUS_INDEX_SHOW_MENU') . "</option> <input type='radio' name=status[$menuid] value='0'>" . lang('MENUS_INDEX_HIDE_MENU') . "</option>" : "<input type='radio' name=status[$menuid] value='1'>" . lang('MENUS_INDEX_SHOW_MENU') . "</option> <input type='radio' name=status[$menuid] value='0' checked>" . lang('MENUS_INDEX_HIDE_MENU') . "</option>";
    
    // chech menus' order and display it
    $order = "<input type='text' name=order[$menuid] value=$menuorder size='1'>";
    
    // check menus's side and dispaly it
    if ($menualign == '1') {
        $side = "<input type='radio' name=align[$menuid] value='1' checked='checked'>" . lang('MENUS_INDEX_RIGHT') . "</option>";
		$side .= "<input type='radio' name=align[$menuid] value='3'>" . lang('MENUS_INDEX_MIDDLE') . "</option>";
        $side .= "<input type='radio' name=align[$menuid] value='2'>" . lang('MENUS_INDEX_LEFT') . "</option>";
    } elseif ($menualign == '2') {
        $side = "<input type='radio' name=align[$menuid] value='1'>" . lang('MENUS_INDEX_RIGHT') . "</option>";
        $side .= "<input type='radio' name=align[$menuid] value='3'>" . lang('MENUS_INDEX_MIDDLE') . "</option>";
        $side .= "<input type='radio' name=align[$menuid] value='2' checked='checked'>" . lang('MENUS_INDEX_LEFT') . "</option>";
    } else {
        $side = "<input type='radio' name=align[$menuid] value='1'>" . lang('MENUS_INDEX_RIGHT') . "</option>";
        $side .= "<input type='radio' name=align[$menuid] value='3' checked='checked'>" . lang('MENUS_INDEX_MIDDLE') . "</option>";
        $side .= "<input type='radio' name=align[$menuid] value='2'>" . lang('MENUS_INDEX_LEFT') . "</option>";
    }
    
    // set a hidden value of menuid in order to use it as a refernece when the data is posted
    $hidden .= form_hidden("menu_array['$menuid']", $menuid);
    
    // Set array for template replacement
    $array = array(
        '{TITLE}' => $title,
        '{ORDER}' => $order,
        '{ALIGN}' => $side,
        '{STATUS}' => $status,
        '{SESSION}' => $session,
        '{HIDDEN}' => $hidden,
        '{MENUID}' => $menuid
    );
    
    // store results to this template to include it in the outer template
    $rows .= $admin_templates->get_template('menus_index_row.tpl.php', $array);
}

// get the outer template, replace values and then print it
$content .= $admin_templates->get_template('menus_index.tpl.php', array(
    '{ROWS}' => $rows
));

echo $content;

?>