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
 * This clss handles form bits (text input, file upload, textarea .. etc)
 * 
 * @package	Admin
 * @subpackage	Functions
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	1.1
 * @access 	public
 */

/**
 * handles displaying the whole form table
 *
 * @param array  form array include form actiom, name, title, content, method and sumbit button
 *
 * @return string
 */

function form_output($form = array())
{
    global $admin_templates;
    
    // check for array variables
    if (empty($form['method']))
        $form['method'] = "post";
    if (empty($form['name']))
        $form['name'] = "diycms";
    
    // set the sumbit button
    if (!empty($form['image'])) {
        $submit_button .= "<input type='image' name='submit' src=" . $form['image'] . ">";
    } else {
        $submit_button .= "<input type='submit' name='submit' class='button' value='     " . $form['submit'] . "     '>";
    }
    
    // set variables to be replaced in template
    $form_elements = array(
        '{ACTION}' => $form['action'],
        '{METHOD}' => $form['method'],
        '{NAME}' => $form['name'],
        '{TITLE}' => $form['title'],
        '{CONTENT}' => $form['content'],
        '{EXTRA}' => $form['extra'],
        '{SUBMIT}' => $submit_button
    );
    $form          = $admin_templates->get_template('form_output.tpl.php', $form_elements);
    
    return $form;
    
}

/**
 * hidden form input
 *
 * @param string  name of the input
 * @param mixed  intital value of the input
 *
 * @return string
 */

function form_hidden($name, $value = '')
{
    return "<input type=\"hidden\" name=\"$name\" value=\"$value\">";
}

/**
 * Displays an input form (text or file input)
 *
 * @param string  name of the input
 * @param string  text next to the input field 
 * @param mixed   intital value of the input
 * @param number  size of the input 
 * @param string  type of the input (text or file)
 *
 * @return string
 */

function form_inputform($title, $name, $value = '', $size = '35', $type = 'text')
{
    global $admin_templates;
	
	$title = proccess_lang_array($title);
	
    // set variables to be replaced in template
    $inputform = array(
        '{NAME}' => $name,
        '{TYPE}' => $type,
        '{TITLE}' => $title,
        '{VALUE}' => $value,
        '{SIZE}' => $size
    );
    $form      = $admin_templates->get_template('form_inputfield.tpl.php', $inputform);
    
    return $form;
}


/**
 * Displays textarea in any form
 *
 * @param string  text next to the input field 
 * @param string  name of the input
 * @param mixed   intital value of the input
 * @param mixed	 array contains different aspect of the textarea (height, width, direction.. etc)
 *
 * @return string
 */

function form_textarea($title = 'text', $name = 'post', $value = '', $info = array())
{
    global $admin_templates;
    if (empty($info['cols']))
        $info["cols"] = "80";
    if (empty($info['rows']))
        $info["rows"] = "10";
    
    if (empty($info['dir']))
        $info['dir'] = 'LTR';
    else
        $info['dir'] = 'RTL';
		
    $value = str_replace('</textarea>', '&lt;/textarea&gt;', $value);
	
	$title = proccess_lang_array($title);

    $textarea_array = array(
        '{TITLE}' => $title,
        '{COLUMNS}' => $info["cols"],
        '{ROWS}' => $info["rows"],
        '{DIR}' => $info["dir"],
        '{NAME}' => $name,
        '{VALUE}' => $value
    );
    
    $form = $admin_templates->get_template('form_textarea.tpl.php', $textarea_array);
    
    return $form;
}

/**
 * This function handles multiple selection (accept arrays only)
 *
 * @param string  text next to the input field 
 * @param string  name of the input
 * @param mixed   an array contains the list of options for the slectform
 * @param mixed	 intital value of the input
 *
 * @return string
 */

