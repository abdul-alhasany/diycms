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
  * This file is part of groups section
  * 
  * @package	Admin_sections
  * @subpackage	Groups
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

// get group id
$groupid = set_id_int('groupid');

// check if any data is posted
if ($_POST['submit']) {
    extract($_POST);
    
    while (list($key, $val) = each($_POST)) {
        $diy_db->query("UPDATE diy_groups_privileges SET value='$val'
							WHERE variable='$key' and groupid='$groupid';");
    }
    if ($_POST[pregrouptitle] !== $_POST[grouptitle])
        $diy_db->query("UPDATE diy_groups SET grouptitle='$_POST[grouptitle]'
						WHERE groupid='$groupid';");
    
    
		// cahce results for better performance
		$query_result = $diy_db->query("SELECT groupid, variable, value FROM diy_groups_privileges");
		while($row = $diy_db->dbarray($query_result))
		{
		extract($row);
		$array[$groupid][$variable] = $value;
		}

		$diy_db->create_query_cache_file('global_groups_permissions', $array);
		
		
    info_msg(lang('GROUPS_EDITGROUP_GROUP_UPDATED'), "sections.php?section=groups&$session");
    
}

// set navigation
$nav_array = array(
    lang('GROUPS_INDEX_TITLE') => "sections.php?section=groups&$session",
    lang('GROUPS_EDITGROUP_TITLE')
);
$nav       = $this->nav_bar($nav_array);



// get the data of all groups
$result    = $diy_db->query("SELECT * FROM diy_groups
						  WHERE groupid=$groupid LIMIT 1");
$group_row = $diy_db->dbarray($result);
extract($group_row);

// get groups' details
$result = $diy_db->query("SELECT variable,value
								FROM diy_groups_privileges
								WHERE groupid='$groupid'");
while ($rows = $diy_db->dbarray($result)) {
    extract($rows);
    $$variable = $value;
}

// build form
$content .= form_inputform(lang('GROUPS_PRIVILEGES_GROUP_TITLE'), 'grouptitle', $grouptitle);
$content .= form_hidden('pregrouptitle', $grouptitle);
$content .= form_radio_selection(lang('GROUPS_PRIVILEGES_VIEW_OFFLINE'), 'view_site', '', $view_site);
$content .= form_inputform(lang('GROUPS_PRIVILEGES_MAXIMUM_LETTERS'), 'maximum_posts_letters', $maximum_posts_letters);
$content .= form_inputform(lang('GROUPS_PRIVILEGES_MAXIMUM_EDIT_TIME'), 'maximum_post_edit_time', $maximum_post_edit_time);
$content .= form_inputform(lang('GROUPS_PRIVILEGES_ALLOWED_FILES_UPLOAD'), 'allowed_files_upload', $allowed_files_upload);
$content .= form_inputform(lang('GROUPS_PRIVILEGES_MAXIMUM_UPLOAD_SIZE'), 'maximum_upload_size', $maximum_upload_size);
$content .= form_inputform(lang('GROUPS_PRIVILEGES_MAXIMUM_UPLOAD_WIDTH'), 'maximum_upload_width', $maximum_upload_width);
$content .= form_inputform(lang('GROUPS_PRIVILEGES_MAXIMUM_UPLOAD_HEIGHT'), 'maximum_upload_height', $maximum_upload_height);
	$select_array = array('disabled' => lang('GROUPS_PRIVILEGES_EDITOR_DISABLED'),
						'bbcode' => lang('GROUPS_PRIVILEGES_EDITOR_BBCODE'),
						'html' => lang('GROUPS_PRIVILEGES_EDITOR_HTML')
						);
$content .= form_selectform(lang('GROUPS_PRIVILEGES_EDITOR_TYPE'), 'editor_type', $select_array, $editor_type);
$content .= form_textarea(lang('GROUPS_PRIVILEGES_ALLOWED_HTML_TAGS'), 'allowed_html_tags', $allowed_html_tags);
 
// get form array
$form_array = array(
    "action" => "sections.php?section=groups&file=edit_group&groupid=$groupid&$session",
    "title" => lang('GROUPS_EDITGROUP_TITLE'),
    "name" => 'edit_group',
    "content" => $content,
    "submit" => lang('SUBMIT')
);

$output = form_output($form_array);
echo $nav;
echo $output;

?>