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

if(($_GET['step'] == '0') || ($_GET['step'] == ''))
{
	$form = "<tr><td>";
	$form .= $admin_lang['UNINSTALL_CONFIRM'];
	$form .= "</td></tr>";
	
	$form_array = array(
         "action" 	=> "sections.php?section=modules&file=uninstall&module=$module&&modid=$id&step=1&".$auth->get_sess(),
         "title" 	=> $admin_lang['UNINSTALL_MOUDLE'],
         "name" 	=> 'settings',
         "content" 	=> $form,
         "submit" 	=> 'Yes',
		);
	 
	$output = form_output($form_array);
	echo $output;
	
	
}elseif($_GET['step'] == '1')
{
$modid = $_GET['modid'];
$query = array();
$query[] = "DELETE from diy_modules where id='$modid' and mod_name='$module'";
$query[] = "DROP TABLE IF EXISTS `diy_search`;";

foreach($query as $line){
$k++;
if (!mysql_query($line)) {
             $query_cid = $k;
             echo "<table>";
             echo "<tr>";
             echo "<td>$admin_lang[UNINSTALL_DONE_ERROR]</td>";
             echo "</tr>";
             echo "<tr>";
             print "<td dir=ltr>" . mysql_error() . '</td>';
             echo "</tr>";
             echo "<tr>";
             echo "<td><b>$admin_lang[QUERY]</b></td>";
             echo "</tr>";
             echo "<tr>";
             echo "<td align=left>$line</td>";
             echo "</tr></table>";
             
             print "<hr noshade size=\"1\">\n";
             $false = true;
}
}

if(!$false == true){
$modid  = $_GET['modid'];
$diy_db->query("DELETE FROM diy_modules_templates WHERE modid='$modid';");
$diy_db->query("DELETE FROM diy_modules_settings WHERE set_mod='$module';");
$diy_db->query("DELETE FROM diy_module_tempgroup WHERE modid='$modid';");
$diy_db->query("DELETE FROM diy_menu WHERE modid='$modid';");
}
 if ($false == true) {
         $msg = $admin_lang['UNINSTALL_DONE_ERROR'];
     } else {
         $msg = $admin_lang['UNINSTALL_DONE'];
     }
	 
     $content = info_msg($msg, "sections.php?section=modules&".$auth->get_sess());
	 echo $content;
}
?>