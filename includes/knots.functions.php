<?php
/*
+===============================================================================+
|      	Some or all this file's contents were created by ArabPortal Team   		|
|						Web: http://www.arab-portal.info						|
|   	--------------------------------------------------------------   		|
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
 * Manages knots in DiY-CMS
 * 
 * @package	Global
 * @subpackage	Functions
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	2010
 * @access 	public
 */

function hook_function($knot, $callback_function, $knot_type = 'override', $paramters, $object = array())
{
    global $diy_hooks;
    
    $diy_hooks[$knot][$knot_type][$callback_function] = $paramters;
    
    // check if the object is instiated already and call the requried method again
    if (!empty($object)) {
        if (is_array($object)) {
            if (method_exists($object[0], $object[1])) {
                $object[0]->{$object[1]}();
            }
        }
    }
	return;
}

function knot_function($knot, $callback_function, $knot_type = 'override', $paramters, $object = array())
{
	hook_function($knot, $callback_function, $knot_type, $paramters, $object);
	return;
}

function apply_knots($knot, $knot_type)
{
    global $diy_hooks;
    
    foreach ($diy_hooks[$knot][$knot_type] as $function_name => $function_paramas) {
        if (is_array($function_paramas)) {
            $output .= call_user_func_array($function_name, $function_paramas);
        } else {
            $output .= call_user_func($function_name, $function_paramas);
        }
    }
    return $output;
}

function add_function_contents($function, $contents)
{
    global $function_contents;
    $function_contents[$function] = $contents;
}

function check_hook_function($knot_function, &$contents)
{
    global $diy_hooks;
    
    add_function_contents($knot_function, $contents);
    
    if ($diy_hooks[$knot_function]['override']) {
        $contents = apply_knots($knot_function, 'override');
    } elseif ($diy_hooks[$knot_function]['append']) {
        $contents .= apply_knots($knot_function, 'append');
    } else {
        $contents = $contents;
    }
    return $contents;
}

function check_knot_function($knot_function, &$contents)
{
	$contents = check_hook_function($knot_function, $contents);
	return $contents;
}

?>