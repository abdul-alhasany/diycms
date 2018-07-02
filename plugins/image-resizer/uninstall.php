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

if (($_GET['step'] == '0') || ($_GET['step'] == '')) {
     	$form = "<tr><td>";
	$form .= $admin_plugin_lang['UNINSTALL_CONFIRM'];
	$form .= "</td></tr>";
	
	$form_array = array(
         "action" 	=> "sections.php?section=plugins&file=uninstall&plugin=$plugin&&plugin_id=$plugin_id&step=1&".$auth->get_sess(),
         "title" 	=> $admin_plugin_lang['UNINSTALL_PLUGIN'],
         "name" 	=> 'settings',
         "content" 	=> $form,
         "submit" 	=> 'Yes',
		);
	 
	$output = form_output($form_array);
	echo $output;
 } elseif ($_GET['step'] == '1') {
$plugin_id = $_GET['plugin_id'];

     $diy_db->query("DELETE from diy_plugins where plugin_id='$plugin_id'");
	$diy_db->query("DELETE from diy_plugins_settings where plugin_id='$plugin_id'");
	 
     if ($false == true) {
         $msg = $admin_plugin_lang['UNINSTALL_DONE_ERROR'];
     } else {
         $msg = $admin_plugin_lang['UNINSTALL_DONE'];
     }
     
    $content = info_msg($msg, "sections.php?section=plugins&".$auth->get_sess());
	 echo $content;
 }
?>