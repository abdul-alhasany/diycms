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


if (RUN_SECTION !== true) {
	die("<center><h3>" . lang('ACCESS_NOT_ALLOWED') . "</h3></center>");
}

// function to copy file
function copy_file($file1, $file2)
{
	global $CONF;
	$contentx   = @get_contents($file1);
	$openedfile = @fopen($CONF['upload_path']."/$file2", "w");
	fwrite($openedfile, $contentx);
	fclose($openedfile);
	if ($contentx === FALSE) 
		$status = false;
	 else
		$status = true;
		
	return $status;
}

function get_file_contents($file)
{
	if (function_exists('file_get_contents')) {
		$buffer = get_contents($file);
		return $buffer;
	} elseif (function_exists('file')) {
		$buffer = implode('', @file($file));
		return $buffer;
	} else {
		return 0;
	}
}
// get the deatiles
$id = $_GET['id'];

$html = @get_contents("http://www.diy-cms.com/updates/".$CONF['lang']."/index.php?id=$id");

$html = json_decode($html, true);

extract($html);

$filename        = $html['file_name'];
$total_file_name = "http://www.diy-cms.com/updates/".$CONF['lang']."/$filename";

if (@get_contents($total_file_name)) {
	$copy_file = copy_file($total_file_name, $filename);

	// check if the file is copied, if it is copied go ahead with the rest of the script else display a message
	if ($copy_file) {

		$file_path = $CONF['upload_path']."/".$filename;
		include($file_path);

		$file_exists = $diy_db->dbnumquery("diy_updates", "file_name ='$html[file_name]'");
		
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
			@unlink($file_path);
			info_msg("Database has been updated");
			
		}
	
		
	} else {
	$file_exists = $diy_db->dbnumquery("diy_updates", "file_name ='$html[file_name]'");
		
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
		
		$file_path = $CONF['upload_path'] . "/$filename";
		$file      = get_contents("$file_path");
		
		echo "<center>Database could not updated.<br><br>Update your database with this code:<br><br><textarea rows=20 cols=100>$file</textarea>";
		@unlink($file_path);
	}
} else {
	info_msg("File does not exist");
}
?>