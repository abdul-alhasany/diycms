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
require_once('includes/module_templates_stream.class.php');

$index_middle = $mod->nav_bar($lang['USER_INFO']);

$userid =  set_id_int(userid);

    $result = $diy_db->dbfetch("SELECT * FROM diy_users WHERE userid='$userid'");

    $row     =  format_data_out($result);


    $avatarfile = get_file_path("$userid.avatar", 'users');
    $avatar_pic = (file_exists($avatarfile)) ? "<img src=filemanager.php?action=avatar&userid=".$userid.">" : "<img src=images/no_pic.gif>";
    
	foreach($row as $key => &$value)
	{
		if(empty($value))
		$value = $lang['NONE'];
	}
	
	
 $perm = $mod->setting('edit_member', $_COOKIE['cgroup']);
	
	// set array for user info template and display it
	$user_info = array('row' => $row, 'lang' => $lang, 'avatar_pic' => $avatar_pic, 'perm' => $perm);
    $index_middle .= $mod->get_template_code ( 'users_info', $user_info);
    
	

echo $index_middle;

?>