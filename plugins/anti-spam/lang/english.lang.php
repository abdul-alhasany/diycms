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


$admin_plugin_lang = array(
'title'  => "Anti Spam",
'version'  => "1.0",
'author'  => "Khr2003",
'desc'  => "Protects forms agains spam and robotic posting",

'INSTALL_MOUDLE' => "Installing Anti spam plugin version 1.0 for diycms",
'SETUP_DONE_ERROR' => "Setup has completed. However, there were some errors. Please refer to the documentation or to the support forum.",
'SETUP_DONE' => "Setup was completed Successfuly.",
'BACK_TO_MAIN' => "Go back to the plugins page.",


'UNINSTALL_PLUGIN' => "Uninstalling anti spam plugin version 1.0 ",
'UNINSTALL_CONFIRM' => 'Are you sure you want to delete this plugin?<br> You will delete all the data related to it, such as articls, blocks or anything else.',
'UNINSTALL_DONE_ERROR' => "Uninstall has completed. However, there were some errors. Please refer to the documentation or to go the support forum.",
'UNINSTALL_DONE' => "Uninstall was completed Successfuly.",
'BACK_TO_MAIN' => "Go back to the plugins page.",

'GENERAL_SETTINGS' => "General Settings",
'PERMISSIONS' => 'Permissions',
'PROTECTION_TYPE' => "Anti-spam protection type",
'protection_type' => array ('calc' => 'Calculation', 'word' => 'Blank Word'),
'SENTENCES' => "Sentences to be used for the blank word option",
'CALCULATION_TYPES' => "Calculation types to be used with the calculation option",
'calculation_types' => array('addition' => 'Addition', 'subtraction' => 'Subtraction', 'multiply' => 'Multiplication','division' => 'Division'),
'NUMBER_RANGE' => "Numbers range for the calculation option",
);


$antispam_lang = array( 
'ANTISPAM_CALCULATIONS_MULTIPLICATIONS' => "What is %d * %d ?",
'ANTISPAM_CALCULATIONS_ADDITIONS' => "What is %d + %d ?",
'ANTISPAM_CALCULATIONS_SUBTRACTION' => "What is %d - %d ?",
'ANTISPAM_CALCULATIONS_DIVISION' => "What is %d / %d ?",
'ANTISPAM_FILL_BLANK_WORD' => "Fill the blank word",
'ANTISPAM_CALC_NO_MATCH' => "The result of the calculation is not correct.<br>Please go back and enter the correct result",
'ANTISPAM_WORD_NO_MATCH' => "The missing word is not correct. <br>Please go back and enter the correct missing word",
);

 
?>