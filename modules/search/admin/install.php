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

// check that the file is not run directly
if (RUN_SECTION !== true)
{
    die ("<center><h3>".lang('ACCESS_NOT ALLOWED')."</h3></center>");
}

include('./../modules/'.$module.'/lang/$CONF[lang].lang.php');


$query = array(); 
$query[] = "DROP TABLE IF EXISTS `diy_search`;";
$query[] = "CREATE TABLE IF NOT EXISTS `diy_search` (
  `search_id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `keywords` varchar(225) COLLATE utf8_bin NOT NULL,
  `type` varchar(20) COLLATE utf8_bin NOT NULL,
  `from` int(11) NOT NULL,
  `max_view` int(10) NOT NULL,
  `scope` varchar(225) COLLATE utf8_bin NOT NULL,
  `text_part` varchar(15) COLLATE utf8_bin NOT NULL,
  `timestamp` int(11) NOT NULL,
  `user_ip` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`search_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Search table';";

$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'FLOOD_CONTROL', 'flood_control', '10', 0, 6);";


$query[] = "INSERT INTO diy_modules_settings VALUES ('', '$module', 'ALLOW_SEARCH', 'allow_search', '1,2,3,4,5', 1, 7);";

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

if($false == true){$msg = $admin_lang['SETUP_DONE_ERROR'];
}else{
$msg = $admin_lang['SETUP_DONE'];
}
$content = info_msg($msg, "sections.php?section=modules&file=setup&module=$module&".$auth->get_sess());
	 echo $content;
?>