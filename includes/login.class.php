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
  * This class handles login functions
  * 
  * @package	Global
  * @subpackage	Classes
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	2010
  * @access 	public
  */
  
class login
{
  /**
   * Set a cookie
   * 
   * @param string $cookie_name 	cookie name
   * @param mixed $cookie		serlized cookie information (userid, groupid, cookie time and session id)
   * @param string $exp			expiration time
   * @return null				the cookie to be set
   */
  function set_cookie($cookie_name = '', $cookie, $exp = '')
  {
	global $CONF;
	check_hook_function('set_cookie', $cookie_name);
	
    if ($cookie_name == '')
    {
      $cookie_name = $CONF['cookie_info'];
    }
    if ($exp == '')
    {
      $expires = time() + $CONF['cookie_expires'];
    }
    $cookie_path = $CONF['cookie_path'] == "" ? "/" : $CONF['cookie_path'];
    $cookie_domain = $CONF['cookie_domain'] == "" ? "" : $CONF['cookie_domain'];

    setcookie($cookie_name, $cookie, $expires, $cookie_path, $cookie_domain);
  }
  
  /**
   * destroy cookies
   * 
   * @return null 	the destroyed cookie
   */
  function destroy_coockie()
  {
	global $CONF;
	// $empty variable is an empty variable, since the second paramter is passed by refrence and can not be empty
	check_hook_function('set_cookie', $empty);
	
    $expires = time() + (60 * 60);

    $cookie_path = $CONF['cookie_path'] == "" ? "/" : $CONF['cookie_path'];

    $cookie_domain = $CONF['cookie_domain'] == "" ? "" : $CONF['cookie_domain'];

    setcookie($CONF['cookie_info'], '', $expires, $cookie_path, $cookie_domain);
    setcookie('logintheme', '', $expires);

  }

  /**
   * creat cookie
   * 
   * @return 	null 	the created cookie
   */
  function set_cookie_time()
  {
  
    // $empty variable is an empty variable, since the second paramter is passed by refrence and can not be empty
	check_hook_function('set_cookie_time', $empty);
	
    if ($_COOKIE['clogin'] == 'DIY-CMS')
    {
      $cookie = serialize(array('DIY-CMS', $_COOKIE['activate'], $_COOKIE['cid'], time(), session_id()));
      $this->set_cookie('', base64_encode($cookie));
    }
    else
    {
      $cookie = serialize(array('Guest', 0, 0, time(), session_id()));
      $this->set_cookie('', base64_encode($cookie));
    }
  }
  //---------------------------------------------------
  //
  //---------------------------------------------------

  /**
   * proccess login information and cookie making
   * 
   * @return null	the created cookie
   */
  function start_login_info()
  {
    global $CONF, $diy_db;
	
	// $empty variable is an empty variable, since the second paramter is passed by refrence and can not be empty
	check_hook_function('start_login_info_start', $empty);
	
    $loginfo = $CONF['cookie_info'];
    if (isset($_COOKIE[$loginfo])) ;
    {

      $user_info = urldecode(stripslashes(base64_decode($_COOKIE[$loginfo])));
      list($cookielogin, $activate, $cookieid, $lastlogin, $session_id) = unserialize($user_info);
      $_COOKIE['clogin'] = $cookielogin;
      $_COOKIE['activate'] = $activate;
      $_COOKIE['cid'] = $cookieid;
      $_SESSION["selastlogin"] = $lastlogin;
      $_COOKIE['lastlogin'] = $_SESSION['selastlogin'];
      if ($session_id != session_id())
      {
        if (($_COOKIE['cid'] > 0) && ($_COOKIE['cid'] != $CONF['Guest_id']) && ($_COOKIE['cid'] != '0'))
        {
          $result = $diy_db->query("UPDATE diy_users SET
											lastlogin='$lastlogin'
											WHERE userid='" . $_COOKIE['cid'] . "'");
        }

        $this->set_cookie_time();

      }


      if (($_COOKIE['clogin'] == 'DIY-CMS'))
      {

        $result = $diy_db->query("SELECT * FROM diy_users WHERE
                                     userid='" . $_COOKIE['cid'] . "'
                                     and activated='" . $_COOKIE['activate'] . "'");

        if ($diy_db->dbnumrows($result) > 0)
        {

          if (!isset($_SESSION["sessid"]))
          {
            $usersr = $diy_db->dbarray($result);
            if ($usersr[activated] !== "approved")
            {
              $this->destroy_coockie();
              $this->start_login_info();
            }
            else
            {
              $_SESSION["sessid"] = $usersr[userid];
              $_SESSION["sessname"] = $usersr[username];
              $_SESSION["sessadmin"] = $usersr[useradmin];
              $_SESSION["sessgroup"] = $usersr[groupid];
              $_SESSION["sesstheme"] = $usersr[heme];
              $_SESSION["selastvisit"] = $usersr[lastlogin];
            }
          }
        }
      }
      else
      {
        if ((!isset($_SESSION["sessid"]) || $_SESSION["sessid"] == $CONF['Guest_id']))
        {
          $_SESSION["sessid"] = $CONF['Guest_id'];
          $_SESSION["sessname"] = 'Guest';
          $_SESSION["sessadmin"] = 0;
          $_SESSION["sessgroup"] = 5;
          $_SESSION["sesstheme"] = get_global_setting('theme');
          $_SESSION["selastvisit"] = $selastlogin;

        }

      }

      $_COOKIE['cid'] = $_SESSION['sessid'];
      $_COOKIE['clogin'] = $_SESSION['clogin'];
      $_COOKIE['cname'] = $_SESSION['sessname'];
      $_COOKIE['cadmin'] = $_SESSION['sessadmin'];
      $_COOKIE['cgroup'] = $_SESSION['sessgroup'];
      $_COOKIE['ctheme'] = $_SESSION['sesstheme'];
      $_COOKIE['lastvisit'] = $_SESSION['selastvisit'];
      $_COOKIE['lastlogin'] = $_SESSION['selastlogin'];
    }
	
	// $empty variable is an empty variable, since the second paramter is passed by refrence and can not be empty
	check_hook_function('start_login_info_end', $empty);
  }
}

?>