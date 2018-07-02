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
  * This file is part of guestbook module
  * 
  * @package	Modules
  * @subpackage	Guestbook
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
// get module name
$module = $_GET['module'];


// check if any data is posted
 if ($_POST['submit']){
	foreach ($_POST as $key => $value)
		{
         $value = (is_array($value)) ? implode_data($value) : $value;
 
         $result = $diy_db->query("UPDATE diy_modules_settings
								SET set_val='$value'
								WHERE set_var='$key'
								AND set_mod='$module'");
     }
     $content .= info_msg(lang('MODULES_SETTINGS_UPDATED_SUCCESSFULLY'));
 } else {
	$content .= edit_module_settings($module);
 }
?>