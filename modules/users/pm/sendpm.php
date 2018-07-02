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

require_once("modules/".$mod->module."/settings.php");
require_once("includes/email.class.php");
require_once ('includes/module_templates_stream.class.php');

checkcookie();
$perm = $mod->setting('allowed_pm',$_COOKIE['cgroup']);
$mod->permission($perm);

$index_middle = $mod->nav_bar($lang['PM_SENDPM_SENDPM']);

    $userid = (int) $_GET['userid'];
	
	// set array for tabs template and display the template
$users_array = array(
    'userid' => $userid,
    'lang' => $lang
);
$index_middle .= $mod->get_template_code('users_usercp_head', $users_array);


    if(isset($userid))
    {
        $result      = $diy_db->query("SELECT username FROM diy_users where userid='$userid'");
        $row         = $diy_db->dbarray($result);
        $tousername  = $row[username];
    }
	
if($_POST['submit'])
{
 extract($_POST);
     $arr_post_vars = array($msgtitle,
                            $username,
                            $message);
                            
    if (!required_entries($arr_post_vars))
    {
        error_message($lang['LANG_ERROR_VALIDATE']);
    }
    
    $result    = $diy_db->query("SELECT email,username,userid FROM diy_users where username='$username' and userid != '$CONF[Guest_id]'");
	
    if ($diy_db->dbnumrows($result) == 0){
       error_message($lang['PM_SENDPM_USERNAME_NOT_EXIST']);
    }

    $row       = $diy_db->dbarray($result);
    $toid      = $row['userid'];
    $email     = $row['email'];

    $nummsg    = $diy_db->dbnumquery("diy_messages","userid='$toid' and msgbox='1'");
    $maxpmuser = $mod->setting('maximum_messages');
    
    if ($nummsg >= $maxpmuser)
    {
       error_message($lang['PM_SENDPM_USER_INBOX_FULL']);
    }
    
    $nummsg = $diy_db->dbnumquery("diy_messages","userid='".$_COOKIE['cid']."' and msgbox='2'");

    if ($nummsg >= $maxpmuser)
    {
       error_message($lang['PM_SENDPM_YOUR_OUTBOX_FULL']);
    }
    
    $fromid   = $_COOKIE['cid'];
    $fromname  = $_COOKIE['cname'];
    $msgdate   = time();
	
    $result    = $diy_db->query("INSERT INTO diy_messages (msgbox,
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
															'$toid',
															'$msgdate',
                                                            '1',
                                                            '$msgtitle',
                                                            '$message',
                                                            '$fromid',
                                                            '$fromname',
                                                            '$toid',
															'$username')");
   $id        = $diy_db->insertid();
    if ($result)
    {
															
        $result_box    = $diy_db->query("INSERT INTO diy_messages (msgbox,
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
                                                            ('2',
															'$fromid',
															'$msgdate',
                                                            '1',
                                                            '$msgtitle',
                                                            '$message',
                                                            '$fromid',
                                                           '$fromname',
                                                            '$toid',
															'$username')");
															
															
															
        $name      = $_COOKIE['cname'];
        $sitetitle = get_global_setting("sitetitle");
        $sitemail  = get_global_setting("sitemail");
        if(substr(get_global_setting("siteURL"),-1) != '/'){
        $url = get_global_setting("siteURL") . '/';
        }
		
				$url       = $url."mod.php?mod=users&dir=pm&modfile=viewmsg&msgid=$id&box=1&tab=2";
                $replace_array   =  array( "{name}"  => $name ,
                             "{sitetitle}" => $sitetitle,
                             "{url}"       => $url);
                
                $mail    = new email;
				$message = strtr($lang['MESSAGE_NOTIFICATION'], $replace_array);
                $mail->send($email, $mod->setting('alert_pm_title'), $message, $sitetitle, $sitemail, 1);
				
        
      
        info_message($lang['PM_SENDPM_MSG_IS_SENT'],"mod.php?mod=users&dir=pm&box=2&tab=2");
    }
    else
    {
    
        info_message($lang['PM_SENDPM_MSG_IS_NOT_SENT']);
    }
}


    eval("\$index_middle .= \" " . $mod->gettemplate ( 'users_pm_head' ) . "\";");


     $form = new form;
	
     $send_form .= $form->inputform   ($lang['PM_SENDPM_SENDTO'],"text","username","*",$tousername);
     $send_form .= $form->inputform   ($lang['PM_SENDPM_MSG_TITLE'],"text","msgtitle","*","","30");
	 
	 $info = array(
	'smiles' => 'on',
	'rows' => '15',
	'cols' => '60',
	'count' => "$max_letters",
	'bbcode' => "on",
	'required' => 'yes'
	);
	
     $send_form .= $form->textarea    ($lang['PM_SENDPM_MSG_TEXT'],"message","",$info);


     $output = array("action"      => "mod.php?mod=users&dir=pm&modfile=sendpm",
                     "title"      => $lang['PM_SENDPM_SENDPM'],
                     "name"       => 'sendpm',
                     "content"    => $send_form,
                     "submit"	=>  LANG_FORM_ADD_BUTTON
                      );
         $index_middle  .= $form->form_table($output);
     
	 echo $index_middle;
	 
	 ?>