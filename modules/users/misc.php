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


require_once('modules/' . $mod->module . '/settings.php');
require_once('includes/email.class.php');

$index_middle = $mod->nav_bar();

$action = $_GET['action'];
switch ($action) {
    
    // login case
    case 'login':
        if (isset($_POST[username]) && isset($_POST[userpass])) {
            extract($_POST);
            $login->destroy_coockie();
            $username = $username;
            $userpass = md5($userpass);
            
            $fullarr = array(
                $username,
                $userpass
            );
            
            if (!required_entries($fullarr)) {
                error_message($lang['LANG_ERROR_VALIDATE']);
            }
            
            $result = $diy_db->query("SELECT * FROM diy_users WHERE
                              (username ='$username') AND
                              (password ='$userpass')");
            
            if ($row = $diy_db->dbnumrows($result) == 0) {
                error_message($lang['ERROR_LOGIN']);
            }
            
            $row = $diy_db->dbarray($result);
            
            if ($row["activated"] !== "approved") {
                error_message($lang['ERROR_NOT_ACTIVATED']);
            }
            
            if (($row["username"] == $username) && ($row["password"] == $userpass)) {
                extract($row);
                $userip    = get_user_ip();
                $logintime = time();
                $cookie    = serialize(array(
                    'DIY-CMS',
                    $activated,
                    $userid,
                    time(),
                    session_id()
                ));
                
                // set cookie
                $login->set_cookie("", base64_encode($cookie));
                
                // create session
                $_SESSION["sessid"]      = $userid;
                $_SESSION["clogin"]      = 'DIY-CMS';
                $_SESSION["sessname"]    = $username;
                $_SESSION["sessadmin"]   = $useradmin;
                $_SESSION["sessgroup"]   = $groupid;
                $_SESSION["sesstheme"]   = $themeid;
                $_SESSION["selastvisit"] = $logintime;
                $_SESSION["selastlogin"] = $logintime;
                
                
                $X_url = explode('/', $_SERVER['HTTP_HOST']);
                $Y_url = explode('/', $_SERVER['HTTP_REFERER']);
                $goto  = (($X_url[0] != $Y_url[2]) OR (strpos($_SERVER['HTTP_REFERER'], 'login_page') !== false)) ? 'index.php' : $_SERVER['HTTP_REFERER'];
                
                
                $diy_db->query("UPDATE diy_users SET userip='$userip',lastlogin='$logintime',activation_code='$activate' WHERE userid='$userid'");
                info_message($lang['LANG_MSG_LOGED_IN'] . $username, $goto);
            }
        }
        break;
    
    // logout case
    case 'logout':
        session_unset();
        session_destroy();
        $login->destroy_coockie();
        header("Refresh: 0;url=" . $_SERVER['HTTP_REFERER']);
        info_message($lang['LANG_MSG_LOGED_OUT']);
        break;
    
    // delete an avatar
    case 'delete_avatar':
        $userid = set_id_int(userid);
        $perm   = $mod->setting('edit_member', $_COOKIE['cgroup']);
        if (($perm == '') && ($userid != $_COOKIE['cid'])) {
            error_message($lang['EDIT_NOT_ALLOWED']);
        }
        
        $avatarfile = get_file_path("$userid.avatar", 'users');
        if (!@unlink($avatarfile)) {
            error_message($lang[MISC_DELETE_UNSUCCESSFUL]);
        } else {
            info_message($lang[MISC_DELETE_SUCCESSFUL], "mod.php?mod=users&modfile=info&userid=$userid");
        }
        break;
    
    // delete a user case
    case 'delete_user':
        $userid = set_id_int('userid');
        $perm   = $mod->setting('edit_member', $_COOKIE['cgroup']);
        $mod->permission($perm);
        
        $result = $diy_db->query("DELETE from diy_users WHERE userid='$userid'");
        if ($result) {
            info_message($lang['EDIT_DELETED_SUCCESSFULY'], "index.php");
        } else {
            info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
        }
        break;
    
    // activiate a user
    case 'activate':
        $get_activate = $_GET['allowid'];
        
        
        $result = $diy_db->query("UPDATE diy_users set activated='approved' WHERE activation_code ='$get_activate'");
        
        if ($result) {
            diy_page_header($lang['ACTIVATION']);
            info_message($lang['ACTIVATION_SUCCESSFUL'], "mod.php?mod=users&modfile=misc&action=login_page");
        } else {
            info_message(LANG_ERROR_ADD_DB, "index.php");
        }
        break;
    
	// remind user of his/her login details
    case 'remind_me':
        if ($_POST['submit']) {
            $email = $_POST['email'];
            if (!check_email_validity($email)) {
                error_message($lang['ERROR_VALID_EMIAL']);
            }
            
            $query = $diy_db->query("SELECT * FROM diy_users WHERE email = '$email' AND activated ='approved'");
            if ($row = $diy_db->dbnumrows($result) == 0) {
                error_message($lang['EMAIL_DOES_NOT_EXIST']);
            } else {
                // send confiramtion email
                $query = $diy_db->dbfetch("SELECT * FROM diy_users WHERE email = '$email'");
                extract($query);
                
                $sitetitle = get_global_setting("sitetitle");
                $sitemail  = get_global_setting("sitemail");
                
                // set new password and send it
                $alpha = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()-+=');
                shuffle($alpha);
                $str_md5 = md5(implode('', array_slice($alpha, 0, 8)));
                $str     = implode('', array_slice($alpha, 0, 8));
                
				// update user info
                $query   = $diy_db->dbfetch("UPDATE diy_users SET password = '$str_md5' WHERE email = '$email'");
                $subject = str_replace('{sitetitle}', $sitetitle, $lang['REMIND_ME_SUBJECT']);
                $replace_array  = array(
                    "{username}" => $username,
                    "{password}" => $str,
                    '{sitetitle}' => $sitetitle
                );
                
                $mail    = new email;
				$message = strtr($lang['REMIND_ME_EMAIL'], $replace_array);
                $mail->send($email, $subject, $message, $sitetitle, $sitemail, 1);
                
                info_message($lang['REMIND_ME_SUCCESSFUL'], "index.php");
            }
        }
        
        $index_middle = $mod->nav_bar($lang['REMIND_ME']);
        
        $form = new form;
        $signup_form .= $form->inputform($lang['EMAIL'], "text", "email", "", "", "30");
        $form_array = array(
            "action" => "mod.php?mod=users&modfile=misc&action=remind_me",
            "title" => $lang['REMIND_ME'],
            "name" => 'remind',
            "content" => $signup_form,
            "submit" => 'Submit'
        );
        $index_middle .= $form->form_table($form_array);
        echo $index_middle;
        break;
    
    
    case 'login_page':
        login();
        break;
    
    default:
        error_message($lang['PAGE_DOES_NOT_EXIST']);
        break;
}
?>