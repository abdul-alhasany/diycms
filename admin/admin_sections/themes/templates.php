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
$tempid = $_GET['tempid'];


// get action value and switch it to the relevant value
$action = $_GET['action'];
switch ($action)
{

  case 'add_template';
    // check for any existing template group, if non eixst display a message
    $group_count = $diy_db->query("SELECT * FROM diy_temptype
								WHERE themeid='$themeid'
								ORDER BY tempid");
    $check_count = $diy_db->dbnumrows($group_count);
    if ($check_count == 0)
    {
      info_msg(lang('THEMES_TEMPLATES_TEMPLATE_GROUP_NEEDED'), "sections.php?section=themes&$session");
    }

    // check if any data is posted
    if ($_POST['submit'])
    {
      extract($_POST);

      $theme_title = $diy_db->query("SELECT * FROM diy_themes WHERE id='$themeid'");
      $row = $diy_db->dbarray($theme_title);

      $result = $diy_db->query("INSERT INTO diy_templates
                                                      (themeid, theme,name,temptype,template)
                                                      values
                                                      ($themeid, '$row[theme]','$name','$temptype','$template')");
      if ($result)
      {
		cache_templates($themeid);
        info_msg(lang('THEMES_TEMPLATES_ADD_SUCCESSFULL'), "sections.php?section=themes&file=view_templates&themeid=$themeid&$session");
      }
    }

    // Build navigation
    $nav_array = array(lang('THEMES_INDEX_TITLE') => "sections.php?section=themes&$session", lang('THEMES_TEMPLATES_ADD_TEMPLATE'));

    // set navigation
    $content .= $this->nav_bar($nav_array);


    $form = form_inputform(lang('THEMES_TEMPLATES_TEMP_TITLE'), 'name');

    // build an array for selectyion form
    $result = $diy_db->query("SELECT * FROM diy_temptype
							WHERE themeid='$themeid'
							ORDER BY tempid");
    while ($row = $diy_db->dbarray($result))
    {
      extract($row);
      $array[$tempid] = $temptypetitle;
    }

    $form .= form_selectform(lang('THEMES_TEMPLATES_GROUP_TITLE'), 'temptype', $array);
    $form .= form_textarea(lang('THEMES_TEMPLATES_TEMPLATE'), 'template');

    // output
    $form_array = array("action" => "sections.php?section=themes&file=templates&action=add_template&themeid=$themeid&$session", "title" => lang('MODULES_TEMPLATES_ADD_TEMPLATE'),
      "name" => 'add_template', "content" => $form, "submit" => lang('SUBMIT'), );
    $content .= form_output($form_array);

    break;



    // edit a single template
  case 'edit_template';

    // check if any data is posted
    if ($_POST['submit'])
    {
      extract($_POST);
      $result = $diy_db->query("UPDATE diy_templates SET name='$name',
													temptype = '$temptype',
													template='$template'
													WHERE id='$tempid'");
      if ($result)
      {
		cache_templates($themeid);
        info_msg(lang('MODULES_TEMPLATES_UPDATE_SUCCESSFULL'), "sections.php?section=themes&file=view_templates&themeid=$themeid&$session");
      }
    }

    // Build navigation
    $nav_array = array(lang('THEMES_INDEX_TITLE') => "sections.php?section=themes&$session", lang('THEMES_TEMPLATES_EDIT_TEMPLATE'));

    // set navigation
    $content .= $this->nav_bar($nav_array);

    $result = $diy_db->query("SELECT * FROM diy_templates WHERE id='$tempid'");
    $temp = $diy_db->dbarray($result);
    extract($temp);

    $form = form_inputform(lang('THEMES_TEMPLATES_TEMP_TITLE'), 'name', $name);

    // build an array for selectyion form
    $result = $diy_db->query("SELECT * FROM diy_temptype
							WHERE themeid='$themeid'
							ORDER BY tempid");
    while ($row = $diy_db->dbarray($result))
    {
      extract($row);
      $array[$tempid] = $temptypetitle;
    }
	
	$text_area_info = array('rows' => '25');
    $form .= form_selectform(lang('THEMES_TEMPLATES_GROUP_TITLE'), 'temptype', $array, $temptype);
    $form .= form_textarea(lang('THEMES_TEMPLATES_TEMPLATE'), 'template', $template, $text_area_info);

    $tempid = $_GET['tempid'];
    // output
    $form_array = array("action" => "sections.php?section=themes&file=templates&action=edit_template&themeid=$themeid&tempid=$tempid&$session", "title" => lang('THEMES_TEMPLATES_EDIT_TEMPLATE'),
      "name" => 'edit_template', "content" => $form, "submit" => lang('UPDATE'), );
    $content .= form_output($form_array);

    break;



    // delete a template
  case 'delete_template';
    $result = $diy_db->query("DELETE FROM diy_templates
							WHERE id='$tempid'");
    if ($result)
    {
	  cache_templates($themeid);
      info_msg(lang('THEMES_TEMPLATES_DELETE_SUCCESSFULL'), "sections.php?section=themes&file=view_templates&themeid=$themeid&$session");
    }

    break;



    // display a single template, good to see how the template will look once included in the theme
  case 'display_template';
    $tempid = set_id_int('tempid');
    $result = $diy_db->query("SELECT * FROM diy_templates
							WHERE id='$tempid'");
    $temp = $diy_db->dbarray($result);
    extract($temp);
    $template = str_replace('<#themepath#>', $templates->themepath, $template);

    $templates->themeid = get_global_setting('theme');
    $result = $diy_db->query("SELECT * FROM diy_themes
									WHERE id='" . $templates->themeid . "'");
    $drow = $diy_db->dbarray($result);
    eval("\$css =\"" . str_replace("\"", "\\\"", stripslashes($drow['style_css'])) . "\";");
    echo '<style>' . $css . '</style>';
    echo $template;
    break;
}
echo $content;

?>