function form_selectform($title, $name, $options_array = array(), $value = '', $extra = null, $multiple = false, $size = '')
{
    global $admin_templates;
	
	$title = proccess_lang_array($title);
	
    if ($extra != null)
        $option .= $extra;
    
	// get an array from $selection variable
    $selection_array = explode(",", $value);
	
    foreach ($options_array as $key => $values) {
	if(is_array($values))
	{
		$option .= "<optgroup label='$key'>";
		foreach($values as $selection => $label)
		{
			$selected = in_array($selection, $selection_array) ? 'selected' : '';
            $option .= "<option value='$selection' $selected>$label</option>";
		}
		$option .= "</optgroup>";
	}else
	{
        $selected = in_array($key, $selection_array) ? 'selected' : '';
       $option .= "<option value='$key' $selected>$values</option>";
    }
	}
    
	if($multiple)
	{
		$mutliple = "multiple='multiple'";
	}
	
	if(!empty($size))
	{
		$size = "size='$size'";
	}
	
    $selectform_array = array(
        '{TITLE}' => $title,
        '{NAME}' => $name,
        '{OPTION}' => $option,
        '{MULTIPLE}' => $mutliple,
        '{SIZE}' => $size,
    );
    
    $form = $admin_templates->get_template('form_selectform.tpl.php', $selectform_array);
    
    return $form;
}

/**
 * This function handels mutliple checkbox bit
 *
 * @param string  text next to the input field 
 * @param string  name of the input
 * @param mixed   an array contains the list of options for the slectform
 * @param mixed	 an array of intital values of the checkboxes
 *
 * @return string
 */

function form_checkbox_select($title, $name, $options = array(), $slection = '', $size = 10)
{
    global $admin_templates;
    // get an array from $selection variable
    $selection_array = explode(",", $slection);
    
    // loop through the options array to find any matches with the selection
    foreach ($options as $menuid => $menutitle) {
        $check = in_array($menuid, $selection_array) ? 'checked' : '';
        $checkbox .= "<input type=\"checkbox\" name=\"$name\" value=\"$menuid\" $check>$menutitle<br>";
    }
    
    
    $title = proccess_lang_array($title);
	
    // build an array and get the outer template
    $form_checkbox = array(
        '{TITLE}' => $title,
        '{CHECKBOXES}' => $checkbox
    );
    
	if(count($options) > $size)
	{
		$form = form_selectform($title, $name, $options, $slection, '', true, $size);
	}
	else
	{
    // get the template for this form bit
    $form = $admin_templates->get_template('form_checkbox_select.tpl.php', $form_checkbox);
    }
	
    return $form;
}

/**
 * This function handles multiple radion selection (defualt value is yes and no, accepts arrays)
 * 
 * @param mixed $title
 * @param mixed $name
 * @param mixed $options
 * @param string $value
 * @return
 */
function form_radio_selection($title, $name, $options = array(), $value = '0')
{
    global $admin_templates;
    if (!empty($options)) {
        foreach ($options as $key => $option_value) {
            if ($key == $value) {
                $option .= "<input type=\"radio\" name='$name' value='$key' checked='checked'>$option_value</option>";
            } else {
                $option .= "<input type=\"radio\" name='$name' value='$key'>$option_value</option>";
            }
        }
    } else {
        if ($value == '1') {
            $option .= "<input type=\"radio\" name='$name' value='1' checked='checked'>".lang('YES'); "</option>";
            $option .= "<input type=\"radio\" name='$name' value='0'>".lang('NO'); "</option>";
        } else {
            $option .= "<input type=\"radio\" name='$name' value='1'>".lang('YES'); "</option>";
            $option .= "<input type=\"radio\" name='$name' value='0' checked='checked'>".lang('NO'); "</option>";
        }
    }
    
	$title = proccess_lang_array($title);
	
    $radio_selection_array = array(
        '{TITLE}' => $title,
        '{NAME}' => $name,
        '{OPTION}' => $option
    );
    
    $form = $admin_templates->get_template('form_radio_selection.tpl.php', $radio_selection_array);
    
    return $form;
}



/**
 * Displays permission form for any given module
 *
 * @param string  module name
 *
 * @return string permission tables for the spcified module
 */

