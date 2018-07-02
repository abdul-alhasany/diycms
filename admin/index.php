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
  * This is a global file for admin section. It has to be included in all admin files in order for them to work correctly.
  * 
  * @package	Admin
  * @subpackage	Files
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

require "global.php";

if (isset($_POST['user_name'])) {
 $auth->login();
}

if (isset($_GET['logout'])) {
 if ($auth->logout() == true) {
  info_msg(lang('ADMIN_LOGIN_LOGOUT_DONE'), "index.php");
 }
}

$auth->view_login_form();

if($_POST['submit'])
{
	$result = $diy_db->query("UPDATE diy_settings set value = '{$_POST['admin_note']}' WHERE variable='admin_note'");
}

// check libraries, functions and versions
$gd_stauts    = (extension_loaded('gd')) ? lang('INDEX_ENABLED') : lang('INDEX_DISABLED');
$magic_status = (php_ini_loaded_file()) ? php_ini_loaded_file() : lang('INDEX_DISABLED');
$zlib         = (extension_loaded('zlib')) ? lang('INDEX_ENABLED') : lang('INDEX_DISABLED');
$xml          = (extension_loaded('xml')) ? lang('INDEX_ENABLED') : lang('INDEX_DISABLED');
$mysqli       = (extension_loaded('mysqli')) ? lang('INDEX_ENABLED') : lang('INDEX_DISABLED');
$zip          = (extension_loaded('zip')) ? lang('INDEX_ENABLED') : lang('INDEX_DISABLED');
$pdf          = (extension_loaded('pdf')) ? lang('INDEX_ENABLED') : lang('INDEX_DISABLED');
$pear         = (ini_get('include_path')) ? lang('INDEX_ENABLED') : lang('INDEX_DISABLED');
$curl         = (function_exists('curl_version()')) ? lang('INDEX_ENABLED') : lang('INDEX_DISABLED');
//$rewrite      = (in_array('mod_rewrite', apache_get_modules())) ? lang('INDEX_ENABLED') : lang('INDEX_DISABLED');

// store results to this template to include it in the outer template
$row_array = array(
 lang('INDEX_DIY_VERSION') => get_diycms_version(true),
 lang('INDEX_PHP_VERSION') => phpversion(),
 lang('INDEX_MYSQL_VERSION') => mysql_get_server_info(),
 lang('INDEX_ZEND_VERSION') => zend_version(),
 //lang('INDEX_MOD_REWRITE') => $rewrite,
 lang('INDEX_GD_LIBRARY') => $gd_stauts,
 lang('INDEX_ZLIP_LIBRARY') => $zlib,
 lang('INDEX_XML_LIBRARY') => $xml,
 lang('INDEX_MYSQLI_LIBRARY') => $mysqli,
 lang('INDEX_ZIP_LIBRARY') => $zip,
 lang('INDEX_PDF_LIBRARY') => $pdf,
 lang('INDEX_PEAR_LIBRARY') => $pear,
 lang('INDEX_CURL_LIBRARY') => $curl,
 lang('INDEX_MAGIC_QOUTES') => get_magic_quotes_gpc(),
 lang('INDEX_PHP_INI_PATH') => $magic_status,
 lang('INDEX_SAFE_MODE') => ini_get('safe_mode'),
 lang('INDEX_MEMORY_LIMIT') => ini_get('memory_limit'),
 lang('INDEX_ERROR_DISPLAY') => ini_get('display_errors'),
 lang('INDEX_LOG_ERRORS') => ini_get('log_errors'),
 lang('INDEX_OS') => php_uname('a')
);

foreach ($row_array as $key => $value) {
 $new_array = array(
  '{TITLE}' => $key,
  '{CELL}' => $value
 );
 $rows .= $admin_templates->get_template('table_row.tpl.php', $new_array);
}

// get the outer template, replace values and then print it
$content .= $admin_templates->get_template('index_table.tpl.php', array(
 '{SPEC_ROWS}' => $rows
));

output($content);

?>