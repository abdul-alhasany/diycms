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

	
$index_middle = $mod->nav_bar($lang['ADMIN_MESSAGES']);
$bbcode = new bbcode;

$perm = $mod->setting('manage_msg',$_COOKIE['cgroup']);
$mod->permission($perm);
$spp = 30;

			

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
                    $result = $diy_db->query("UPDATE diy_contact set replied_to = 'yes' where id='$sid'");
				}
				if($result)
				info_message($lang['MESSAGES_READ'],"mod.php?mod=contact-us&dir=control&modfile=index");
		}
		else
		{
		info_message($lang['NO_MESSAGES_SELECTED'],"mod.php?mod=contact-us&dir=control&modfile=index");
		}
}
	
$delete = $_POST['delete'];
if($delete)
{
if (count($_POST['select']) > 0)
        {
                 foreach($_POST['select'] as $sid)
                 {
                    $result = $diy_db->query("DELETE from diy_contact where id='$sid'");
				}
				if($result)
				info_message($lang['MESSAGES_REMOVED'],"mod.php?mod=contact-us");
		}
		else
		{
		info_message($lang['NO_MESSAGES_SELECTED'],"mod.php?mod=contact-us");
		}
}


$result = $diy_db->query("SELECT * FROM diy_contact ORDER BY replied_to,date_added ASC LIMIT $start,$spp");
 while($row = $diy_db->dbarray($result))
    {
        extract($row);
		$row			=	format_data_out($row);
		$date_added      =  format_date($date_added)." ".format_time($date_added);
		if($replied_to == 'no')
		eval("\$manage_msg_row .= \" " . $mod->gettemplate ('contact-us_admin_msg_row_pending') . "\";");
		else
		eval("\$manage_msg_row .= \" " . $mod->gettemplate ('contact-us_admin_msg_row') . "\";");
	}
	eval("\$index_middle .= \" " . $mod->gettemplate ('contact-us_admin_list') . "\";");
	
	$numrows = $diy_db->dbnumquery("diy_contact","");
	if($numrows == '0')
	$index_middle .= $lang['NO_MSG_TO_MANAGE'];
	$index_middle .= pagination($numrows,$spp,"mod.php?mod=contact-us&dir=control");
	
	eval("\$index_middle .= \" " . $mod->gettemplate ('contact-us_control_buttons') . "\";");
	

echo $index_middle;

                  
?>