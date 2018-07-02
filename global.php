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
  * This is a global file in diy-cms. It has to be included in all files in order for the cms to work correctly.
  * 
  * @package	Global
  * @subpackage	Files
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */
// set error reporting varibales
error_reporting(E_ALL^E_NOTICE);


// check php version, if it is older than 5.0.0 and regiering long arrays is disabled then change all these long arrays to the new global arrays
if (phpversion() >= '5.0.0' && (!ini_get('register_long_arrays') || ini_get('register_long_arrays') == '0' || strtolower(ini_get('register_long_arrays')) == 'off'))
{
  $HTTP_POST_VARS = $_POST;
  $HTTP_GET_VARS = $_GET;
  $HTTP_SERVER_VARS = $_SERVER;
  $HTTP_COOKIE_VARS = $_COOKIE;
  $HTTP_ENV_VARS = $_ENV;
  $HTTP_POST_FILES = $_FILES;
  if (isset($_SESSION))
  {
    $HTTP_SESSION_VARS = $_SESSION;
  }
}
// Check if the installation file exists so the website admin will remove in order to stop any further installation by unathorised useres
if ((is_dir("install") AND (!file_exists("install/file.lock"))))
{
  header('Location: install/index.php');
  exit;
}

// This value has to be checked in every menu (or block) file in order to prevent direct access
define('TURN_BLOCK_ON', true);

// include the reuqired files to run the cms
require_once ('admin/conf.php');
require_once ('includes/knots.functions.php');
require_once ("includes/protection.php");
require_once ('lang/' . $CONF['lang'] . '.php');
require_once ('includes/general.functions.php');
require_once ('includes/mysql_cache.class.php');
require_once ('includes/mysql.class.php');
require_once ('includes/bbcode.class.php');
require_once ("includes/session.class.php");
require_once ('includes/blocks.class.php');
require_once ('includes/form.class.php');
require_once ('includes/module.class.php');
require_once ('includes/plugins.class.php');
require_once ('includes/spam.class.php');
require_once ('includes/post.functions.php');
require_once ('includes/login.class.php');
require_once ('includes/templates.class.php');
require_once ('includes/templates_stream.class.php');


// intiate database class
$diy_db = new mysql();

// check start varibales, this is neccessary for pagination (will be changed in next versions)
$start = (int)$_GET['start'];
if (!isset($_GET['start']))
{
  $start = 0;
}

// create some arrays that hold various contents
$diy_hooks = array();
$function_contents = array();
$diy_global_settings_array = diy_global_settings_array();
$diy_group_permissions_array = diy_group_permissions_array();

//echo nl2br(print_r($diy_group_permissions_array,1));

// Check login information, user stats (guest or member) and login lifetime
$login = new login;
$login->start_login_info();

set_error_handler("diy_error_handler");

$templates = new templates;


$cgroup = ($_COOKIE['cgroup'] == '') ? 5 : $_COOKIE['cgroup'];

$maxlifetime = $CONF['maxlifetime'] ? $CONF['maxlifetime'] : get_cfg_var("session.gc_maxlifetime");
    
check_hook_function('global_file_start', $extra);

//---------------------------------------------------
// Check whether cms is turned on or off
//---------------------------------------------------
if ($_COOKIE['cgroup'] !== '1')
{
  if (get_global_setting('turn_off') == '1')
  {
    $file = basename($_SERVER['PHP_SELF']);
    if ($_GET['action'] !== "login")
    {
     diy_page_header("Website is closed");
      $turn_off_msg = get_global_setting('turn_off_msg');
      echo $templates->display_template('turn_off_site');
      exit;
    }
  }
}
//--------------------end Turn Off Website----------------

//---------------------------------------------------
//  Check banned IPs and ban them
//---------------------------------------------------
$ban_ips = get_global_setting('ban_ip');
$ban_ips = @explode("\n", $ban_ips);
if (in_array(get_user_ip(), $ban_ips))
{
  error_message("You are not allowed to access this website");
  exit;
}
//--------------------end IP Ban----------------
//

// sanitize $_POST array
if (isset($_POST))
{
  foreach ($_POST as $key => &$val)
  {
    if (!is_array($val))
    {
      $val = format_data($val); 
    }
  }
  unset($val);
}
reset($_POST);


if (count($_POST) > 0)
{
  check_referer();
}

$session = md5(uniqid(rand()));
  
  
//---------------------------------------------------
//  Check some variables in order to use them for the online mod
//---------------------------------------------------
$timestamp = time();
$lifetimeout = 300;
$timeout = $timestamp - $lifetimeout;
$online_ip = get_user_ip();
$session_id = session_id();
$useronline = $_COOKIE['cname'];
$useronlineid = $_COOKIE['cid'];

if (($useronline == '') and ($useronlineid == ''))
{
  $_COOKIE['clogin'] = '';
  $_COOKIE['cname'] = 'Guest';
  $_COOKIE['cid'] = $CONF['Guest_id'];
  $useronline = $_COOKIE['cname'];
  $useronlineid = $_COOKIE['cid'];
}
if(empty($_COOKIE['cgroup']))
		{
		$_COOKIE['cgroup'] = '5';
		}
		
		
$REQUEST_URI = format_data($_SERVER['REQUEST_URI']);
$PHP_SELF = format_data($_SERVER['PHP_SELF']);
$USER_AGENT = format_data($_SERVER['HTTP_USER_AGENT']);
/*
$diy_db->query("DELETE FROM diy_online WHERE onlineSID ='$session_id' or timestamp < $timeout");

$diy_db->query("INSERT INTO diy_online (timestamp,
                                          onlineip,
                                          onlinefile,
                                          onlinepage,
                                          onlineSID,
                                          user_online,
                                          user_agent,
                                          useronlineid)
                                  VALUES ('$timestamp',
                                          '$online_ip',
                                          '$PHP_SELF',
                                          '$REQUEST_URI',
                                          '$session_id',
                                          '$useronline',
                                          '$USER_AGENT',
                                          '$useronlineid')", 'diy_online');

*/
// End online mod

//////////////////////////// function check cookies ////////////////


$urlarr = array($id, $cat_id, $userid, $msgid, $start, $page, $newsid, $threadid, $downid, $allowid, $mineID);

while (list($key, $value) = each($urlarr))
{
  if (!empty($key))
  {
    if (preg_match('/[^0-9]/', $value))
    {
      error_message(LANG_ERROR_URL);
    }
  }

}
?>