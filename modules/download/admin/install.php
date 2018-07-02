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


// check that the file is not run directly
if (RUN_SECTION !== true)
{
  die("<center><h3>" . lang('ACCESS_NOT ALLOWED') . "</h3></center>");
}

include ('./../modules/' . $module . '/lang/english.lang.php');

$query = array();
$query[] = "DROP TABLE IF EXISTS `diy_download_cat`;";
$query[] = "
CREATE TABLE IF NOT EXISTS `diy_download_cat` (
  `catid` int(10) NOT NULL AUTO_INCREMENT,
  `cat_order` int(10) NOT NULL DEFAULT '0',
  `parent` int(10) NOT NULL DEFAULT '0',
  `cat_title` varchar(100) NOT NULL DEFAULT '',
  `dsc` text NOT NULL,
  `dscin` text NOT NULL,
  `countopic` int(10) NOT NULL DEFAULT '0',
  `countcomm` int(10) NOT NULL DEFAULT '0',
  `lastpostid` int(11) NOT NULL DEFAULT '0',
  `grouppost` varchar(200) NOT NULL DEFAULT '0',
  `groupview` varchar(200) NOT NULL DEFAULT '0',
  `cat_email` varchar(255) DEFAULT NULL,
  `closed` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`catid`)
);";

$query[] = "DROP TABLE IF EXISTS `diy_download_files`;";
$query[] = "
CREATE TABLE IF NOT EXISTS `diy_download_files` (
  `downid` int(255) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(255) NOT NULL DEFAULT '0',
  `username` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `file_size` int(11) NOT NULL COMMENT 'The size of the file added',
  `size_unit` varchar(11) NOT NULL COMMENT 'The size unit of the file',
  `file_link` varchar(500) COLLATE latin1_bin NOT NULL COMMENT 'The link to the file (if the file is not uploaded)',
  `clicks` int(11) COLLATE latin1_bin NOT NULL COMMENT 'Number of file downloads',
  `date_added` int(11) NOT NULL DEFAULT '0',
  `post` longtext,
  `allow` char(3)  NOT NULL DEFAULT '',
  `readers` int(10) DEFAULT '0',
  `comments_no` int(10) DEFAULT '0',
  `status` varchar(100) NOT NULL DEFAULT '0',
  `rating_total` int(10) NOT NULL DEFAULT '0',
  `ratings` int(10) NOT NULL DEFAULT '0',
  `lastuserid` int(11) NOT NULL DEFAULT '0',
  `uploadfile` int(10) NOT NULL DEFAULT '0',
  `edit_by` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`downid`)
);";

$query[] = "DROP TABLE IF EXISTS `diy_download_comments`;";
$query[] = "CREATE TABLE IF NOT EXISTS `diy_download_comments` (
  `commentid` int(10) NOT NULL AUTO_INCREMENT,
  `downid` int(10) NOT NULL DEFAULT '0',
  `userid` int(10) NOT NULL DEFAULT '0',
  `cat_id` int(10) NOT NULL DEFAULT '0',
  `username` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `date_added` int(11) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `uploadfile` int(10) NOT NULL DEFAULT '0',
  `allow` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`commentid`)
);";

$query[] = "INSERT INTO `diy_download_cat` (`catid`, `cat_order`, `parent`, `cat_title`, `dsc`, `dscin`, `countopic`, `countcomm`, `lastpostid`, `grouppost`, `groupview`, `cat_email`, `closed`) VALUES
(1, 0, 0, 'Test cateogry', 'This category is for testing purposes only', '', 1, 0, 1, '1,2,3,4,5,9', '1,2,3,4,5,9', '', '0');";

$query[] = "INSERT INTO `diy_download_files` (`downid`, `userid`, `cat_id`, `username`, `title`, `date_added`, `post`, `allow`, `readers`, `comments_no`, `status`, `rating_total`, `ratings`, `lastuserid`, `uploadfile`, `edit_by`) VALUES
(1, 1, 1, 'admin', 'Test post', 1249996876, '[b]This post is for testing purposes only[/b]. [i]You can edit or delete this post.[/i]', 'yes', 1, 0, '0', 0, 0, 0, 0, '0');";


