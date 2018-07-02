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
  * This file is part of modules section
  * 
  * @package	Admin_sections
  * @subpackage	Modules
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

// get some ids and info
$module  = $_GET['module'];
$modid   = set_id_int('modid');
$themeid = $_GET['themeid'];
$tempid  = $_GET['tempid'];
$groupid = $_GET['groupid'];

// get action value and switch it to the relevant value
$action = $_GET['action'];
switch ($action) {
    case 'view_templates';
        
        // Build navigation
        $nav_array = array(
            lang('MODULES_INDEX_TITLE') => "sections.php?section=modules&$session",
            lang('MODULES_THEME_TITLE') => "sections.php?section=modules&file=theme&module=$module&modid=$modid&$session",
            lang('MODULES_TEMPLATES_TITLE')
        );
        
        // set navigation
        $content .= $this->nav_bar($nav_array);
        
        $temp_group_result = $diy_db->query("SELECT * FROM diy_module_tempgroup
									  WHERE modid='$modid'
									  AND themeid='$themeid'
									  ORDER BY groupid");
        
        while ($temp_group_array = $diy_db->dbarray($temp_group_result)) {
            extract($temp_group_array);
            
            $group_id = $groupid;
            $result   = $diy_db->query("SELECT * FROM diy_modules_templates
								WHERE modid='$modid'
								AND parent='$themeid'
								AND temp_groupid = '$groupid'
								ORDER BY temp_title");
            // unset rows so its value will not add up every time the main query loops
            unset($rows);
            
            while ($row = $diy_db->dbarray($result)) {
                extract($row);
                
                // Set array for template replacement
                $array = array(
                    '{TEMP_TITLE}' => $temp_title,
                    '{MODID}' => $modid,
                    '{MODULE}' => $module,
                    '{SESSION}' => $session,
                    '{THEME}' => $row['theme'],
                    '{THEME_ID}' => $_GET['themeid'],
                    '{TEMP_ID}' => $row['id'],
                    '{GROUP_ID}' => $group_id
                );
                
                // store results to this template to include it in the outer template
                $rows .= $admin_templates->get_template('modules_templates_view_row.tpl.php', $array);
                
            }
            
            // get the outer template, replace values and then print it
            $array = array(
                '{ROWS}' => $rows,
                '{TEMP_GROUP}' => $title
            );
            
            $content .= $admin_templates->get_template('modules_templates_view.tpl.php', $array);
            
        }
        break;
    
    
    
    // display a single template, good to see how the template will look once included in the theme
    case 'display_template';
        $tempid = set_id_int('tempid');
        $result = $diy_db->query("SELECT * FROM diy_modules_templates
							WHERE id='$tempid'");
        $temp   = $diy_db->dbarray($result);
        extract($temp);
        $template = str_replace('<#themepath#>', $templates->themepath, $template);
        $template = str_replace('<#mod_themepath#>', "../modules/$module/images", $template);
        
        $templates->themeid = get_global_setting('theme');
        $result             = $diy_db->query("SELECT * FROM diy_themes
									WHERE id='" . $templates->themeid . "'");
        $drow               = $diy_db->dbarray($result);
        eval("\$css =\"" . str_replace("\"", "\\\"", stripslashes($drow['style_css'])) . "\";");
        echo '<style>' . $css . '</style>';
        echo $template;
        break;
    
    
    
    // edit a single template
    case 'edit_template';
        
        // check if any data is posted
        if ($_POST['submit']) {
            extract($_POST);
            $result = $diy_db->query("UPDATE diy_modules_templates SET
							temp_groupid='$group_id',
							temp_title='$temp_title',
							template='$template'
							WHERE id='$tempid'");
            if ($result) {
				cache_module_templates($modid, $themeid);
                info_msg(lang('MODULES_TEMPLATES_UPDATE_SUCCESSFULL'), "sections.php?section=modules&file=templates&action=view_templates&modid=$modid&module=$module&themeid=$themeid&$session");
            }
        }
        
        // Build navigation
        $nav_array = array(
            lang('MODULES_INDEX_TITLE') => "sections.php?section=modules&$session",
            lang('MODULES_THEME_TITLE') => "sections.php?section=modules&file=theme&module=$module&modid=$modid&$session",
            lang('MODULES_TEMPLATES_TITLE') => "sections.php?section=modules&file=templates&action=view_templates&modid=$modid&module=$module&themeid=$themeid&$session",
            lang('MODULES_TEMPLATES_EDIT_TEMPLATE')
        );
        
        // set navigation
        $content .= $this->nav_bar($nav_array);
        
        $result = $diy_db->query("SELECT * FROM diy_modules_templates
								WHERE id='$tempid'");
        $temp   = $diy_db->dbarray($result);
        extract($temp);
        $theme_id = $_GET['themeid'];
        $form     = form_inputform(lang('MODULES_TEMPLATES_TEMP_TITLE'), 'temp_title', $temp_title);
        
        // build an array for selectyion form
        $result = $diy_db->query("SELECT * FROM diy_module_tempgroup
							WHERE modid='$modid'
							and themeid='$theme_id'
							ORDER BY groupid");
        while ($row = $diy_db->dbarray($result)) {
            extract($row);
            $array[$groupid] = $title;
        }
        $group_id = $_GET['groupid'];
        
		$info['rows'] = '25';
        $form .= form_selectform(lang('MODULES_TEMPLATES_GROUP_TITLE'), 'group_id', $array, $group_id);
        $form .= form_textarea(lang('MODULES_TEMPLATES_TEMPLATE'), 'template', htmlspecialchars($template), $info);
        
        // output
        $form_array = array(
            "action" => "sections.php?section=modules&file=templates&action=edit_template&modid=$modid&module=$module&themeid=$theme_id&tempid=$tempid&groupid=$group_id&$session",
            "title" => lang('MODULES_TEMPLATES_EDIT_TEMPLATE'),
            "name" => 'edit_template',
            "content" => $form,
            "submit" => lang('EDIT')
        );
        $content .= form_output($form_array);
        
        break;
    
    
    // delete a template
    case 'delete_template';
        $result = $diy_db->query("DELETE FROM diy_modules_templates
							WHERE id='$tempid'");
        if ($result) {
			cache_module_templates($modid, $themeid);
            info_msg(lang('MODULES_TEMPLATES_DELETE_SUCCESSFULL'), "sections.php?section=modules&file=templates&action=view_templates&modid=$modid&module=$module&themeid=$themeid&groupid=$groupid&$session");
        }
        
        break;
    
    
    case 'edit_template_group';
        if ($_POST['submit']) {
            extract($_POST);
            $result = $diy_db->query("UPDATE diy_module_tempgroup SET
							title='$group_title',
							`desc`='$desc'
							WHERE groupid='$groupid'");
            if ($result) {
                info_msg(lang('MODULES_TEMPLATES_GROUP_UPDATE_SUCCESSFULL'), "sections.php?section=modules&file=templates&action=view_templates&modid=$modid&module=$module&themeid=$themeid&$session");
            }
        }
        
        // Build navigation
        $nav_array = array(
            lang('MODULES_INDEX_TITLE') => "sections.php?section=modules&$session",
            lang('MODULES_THEME_TITLE') => "sections.php?section=modules&file=theme&module=$module&modid=$modid&$session",
            lang('MODULES_TEMPLATES_TITLE') => "sections.php?section=modules&file=templates&action=view_templates&modid=$modid&module=$module&themeid=$themeid&$session",
            lang('MODULES_TEMPLATES_EDIT_GROUP')
        );
        
        // set navigation
        $content .= $this->nav_bar($nav_array);
        
        $result = $diy_db->dbfetch("SELECT * FROM diy_module_tempgroup
								WHERE modid='$modid'
								AND groupid='$groupid'
								ORDER BY groupid");
        extract($result);
        $theme_id = $_GET['themeid'];
        
        $form = form_inputform(lang('MODULES_TEMPLATES_GROUP_TITLE'), 'group_title', $title);
        $form .= form_textarea(lang('MODULES_TEMPLATES_GROUP_DESC'), 'desc', $desc);
        
        // output
        $form_array = array(
            "action" => "sections.php?section=modules&file=templates&action=edit_template_group&modid=$modid&module=$module&themeid=$theme_id&tempid=$tempid&groupid=$groupid&$session",
            "title" => lang('MODULES_TEMPLATES_EDIT_GROUP'),
            "name" => 'edit_template_group',
            "content" => $form,
            "submit" => lang('SUBMIT')
        );
        $content .= form_output($form_array);
        
        break;
    
    
    
    case 'delete_template_group';
        $diy_db->query("DELETE from diy_module_tempgroup WHERE groupid='$groupid' AND modid='$modid'");
        $diy_db->query("DELETE from diy_modules_templates where temp_groupid='$groupid' AND modid='$modid'");
        
        info_msg(lang('MODULES_TEMPLATES_GROUP_DELETE_SUCCESSFULL'), "sections.php?section=modules&file=templates&action=view_templates&modid=$modid&module=$module&themeid=$themeid&$session");
        
        break;
    
    
    case 'add_template';
        // check for any existing template group, if non eixst display a message
        $group_count = $diy_db->query("SELECT * FROM diy_module_tempgroup where modid='$modid' and themeid='$themeid' ORDER BY groupid");
        $check_count = $diy_db->dbnumrows($group_count);
        if ($check_count == 0) {
            info_msg(lang('MODULES_TEMPLATES_TEMPLATE_GROUP_NEEDED'), "sections.php?section=modules&file=theme&modid=$modid&module=$module&$session");
        }
        
        // check if any data is posted
        if ($_POST['submit']) {
            extract($_POST);
            $result = $diy_db->query("INSERT INTO diy_modules_templates VALUES ('', '0', '0', $groupid, '$themeid', '$modid', '$module', '', '$temp_title', '$template');");
            if ($result) {
				cache_module_templates($modid, $themeid);
                info_msg(lang('MODULES_TEMPLATES_ADD_SUCCESSFULL'), "sections.php?section=modules&file=templates&action=view_templates&modid=$modid&module=$module&themeid=$themeid&$session");
            }
        }
        
        // Build navigation
        $nav_array = array(
            lang('MODULES_INDEX_TITLE') => "sections.php?section=modules&$session",
            lang('MODULES_THEME_TITLE') => "sections.php?section=modules&file=theme&module=$module&modid=$modid&$session",
            lang('MODULES_TEMPLATES_ADD_TEMPLATE')
        );
        
        // set navigation
        $content .= $this->nav_bar($nav_array);
        
        
        $form = form_inputform(lang('MODULES_TEMPLATES_TEMP_TITLE'), 'temp_title', $temp_title);
        
        // build an array for selectyion form
        $result = $diy_db->query("SELECT * FROM diy_module_tempgroup
							WHERE modid='$modid'
							and themeid='$themeid'
							ORDER BY groupid");
        while ($row = $diy_db->dbarray($result)) {
            extract($row);
            $array[$groupid] = $title;
        }
        
        $form .= form_selectform(lang('MODULES_TEMPLATES_GROUP_TITLE'), 'groupid', $array, '');
        $form .= form_textarea(lang('MODULES_TEMPLATES_TEMPLATE'), 'template', htmlspecialchars($template));
        
        // output
        $form_array = array(
            "action" => "sections.php?section=modules&file=templates&action=add_template&modid=$modid&module=$module&themeid=$themeid&$session",
            "title" => lang('MODULES_TEMPLATES_ADD_TEMPLATE'),
            "name" => 'add_template',
            "content" => $form,
            "submit" => lang('SUBMIT')
        );
        $content .= form_output($form_array);
        
        break;
    
    
    
    case 'add_template_group';
        // check for any existing template group, if non eixst display a message
        
        // check if any data is posted
        if ($_POST['submit']) {
            extract($_POST);
            $result = $diy_db->query("INSERT INTO diy_module_tempgroup VALUES ('', '$modid', '$themeid', '$group_title', '$desc');");
            if ($result) {
                info_msg(lang('MODULES_TEMPLATES_GROUP_ADD_SUCCESSFULL'), "sections.php?section=modules&file=theme&modid=$modid&module=$module&$session");
            }
        }
        
        // Build navigation
        $nav_array = array(
            lang('MODULES_INDEX_TITLE') => "sections.php?section=modules&$session",
            lang('MODULES_THEME_TITLE') => "sections.php?section=modules&file=theme&module=$module&modid=$modid&$session",
            lang('MODULES_TEMPLATES_ADD_TEMPLATE')
        );
        
        // set navigation
        $content .= $this->nav_bar($nav_array);
        
        
        $form = form_inputform(lang('MODULES_TEMPLATES_TEMP_GROUP_TITLE'), 'group_title', $temp_title);
        
        $form .= form_textarea(lang('MODULES_TEMPLATES_GROUP_DESCRIPTION'), 'desc');
        
        // output
        $form_array = array(
            "action" => "sections.php?section=modules&file=templates&action=add_template_group&modid=$modid&module=$module&themeid=$themeid&$session",
            "title" => lang('MODULES_TEMPLATES_ADD_TEMPLATE_GROUP'),
            "name" => 'add_template_group',
            "content" => $form,
            "submit" => lang('SUBMIT')
        );
        $content .= form_output($form_array);
        break;
    
    
    
    case 'export_theme';
        // set header
        header("Content-disposition: attachment; filename=$module.xml");
        header("Content-type: text/xml");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        // start building xml file
        $style = '<?xml version="1.0"?>';
        $style .= '<style>';
        $result = $diy_db->query("SELECT * FROM diy_module_tempgroup
							WHERE modid='$modid'
							AND themeid='$themeid'
							ORDER BY groupid");
        while ($row = $diy_db->dbarray($result)) {
            extract($row);
            // encode data so no issues occures as a result of including quotes or speical charchter
            $title = base64_encode($title);
            $desc  = base64_encode($desc);
            $style .= "<main_group>\n";
            $style .= "<group_title><![CDATA[$title]]></group_title>\n";
            $style .= "<group_desc><![CDATA[$desc]]></group_desc>\n";
            
            $temp_result = $diy_db->query("SELECT * FROM diy_modules_templates
									WHERE modid='$modid'
									AND parent='$themeid'
									AND temp_groupid='$groupid'
									ORDER BY id");
            while ($temp_row = $diy_db->dbarray($temp_result)) {
                extract($temp_row); {
                    $template   = str_replace("\'", "\"", $template);
                    $template   = base64_encode($template);
                    $temp_title = base64_encode($temp_title);
                    $style .= "<template>\n<temp_title><![CDATA[$temp_title]]></temp_title>\n";
                    $style .= "<temp_content><![CDATA[$template]]></temp_content>\n</template>\n";
                }
            }
            $style .= "</main_group>\n";
        }
        $style .= "</style>";
        // output file
        echo $style;
        break;
    
    
    case 'delete_theme';
        
        // check if the theme to be deleted is selected as a default theme
        $result = $diy_db->query("SELECT * FROM diy_modules WHERE id='$modid'");
        $row    = $diy_db->dbarray($result);
        if ($row['themeid'] == $themeid) {
            info_msg(lang('MODULES_TEMPLATES_CANNOT_DELETE_DEFAULT'), "sections.php?section=modules&file=theme&modid=$modid&module=$module&$session");
        }
        
        //check if this theme is the only theme the module has
        $themes      = $diy_db->query("SELECT * FROM diy_modules_templates WHERE id='$modid' AND parent='0'");
        $check_count = $diy_db->dbnumrows($themes);
        if ($check_count == '1') {
            info_msg(lang('MODULES_TEMPLATES_CANNOT_DELETE_SINGLE'), "sections.php?section=modules&file=theme&modid=$modid&module=$module&$session");
        }
        
        // delete theme and post a message
        $result = $diy_db->query("DELETE FROM diy_modules_templates WHERE modid='$modid' and parent='$themeid'");
        $result = $diy_db->query("DELETE FROM diy_modules_templates WHERE modid='$modid' and parent='0' AND themeid='$themeid'");
        $result = $diy_db->query("DELETE FROM diy_module_tempgroup WHERE modid='$modid' and themeid='$themeid'");
        if ($result) {
            info_msg(lang('MODULES_TEMPLATES_THEME_DELETE_SUCCESSFULL'), "sections.php?section=modules&file=theme&modid=$modid&module=$module&$session");
        }
        break;
}
echo $content;

?>