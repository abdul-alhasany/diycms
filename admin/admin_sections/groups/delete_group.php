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

if (RUN_SECTION !== true)
{
  die("<center><h3>" . lang('ACCESS_NOT ALLOWED') . "</h3></center>");
}

// assing admin session to a variable for later and easier use
$session = $auth->get_sess();

// get group id
$groupid = set_id_int('groupid');

// check if any data is posted
if ($_POST['submit'])
{
  extract($_POST);

  if ($_POST['group_id'] != 'none')
  {
    $result = $diy_db->query("UPDATE diy_users SET groupid ='$group_id'
								 WHERE groupid= $groupid");
  }
  else
  {
    $result = $diy_db->query("DELETE FROM diy_users WHERE groupid= $groupid");
  }

  $result = $diy_db->query("DELETE FROM diy_groups WHERE groupid= $groupid");
  $result = $diy_db->query("DELETE FROM diy_groups_privileges WHERE groupid= $groupid");

  info_msg(lang('GROUPS_DELETEGROUP_GROUP_DELETED'), "sections.php?section=groups&$session");
}

// set navigation
$nav_array = array(lang('GROUPS_INDEX_TITLE') => "sections.php?section=groups&$session", lang('GROUPS_DELETEGROUP_TITLE'));
$nav = $this->nav_bar($nav_array);


// build group array that does not include the group to be deleted or the guest group
$groups = $diy_db->query("SELECT groupid,grouptitle FROM diy_groups
							WHERE groupid !='$groupid'
							AND groupid !='5'
							ORDER BY groupid ASC");
while ($groups_row = $diy_db->dbarray($groups))
{
  $group_array[$groups_row['groupid']] = $groups_row['grouptitle'];
}

$extra = "<option value='none' selected>None</option>";
$content .= form_selectform(lang('GROUPS_DELETEGROUP_GROUP'), 'group_id', $group_array, '', $extra);

// get form array
$form_array = array("action" => "sections.php?section=groups&file=delete_group&groupid=$groupid&$session", "title" => lang('GROUPS_DELETEGROUP_TITLE'), "name" => 'delete_group',
  "content" => $content, "submit" => lang('SUBMIT'), );

$output = form_output($form_array);
echo $nav;
echo $output;

?>