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
  * This file handels admin sections display
  * 
  * @package	Admin
  * @subpackage	Files
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */


// call global file
include ('global.php');

// RUN_SECTION should be used in every file in any section in order to prevent direct access to the section file
define('RUN_SECTION', true);


$auth->view_login_form();

// some security checks
if (isset($_GET['section']))
{
  if (eregi("http\:\/\/", $_GET['section']))
  {
    info_msg("You are not allowed to access this file");
  }
}
// create an instance for section class
$section = new admin_sections;

if (!isset($_GET['fullpage']))
{
  // create buffer
  ob_start();
  $index_middle .= $section->output();
  // buffer end
  ob_end_flush();

  // print page
  output($index_middle);

}
else
{
  // if fullpage is set to 1 then do not display header or footer
  $fullpage = set_id_int('fullpage');
  if ($fullpage == '1')
  {
    // create the buffer
    ob_start();
    $index_middle .= $section->output();
    // buffer end
    ob_end_flush();

    echo $index_middle;
  }
}

?>