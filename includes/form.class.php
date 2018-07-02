<?php
/*
+===============================================================================+
|      	Some or all this file's contents were created by ArabPortal Team   		|
|						Web: http://www.arab-portal.info						|
|   	--------------------------------------------------------------   		|
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
  * This calss handles form fields (text input, file upload, textarea .. etc)
  * 
  * @package	Global
  * @subpackage	Classes
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	2010
  * @access 	public
  */
  
class form
{

  
  /**
   * Display the form table with all the form elements
   * 
   * @param 	array 	$form	accepts an array containg action, method, name, submit button and title
   * @return	string			form template containg all the elements
   */
  function form_table($form = array())
  {
    global $templates;
    if (empty($form['method'])) $form['method'] = "post";
    if (empty($form['name'])) $form['name'] = "diycms";
	
    check_hook_function('form_table_content', $form['content']);

    if (!empty($form[image]))
    {
      $submit_button .= "<input type='image' id='submit_button' name='submit' src=" . $form[image] . ">";
    }
    else
    {
      $submit_button .= "<input type='submit' id='submit_button' name='submit' value=" . $form[submit] . ">";
    }
	
	check_hook_function('form_table_form_array', $form);
	
	$form = $templates->display_template('form_table', array('form' => $form, 'submit_button' => $submit_button));
	
	check_hook_function('form_table_form_end', $form);
	
    return $form;

  }

  /**
   * adds a hidden form
   * 
   * @param 	string 	$name	name of the input
   * @param 	string 	$value	value of the input
   * @return	string			hidden input form
   */
  function hiddenform($name, $value = '')
  {
	check_hook_function('form_hiddenform', $name);
    return "<input type=\"hidden\" name=\"$name\" value=\"$value\">";
  }

  
  /**
   * handles input form and dispalys it
   * 
   * @param	string 	$title	title of the input
   * @param	string 	$type	type of the input (file or text)
   * @param string 	$name	name of the input
   * @param string 	$full	fill with * to make it a required input
   * @param mixed 	$value	intial value of the input
   * @param int		$size	size of the input box
   * @return string			template containg input form field
   */
  function inputform($title = '', $type, $name, $full = '', $value = '', $size = '35')
  {
    global $templates;
	
	check_hook_function('form_inputform_title', $title);
	check_hook_function('form_inputform_type', $type);
	check_hook_function('form_inputform_value', $value);
	
    if ($full == '')
    {
      $full = "";
    }
    else
    {
      $full = "<font color=\"#FF0000\">*</font>";
    }
	
	$form_array = array('title' => $title,
						'type' => $type,
						'name' => $name,
						'value' => $value,
						'full' => $full,
						'size' => $size);
	$form = $templates->display_template('form_inputform', $form_array);
    
	check_hook_function('form_inputform_end', $form);
    return $form;
  }

 
  /**
   * This function displays smiles next the box of posting a message
   * 
   * @return	mixed 	smiles box
   */
  function smiles()
  {
    global $diy_db, $bgcolor3;
    $form .= "<br>&nbsp;<div align=\"center\">
                 <table border=\"0\" id=\"table14\" cellspacing=\"4\" cellpadding=\"4\" bgcolor=\"#F4F4F4\" style=\"border-style: inset; border-width: 1px\"><tr><td>";
    $result = $diy_db->query("SELECT * FROM diy_smileys ORDER BY id");


    while ($row = $diy_db->dbarray($result))
    {
      extract($row);
      $form .= "<a onclick=\"addtxt('post','$code');\">
                       <img src=\"images/smiles/$smile\" alt=\"$smilename\" border=\"0\" style=\"cursor: pointer;\"></a>&nbsp;";
      $count++;
      if ($count == 3)
      {
        $form .= "<br>";
        $count = 0;
      }

    }
    $form .= "</td></tr></table></div>\n";
    return $form;
  }


