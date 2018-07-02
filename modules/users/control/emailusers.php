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



include("modules/" . $mod->module . "/settings.php");


$index_middle = $mod->nav_bar($lang['CONTROL_EMAIL_USERS']);

$perm = $mod->setting('email_members', $_COOKIE['cgroup']);

$max_letters = get_group_setting('maximum_posts_letters');

$editor_type = get_group_setting('editor_type');
$mod->permission($perm);

if ($_POST['submit']) {
    extract($_POST);
    
    $this_url = explode('/', $_SERVER['HTTP_HOST']);
    $reff_url = explode('/', $_SERVER['HTTP_REFERER']);
    
    if ($this_url[0] !== $reff_url[2]) {
        info_message('No External Post', "mod.php?mod=users&modfile=signup");
    }
    
    $fullarr = array(
        $group_id,
        $title,
        $post
    );
    
    if (!required_entries($fullarr)) {
        error_message($lang['ERROR_VALIDATE']);
    }
    
    $max_letters = $mod->setting('signature_max_letters');
    if (!maximum_allowed($signature, $max_letters)) {
        error_message($lang['ERROR_LETTER_MAX']);
    }
    
    if ($group_id !== "0") {
        $query = "AND groupid = '$group_id'";
    }
    
    $users = $diy_db->query("SELECT * FROM diy_users
						WHERE groupid != '5'
						$query");
    while ($row = $diy_db->dbarray($users)) {
        extract($row);
        
        $fromid   = $_COOKIE['cid'];
        $fromname = $_COOKIE['cname'];
        $msgdate  = time();
        
        
        $result = $diy_db->query("INSERT INTO diy_messages (msgbox,
														userid,
														msgdate,
                                                            msgisread,
                                                            msgtitle,
                                                            message,
                                                            fromid,
                                                            fromname,
                                                            toid,
															toname)
                                                      VALUES
                                                            ('1',
															'$userid',
															'$msgdate',
                                                            '1',
                                                            '$title',
                                                            '$post',
                                                            '$fromid',
                                                            '$fromname',
                                                            '$userid',
															'$username')");
    }
    
    
    if ($result) {
        info_message($lang['MESSAGE_SENT_SUCCESSFUL'], "mod.php?mod=users&dir=control");
    } else {
        info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
    }
    
}





$form           = new form;
$group_array[0] = $lang['CONTROL_EMAILUSERS_ALL_GROUPS'];
$result         = $diy_db->query("SELECT * from diy_groups where groupid !='5' order by groupid ASC");
while ($row = $diy_db->dbarray($result)) {
    $groupid               = $row['groupid'];
    $grouptitle            = $row['grouptitle'];
    $group_array[$groupid] = $grouptitle;
}




$info = array(
    'smiles' => 'off',
    'rows' => '15',
    'cols' => '60',
    'count' => "$max_letters",
    'editor' => "$editor_type",
    'required' => 'yes'
);
$send_message .= $form->selectform($lang['CONTROL_EMAILUSERS_SELECT_GROUPS'], "group_id", $group_array, '', '*');
$send_message .= $form->inputform($lang['CONTROL_EMAILUSERS_MSG_TITLE'], "text", "title", "*");
$send_message .= $form->textarea($lang['CONTROL_EMAILUSERS_MSG_POST'], "post", "", $info);


$form_array = array(
    "action" => "mod.php?mod=users&dir=control&modfile=emailusers",
    "title" => $lang['CONTROL_EMAIL_USERS'],
    "name" => 'signupform',
    "content" => $send_message,
    "submit" => 'Submit'
);

$index_middle .= $form->form_table($form_array);



echo $index_middle;


?>