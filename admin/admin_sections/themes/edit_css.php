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

if (RUN_SECTION !== true) {
   die("<center><h3>" . lang('ACCESS_NOT ALLOWED') . "</h3></center>");
}

// assing admin session to a variable for later and easier use
$session = $auth->get_sess();

// get some ids and info
$themeid = set_id_int('themeid');

// check if any data is posted
if ($_POST['submit']) {
   extract($_POST);
   
   
   // write updated css to the file
   $css = str_replace('\r\n', '
', $css);
	$file_css = stripslashes($css);
   file_put_contents($CONF['site_path'] . "/themes/$themepath/style.css", $file_css);
   
   // update database 
   $result = $diy_db->query("UPDATE diy_themes SET  pagehd='$header',
													pageft ='$footer'
													WHERE id ='$themeid'");
   if ($result) {
      info_msg(lang('THEMES_CSS_EDIT_SUCCESSFULL'), "sections.php?section=themes&$session");
   }
}

// Build navigation
$nav_array = array(
   lang('THEMES_INDEX_TITLE') => "sections.php?section=themes&$session",
   lang('THEMES_CSS_TITLE')
);

// set navigation
$content .= $this->nav_bar($nav_array);

// retrive theme info
$theme_results = $diy_db->query("SELECT * FROM diy_themes
						   WHERE id= '$themeid'
						   LIMIT 1");

$theme_array = $diy_db->dbarray($theme_results);
extract($theme_array);

// check if the style file exits in the theme folder otherwise get from the css folder
if (file_exists($CONF['site_path'] . "/themes/$themepath/style.css")) {
   $style = file_get_contents($CONF['site_path'] . "/themes/$themepath/style.css");
} else {
   $style = file_get_contents($CONF['site_path'] . "/html/css/" . $theme . ".css");
}

// do some replecemnts in order to add the style file inside the theme folder rather than in the html/css folder
$style = preg_replace('@../../themes/(\w+)/@', "", $style);
$style = preg_replace('@themes/(\w+)/@', "", $style);
$style = str_replace('../bbcode', '../../html/bbcode', $style);

// build form
$form = form_textarea(lang('THEMES_CSS_STYLE_SHEET'), 'css', $style, $info = array(
   'cols' => '100',
   'rows' => '30'
));
$form .= form_textarea(lang('THEMES_CSS_THEME_HEADER'), 'header', $pagehd, $info = array(
   'cols' => '100',
   'rows' => '30'
));
$form .= form_textarea(lang('THEMES_CSS_THEME_FOOTER'), 'footer', $pageft, $info = array(
   'cols' => '100',
   'rows' => '30'
));
$form .= form_hidden('themepath', $themepath);

// output form
$form_array = array(
   "action" => "sections.php?section=themes&file=edit_css&themeid=$themeid&$session",
   "title" => lang('THEMES_CSS_TITLE'),
   "name" => 'edit_css',
   "content" => $form,
   "submit" => lang('EDIT')
);
$content .= form_output($form_array);

echo $content;

?>