  /**
   * This function handles textarea field
   * 
   * @param string $title	textarea title
   * @param string $name	textarea name
   * @param string $value	textarea intial value
   * @param array $info		textarea info array containg cols, row, count, editor type, smiles status (on or off) and required,
   * @return mixed			template containg textarea form field
   */
  function textarea($title = 'Text', $name = 'post', $value = '', $info = array())
  {
    global $templates;

    if (empty($info[cols])) $info["cols"] = "70";
    if (empty($info[rows])) $info["rows"] = "20";

    if (empty($info["count"])) $info["count"] = "1000";

    if ($info[smiles] == "on")
    {
      $smiles = $this->smiles();
    }

    if ($info['editor'] == "bbcode" || $info['bbcode'] == "1" || $info['bbcode'] == "on")
    {
		
		$bbcode = $templates->display_template('form_bbcode');	
     
	  check_hook_function('form_textarea_post_bbcode', $bbcode);
    }
	elseif ($info[editor] == "html" || $info[html] == "1" || $info[html] == "on")
    {
      $html_area = $this->html_area();
	  check_hook_function('form_textarea_post_html_area', $html_area);
	  print $html_area;
    }



    if ($info[required] == 'yes')
    {
      $full = "<font color=\"#FF0000\">*</font>";
    }


    $rows = $info["rows"];
    $cols = $info["cols"];
    $letter_count = $info["count"];

	check_hook_function('form_textarea_post_array', $info);
	
	$form_array = array('title' => $title,
						'name' => $name,
						'value' => $value,
						'rows' => $rows,
						'cols' => $cols,
						'letter_count' => $letter_count,
						'full' => $full,
						'bbcode' => $bbcode
						);
	$form = $templates->display_template('form_textarea_post', $form_array);
   
	check_hook_function('form_textarea_post_end', $form);
	
    return $form;
  }


