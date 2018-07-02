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


if (RUN_MODULE !== true)
{
    die ("<center><h3>You are not allowed to access this file directly.</h3></center>");
}

include("modules/".$mod->module."/settings.php");

$index_middle = $mod->nav_bar($lang['MANAGE_MSG']);

$mid = set_id_int('mid');

$perm = $mod->setting('manage_msg',$_COOKIE['cgroup']);
$mod->permission($perm);

	$result = $diy_db->dbfetch("SELECT * FROM diy_contact where id='$mid' ORDER BY id LIMIT 1");
	extract($result);
	
	$date = format_date($date_added);
	eval("\$index_middle .= \" " . $mod->gettemplate ( 'contact_read_message' ) . "\";");
	eval("\$index_middle .= \" " . $mod->gettemplate ( 'contact_buttons' ) . "\";");

	
echo $index_middle;


?>