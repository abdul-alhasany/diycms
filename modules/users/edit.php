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

 include_once("modules/" . $mod->module . "/settings.php");
 require_once('includes/module_templates_stream.class.php');
 
 $index_middle = $mod->nav_bar($lang['EDIT_PROFILE']);
 
 // check user id
 $userid = set_id_int(userid);
 
 // check if the user has the right permission to edit the user info
 $perm = $mod->setting('edit_member', $_COOKIE['cgroup']);
 
 if (($perm == '') && ($userid != $_COOKIE['cid'])) {
     error_message($lang['EDIT_NOT_ALLOWED']);
 }
 
 // which part to edit
 switch ($_GET['action'])
 {
	// profile part
	case 'profile':
	
	// check if any data is submited
	$submit = $_POST['submit'];
     if ($submit) {
         extract($_POST);
         
         $fullarr = array(
             $email
         );
         
         if (!required_entries($fullarr)) {
             error_message($lang['ERROR_VALIDATE']);
         }
         
         if (!check_email_validity($email)) {
             error_message($lang['ERROR_VALID_EMIAL']);
         }
         
         
         $max_letters = $mod->setting('signature_max_letters');
         if (!maximum_allowed($signature, $max_letters)) {
             error_message($lang['ERROR_LETTER_MAX']);
         }
         // Check user avatar
         $wt_avatar = $mod->setting("avatar_max_width");
         $ht_avatar = $mod->setting("avatar_max_height");
         
         upload_image("avatar", $wt_avatar, $ht_avatar, "$userid.avatar");
         
         $showemail = intval($showemail);         
         $themeid = intval($theme);
         $signature = format_post($signature);
         
		 
         $result = $diy_db->query("UPDATE diy_users set
						  email = '$email',
						  show_email = '$show_email',
						  website = '$website',
						  groupid = '$group_id',
						  gender = '$gender',
						  location = '$location',
						  yahoo = '$yahoo',
						  icq = '$icq',
						  aim = '$aim',
						  hotmail = '$hotmail',
						  themeid = '$themeid',
						  signature = '$signature'
						  where userid='$userid'");
         
         if ($result) {
             info_message($lang['EDIT_SUCCESSFUL'], "mod.php?mod=users&modfile=usercp&userid=$userid");
         } else {
             info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
         }
         
     } 
	 
         $result = $diy_db->query("SELECT * FROM diy_users WHERE userid='$userid'");
         
         $row = $diy_db->dbarray($result);
         extract($row);
         $users_array = array('userid' => $userid, 'lang' => $lang);
         $index_middle .= $mod->get_template_code ( 'users_usercp_head',$users_array );

         $avatarfile = get_file_path("$userid.avatar", 'users');
         if (file_exists($avatarfile)) {
             $avatar_pic = "<img src=filemanager.php?action=avatar&userid=" . $userid . ">";
         } else {
             $avatar_pic = $lang['USERS_NO_AVATAR'];
         }
         
         $form = new form;
         $edit_form .= $form->inputform($lang['WEBSITE'], "text", "website", "", "$website", "30");
         $edit_form .= $form->inputform($lang['EMAIL'], "text", "email", "*", "$email", "30");
         $edit_form .= $form->radio_selection($lang['SHOW_EMAIL'], "showemail", "$show_email");
         
		 // get theme array
         $result = $diy_db->query("select * from diy_themes where usertheme='1' order by id");
         while ($row = $diy_db->dbarray($result)) {
             $id    = $row['id'];
             $theme = $row['theme'];
             
             $theme_array[$id] = $theme;
         }
         
         $edit_form .= $form->selectform($lang['THEME'], "theme", $theme_array,$themeid);
         
		 $perm = $mod->setting('edit_member', $_COOKIE['cgroup']);
		 if($perm)
		 {
		// get users groups
		$result = $diy_db->query("SELECT * from diy_groups where groupid !='5' order by groupid ASC");
     while ($row = $diy_db->dbarray($result)) {
         $group_id             	= $row['groupid'];
         $grouptitle         	= $row['grouptitle'];
         $group_array[$group_id] = $grouptitle;
		
     }
	  $edit_form .= $form->selectform($lang['CONTROL_EMAILUSERS_SELECT_GROUPS'], "group_id", $group_array, $groupid, '');
		 }
		 else
		 {
		 $edit_form .= $form->hiddenform("group_id", $groupid);
		 }
         
         $gender_array = array(
			  'none' => $lang['NONE'],
			  'male' => $lang['MALE'],
			  'female' => $lang['FEMALE'],
         );
		 $avatarfile = get_file_path("$userid.avatar", 'users');
         $avatar_pic = (file_exists($avatarfile)) ? "<img src=filemanager.php?action=avatar&userid=".$userid.">" : "<img src=images/no_pic.gif>";
		 
         $edit_form .= $form->selectform($lang['GENDER'], "gender", $gender_array, "$gender");
         $edit_form .= $form->inputform($lang['LOCATION'], "text", "location", "", "$location", "30");
         $edit_form .= $form->inputform($lang['YAHOO'], "text", "yahoo", "", "$yahoo", "30");
         $edit_form .= $form->inputform($lang['HOTMAIL'], "text", "hotmail", "", "$hotmail", "30");
         $edit_form .= $form->inputform($lang['ICQ'], "text", "icq", "", "$icq", "30");
         $edit_form .= $form->inputform($lang['AIM'], "text", "aim", "", "$aim", "30");
         $edit_form .= "<tr><td nowrap class=\"info_bar\">$lang[CURRENT_AVATAR]:";
		 if(file_exists($avatarfile))
		 $edit_form .= "<br><a href=mod.php?mod=users&modfile=misc&action=delete_avatar&userid=$userid>$lang[USERS_DELETE_CURRENT_AVATAR]</a>";
		 
		 $edit_form .= "
		 </td>
		  <td width=\"100%\">$avatar_pic</td></tr>";
         $edit_form .= $form->inputform($lang['UPLOAD_AVATAR'], "file", "avatar", "");
         
         $max_letters = $mod->setting('signature_max_letters');
         
         $bbcode = $mod->setting('allow_bbcode');
         
         $info = array(
             'smiles' => 'off',
             'rows' => '15',
             'cols' => '60',
             'count' => $max_letters,
             'bbcode' => $bbcode
         );
         $edit_form .= $form->textarea($lang[SIGNATURE], "signature", "$signature", $info);
         $edit_form .= $form->hiddenform("spam", "1");
         
         
         $form_array = array(
             "action" => "mod.php?mod=users&modfile=edit&action=profile&userid=$userid",
             "title" => "$lang[EDIT_PROFILE]",
             "name" => 'edit_profile',
             "content" => $edit_form,
             "submit"	=>  LANG_FORM_EDIT_BUTTON
         );
         
         $index_middle .= $form->form_table($form_array);
	 break;
	 
	 case 'password':
	  $userid = set_id_int(userid);
     
     $submit = $_POST['submit'];
     if ($submit) {
         extract($_POST);
         
         if (maximum_allowed($npassword, 4)) {
             error_message($lang[EDIT_ERROR_PASSWORD_SHORT]);
         }
         if ($npassword != $npassword2) {
             error_message($lang[EDIT_ERROR_PASSWORD_NOT_IDENTICAL]);
         }
         
         $result = $diy_db->query("SELECT password FROM diy_users WHERE userid='" . $_COOKIE['cid'] . "'");
         
         $row = $diy_db->dbarray($result);
         
         if (md5($opassword) != $row["password"]) {
             error_message($lang[EDIT_ERROR_PASSWORD_NOT_CORRECT]);
         }
         
         $npassword = md5($npassword);
         
         $result = $diy_db->query("update diy_users set
                              password='$npassword'
                              WHERE userid='" . $_COOKIE['cid'] . "'");
         if ($result) {
             $login->destroy_coockie();
             
             info_message($lang[EDIT_PASSWORD_CHANGED_SUCCESSFULLY]);
             ;
             
         } else {
             info_message($lang['LANG_ERROR_ADD_DB'], "index.php");
         }
         
     }
     $result = $diy_db->query("SELECT * FROM diy_users WHERE userid='$userid'");
     $row    = $diy_db->dbarray($result);
     extract($row);
     $form = new form;
     $users_array = array('userid' => $userid, 'lang' => $lang);
     $index_middle .= $mod->get_template_code ( 'users_usercp_head',$users_array );
     $changepass = $form->inputform($lang[EDIT_CURRENT_PASSWORD], "password", "opassword", "*");
     $changepass .= $form->inputform($lang[EDIT_NEW_PASSWORD], "password", "npassword", "*");
     $changepass .= $form->inputform($lang[EDIT_CONFIRM_PASSWORD], "password", "npassword2", "*");
     
     $form_array = array(
         "action" => "mod.php?mod=users&modfile=edit&action=password&userid=$userid",
         "title" => "$lang[EDIT_CHANGE_PASSWORD]",
         "name" => 'passwordform',
         "content" => $changepass,
         "submit" => LANG_FORM_EDIT_BUTTON
     );
     
     $index_middle .= $form->form_table($form_array);
     
 
	 break;
	 }
 echo $index_middle;
 
?>