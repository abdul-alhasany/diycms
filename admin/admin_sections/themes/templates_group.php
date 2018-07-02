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

// get some ids and info
$themeid = $_GET['themeid'];
$groupid = $_GET['groupid'];


// get action value and switch it to the relevant value
$action = $_GET['action'];
switch ($action)
{
  case 'add_template_group';

    // check if any data is posted
    if ($_POST['submit'])
    {
      extract($_POST);
      $result = $diy_db->query("INSERT INTO diy_temptype VALUES ('', '$group_title', '$desc', '$themeid');");
      if ($result)
      {
        info_msg(lang('THEMES_TEMPGROUP_GROUP_ADDED'), "sections.php?section=themes&file=view_templates&themeid=$themeid&$session");
      }
    }

    // Build navigation
    $nav_array = array(lang('THEMES_INDEX_TITLE') => "sections.php?section=themes&$session", lang('THEMES_TEMPGROUP_ADD_TEMPLATE_GROUP'));

    // set navigation
    $content .= $this->nav_bar($nav_array);


    $form = form_inputform(lang('THEMES_TEMPGROUP_GROUP_TITLE'), 'group_title', $temp_title);

    $form .= form_textarea(lang('THEMES_TEMPGROUP_GROUP_DESCRIPTION'), 'desc');

    // output
    $form_array = array("action" => "sections.php?section=themes&file=templates_group&action=add_template_group&themeid=$themeid&$session", "title" => lang('THEMES_TEMPGROUP_ADD_TEMPLATE_GROUP'),
      "name" => 'add_template_group', "content" => $form, "submit" => lang('ADD'), );
    $content .= form_output($form_array);
    break;


  case 'edit_template_group';
    if ($_POST['submit'])
    {
      extract($_POST);
      $result = $diy_db->query("UPDATE diy_temptype SET
							temptypetitle='$temptypetitle',
							tempdsc='$tempdsc'
							WHERE tempid='$groupid'");
      if ($result)
      {
        info_msg(lang('THEMES_TEMPGROUP_GROUP_UPDATED'), "sections.php?section=themes&file=view_templates&themeid=$themeid&$session");
      }
    }

    // Build navigation
    $nav_array = array(lang('THEMES_INDEX_TITLE') => "sections.php?section=themes&$session", lang('THEMES_TEMPLATES_TITLE') => "sections.php?section=themes&file=view_templates&themeid=$themeid&$session",
      lang('THEMES_TEMPGROUP_EDIT_GROUP'));

    // set navigation
    $content .= $this->nav_bar($nav_array);

    $result = $diy_db->dbfetch("SELECT * FROM diy_temptype
								WHERE themeid='$themeid'
								AND tempid='$groupid'
								ORDER BY tempid");
    extract($result);
    $theme_id = $_GET['themeid'];

    $form = form_inputform(lang('THEMES_TEMPGROUP_GROUP_TITLE'), 'temptypetitle', $temptypetitle);
    $form .= form_textarea(lang('THEMES_TEMPGROUP_GROUP_DESC'), 'tempdsc', $tempdsc);

    // output
    $form_array = array("action" => "sections.php?section=themes&file=templates_group&action=edit_template_group&themeid=$themeid&groupid=$tempid&$session", "title" => lang('THEMES_TEMPGROUP_EDIT_GROUP'),
      "name" => 'edit_template_group', "content" => $form, "submit" => lang('SUBMIT'), );
    $content .= form_output($form_array);

    break;



  case 'delete_template_group';
    $diy_db->query("DELETE FROM diy_temptype WHERE tempid='$groupid' AND themeid='$themeid'");
    $diy_db->query("DELETE FROM diy_templates WHERE temptype ='$groupid' AND themeid='$themeid'");

    info_msg(lang('THEMES_TEMPGROUP_DELETE_SUCCESSFULL'), "sections.php?section=themes&file=view_templates&themeid=$themeid&$session");

    break;

}
echo $content;

?>