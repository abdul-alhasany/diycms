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

$index_middle = $mod->nav_bar($lang['CONTROL_VIEWCAT']);

$perm = $mod->setting('manage_cat', $_COOKIE['cgroup']);
$mod->permission($perm);


if (!isset($_GET['start']))
{
  $start = '0';
}
else
{
  $start = $_GET['start'];
}


$download_row = view_categories();

eval("\$index_middle .= \" " . $mod->gettemplate('download_control_viewcat') . "\";");


$numrows = $diy_db->dbnumquery("diy_download_cat", "");
$index_middle .= pagination($numrows, '50', "mod.php?mod=download&dir=control&modfile=viewcat");
echo $index_middle;

?>