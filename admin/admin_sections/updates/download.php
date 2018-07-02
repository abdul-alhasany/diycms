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

require_once("../includes/files.class.php");
if (RUN_SECTION !== true) {
	die("<center><h3>" . lang('ACCESS_NOT_ALLOWED') . "</h3></center>");
}

// get the deatiles
$id = $_GET['id'];

$html = @get_contents("http://www.diy-cms.com/updates/".$CONF['lang']."/index.php?id=$id");

$html = json_decode($html, true);

extract($html);

		$file      = explode('#', $html['file_name']);
		$file_name = end($file);
		$file_name  = str_replace('.file', '.php', $file_name);

// check if the file exists on the server, if not display a message
if (@fopen("http://www.diy-cms.com/updates/".$CONF['lang']."/$html['file_name']", 'rb')) {
			@header("Content-Type: application/force-download");
          	@header("Content-Type: application/octet-stream");
			@header("Content-Disposition: attachment; filename=$file_name");
			
			$handle = @fopen("http://www.diy-cms.com/updates/".$CONF['lang']."/$html[file_name]", "rb");
			$contents = stream_get_contents($handle);
			@fclose($handle);
			
			echo $contents;
	
	// check if the file is copied, if it is copied go ahead with the rest of the script else display a message
	
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
		
} else {
	info_msg("File does not exist");
}

?>