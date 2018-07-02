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

 include($CONF['site_path'].'/plugins/' . $plugin . '/lang/'.$CONF['lang'].'.lang.php');
 
 
 $diy_db->query("INSERT INTO diy_plugins VALUES ('', '$plugin', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20', '1,2,3,4,5', 'enabled');");
 $plugin_id = $diy_db->insertid();
 
 $i = 0;
$diy_db->query("INSERT INTO diy_plugins_settings VALUES ('', '$plugin_id', '$plugin', 'MIN_WIDTH_RESIZE', 'min_width_resize', '600', '".$i++."', '6','');");
$diy_db->query("INSERT INTO diy_plugins_settings VALUES ('', '$plugin_id', '$plugin', 'MIN_HEIGHT_RESIZE', 'min_height_resize', '600', '".$i++."', '6','');");
$result = $diy_db->query("INSERT INTO diy_plugins_settings VALUES ('', '$plugin_id', '$plugin', 'RESIZE_PERCENTAGE', 'resize_percentage', '50%', '".$i++."', '2','');");

 
 $msg = ($result) ? $msg = $admin_plugin_lang['SETUP_DONE'] : $admin_plugin_lang['SETUP_DONE_ERROR'] ;
 
 
 $content = info_msg($msg, "sections.php?section=plugins&file=setup&plugin=$plugin&".$auth->get_sess());
	 echo $content;
?>