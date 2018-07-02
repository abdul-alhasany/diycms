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

// get menu id
$menuid = set_id_int('menuid');

// check if data is posted
if ($_POST['submit']) {
    extract($_POST);
    
    if ($filemenu !== 'none') {
        $menucenter = '<!--INC dir="blocks" file="' . $filemenu . '.php" -->';
    }
    $checkuser = implode_data($_POST[groups]);
    
    $result = $diy_db->query("UPDATE diy_menu SET title='$title',
                                                         block_template='$block_template',
                                                         menuorder='$menuorder',
                                                         menualign='$menualign',
                                                         menuhead='$menuhead',
                                                         menucenter='$menucenter',
                                                         menushow='$menushow',
                                                         checkuser='$checkuser'
                                                         where menuid=$menuid");
    if ($result) {
        cache_menus();
        info_msg(lang('MENU_EDITMENU_MENU_EDITED'), "sections.php?section=menus&$session");
    }
}
// get navigation
$nav_array = array(
    lang('MENUS_INDEX_TITLE') => "sections.php?section=menus&$session",
    lang('MENU_EDITMENU_TITLE')
);
$nav       = $this->nav_bar($nav_array);

// build edit menu form
$result = $diy_db->query("SELECT * FROM diy_menu
						  WHERE menuid=$menuid");
$row    = $diy_db->dbarray($result);
extract($row);

$content .= form_inputform(lang('MENU_EDITMENU_MENU_TITLE'), 'title', stripslashes($title));

// build block templates array
$theme = get_global_setting('theme');

$result = $diy_db->query("SELECT id,name FROM diy_templates
                           WHERE themeid='$theme'");

while ($row = $diy_db->dbarray($result)) {
    extract($row);
    $block_templates[$name] = $name;
}

$content .= form_selectform(lang('MENU_EDITMENU_TEMPLATE'), 'block_template', $block_templates, $block_template);
$content .= form_inputform(lang('MENU_EDITMENU_ORDER'), 'menuorder', $menuorder, '3');

// build an array for side radio selection and display form bit
$side_array = array(
    '2' => lang('MENUS_EDITMENU_LEFT'),
    '3' => lang('MENUS_EDITMENU_MIDDLE'),
    '1' => lang('MENUS_EDITMENU_RIGHT')
);

$content .= form_radio_selection(lang('MENU_EDITMENU_SIDE'), 'menualign', $side_array, $menualign);

$content .= form_textarea(lang('MENU_EDITMENU_HEAD'), 'menuhead', htmlspecialchars($menuhead));

// get available menu files and display them in a select box
$menus_array['none'] = 'None';
$open                = opendir($CONF['site_path']."/blocks");
while ($file = readdir($open)) {
    if (($file != ".") && ($file != "..") && (is_file("./../blocks/$file"))) {
        $ext = strchr($file, '.');
        if ($ext == '.php') {
            $file               = str_replace(".php", "", $file);
            $file               = preg_replace("/[^a-zA-Z0-9\-\_]/", "", $file);
            $menus_array[$file] = $file;
        }
    }
}


$result = $diy_db->query("SELECT mod_name FROM diy_modules ORDER BY id ASC");

while ($row = $diy_db->dbarray($result)) {
extract($row);
// get available menu files for modules and display them in a select box
if(is_dir($CONF['site_path']."/modules/".$mod_name."/blocks"))
{
$open                = opendir($CONF['site_path']."/modules/".$mod_name."/blocks");
while ($file = readdir($open)) {
    if (($file != ".") && ($file != "..") && (is_file($CONF['site_path']."/modules/".$mod_name."/blocks/$file"))) {
        $info = pathinfo($file);
        if ($info['extension'] == 'php') {
            $file               = preg_replace("/[^a-zA-Z0-9\-\_\.]/", "", $file);
            $menus_array[$mod_name][$file] = $file;
        }
    }
}
}
}

$content .= form_selectform(lang('MENU_EDITMENU_FILE'), 'filemenu', $menus_array);


$content .= form_textarea(lang('MENU_EDITMENU_CONTENT'), 'menucenter', htmlspecialchars($menucenter));

$content .= form_radio_selection(lang('MENU_EDITMENU_SHOW_HIDE'), 'menushow', '', $menushow);

// get groups info and ask which group are allowed to see this menu
$result = $diy_db->query("SELECT * FROM diy_groups");
while ($row = $diy_db->dbarray($result)) {
    extract($row);
    $groups_array[$groupid] = $grouptitle;
}
$content .= form_checkbox_select(lang('MENU_EDITMENU_GROUP_ACCESS'), "groups" . "[]", $groups_array, $checkuser);

// print form with all its deatiles
$form_array = array(
    "action" => "sections.php?section=menus&file=edit_menu&menuid=$menuid&$session",
    "title" => lang('MENU_EDITMENU_TITLE'),
    "name" => 'edit_menu',
    "content" => $content,
    "submit" => lang('SUBMIT')
);

$output = form_output($form_array);

echo $nav;
echo $output;

?>