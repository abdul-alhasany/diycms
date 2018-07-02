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
  * Handles templates and related variables
  * 
  * @package	Admin
  * @subpackage	Classes
  * @author 	Brian E. Lozier (brian@massassi.net) Ricardo Garcia
  * @copyright 	Brian E. Lozier
  * @version 	1.1
  * @access 	public
  */
  
/**
 * Copyright (c) 2003 Brian E. Lozier (brian@massassi.net)
 *
 * set_vars() method contributed by Ricardo Garcia (Thanks!)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

class template
{
  var $vars; /// Holds all the template variables
  var $path; /// Path to the templates

  /**
   * Constructor
   *
   * @param string $path the path to the templates
   *
   * @return void
   */
  function template($path = null)
  {
    $this->path = $path;
    $this->vars = array();
  }

  /**
   * Set the path to the template files.
   *
   * @param string $path path to template files
   *
   * @return void
   */
  function set_path($path)
  {
    $this->path = $path;
  }

  /**
   * Set a template variable.
   *
   * @param string $name name of the variable to set
   * @param mixed $value the value of the variable
   *
   * @return void
   */
  function set($name, $value)
  {
    $this->vars[$name] = $value;
  }

  /**
   * get a template variable.
   *
   * @param string $name name of the variable to get
   *
   * @return variable value
   */
  function get($key)
  {
    return $this->vars[$key];
  }
  
  /**
   * Set a bunch of variables at once using an associative array.
   *
   * @param array $vars array of vars to set
   * @param bool $clear whether to completely overwrite the existing vars
   *
   * @return void
   */
  function set_vars($vars, $clear = false)
  {
    if ($clear)
    {
      $this->vars = $vars;
    }
    else
    {
      if (is_array($vars)) $this->vars = array_merge($this->vars, $vars);
    }
  }

  /**
   * Open, parse, and return the template file.
   *
   * @param string string the template file name
   * @param array  variable arrays (for ease of use - you can use the set_vars function instead)
   * @return string
   */
  function get_template($file, $var_array = '')
  {
	global $CONF;
    if (!empty($var_array))
    {
      $this->set_vars($var_array);
    }

    extract($this->vars); // Extract the vars to local namespace
    ob_start(); // Start output buffering
    include ($this->path . $file); // Include the file
    $contents = ob_get_contents(); // Get the contents of the buffer
    ob_end_clean(); // End buffering and discard


    foreach ($this->vars as $key => $value)
    {
      $contents = str_replace($key, $value, $contents);
    }
    $contents = str_replace('<#admin_images_path#>', 'admin_skin/default/images/', $contents);
    return $contents; // Return the contents
  }
}
