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


class install_templates
{
    var $path;    
    
    /**
     * Constructor: 
     * 
     * @return null
     */
    function __construct($path = '')
    {
		$this->path = $path;
       return;
    }
    
    /**
     * retrive the spcified template
     * 
     * @param string $templatename	Template title
     * @return mixed 					Template content
     */
    function get_template($template_name, $array = '')
    {
		 global $diy_db;
        
        (is_array($array)) ? extract($array) : extract($GLOBALS, EXTR_SKIP);
        
        ob_start();
        include($this->path.$template_name);
        $template .= ob_get_contents();
        ob_end_clean();
        return $template;
    }
}

?>