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
  * Handles login information and proccess
  * 
  * @package	Admin
  * @subpackage	Classes
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */
  
class admin_login
{

	var $sess_period = 3600; 	// Define the time for the admin session expiry (in seconds)
	var $max_attempts = 3; 		// Maximum number of attempts per attempt time
	var $attmpts_interval = 900; // Time between each number of attempts
	
  /**
   * Constructor: check admin session expiry and delete the session in case it is expired
   *
   * @return void
   */
  function admin_login()
  {
    global $diy_db;

    $expiry = time() - $this->sess_period;

    $result = $diy_db->query("DELETE FROM diy_admin_sessions
								WHERE sess_TIME<'$expiry'");
  }

  /**
   * admin_login::get_sess()
   * 
   * @param string $str
   * @return
   */
  public function get_sess($str = '')
  {
    if ($str == '')
    {
      return "sessID=" . $_GET['sessID'];
    }
    else
    {
      return (strstr($str, "?")) ? $str . "&sessID=" . $_GET['sessID'] : $str . "?sessID=" . $_GET['sessID'];
    }
  }

  //-----------------------------------------------

  /**
   * admin_login::login()
   * 
   * @return
   */
  function login()
  {
    global $diy_db;
	$this->check_login_attempts();
    if (!required_entries($_POST))
    {
      error_msg(lang('ADMIN_LOGIN_NO_POST_INFO'));
      exit;
    }

    $user_name = $_POST['user_name'];
    $user_pass = md5($_POST['user_pass']);

    $result = $diy_db->query("SELECT userid,username,password,groupid
									FROM diy_users
									WHERE  (username ='$user_name')
									AND (password ='$user_pass')
									AND (groupid = 1)");

    if ($diy_db->dbnumrows($result) > 0)
    {
      $sess = $diy_db->dbarray($result);
      $logintime = time();
      $ip = get_user_ip();
      $newSid = md5(uniqid(rand()));

      foreach ($sess as $key => $value)
      {
        if (is_integer($key))
        {
          unset($sess[$key]);
        }
      }

      $sess_value = serialize(array($sess));

      $query = "INSERT INTO diy_admin_sessions (sessID,sessIP,sess_TIME,sess_VALUE,sess_LOGTIME) values
                                                      ('$newSid','$ip','$logintime','$sess_value','$logintime')";

      $result = $diy_db->query($query);

      if ($result == true)
      {
        $refe = preg_replace("/(&sessID=).*/i", "", $_SERVER['HTTP_REFERER']);
        $refe = preg_replace("/(php?|php).*/i", "php?", $refe);

        info_msg(lang('ADMIN_LOGIN_LOGIN_DONE'), "index.php?action=index&sessID=" . $newSid);
      }
      else
      {
		$this->store_login_attempts();
        error_msg(lang('ADMIN_LOGIN_LOGIN_ERROR'));
      }
    }
    else
    {
	  $this->store_login_attempts();
      error_msg(lang('ADMIN_LOGIN_WRONG_USER_PASS'));

    }

  }



  //-----------------------------------------------

  /**
   * admin_login::is_login()
   * 
   * @return
   */
  function is_login()
  {
    global $diy_db;

    $sessID = $_GET['sessID'];
    $sessIP = get_user_ip();
    $sess_period = time() + $this->sess_period;

    $result = $diy_db->query("SELECT sessIP from  diy_admin_sessions where  sessID='$sessID' and sessIP='$sessIP' and sess_TIME<'$sess_period'");

    if ($diy_db->dbnumrows($result) > 0)
    {
      $diy_db->query("update diy_admin_sessions set sess_TIME='" . time() . "' where  sessID='$sessID'");
      return true;
    }
    else
    {
      return false;
    }
  }

  //-----------------------------------------------
  /**
   * admin_login::logout()
   * 
   * @return
   */
  function logout()
  {
    global $diy_db;

    $sessID = $_GET[logout];

    $result = $diy_db->query("DELETE FROM diy_admin_sessions where sessID='$sessID'");

    $expires = time() + (60 * 60);

    setcookie('sessID', '', $expires);

    unset($_GET[sessID]);

    if ($result)
    {
      return true;
    }
    else
    {
      return false;
    }
  }


  /**
   * admin_login::view_login_form()
   * 
   * @return
   */
  function view_login_form()
  {
    global $admin_templates;
    if (!$this->is_login() === true)
    {
      echo $admin_templates->get_template('admin_login.tpl.php', $array);
      exit;
    }

  }
  
  /**
   * Store login attempts
   * 
   * @return
   */
  function store_login_attempts()
  {
		$time = $this->attmpts_interval;
		if(isset($_COOKIE['login_attempts']))
		{
		$value += $_COOKIE['login_attempts']+1;
		
		setcookie("login_attempts", $value, time()+$time);
		}else
		{
		setcookie("login_attempts", 1, time()+$time);
		}
		return;
  }
  
   /**
   * Store login attempts
   * 
   * @return
   */
  function check_login_attempts()
  {
		if(isset($_COOKIE['login_attempts']) AND $_COOKIE['login_attempts'] >= $this->max_attempts)
		{
			$min = $this->attmpts_interval / 60;
			error_msg(sprintf(lang('ADMIN_LOGIN_MANY_ATTEMPTS'), $_COOKIE['login_attempts'], $min));
		}
		return;
  }
} // End of Class


?>