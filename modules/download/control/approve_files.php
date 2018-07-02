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


if (RUN_MODULE !== true)
{
  die("<center><h3>Not Allowed!</h3></center>");
}

include ("modules/" . $mod->module . "/settings.php");

$index_middle = $mod->nav_bar("Pending submmisions");

$perm = $mod->setting('approve_files', $_COOKIE['cgroup']);
$mod->permission($perm);


if (!isset($_GET['start']))
{
  $start = '0';
}
else
{
  $start = $_GET['start'];
}
// Check if there is any action taken
// First check if the posts are approved
$approve = $_POST['approve'];
if ($approve)
{
  if (count($_POST['select']) > 0)
  {
    foreach ($_POST['select'] as $downid)
    {
      $result = $diy_db->query("UPDATE diy_download_files set allow = 'yes' where downid='$downid'");
    }
    if ($result) $numrows = $diy_db->dbnumquery("diy_download_files", "allow != 'yes'", "downid");
    info_message($lang['APPROVE_FILES_SELECTED_POSTS_APPROVED'], "mod.php?mod=download&dir=control&modfile=approve_files");
  }
  else
  {
    error_message($lang['APPROVE_FILES_NO_POSTS_SELECTED'], "mod.php?mod=download&dir=control&modfile=approve_files");
  }
}

// Check if the posts are deleted
$delete = $_POST['delete'];
if ($delete)
{
  if (count($_POST['select']) > 0)
  {
    foreach ($_POST['select'] as $downid)
    {
      $result = $diy_db->query("DELETE from diy_download_files where downid='$downid'");
    }
    if ($result) $filename = get_file_path("$downid.download");
    @unlink($filename);

    $numrows = $diy_db->dbnumquery("diy_download_files", "allow != 'yes'", "downid");

    info_message($lang['APPROVE_FILES_SELECTED_POSTS_DELETED'], "mod.php?mod=download&dir=control&modfile=approve_files");
  }
  else
  {
    info_message($lang['APPROVE_FILES_NO_POSTS_SELECTED'], "mod.php?mod=download&dir=control&modfile=approve_files");
  }
}

// Check if the posts are moved to a new category
$move = $_POST['move'];
if ($move)
{
  if (count($_POST['select']) > 0)
  {
    foreach ($_POST['select'] as $downid)
    {
      $result = $diy_db->query("UPDATE diy_download_files SET cat_id='" . $_POST['new_catid'] . "' WHERE downid='$downid'");
    }
    if ($result) $numrows = $diy_db->dbnumquery("diy_download_files", "cat_id='$cat_id'");
    $result = $diy_db->query("UPDATE diy_download_cat SET countopic='$numrows' where catid='$cat_id'");

    info_message($lang['APPROVE_FILES_SELECTED_POSTS_MOVED'], "mod.php?mod=download&dir=control&modfile=approve_files");
  }
  else
  {
    info_message($lang['APPROVE_FILES_NO_POSTS_SELECTED'], "mod.php?mod=download&dir=control&modfile=approve_files");
  }
}

$perpage = 50;
$result = $diy_db->query("SELECT * FROM diy_download_files WHERE
                                allow != 'yes' ORDER BY downid DESC
                                LIMIT  $start,$perpage");

while ($row = $diy_db->dbarray($result))
{
  extract($row);

  eval("\$approve_files_row .= \" " . $mod->gettemplate('download_control_pending_files_row') . "\";");
}


$category = $diy_db->query("SELECT * FROM diy_download_cat ORDER BY catid");
while ($category_list = $diy_db->dbarray($category))
{
  $catid = $category_list['catid'];
  $cat_title = $category_list['cat_title'];
  $options .= "<option value='$catid'>$cat_title</option>";
}

eval("\$index_middle .= \" " . $mod->gettemplate('download_control_pending_files') . "\";");



$numrows = $diy_db->dbnumquery("diy_download_files", "allow != 'yes'");
$index_middle .= pagination($numrows, $perpage, "mod.php?mod=download&dir=control&modfile=approve_files");
echo $index_middle;

?>