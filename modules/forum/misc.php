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
  * This file is part of forum module
  * 
  * @package	Modules
  * @subpackage	Forum
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */
 
 include("modules/" . $mod->module . "/settings.php");
 require_once("includes/files.class.php");
 
 $index_middle = $mod->nav_bar();
 
 if ($_GET['action'] == "attachment") {
	$upid   = set_id_int('upid');
	
	
	$result = $diy_db->query("SELECT * FROM diy_upload
							WHERE upid='$upid'");
							
	if ($diy_db->dbnumrows($result) > 0) {
		while ($rowfile = $diy_db->dbarray($result)) {
			extract($rowfile);
				$pathfile = get_file_path("$upid.forum");
				if (is_readable($pathfile)) {
					$filename = ($name) ? $name : basename($pathfile);

					header("Content-type: $type");
					header("Content-Disposition: attachment; filename=$filename");
					$readfile = Files::read($pathfile);
					echo $readfile;
					$diy_db->query("UPDATE diy_upload SET clicks = clicks+1
								WHERE upid = '$upid'");
					
				}
		}
	} else {
		error_message("File does not exist");
	}	
}
// pin,unpin,close or open a topic
elseif ($_GET['action'] == "change_status") {
	$threadid = set_id_int('threadid');
	$do     = $_GET['do'];
	
	switch($do)
	{
		case 'pin_topic':
		$diy_db->query("UPDATE diy_forum_threads SET status='0' WHERE threadid ='$threadid'");
		break;
		
		case 'unpin_topic':
		$diy_db->query("UPDATE diy_forum_threads SET status='1' WHERE threadid ='$threadid'");
		break;
		
		case 'close_topic':
		$diy_db->query("UPDATE diy_forum_threads SET closed='1' WHERE threadid ='$threadid'");
		break;
		
		case 'open_topic':
		$diy_db->query("UPDATE diy_forum_threads SET closed='0' WHERE threadid ='$threadid'");
		break;
		
		default:
		error_message($lang['MISC_NO_ACTIONS_SELECTED']);
		break;
	}
	
	info_message($lang['MISC_ACTIONS_PERFORMED_SUCCESSFLY'], "mod.php?mod=forum&modfile=viewpost&threadid=$threadid");
}
?>