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
include("modules/" . $mod->module . "/settings.php");

$perm = $mod->setting('allowed_pm', $_COOKIE['cgroup']);

$mod->permission($perm);

$box = $_POST['box'];
echo "====== $box ======";
$do  = $_POST['do'];
switch ($do) {
	
    case 'del':
        checkcookie();
        if (!count($_POST['msgsid']) > 0) {
            info_message("$lang[MANAGE_MESSAGE_IS_NOT_SELECTED]");
        } else {
            foreach ($_POST['msgsid'] as $id) {
                $result = $diy_db->query("delete from diy_messages
                                      WHERE msgid='$id'
                                      and userid='" . $_COOKIE['cid'] . "'");
                
            }
        }
        
        if ($result) {
            info_message($lang['MANAGE_SELECTED_MESSAGES_DELETED'], "mod.php?mod=users&dir=pm&box=$box&tab=2");
            
        }
        break;
    
    case 'read':
        if (!count($_POST['msgsid']) > 0) {
            info_message("$lang[MANAGE_MESSAGE_IS_NOT_SELECTED]");
        } else {
            foreach ($_POST['msgsid'] as $id) {
                $result = $diy_db->query("update diy_messages set msgisread='2'
                                      WHERE msgid='$id'
                                      and userid='" . $_COOKIE['cid'] . "'");
                
            }
        }
        
        if ($result) {
            info_message($lang['MANAGE_SELECTED_MESSAGES_MARKED_READ'], "mod.php?mod=users&dir=pm&box=$box&tab=2");
            
        }
        break;
    
    case 'unread':
        if (!count($_POST['msgsid']) > 0) {
            info_message($lang['MANAGE_MESSAGE_IS_NOT_SELECTED']);
        } else {
            foreach ($_POST['msgsid'] as $id) {
                $result = $diy_db->query("update diy_messages set msgisread='1'
                                      WHERE msgid='$id'
                                      and userid='" . $_COOKIE['cid'] . "'");
                
            }
        }
        
        if ($result) {
            info_message($lang['MANAGE_SELECTED_MESSAGES_MARKED_UNREAD'], "mod.php?mod=users&dir=pm&box=$box&tab=2");
            
        }
        break;
    
    default:
        info_message($lang['MANAGE_NO_ACTIONS_SELECTED'], "mod.php?mod=users&dir=pm&box=$box&tab=2");
        break;
}

?>