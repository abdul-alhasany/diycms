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
  * This file is part of users module
  * 
  * @package	Modules
  * @subpackage	Users
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */
 

 if (RUN_MODULE !== true) {
     die("<center><h3>Not Allowed!</h3></center>");
 }
 
 /**
* Check username
*
* 
*
* @param string $name
* @return boolean 
*/

    function check_name_validity($name)
    {
	if (preg_match('@[-_.A-Za-z0-9 ]+@si', $name))
	{
		return true;
		}
        else
		{
        return false;
		}
    }

	 /**
    * Check that the username or email is not been used before
    *
    * 
    * @param string $where 
    * @param string $check
    * @return  boolean
    */

    function check_existence($where, $check)
    {
	global $diy_db;
        $result = $diy_db->query("SELECT userid FROM diy_users
                                WHERE $where='$check'");
        if ($diy_db->dbnumrows($result) > 0)
        {
            return false;
        }
        return true;
    }
	
 //---------------------------------------------------
//
//---------------------------------------------------
function generate_activation_code()
{
global $diy_db;
    $salt = "1234567890";
    
    srand((double)microtime()*1000000);
    
    $i = 0;
 	while ($i <= 6)
   {
 		$num = rand() % 10;
 		$tmp = substr($salt, $num, 1);
 		$active = $active . $tmp;
 		$i++;
  	}
   
    $result = $diy_db->query("SELECT activation_code FROM diy_users WHERE activation_code ='$active'");

    if($diy_db->dbnumrows($result)==0)
    {
        return $active;
    }
    else
    {
        return generate_activation_code();
    }
    
}

function check_birthdate ($date)
    {
        if (ereg("^[0-9]{2}\/[0-9]{2}\/([0-9]{4})$", $date))
       {
		$date = explode ('/',$date);
		$date = mktime('0','0','0',"$date[1]","$date[0]","$date[2]");
		return $date;
		}
        else{
		return false;
		}
    }

	
function add_style($lang)
{
    global $mod;
	$dir = ($lang == 'arabic') ? 'rtl' : 'ltr';
	
	$style = '<link rel="stylesheet" type="text/css" href="modules/' . $mod->modInfo['mod_name'] . '/'.$dir.'.css">';
    
    return $style;
}

/**
 * maximum_allowed()
 * 
 * @param mixed $txt
 * @param mixed $min
 * @return
 */
function minimum_allowed($txt, $min)
{
  if (strlen($txt) > $min)
  {
    return false;
  }
  return true;
}

function usage_bar($lang, $userid, $box)
{
    global $mod, $diy_db;
	
	$total =  $mod->setting("maximum_messages");
    $nummsg = $diy_db->dbnumquery("diy_messages","msgbox = '$box' AND userid='".$userid."'");
    $result = @(($nummsg / $total)* 100);
    $array['width'] = number_format($result);
    $array['usage'] = sprintf($lang['USAGE'], $nummsg, $total);
	
    return $array;
}

function inline_error_message($string)
{
	$string = "<li>$string</li>";
	return $string;
}
?>