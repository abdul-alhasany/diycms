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
 * This file is part of settings section
 * 
 * @package	Admin_sections
 * @subpackage	Settings
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	1.1
 * @access 	public
 */

if (RUN_SECTION !== true) {
	die("<center><h3>" . lang('ACCESS_NOT_ALLOWED') . "</h3></center>");
}


// function to copy file
function copy_file($file1, $file2)
{
	$contentx   = @file_get_contents($file1);
	$openedfile = @fopen("../upload/$file2", "w");
	fwrite($openedfile, $contentx);
	fclose($openedfile);
	if ($contentx === FALSE) {
		$status = false;
	} else
		$status = true;
	
	return $status;
}

// get the deatiles
$id = $_GET['id'];

$html = @get_contents("http://www.diy-cms.com/updates/".$CONF['lang']."/index.php?id=$id");

$html = json_decode($html, true);

extract($html);

$filename = $html[0];

// check if the file exists on the server, if not display a message
if (@fopen("http://www.diy-cms.com/updates/".$CONF['lang']."/$filename", 'rb')) {
	$copy_file = copy_file("http://www.diy-cms.com/updates/".$CONF['lang']."/$filename", "$filename");
	
	// checo if the file is copied, if it is copied go ahead with the rest of the script else display a message
	if ($copy_file) {
		$upload_path = $CONF['upload_path'] . "/$filename";
		$filename    = str_replace('#', '/', $filename);
		$filename    = str_replace('.file', '.php', $filename);
		$filename    = $CONF['site_path'] . '/' . $filename;
		$rename_move = rename($upload_path, $filename);
		
		if ($rename_move) {
			$file_exists = $diy_db->dbnumquery("diy_updates", "file_name ='$filename'");
			
			if ($file_exists > 0) {
				$result = $diy_db->query("UPDATE diy_updates SET
						issue = '$html[desc]',
						timestamp = '$html[timestamp]',
						cms_version = '$html[cms_version]'
						WHERE file_name = '$html[file_name]'");
			} else {
				$result = $diy_db->query("INSERT into diy_updates (file_name,
                                                    issue,
                                                    timestamp,
													cms_version,
													language
												)
                                              values
                                                    ('$html[file_name]',
                                                    '$html[desc]',
                                                    '$html[timestamp]',
                                                    '$html[cms_version]',
													'".$CONF['lang']."'
													)");
			}
			
			if ($result) {
				info_msg("File was updated");
			}
			
		}
		
	} else {
		$file      = explode('#', $filename);
		$file_name = end($file);
		$file_name  = str_replace('.file', '.php', $file_name);
		
		echo "<center>Update proccess could not be completed.<br><br>Please download the file through this link: <b><a href=sections.php?section=updates&file=download&id=$id&fullpage=1&" . $auth->get_sess() . ">$file_name</a></b><br><br>Copy it to the apropriate folder";
	}
} else {
	info_msg("File does not exist");
}

?>