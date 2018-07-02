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
  * This file handels uploaded images in the diycms
  * 
  * @package	Global
  * @subpackage	Files
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

// reuqire files and global files
require_once ("global.php");
require_once ("includes/files.class.php");

$action = $_GET['action'];
switch ($action)
{
    
    // get user avatar
  case 'avatar':
    $userid = set_id_int('userid');
    $avatarfile = get_file_path("$userid.avatar", 'users');
    if (file_exists($avatarfile))
    {
      $filesize = filesize($avatarfile);
      header("Content-type: image/gif");
      header("Content-disposition: inline; filename=" . $userid . ".gif");
      header("Content-Length: $filesize");
      header("Pragma: no-cache");
      header("Expires: 0");
      echo Files::read($avatarfile);
    }
    break;

    // Get rank images
  case 'rank_avatar':
    $rankid = set_id_int('rankid');
    $avatarfile = get_file_path("$rankid.rankavatar", 'users');
    if (file_exists($avatarfile))
    {
      $filesize = filesize($avatarfile);
      header("Content-type: image/gif");
      header("Content-disposition: inline; filename=" . $rankid . ".gif");
      header("Content-Length: $filesize");
      header("Pragma: no-cache");
      header("Expires: 0");
      echo Files::read($avatarfile);
    }
    break;
    // get uploaded image
  case 'getimage':
    $info = $_GET['info'];
    $info = explode(';', $info);

    $id = $info[0];
    $name = $info[1];
	$module = $info[2];

    $file = get_file_path("$id.$name", $module);
    if (file_exists($file))
    {
      $filesize = filesize($file);
      header("Content-type: image/gif");
      header("Content-disposition: inline; filename=" . $id . ".gif");
      header("Content-Length: $filesize");
      header("Pragma: no-cache");
      header("Expires: 0");
      echo Files::read($file);
    }
    break;

  default:

    require_once ('includes/save.php');
    $arch = new archive('news');
    $id = set_id_int('id');
    @header("Content-Type: application/x-ms-download");
    @header("Content-disposition: attachment; filename=news" . $id . ".html");
    @header("Pragma: no-cache");
    @header("Expires: 0");
    $arch->loud_view(1);
}

?>