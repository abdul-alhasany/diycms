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
  * Handles sections in the admin area
  * 
  * @package	Admin
  * @subpackage	Classes
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */
  
class admin_sections
{
  var $section = "";
  var $file = "index";
  var $dir;

  /**
   * admin_sections::admin_sections()
   * 
   * @return
   */
  function admin_sections()
  {
    $this->section = $this->section_name($_GET['section']);

    if ($this->section == "")
    {
      header("Location: index.php");
      exit();
    }

    if (isset($_GET['dir']) || $_GET['dir'] != 'admin')
    {
      $this->dir = $this->section_name($_GET['dir']);

      if ($_GET['file'])
      {
        $this->file = $this->section_name($_GET['file']);
      }
      else
      {
        $this->file = "index";
      }
      if (!@file_exists('admin_sections/' . $this->section . '/' . $this->dir . '/' . $this->file . '.php'))
      {
        info_msg(lang('ADMIN_SECTION_FILE_NOT_FOUND'));
      }
    }
    else
    {
      if ($_GET['file'])
      {
        $this->file = $this->section_name($_GET['file']);
      }
      else
      {
        $this->file = "index";
      }
      if (!@file_exists('admin_sections/' . $this->section . '/' . $this->file . '.php'))
      {
        info_msg(lang('ADMIN_SECTION_FILE_NOT_FOUND'));
      }
    }
  }

  /**
   * admin_sections::output()
   * 
   * @return
   */
  function output()
  {
    global $auth, $admin_templates, $diy_db, $CONF;

    if (!$this->file) return;

    ob_start();

    if ($_GET['dir'])
    {
      $this->dir = $this->section_name($_GET['dir']);

      include ('admin_sections/' . $this->section . '/' . $this->dir . '/' . $this->file . '.php');
    }
    else
    {
      include ('admin_sections/' . $this->section . '/' . $this->file . '.php');
    }

    $output = ob_get_contents();

    ob_end_clean();

    return $output;
  }

  /**
   * admin_sections::section_name()
   * 
   * @param mixed $name
   * @return
   */
  function section_name($name)
  {
    return preg_replace("/[^a-zA-Z0-9\-\_]/", "", $name);
  }

  /**
   * admin_sections::nav_bar()
   * 
   * @param string $extra
   * @return
   */
  function nav_bar($extra = '')
  {
    global $auth, $admin_templates;

    $section_name = "<a href=index.php?action=index&" . $auth->get_sess() . ">&nbsp; ". lang(ADMIN_CP); "</a>";
    if (is_array($extra))
    {
      foreach ($extra as $key => $value)
      {
        if (is_numeric($key))
        {
          $section_name .= "&nbsp;» $value";
        }
        else
        {
          $section_name .= "&nbsp;» <a href=$value> $key</a>";
        }
      }
    } elseif (!empty($extra))
    {
      $section_name .= "&nbsp;» $extra";
    }

    $nav_array = array('{NAVIGATION}' => $section_name);
    $template .= $admin_templates->get_template('admin_sections_naviagation.tpl.php', $nav_array);
    return $template;
  }
}

?>