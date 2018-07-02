<?php
/*
+===============================================================================+
|      					DIY-CMS V1.0.0 Copyright © 2011   						|
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
 * This file is part of users module
 * 
 * @package	Modules
 * @subpackage	Users
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	1.1
 * @access 	public
 */

checkcookie();

require_once("modules/" . $mod->module . "/settings.php");
require_once('includes/module_templates_stream.class.php');
$perm = $mod->setting('allowed_pm', $_COOKIE['cgroup']);
$mod->permission($perm);

$index_middle = $mod->nav_bar($lang['VIEW_MESSAGE']);
$msgid        = set_id_int('msgid');
$box          = set_id_int('box');
if (!$box)
    $box = 1;


$result = $diy_db->query("SELECT * FROM diy_messages WHERE
    msgid='$msgid' and msgbox='$box' and userid='" . $_COOKIE['cid'] . "' limit 1");

$row = $diy_db->dbarray($result);
if (empty($row))
    error_message($lang['LANG_ERROR_PM_URL']);
extract($row);

$result = $diy_db->dbfetch("SELECT * FROM diy_messages WHERE msgid='$msgid'");
if($result['msgisread'] != '3')
{
$diy_db->query("UPDATE diy_messages SET msgisread ='2' WHERE msgid='$msgid'");
}

// set array for tabs template and display the template
$users_array = array(
    'userid' => $userid,
    'lang' => $lang
);
$index_middle .= $mod->get_template_code('users_usercp_head', $users_array);

eval("\$index_middle .= \" " . $mod->gettemplate('users_pm_head') . "\";");

$bbcode = new bbcode;
$rows   = get_user_info($fromid);

$userid   = $fromid;
$username = format_data_out($rows->username);

$message = $bbcode->format_bbcode($message);
$date    = format_date($msgdate) . " " . format_time($msgdate);

$message_table = array(
    'username' => $username,
    'date' => $date,
    'msgtitle' => $msgtitle,
    'message' => $message,
    'msgid' => $msgid,
    'box' => $box,
	'lang' => $lang
);

$index_middle .= $mod->get_template_code('users_pm_msg_table', $message_table);

echo $index_middle;
?>