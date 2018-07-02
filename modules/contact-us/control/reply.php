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


if (RUN_MODULE !== true)
{
    die ("<center><h3>You are not allowed to access this file directly.</h3></center>");
}

include("modules/".$mod->module."/settings.php");
include("includes/email.class.php");

$index_middle = $mod->nav_bar($lang['REPLY_MESSAGE']);

$mid = set_id_int('mid');

$perm = $mod->setting('manage_msg',$_COOKIE['cgroup']);
$mod->permission($perm);

$message = $diy_db->dbfetch("SELECT * FROM diy_contact where id='$mid' ORDER BY id LIMIT 1");


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

    $fullarr =  array($post);

     if (!required_entries($fullarr))
     {
         error_message($lang['LANG_ERROR_VALIDATE']);
     }

	
		$mail = new email;
        $result = $mail->send($message[email], $lang['REPLY_TITLE'], $post, '', $mod->setting("notification_email"), 0);
	
	if ($result)
    {
        info_message($lang['REPLY_SENT'],"mod.php?mod=contact-us&dir=control");
		$diy_db->query("UPDATE diy_contact set replied_to = 'yes' where id='$mid'");
	}	
		else
		{
		info_message($lang['REPLY_NOT_SENT'],"mod.php?mod=contact-us&dir=control");
		}
    
	
}

$form = new form;
	
	
	

echo $message[email];
	$maximum_letters = get_group_setting('maximum_posts_letters');
	$info = array(
	'smiles' => 'off',
	'rows' => '30',
	'cols' => '60',
	'count' => "$maximum_letters",
	'bbcode' => 'off',
	'required' => 'yes',
	);
	
	$edit_form .= $form->textarea("$lang[MESSAGE]","post","\n\n-------------------\n$lang[YOUR_MESSAGE]\n$message[post]\n-------------------\n",$info);

	
	
		$form_array = array("action"     => "mod.php?mod=contact-us&dir=control&modfile=reply&mid=$mid",
                            "title"      => "$lang[REPLY_MESSAGE]",
                            "name"       => 'edit_sign',
                            "content"    => $edit_form,
							"submit"	=> $lang['SEND_REPLY']
                           );
						   
	$index_middle .= $form->form_table($form_array);
	
echo $index_middle;


?>