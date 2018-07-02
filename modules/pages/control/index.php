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
  * This file is part of pages module
  * 
  * @package	Modules
  * @subpackage	Pages
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

include("modules/".$mod->module."/settings.php");

	
$index_middle = $mod->nav_bar($lang['ADMIN_PAGES']);

$perm = $mod->setting('edit_page',$_COOKIE['cgroup']);
$mod->permission($perm);

$approve = $_POST['approve'];
if($approve)
{
if (count($_POST['select']) > 0)
        {
                 foreach($_POST['select'] as $sid)
                 {
                    $result = $diy_db->query("UPDATE diycms_pages set allow = 'yes' where id='$sid'");
				}
				if($result)
				info_message($lang['PAGES_APPROVED'],"mod.php?mod=forum&dir=control");
		}
		else
		{
		info_message($lang['NO_PAGES_SELECTED'],"mod.php?mod=forum&dir=control");
		}
}
	
$delete = $_POST['delete'];
if($delete)
{
if (count($_POST['select']) > 0)
        {
                 foreach($_POST['select'] as $sid)
                 {
                    $result = $diy_db->query("DELETE from diycms_pages where id='$sid'");
				}
				if($result)
				info_message($lang['PAGES_REMOVED'],"mod.php?mod=forum&dir=control");
		}
		else
		{
		info_message($lang['NO_PAGES_SELECTED'],"mod.php?mod=forum&dir=control");
		}
}
eval("\$index_middle .= \" " . $mod->gettemplate ('pages_admin_top') . "\";");

$result = $diy_db->query("SELECT * FROM diycms_pages where allow='no' ORDER BY id DESC");
 while($row = $diy_db->dbarray($result))
    {
		$row			=	format_data_out($row);
		extract($row);

		eval("\$index_middle .= \" " . $mod->gettemplate ('pages_admin_pending_list') . "\";");
	}
	
	$numrows = $diy_db->dbnumquery("diycms_pages","allow='no'");
	if($numrows == '0')
	$index_middle .= $lang['NO_PAGES_TO_MANAGE'];

	
	eval("\$index_middle .= \" " . $mod->gettemplate ('pages_admin_bottom') . "\";");
	

echo $index_middle;

                  
?>