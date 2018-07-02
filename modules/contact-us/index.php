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


include("modules/".$mod->module."/settings.php");
include("includes/email.class.php");

$index_middle = $mod->nav_bar($lang['ADD_MESSAGE']);

$perm = $mod->setting('send_msg',$_COOKIE['cgroup']);
$mod->permission($perm);

$submit  = $_POST['submit'];

if($submit)
{
extract($_POST);

    if($CONF['mach_ip'] == 1){
    $this_url = explode('/',$_SERVER['HTTP_HOST']);
    $reff_url = explode('/',$_SERVER['HTTP_REFERER']);

    if($this_url[0] !== $reff_url[2])
    info_message('No external link',"mod.php?mod=contact-us");
    }

    $fullarr =  array($username,$email,$post);

     if (!required_entries($fullarr))
     {
         error_message($lang['LANG_ERROR_VALIDATE']);
     }

     if(!check_email_validity($email))
     {
         error_message($lang['LANG_ERROR_VALIDATE_EMAIL']);
     }

    if (!maximum_allowed($post,$mod->setting("max_letters")))
    {
        error_message($error_mxs);
    }

	$userid 		= $_COOKIE['cid'];
    $timestamp 		= time();
	$ip				= get_user_ip();
	
    $Spams  = new Spams();
    if( $Spams->checkSpams() == false )
    {
        info_message($lang['LANG_ERROR_WAIT_SECONDS'],'mod.php?mod=contact-us');
    }
	
	if($mod->setting("notification_type") == 'database')
	{
    $result= $diy_db->query("insert into diy_contact
                          (userid,name,title,email,website,post,date_added,ip) values
                          ('$userid','$username','$title','$email','$website','$post','$timestamp','$ip')");
	}
	elseif($mod->setting("notification_type") == 'email')
	{
		$mail = new email;
        $result = $mail->send($mod->setting("notification_email"), $title, $post, $username, $email, 0);
	}
	else
	{
		info_message('Message could not be delivered',"mod.php?mod=contact-us");
	}
    
	if ($result)
    {
        info_message($lang['MESSAGE_SENT'],"mod.php?mod=contact-us");
	}	
		else
		{
		info_message($lang['MESSAGE_NOT_SENT'],"mod.php?mod=contact-us");
		}
    
	
}
else
{

$form = new form;
	
	$max_letters = $mod->setting("max_letters");
	
	$array_values = explode("\n", $mod->setting("message_types"));
	$title_array = array_combine(array_values($array_values),$array_values);
	
	$add_form .= $form->inputform($lang['USERNAME'],"text","username","*","");
	$add_form .= $form->inputform($lang['EMAIL'],"text","email","*","");
	$add_form .= $form->inputform($lang['WEBSITE'],"text","website","","");
	$add_form .= $form->selectform($lang['SELECT_TITLE'], "title", $title_array, '', '*');
	$info = array(
	//'smiles' => 'on',
	'rows' => '15',
	'cols' => '60',
	'count' => "$max_letters",
	//'bbcode' => 'on',
	'required' => 'yes',
	);
	$add_form .= $form->textarea($lang['SEND_MESSAGE'],"post","",$info);

		$form_array = array("action"     => "mod.php?mod=contact-us",
                            "title"      => $lang['SEND_MESSAGE'],
                            "name"       => 'add_sign',
                            "content"    => $add_form,
							"submit"	=> $lang['SUBMIT']
                           );
						   
	$index_middle .= $form->form_table($form_array);

echo $index_middle;
}

?>