  /**
   * This function handles multiple selection (accept arrays only)
   * 
   * @param string $title	title of the select form field
   * @param string $name	name of the select form field
   * @param array $options	array of options to populate in the selection form field
   * @param string $value	intial selected value
   * @param string $full	fill with * to make it a required input
   * @return mixed			template containg select form field
   */
  function selectform($title, $name, $options = array(), $value = '', $full = '')
  {
    global $templates;
	
	check_hook_function('form_selectform_title', $title);
	check_hook_function('form_selectform_name', $name);
	check_hook_function('form_selectform_options', $options);
	check_hook_function('form_selectform_value', $value);
	
    $full =  ($full !== '') ? "<font color=\"#FF0000\">*</font>" : '';

    foreach ($options as $key => $option_value)
    {
     $option .= ($key == $value) ? "<option value='$key' selected>$option_value</option>" : "<option value='$key'>$option_value</option>";
     }
	
	$form_array = array('title' => $title,
						'name' => $name,
						'value' => $value,
						'option' => $option,
						'options' => $options,
						'full' => $full,
						);	
	$form .= $templates->display_template('form_selectform', $form_array);
	 
	check_hook_function('form_selectform_end', $form);
    return $form;
  }

  
  /**
   * This function handles group permissions field in the form (used for moderators when adding a category)
   * 
   * @param string 	$msg 	title of the form field
   * @param array	$name	name of the form field
   * @param string 	$value	intial value of the form field
   * @return mixed			template of group permissions
   */
  function group_permission($msg, $name = array(), $value = '')
  {
    global $templates, $diy_db;
	
	check_hook_function('group_permission_start', $name);
	
    $result = $diy_db->query("SELECT * FROM diy_groups ORDER BY groupid ASC");

    while ($row = $diy_db->dbarray($result))
    {
      extract($row);

      $find = strpos($value, $groupid);
      if ($find !== false)
      {
        $check = 'checked';
      }
      else
      {
        $check = '';
      }

      $checkbox .= "<input type=\"checkbox\" name=\"$name\" value=\"$groupid\" $check>$grouptitle<br>";
    }
	
	$form_array = array('msg' => $msg,
						'name' => $name,
						'value' => $value,
						'checkbox' => $checkbox
						);	
						
	$form .= $templates->display_template('form_group_checkbox', $form_array);

	check_hook_function('group_permission_end', $form);
	
    return $form;
  }

  
  /**
   * This function handles checkbox selection
   * 
   * @param mixed 	$title			title of the form field
   * @param array	$name_options	array containing checkbox values and titles
   * @param string 	$value			intial checked values
   * @param string 	$full			fill with * to make it a requrired form field
   * @return mixed					template containing checkbox form field
   */
  function checkbox_selection($title, $name_options = array(), $value = array(), $full = '')
  {
    global $templates;
	
	check_hook_function('checkbox_selection_start', $name_options);
	
	foreach ($name_options as $name => $option)
	{
		$checkbox .= "<input type=\"checkbox\" name=\"$name\" value=\"0\">$option<br>";
	}
	
	$form_array = array('title' => $title,
						'name_options' => $name_options,
						'value' => $value,
						'full' => $full,
						'checkbox' => $checkbox
						);	
						
	$form .= $templates->display_template('form_checkbox_selection', $form_array);

	
	check_hook_function('checkbox_selection_end', $form);
    return $form;
  }
  //---------------------------------------------------
  // This function handles upload field
  //---------------------------------------------------
  /**
   * handles editing file upload, paritcularly attachments
   * 
   * @param string $field_name			name of the input
   * @param string $attachment_name		name of attachment to be edited
   * @return mixed						template with edit upload form field
   */
  function edit_upload($input_name, $post_id, $location, $replace = 'replace[]', $delete = 'delete[]', $new = 'attachment[]')
  {
    global $templates, $diy_db, $mod;
	
	check_hook_function('edit_upload_start', $empty);
	
	$module = $mod->modInfo['mod_name'];
	$file_query = $diy_db->query("SELECT * FROM diy_upload
				WHERE post_id = '$post_id'
				AND location = '$location'
				AND module = '$module'");
	$i = 1;
     while ($files = $diy_db->dbarray($file_query))
       {
		$attachment .= "
		<div class='fontablt'>
		<fieldset style=\"padding: 10px; width:60%\"><legend>($i) $files[name]</legend>
		<table><tr><td><div class='fontablt'>";
		$attachment .= $this->hiddenform('upload_id[]', $files[upid]);
		
		$attachment .= LANG_EDIT_UPLOAD_REPLACE_ATTACHMENT."<br>
		<input type='file' size='30' name='$replace'></div></td>
		<td width='120'><div class='fontablt'><input type=\"checkbox\" value=\"$files[upid]\" name=\"$delete\"><label>".LANG_EDIT_UPLOAD_DELETE_ATTACHMENT."</label></div></td>
		</tr></table>
		</fieldset></div><br>";
		$i++;
		}
	$attachment .= "
		<div class='fontablt'>
		<fieldset style=\"padding: 10px; width:60%\"><legend>".LANG_EDIT_UPLOAD_UPLOAD_NEW."</legend>
		<table><tr><td><div class='fontablt'>
		<input type='file' size='30' name='$new'></div></td>
		<td width='120'><div class='fontablt'></div></td>
		</tr></table>
		</fieldset></div><br>";
	
	$form_array = array('input_name' => $input_name,
						'attachment' => $attachment,
						);
						
	$form .= $templates->display_template('form_edit_upload', $form_array);
	check_hook_function('edit_upload_end', $form);
    return $form;
  }

  
  /**
   * This function handles multiple radio selection. The defualt value is yes and no.
   * This function accepts arrays only as options. If $options is left empty a simple Yes and No values will be loaded
   * 
   * @param mixed $title	title of the form field
   * @param mixed $name		name of the form field
   * @param array $options  array of options to be poulated
   * @param string $value	value of the form field
   * @param string $full	fill with * to make it a requrired field
   * @return mixed			template includ radio selection options
   */
  function radio_selection($title, $name, $options = array(), $value = '0', $full = '')
  {
    global $templates;
	
	check_hook_function('radio_selection_start', $empty);
	
    $full = ($full !== '') ? "<font color=\"#FF0000\">*</font>" : '';

    if (!empty($options))
    {
      foreach ($options as $key => $option_value)
      {
        if ($key == $value)
        {
          $option .= "<input type=\"radio\" name='$name' value='$key' checked>$option_value</option>";
        }
        else
        {
          $option .= "<input type=\"radio\" name='$name' value='$key'>$option_value</option>";
        }
      }
    }
    else
    {

      if ($value == '1')
      {
        $option .= "<input type=\"radio\" name='$name' value='1' checked>".LANG_YES."</option>";
        $option .= "<input type=\"radio\" name='$name' value='0'>".LANG_NO."</option>";
      }
      else
      {
        $option .= "<input type=\"radio\" name='$name' value='1'>".LANG_YES."</option>";
        $option .= "<input type=\"radio\" name='$name' value='0' checked>".LANG_NO."</option>";
      }
    }
	
		$form_array = array('title' => $title,
						'option' => $option,
						);	
						
	$form .= $templates->display_template('form_yesorno', $form_array);
	
	check_hook_function('radio_selection_end', $form);
	
    return $form;

  }

  /**
   * function adds a deleting form field
   * 
   * @param string $name	name of the form field
   * @return mixed			template inclding form field
   */
  function deleteform($name = 'delete')
  {
    global $templates, $global_lang;
	
	check_hook_function('radio_selection_start', $name);
	
	$form_array = array('name' => $name);	
						
	$form .= $templates->display_template('form_delete', $form_array);
	
	check_hook_function('radio_selection_end', $form);
    return $form;
  }

/**
   * handles file upload field
   * 
   * @param	string 	$title	title of the input
   * @param string 	$name	name of the input
   * @param string 	$full	fill with * to make it a required input
   * @param int		$size	size of the input box
   * @param int 	$fields_no	no of maximum fields to display
   * @return string			template containg input form field
   */
  function files_upload($title, $name, $fields_no = 4, $size = '50', $full = '')
  {
    global $templates;
	
	check_hook_function('files_upload_field_no', $fields_no);
	
    $full = ($full == '') ? "" : "<font color=\"#FF0000\">*</font>";
    
	$form =
<<<EOF
	<script type="text/javascript">

		function ShowContent(d) {
		document.getElementById(d).style.display = "block";
		}
		</script>
EOF;

	$form .= "<tr><td nowrap class='info_bar'>$title : $full <br>";
	
	if($fields_no != 1)
	$form .= "<a href='#' onclick=\"ShowContent('files'); return false;\">".LANG_EDIT_UPLOAD_ADD_EXTRA."</a>";
	
	$form .= "</td><td width=\"100%\">";
	$form .= "<div id='hideshow' style='display:block'>";
	
	if($fields_no != 1)
	$form .= "1 ";
	
	$form .= "<input type='file' name=\"$name\" size=\"$size\" class=\"text_box\"></div>";
	$form .= "<div id='files' style='display:none'>";
		for($i = 2; $i<= $fields_no; $i++)
		{
			$form .= "$i <input type='file' name=\"$name\" size=\"$size\" class=\"text_box\"><br>";
		}
	$form .= "</div>";
	$form .= "</td></tr>";
	
	check_hook_function('files_upload_end', $form);

		
    return $form;
  }
  
  
  /**
   *  This function displays html editor when selected in the textarea
   * 
   * @return string 	html editor
   */
  function html_area()
  {
	
	check_hook_function('html_area_start', $empty);
    $form = <<< EOF

<!-- TinyMCE -->
<script type="text/javascript" src="./html/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	// O2k7 skin
	tinyMCE.init({
		// General options
		mode : "exact",
		language : "en",
		elements : "post,post_head",
		directionality : "ltr",
		theme : "advanced",
		skin : "o2k7",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,inlinepopups",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,preview,fullscreen,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor",
		theme_advanced_buttons2 : "visualchars,nonbreaking,pagebreak,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,emotions,|,ltr,rtl,|,fullscreen,|,print",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,|,sub,sup,|,charmap,iespell,media,advhr,|,cut,copy,paste,pastetext,pasteword,|,styleprops,|,del,ins",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "center",
		theme_advanced_toolbar_direction : "rtl",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "./html/tiny_mce/themes/advanced/skins/default/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "khr2003",
			staffid : ""
		}
	});
</script>
<!-- /TinyMCE -->

EOF;

	check_hook_function('html_area_end', $form);
	return $form;
  }
}

?>