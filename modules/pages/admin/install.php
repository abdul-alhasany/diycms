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
  * This file is part of pages module
  * 
  * @package	Modules
  * @subpackage	Pages
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

// check that the file is not run directly
if (RUN_SECTION !== true)
{
    die ("<center><h3>".lang('ACCESS_NOT ALLOWED')."</h3></center>");
}

include('./../modules/'.$module.'/lang/$CONF[lang].lang.php');


$query = array(); 
$query[] = "DROP TABLE IF EXISTS `diycms_pages`;";
$query[] = "CREATE TABLE IF NOT EXISTS `diycms_pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL DEFAULT '0' COMMENT 'The id of ther user adding the post',
  `date_time` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) COLLATE latin1_bin NOT NULL DEFAULT '',
  `content` text COLLATE latin1_bin NOT NULL,
  `allow` char(3) COLLATE latin1_bin NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
);";

$i = 0;
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'MAX_LETTERS', 'max_letters', '1000', '".$i++."', 6);";

$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'ADD_PAGE', 'add_page', '1,2,3,4,5', '".$i++."', 7);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'EDIT_PAGE', 'edit_page', '1,2,3', '".$i++."', 7);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'VIEW_PAGE', 'view_page', '1,2,3,4,5', '".$i++."', 7);";
$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'WAIT', 'wait', '4,5', '".$i++."', 7);";
 $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'EDITOR_TYPE', 'editor_type', 'bbcode', '".$i++."', 2);";
 $query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'ALLOWED_HTML_TAGS', 'allowed_html_tags', '<P><A><IMG><TABLE><TBODY><TR><TD><SPAN>
<U><I><OL><LI><FONT><UL>
<STRONG><EM><B><BR><EMBED>
<DIV><DEL><INS>', '".$i++."', 4);";

 
$query[] = "INSERT INTO diy_modules VALUES ('', '$module', '$admin_lang[mod_title]', '$admin_lang[mod_user]', 1, '$admin_lang[left_menu]','$admin_lang[right_menu]','0', '1,2',1,'$CONF[lang]')";

foreach($query as $line){
if (!$diy_db->query($line)) {
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
if(!$false == true){
$modid    	= $diy_db->insertid();
$mod  	= $module;
$theme    	= "Default";

$themename = "./../modules/$mod/admin/$mod.xml";

if(!$xml=simplexml_load_file($themename)){
    trigger_error('Error reading XML file',E_USER_ERROR);
}


	$result  = $diy_db->query("INSERT INTO diy_modules_templates VALUES ('', '1', '1', '0', '0', '$modid', '$mod', '$theme', '', '');");
	
foreach($xml->main_group as $child)
  {
	$title = base64_decode($child->group_title);
	$desc = base64_decode($child->group_desc);
	
	$diy_db->query("INSERT INTO diy_module_tempgroup VALUES ('', '$modid', '1', '$title', '$desc');");
	$temp_groupid = $diy_db->insertid();
	foreach($child->template as $line){
	$temp_title = base64_decode($line->temp_title);
	$temp_content = base64_decode($line->temp_content);
	$temp_content = str_replace("'","\'",$temp_content);
	$result  = $diy_db->query("INSERT INTO diy_modules_templates VALUES ('', '0', '0', '$temp_groupid', '1', '$modid', '$mod', '', '$temp_title', '$temp_content');");
	}
  }
}


 $diy_db->query("INSERT INTO diy_menu VALUES ('', 'pages control', 'standard_menu', 'mainmenu', ' Õﬂ„ «·’›Õ« ', '<!--INC dir=\"modules/pages/blocks\" file=\"control.block.php\" -->', '2','1','$modid', '0', '1');");

 
  $block_result = $diy_db->query("SELECT * FROM diy_menu where modid='0'
							  OR modid='$modid'");
    while ($row = $diy_db->dbarray($block_result)) {
          $block_array[] = $row['menuid'];
    }
	$block_list = implode(",",$block_array);
	
   $diy_db->query("UPDATE diy_modules SET mnueid = '$block_list' WHERE id='$modid';");

   
if($false == true){$msg = $admin_lang['SETUP_DONE_ERROR'];
}else{
$msg = $admin_lang['SETUP_DONE'];
}

$content = info_msg($msg, "sections.php?section=modules&file=setup&module=$module&".$auth->get_sess());
	 echo $content;
?>