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
	global $CONF;
	$contentx   = @get_contents($file1);
	$openedfile = @fopen($CONF['upload_path']."/$file2", "w");
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

//$filename = $html['file_name'];

$lang = $CONF['lang'];
// check if the file exists on the server, if not display a message
if (get_contents("http://www.diy-cms.com/updates/".$CONF['lang']."/$file_name")) {
	$copy_file = copy_file("http://www.diy-cms.com/updates/".$CONF['lang']."/$file_name", "$file_name");

	// checo if the file is copied, if it is copied go ahead with the rest of the script else display a message
	if ($copy_file) {
		
			
$zip = zip_open($CONF['upload_path']."/$file_name");
if ($zip) {
  while ($zip_entry = zip_read($zip)) {
    if (zip_entry_open($zip, $zip_entry, "r")) {
		$zip_file_name = zip_entry_name($zip_entry);
		$buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

		if(substr($zip_file_name, -1) != '/')
		file_put_contents($CONF['site_path']."/".$zip_file_name, $buf );
		
		zip_entry_close($zip_entry);
    }
  }
  zip_close($zip);
}


		$zip_file    = $CONF['upload_path'] . '/' . $file_name;

			$file_exists = $diy_db->dbnumquery("diy_updates", "file_name ='$file_name'");
			
			if ($file_exists > 0) {
				$result = $diy_db->query("UPDATE diy_updates SET
						issue = '$desc',
						timestamp = '$timestamp',
						cms_version = '$cms_version'
						WHERE file_name = '$file_name'");
			} else {
				$result = $diy_db->query("INSERT into diy_updates (file_name,
                                                    issue,
                                                    timestamp,
													cms_version,
													language
												)
                                              values
                                                    ('$file_name',
                                                    '$desc',
                                                    '$timestamp',
                                                    '$cms_version',
													'$lang'
													)");
			}
			
			if ($result) {
				unlink($zip_file);
				info_msg("File was updated");
			}

		
	} else {
		echo "<center>Update proccess could not be completed.<br><br>Please post your issue in the support forums. ";
	}
} else {
	info_msg("File does not exist");
}

?>