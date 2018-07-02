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



include("modules/".$mod->module."/settings.php");


$index_middle = $mod->nav_bar($lang['CONTROL_NEWUSER_ADD_USER']);

$perm = $mod->setting('edit_member',$_COOKIE['cgroup']);

$mod->permission($perm);

if($_POST['submit'])
{

  if ($mod->setting('allow_registration') == '0')
    {
        error_message($lang['REGISTERATION_CLOSED']);
    }
	
    extract($_POST);

    $this_url = explode('/',$_SERVER['HTTP_HOST']);
    $reff_url = explode('/',$_SERVER['HTTP_REFERER']);

    if($this_url[0] !== $reff_url[2]){
    info_message('ÚÝæÇ ... áÇ íãßäß ÊÓÌíá ãÓÊÎÏã ãä ÎÇÑÌ ÇáãæÞÚ',"mod.php?mod=users&modfile=signup");
    }

    $fullarr =  array($username,$password,$email);

    if (!required_entries($fullarr))
    {
        error_message($lang['ERROR_VALIDATE']);
    }

    if (!check_name_validity($username))
    {
        error_message ($lang['ERROR_USERNAME_MUST_BE']);
    }
    
    if (minimum_allowed($username,2))
    {
        error_message($lang['ERROR_USERNAME_MUST_MORE']);
    }
    
  if (!check_existence("username",$username))
    {
        error_message($lang['ERROR_USERNAME_EXISTED']);
    }

    if (minimum_allowed($password,3))
    {
        error_message($lang['ERROR_PASS_MUST_MORE']);
    }

 
  if (!check_email_validity($email))
    {
        error_message($lang['ERROR_VALID_EMIAL']);
    }
  
    if (!check_existence("email",$email))
    {
        error_message($lang['ERROR_EMIAL_EXISTED']);
    }
	$max_letters = $mod->setting('signature_max_letters');
    if (!maximum_allowed($signature,$max_letters))
    {
        error_message($lang['ERROR_LETTER_MAX']);
    }

	$showemail = intval($showemail);
	
	$birthdate  = 	check_birthdate($birthdate);
	$themeid = intval($theme);
    $signature = format_post($signature);
    $activation_code  = generate_activation_code();
    $register_date  = time();

	$password = md5($password);
    $result=$diy_db->query("insert into diy_users (username,
                                                    password,
                                                    groupid,
                                                    email,
													show_email,
                                                    website,
                                                    gender,
                                                    birthdate,
													location,
                                                    yahoo,
                                                    hotmail,
                                                    icq,
                                                    aim,
                                                    avatar,
													activated,
													activation_code,
													themeid,
													register_date,
													signature
												)
                                              values
                                                    ('$username',
                                                    '$password',
                                                    '4',
                                                    '$email',
													'$showemail',
                                                    '$website',
                                                    '$gender',
                                                    '$birthdate',
													'$location',
                                                    '$yahoo',
                                                    '$hotmail',
                                                    '$icq',
                                                    '$aim',
                                                    '$avatar',
													'approved',
													'$activation_code',
													'$themeid',
													'$register_date',
													'$signature')");

   if ($result)
   {
   	
            info_message($lang['SUCCESSFUL_REGISTRATION'],"mod.php?mod=users&dir=control");
    }
   
   else
   {
        info_message($lang['LANG_ERROR_ADD_DB'],"index.php");
   }
   
}else{
  

   


        $form = new form;

        $signup_form .= $form->inputform  ($lang['USERNAME'],"text", "username","*");
        $signup_form .= $form->inputform  ($lang['PASSWORD'],"password", "password","*");
        $signup_form .= $form->inputform  ($lang['EMAIL'],"text", "email","*","","30");
		$signup_form .= $form->radio_selection	($lang['SHOW_EMAIL'], "showemail", 0);
		
		$result = $diy_db->query("select * from diy_themes where usertheme='1' order by id");
		while($row = $diy_db->dbarray($result))
        {
           $id = $row['id'];
		   $theme = $row['theme'];
		   
		   $theme_array[$id] =  $theme;
        }
		$signup_form .= "<tr><td colspan=2 align=\"center\">$lang[OPTIONAL]</td></tr>";
		$signup_form .= $form->inputform  ($lang['WEBSITE'],"text", "website","","","30");
		$signup_form .= $form->selectform   ($lang['THEME'], "theme", $theme_array);
        
		$gender_array = array(
        'none' => $lang['NONE'],
        'male' => $lang['MALE'],
        'female' => $lang['FEMALE']
    );
        $signup_form .= $form->selectform   ($lang['GENDER'], "gender", $gender_array);
        $signup_form .= $form->inputform  ($lang['BIRTHDATE'],"text", "birthdate","","","30");
		$signup_form .= $form->inputform  ($lang['LOCATION'],"text", "location","","","30");
		$signup_form .= $form->inputform  ($lang['YAHOO'],"text", "yahoo","","","30");
		$signup_form .= $form->inputform  ($lang['HOTMAIL'],"text", "hotmail","","","30");
		$signup_form .= $form->inputform  ($lang['ICQ'],"text", "icq","","","30");
		$signup_form .= $form->inputform  ($lang['AIM'],"text", "aim","","","30");

	$max_letters = $mod->setting('signature_max_letters');
	
	$bbcode = $mod->setting('allow_bbcode');

	$info = array(
	'smiles' => 'off',
	'rows' => '15',
	'cols' => '60',
	'count' => "$max_letters",
	'bbcode' => "$bbcode",
	);
	$optional .= $form->textarea($lang[SIGNATURE],"signature","",$info);	
	$signup_form .= $form->hiddenform  ("spam","1");
	
	 $form_array = array("action"     => "mod.php?mod=users&dir=control&modfile=adduser",
                            "title"      => $lang['CONTROL_NEWUSER_ADD_USER'],
                            "name"       => 'signupform',
                            "content"    => $signup_form,
							"submit"	=> 'Submit'
                           );
						   
	$index_middle .= $form->form_table($form_array);
   
}

echo $index_middle;


?>