$i = 0;
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'LIST_TYPE', 'list_type', '0', '" . $i++ . "', '2');";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'CAT_PER_ROW', 'cat_per_row', '10', '" . $i++ . "', 3);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'POSTS_PER_PAGE', 'posts_per_page', '10', '" . $i++ . "', 3);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'COMMENTS_PER_PAGE', 'comments_per_page', '10', '" . $i++ . "', 3);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'ALLOWED_FILES', 'allowed_files', '.zip,.pdf,.rar', '" . $i++ . "', 6);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'MAXIMUM_UPLOAD_SIZE', 'maximum_upload_size', '500', '" . $i++ . "', 6);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'ORDER_POSTS_BY', 'order_posts_by', 'last_added', '" . $i++ . "', 2);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'SORT_POSTS_BY', 'sort_posts_by', 'DESC', '" . $i++ . "', 2);";


$i = 0;
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'MANAGE_CAT', 'manage_cat', '1,2', '" . $i++ . "', 7);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'ADD_POST', 'add_post', '1,2,3,4,5', '" . $i++ . "', 7);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'EDIT_ALL_POSTS', 'edit_all_posts', '1,2', '" . $i++ . "', 7);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'EDIT_OWN_POST', 'edit_own_post', '1,2,3,4,5', '" . $i++ . "', 7);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'APPROVE_FILES', 'approve_files', '1,2', '" . $i++ . "', 7);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'WAIT', 'wait', '5', '" . $i++ . "', 7);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'ALLOW_DOWNLOAD', 'allow_download', '1,2,3,4,5', '" . $i++ . "', 7);";

$query[] = "INSERT INTO diy_modules VALUES ('', '$module', '$admin_lang[mod_title]', '$admin_lang[mod_user]', 1, '$admin_lang[left_menu]','$admin_lang[right_menu]','0', '1,2',1,'english');";


foreach ($query as $line)
{
  if (!$diy_db->query($line))
  {
    $query_cid = $k + 1;
    $content .= "<table>";
    $content .= "<tr>";
    $content .= "<td>$admin_lang[QUERY_ERROR]</td>";
    $content .= "</tr>";
    $content .= "<tr>";
    $content .= "<td dir=ltr>" . mysql_error() . '</td>';
    $content .= "</tr>";
    $content .= "<tr>";
    $content .= "<td><b>$admin_lang[QUERY_TEXT]</b></td>";
    $content .= "</tr>";
    $content .= "<tr>";
    $content .= "<td align=left>$line</td>";
    $content .= "</tr></table>";

    echo $content;
    $false = true;
  }
}
if (!$false == true)
{
  $modid = $diy_db->insertid();
  $mod = $module;
  $theme = "Default";

  $themename = "./../modules/$mod/admin/$mod.xml";

  if (!$xml = simplexml_load_file($themename))
  {
    trigger_error('Error reading XML file', E_USER_ERROR);
  }


  $themeid = 1;
  $result = $diy_db->query("INSERT INTO diy_modules_templates VALUES ('', '1', '$themeid', '0', '0', '$modid', '$mod', '$theme', '', '');");

  foreach ($xml->main_group as $child)
  {
    $title = base64_decode($child->group_title);
    $desc = base64_decode($child->group_desc);

    $diy_db->query("INSERT INTO diy_module_tempgroup VALUES ('', '$modid', '$themeid', '$title', '$desc');");
    $temp_groupid = $diy_db->insertid();
    foreach ($child->template as $line)
    {
      $temp_title = base64_decode($line->temp_title);
      $temp_content = base64_decode($line->temp_content);
      $temp_content = str_replace("'", "\'", $temp_content);
      $result = $diy_db->query("INSERT INTO diy_modules_templates VALUES ('', '0', '0', '$temp_groupid', '$themeid', '$modid', '$mod', '', '$temp_title', '$temp_content');");
    }
  }
}

$diy_db->query("INSERT INTO diy_menu VALUES ('', 'download control', 'standard_menu', 'mainmenu', ' Õﬂ„ „—ﬂ“ «· Õ„Ì·', '<!--INC dir=\"modules/download/blocks\" file=\"control.block.php\" -->', '2','1','$modid', '0', '1');");


$block_result = $diy_db->query("SELECT * FROM diy_menu where modid='0'
							  OR modid='$modid'");
while ($row = $diy_db->dbarray($block_result))
{
  $block_array[] = $row['menuid'];
}
$block_list = implode(",", $block_array);

$diy_db->query("UPDATE diy_modules SET mnueid = '$block_list' WHERE id='$modid';");

admin_create_delete_dir('create_directory', $module);

if ($false == true)
{
  $msg = $admin_lang['SETUP_DONE_ERROR'];
}
else
{
  $msg = $admin_lang['SETUP_DONE'];
}

$content = info_msg($msg, "sections.php?section=modules&file=setup&module=$module&" . $auth->get_sess());
echo $content;

?>