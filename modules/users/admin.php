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

	
$index_middle = $mod->nav_bar($guestbook_lang['ADMIN_SIGN']);
$bbcode = new bbcode;

$perm = $mod->setting('edit_sign',$_COOKIE['cgroup']);
$mod->permission($perm);
$spp = $mod->setting('signs_per_page');

			

		if(!isset($_GET['start']))
		{$start = '0';
		}else{
		$start = $_GET['start'];
		}
$approve = $_POST['approve'];
if($approve)
{
if (count($_POST['select']) > 0)
        {
                 foreach($_POST['select'] as $sid)
                 {
                    $result = $diy_db->query("UPDATE diy_guestbook set allow = 'yes' where id='$sid'");
				}
				if($result)
				info_message($guestbook_lang['SINGS_APPROVE'],"mod.php?mod=guestbook&modfile=admin");
		}
		else
		{
		info_message($guestbook_lang['NO_SIGNS_SELECTED'],"mod.php?mod=guestbook&modfile=admin");
		}
}
	
$delete = $_POST['delete'];
if($delete)
{
if (count($_POST['select']) > 0)
        {
                 foreach($_POST['select'] as $sid)
                 {
                    $result = $diy_db->query("DELETE from diy_guestbook where id='$sid'");
				}
				if($result)
				info_message($guestbook_lang['SINGS_REMOVED'],"mod.php?mod=guestbook");
		}
		else
		{
		info_message($guestbook_lang['NO_SIGNS_SELECTED'],"mod.php?mod=guestbook");
		}
}
eval("\$index_middle .= \" " . $mod->gettemplate ('guestbook_admin_top') . "\";");

$result = $diy_db->query("SELECT * FROM diy_guestbook where allow='no' ORDER BY id DESC LIMIT $start,$spp");
 while($row = $diy_db->dbarray($result))
    {
        extract($row);
		$sid			=	format_data_out($id);
		$username       =  format_data_out($username);
		$date_time      =  format_date(date_time)." ".format_time(date_time);
		$email        	=  format_data_out($email);
		$website     	=  format_data_out($website);
		$post      		=  $bbcode->format_bbcode($post);

		eval("\$index_middle .= \" " . $mod->gettemplate ('guestbook_admin_sign_table') . "\";");
	}
	
	$numrows = $diy_db->dbnumquery("diy_guestbook","allow='no'");
	if($numrows == '0')
	$index_middle .= $guestbook_lang['NO_SIGNS_TO_MANAGE'];
	$index_middle .= pagination($numrows,$spp,"mod.php?mod=guestbook");
	
	eval("\$index_middle .= \" " . $mod->gettemplate ('guestbook_admin_bottom') . "\";");
	

echo $index_middle;

                  
?>