function form_module_permissions($module)
{
    global $diy_db, $admin_templates, $admin_lang;
    // build a groups array
    $group_query = $diy_db->query("SELECT * FROM diy_groups
								  ORDER BY groupid ASC");
    while ($row = $diy_db->dbarray($group_query)) {
        extract($row);
        $perm_array[$row['grouptitle']] = $row['grouptitle'];
        $group_array[$row['groupid']]   = $row['groupid'];
        $head_group_title .= "<td class='cell'><center>$grouptitle</td>";
    }
    // retrive permission data
    $perm_result = $diy_db->query("SELECT * FROM diy_modules_settings
									WHERE set_mod='$module'
									AND set_type ='7'
									ORDER BY set_order ASC");
    // check that permission exist for the module
    if ($diy_db->dbnumrows($perm_result) !== 0) {
        // loop through results
        while ($row = $diy_db->dbarray($perm_result)) {
            extract($row);
            
            $catgrouparr = explode(",", $set_val);
            $option      = "<td class='first_cell'>$admin_lang[$set_text]</td>";
            // loop through array to check if a given option is selected against the given group
            foreach ($group_array as $key => $value) {
                $check = (in_array($key, $catgrouparr)) ? 'checked' : '';
                $option .= "<td class='cell'><center><input type='checkbox' name=$set_var" . "[] value=\"$key\" $check></center></td>";
            }
            
            // store all the results to an inner template for later use
            $rows .= $admin_templates->get_template('form_module_permission_row.tpl.php', array(
                '{CELLS}' => $option
            ));
            
        }
        
    }
    
    // build an array and get the outer template
    $form_permission = array(
        '{TITLE}' => $title,
        '{NAME}' => $name,
        '{HEAD_GROUP}' => $head_group_title,
        '{ROWS}' => $rows,
        '{OPTION}' => $option
    );
    
    $content = $admin_templates->get_template('form_module_permission.tpl.php', $form_permission);
    
    return $content;
}

/**
 * Displays permission form for any given plugin
 *
 * @param string  plugin id
 *
 * @return string permission tables for the spcified plugin
 */

function form_plugin_permissions($plugin_id)
{
    global $diy_db, $admin_templates, $admin_plugin_lang;
    // build a groups array
    $group_query = $diy_db->query("SELECT * FROM diy_groups
								  ORDER BY groupid ASC");
    while ($row = $diy_db->dbarray($group_query)) {
        extract($row);
        $perm_array[$row['grouptitle']] = $row['grouptitle'];
        $group_array[$row['groupid']]   = $row['groupid'];
        $head_group_title .= "<td class='cell'><center>$grouptitle</td>";
    }
    // retrive permission data
    $perm_result = $diy_db->query("SELECT * FROM diy_plugins_settings
									WHERE plugin_id ='$plugin_id'
									AND type ='7'
									ORDER BY `order` ASC");
    // check that permission exist for the plugin
    if ($diy_db->dbnumrows($perm_result) !== 0) {
        // loop through results
        while ($row = $diy_db->dbarray($perm_result)) {
            extract($row);
            
            $catgrouparr = explode(",", $set_val);
            $option      = "<td class='first_cell'>".$admin_plugin_lang[$text]."</td>";
            // loop through array to check if a given option is selected against the given group
            foreach ($group_array as $key => $value) {
                $check = (in_array($key, $catgrouparr)) ? 'checked' : '';
                $option .= "<td class='cell'><center><input type='checkbox' name=$varaible" . "[] value=\"$key\" $check></center></td>";
            }
            
            // store all the results to an inner template for later use
            $rows .= $admin_templates->get_template('form_plugin_permission_row.tpl.php', array(
                '{CELLS}' => $option
            ));
            
        }
        
    }
    
    // build an array and get the outer template
    $form_permission = array(
        '{TITLE}' => $title,
        '{NAME}' => $name,
        '{HEAD_GROUP}' => $head_group_title,
        '{ROWS}' => $rows,
        '{OPTION}' => $option
    );
    
    $content = $admin_templates->get_template('form_plugin_permission.tpl.php', $form_permission);
    
    return $content;
}

function form_elements_group_seprator($title)
{    
	global $admin_templates;
    $content = $admin_templates->get_template('form_elements_group_seprator.tpl.php', array('{TITLE}' => $title));
    
    return $content;
}
?>