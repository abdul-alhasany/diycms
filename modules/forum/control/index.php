<?php
/*
+===============================================================================+
|      					DIY-CMS V1.0.0 Copyright © 2011   						|
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
  * This file is part of forum module
  * 
  * @package	Modules
  * @subpackage	Forum
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

include("modules/".$mod->module."/settings.php");

 
  $perm = $mod->setting('manage_cat', $_COOKIE['cgroup']);
  $mod->permission($perm);
  	
if(( $_COOKIE['cid'] == 0) || ($_COOKIE['cid'] == $CONF['Guest_id']))
{
  eval("\$index_middle .=\" " . $mod->gettemplate ( 'forum_login_bar' ) . "\";");
}
else
{
    $userid = $_COOKIE['cid'];
	$pmumrows = $diy_db->dbnumquery("diy_messages","msgbox='1' and userid='".$_COOKIE['cid']."' AND msgisread ='1'");
	 $perm1 = $mod->setting('manage_cat', $_COOKIE['cgroup']);
	 $perm2 = $mod->setting('approve_posts', $_COOKIE['cgroup']);
	 
	 if(($perm1) && ($perm2))
	 {
        $isadmin = " | <a href=mod.php?mod=forum&dir=control>{$lang['INDEX_CONTROL_FORUM']}</b></font></a>";
	 }
  eval("\$index_middle .=\" " . $mod->gettemplate ( 'forum_tools_bar' ) . "\";");
}

$index_middle .= $mod->nav_bar($lang['CONTROL_FORUM']);

eval("\$index_middle .= \" " . $mod->gettemplate ( 'forum_control_index' ) . "\";"); 

echo $index_middle;

                  
?>