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
  * This file is part of download module
  * 
  * @package	Modules
  * @subpackage	Download
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */


include ("modules/" . $mod->module . "/settings.php");
require_once ("includes/files.class.php");

if ($_GET['action'] == "goto")
{
  $downid = set_id_int('downid');
  $result_download = $diy_db->query("SELECT * FROM diy_download_files
								WHERE downid='$downid'");
  $row_download = $diy_db->dbarray($result_download);
  if ($row_download['uploadfile'] == 1)
  {

  	$result = $diy_db->query("SELECT * FROM diy_upload
							WHERE post_id='$row_download[downid]'
							AND location = 'post'");
							
	if ($diy_db->dbnumrows($result) > 0) {
		while ($rowfile = $diy_db->dbarray($result)) {
			extract($rowfile);
				$pathfile = get_file_path("$upid.download");
				if (is_readable($pathfile)) {
					$filename = ($name) ? $name : basename($pathfile);

					header("Content-type: $type");
					header("Content-Disposition: attachment; filename=$filename");
					$readfile = Files::read($pathfile);
					echo $readfile;
					$diy_db->query("UPDATE diy_download_files SET clicks = clicks+1 WHERE downid = '$downid'");
					$diy_db->query("UPDATE diy_upload SET clicks = clicks+1 WHERE module= 'download' AND post_id = '$row_download[downid]'");
					
				}
		}
	} else {
		error_message("File does not exist");
	}
	
  }
  else
  {
    $result_filelink = $diy_db->query("SELECT * FROM diy_download_files WHERE downid='$downid'");
    $row_filelink = $diy_db->dbarray($result_filelink);

    $diy_db->query("UPDATE diy_download_files SET clicks = clicks+1 WHERE downid = '$downid'");
    header("Refresh: 0;url=" . $row_filelink['file_link'] . "");
  }
}


// pin,unpin,close or open a topic
elseif ($_GET['action'] == "change_status")
{
  $downid = set_id_int('downid');
  $do = $_GET['do'];


  $result = $diy_db->query("SELECT * FROM diy_download_files WHERE downid ='$downid'");
  $row = $diy_db->dbarray($result);
  extract($row);
  echo $status;
  if ($status == '0')
  {
    if ($do == 'pin_topic')
    {
      $diy_db->query("UPDATE diy_download_files SET status='1' WHERE downid ='$downid'");
    } elseif ($do == 'close_topic')
    {
      $diy_db->query("UPDATE diy_download_files SET status='2' WHERE downid ='$downid'");
    }
    else
    {
      error_message($lang['MISC_UNPIN_OR_OPEN_NOT_ABLE']);
    }
  } elseif ($status == '1')
  {
    if ($do == 'unpin_topic')
    {
      $diy_db->query("UPDATE diy_download_files SET status='0' WHERE downid ='$downid'");
    } elseif ($do == 'close_topic')
    {
      $diy_db->query("UPDATE diy_download_files SET status='12' WHERE downid ='$downid'");
    }
    else
    {
      error_message($lang['MISC_PIN_OR_OPEN_NOT_ABLE']);
    }
  } elseif ($status == '2')
  {
    if ($do == 'pin_topic')
    {
      $result = $diy_db->query("UPDATE diy_download_files SET status='12' WHERE downid ='$downid'");
    } elseif ($do == 'open_topic')
    {
      $result = $diy_db->query("UPDATE diy_download_files SET status='0' WHERE downid ='$downid'");
    }
    else
    {
      error_message($lang['MISC_UNPIN_OR_CLOSE_NOT_ABLE']);
    }
  } elseif ($status == '12')
  {
    if ($do == 'unpin_topic')
    {
      $result = $diy_db->query("UPDATE diy_download_files SET status='2' WHERE downid ='$downid'");
    } elseif ($do == 'open_topic')
    {
      $result = $diy_db->query("UPDATE diy_download_files SET status='1' WHERE downid ='$downid'");
    }
    else
    {
      error_message($lang['MISC_PIN_OR_CLOSE_NOT_ABLE']);
    }
  }
  else
  {
    error_message($lang['MISC_NO_ACTIONS_SELECTED']);

  }

  info_message($lang['MISC_ACTIONS_PERFORMED_SUCCESSFLY'], "mod.php?mod=download&modfile=view_file&downid=$downid");
}
elseif ($_GET['action'] == "rate_file")
{
  diy_page_header("Rate the file");

  $downid = set_id_int('downid');
  $submit = $_POST['submit'];
  if ($submit)
  {
    $result = $diy_db->query("UPDATE diy_download_files SET
								  rating_total=rating_total + " . $_POST['rating'] . ",
								  ratings = ratings+1
								  WHERE downid= '$downid'");
    popup_window($lang['MISC_RATE_FILE_RATE_ADDED']);
  }
  else
  {
    eval("\$index_middle .= \" " . $mod->gettemplate('download_misc_rate_file') . "\";");
    echo $index_middle;
  }
}
else
{
  echo "No actions selected";
}

?>