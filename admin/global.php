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
  * This is a global file for admin section. It has to be included in all admin files in order for them to work correctly.
  * 
  * @package	Admin
  * @subpackage	Files
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

// set error reporting varibales
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR);

// Check if the installation file exists in order to stop any further installation by unathorised useres
if ((is_dir("../install")) AND (!file_exists("../install/file.lock")))
{
  header('Location: ../install/index.php');
  exit;
}
require_once ('conf.php');

if ($CONF['class_folder'] == '') $CONF['class_folder'] = 'aclass';
if (!@fopen($CONF['class_folder'] . "/index.html", r))
{
  exit("<br><br><center dir=rtl><b>Please make sure the aclass folder is renamed to {$CONF[class_folder]}</b></center>");
}

require_once ('admin_lang/'.$CONF['lang'].'.lang.php');
require_once ($CONF['site_path'].'/includes/knots.functions.php');
require_once ($CONF['site_path'].'/includes/protection.php');
require_once ($CONF['site_path'].'/includes/mysql_cache.class.php');
require_once ($CONF['site_path'].'/includes/mysql.class.php');
require_once ($CONF['site_path'].'/includes/email.class.php');
require_once ($CONF['site_path'].'/includes/files.class.php');
require_once ($CONF['site_path'].'/includes/templates.class.php');
require_once ($CONF['site_path'].'/includes/general.functions.php');
require_once ($CONF['site_path'].'/includes/post.functions.php');
require_once ($CONF['class_folder'] . '/functions.php');
require_once ($CONF['class_folder'] . '/admin_login.class.php');
require_once ($CONF['class_folder'] . '/admin_knots.functions.php');
require_once ($CONF['class_folder'] . '/template_engine.class.php');
require_once ($CONF['class_folder'] . '/admin_sections.class.php');
require_once ($CONF['class_folder'] . '/admin_form.class.php');
require_once ($CONF['class_folder'] . '/cache.functions.php');


$diy_db = new mysql();

$templates = new templates;

$diy_global_settings_array = diy_global_settings_array();

// sanitize $_GET array
if (isset($_GET))
{
  foreach ($_GET as $key => &$val)
  {
    $val = trim(stripslashes(strip_tags($val)));
  }
}

// sanitize $_POST array
if (isset($_POST))
{
  foreach ($_POST as $key => &$val)
  {
    if (!is_array($val))
    {
      $val = admin_format_data($val); 
    }
  }
  unset($val);
}

reset($_POST);

$auth = new admin_login;
$admin_templates = new template("admin_skin/default/");

$diy_admin_knots = array();
$diy_admin_contents = array();

if (count($_POST) > 0)
{
  check_referer();
}

?>