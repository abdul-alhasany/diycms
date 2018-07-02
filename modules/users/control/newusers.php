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


$index_middle = $mod->nav_bar($lang['CONTROL_PENDING_USERS']);

$perm = $mod->setting('approve_new_members',$_COOKIE['cgroup']);

$mod->permission($perm);

$delete = $_POST['delete'];
if($delete)
{
if (count($_POST['select']) > 0)
        {
                 foreach($_POST['select'] as $userid)
                 {
                    $result = $diy_db->query("DELETE from diy_users where userid='$userid'");
				  $i++;
				}
				
				if($result)
				info_message($lang['CONTROL_USERS_REMOVED']);
		}
		else
		{
		info_message($lang['CONTROL_NO_USERS_SELECTED']);
		}
}

$approve = $_POST['approve'];
if($approve)
{
if (count($_POST['select']) > 0)
        {
                 foreach($_POST['select'] as $userid)
                 {
                    $result = $diy_db->query("UPDATE diy_users set activated = 'approved' where userid='$userid'");
				  $i++;
				}
				
				if($result)
				info_message($lang['CONTROL_USERS_APPROVED']);
		}
		else
		{
		info_message($lang['CONTROL_NO_USERS_SELECTED']);
		}
}
  

        $form = new form;

       if(!isset($_GET['start']))
		{$start = '0';
		}else{
		$start = $_GET['start'];
		}
		
            $upp = "50";
            $result =  $diy_db->query("SELECT * FROM diy_users WHERE activated != 'approved'
									  AND userid != '$CONF[Guest_id]'
                                      ORDER BY userid LIMIT $start,$upp");

            while($row = $diy_db->dbarray($result))
            {
                extract($row);
				eval("\$users_row .= \" " . $mod->gettemplate ('users_control_newusers_row') . "\";");

            }

	eval("\$index_middle .= \" " . $mod->gettemplate ('users_control_newusers') . "\";");
		$numrows = $diy_db->dbnumquery("diy_users","activated != 'approved'");
	$index_middle .= pagination($numrows,$upp,"mod.php?mod=users&dir=control&modfile=newusers");
   


echo $index_middle;


?>