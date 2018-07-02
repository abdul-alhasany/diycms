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
  * This class sessions in DiY-CMS. The class extends to mysql class
  * 
  * @package	Global
  * @subpackage	Classes
  * @version 	2010
  * @access 	public
  */
  
class sessions extends mysql
{
 
  var $ses_table = "diy_sessions";

  /**
   * Open session
   * 
   * @param mixed $path	
   * @param mixed $name
   * @return
   */
  function _open($path, $name)
  {

    $this->link = @mysql_connect($this->dbserver, $this->dbuser, $this->dbpword);
    return true;
  }

  /**
   * Close session
   * 
   * @return
   */
  function _close()
  {
    /* This is used for a manual call of the
    session gc function */
    $this->_gc(0);
    return true;
  }


  /**
   * Read session data from database
   * 
   * @param mixed $ses_id
   * @return
   */
  function _read($ses_id)
  {
    $session_sql = "SELECT * FROM " . $this->ses_table . " WHERE ses_id = '$ses_id'";
    $session_res = @mysql_query($session_sql, $this->link);
    if (!$session_res)
    {
      return '';
    }

    $session_num = @mysql_num_rows($session_res);
    if ($session_num > 0)
    {
      $session_row = mysql_fetch_assoc($session_res);
      $ses_data = $session_row["ses_value"];
      return $ses_data;
    }
    else
    {
      return '';
    }
  }

  /**
   * Write new data to database
   * 
   * @param mixed $ses_id
   * @param mixed $data
   * @return
   */
  function _write($ses_id, $data)
  {
    $session_sql = "UPDATE " . $this->ses_table . " SET ses_time='" . time() . "', ses_value='$data' WHERE ses_id='$ses_id'";
    $session_res = @mysql_query($session_sql, $this->link);
    if (!$session_res)
    {
      return false;
    }
    if (@mysql_affected_rows())
    {
      return true;
    }

    $session_sql = "INSERT INTO " . $this->ses_table . " (ses_id, ses_time, ses_start, ses_value)" . " VALUES ('$ses_id', '" . time() . "', '" . time() . "', '$data')";
    $session_res = @mysql_query($session_sql, $this->link);
    if (!$session_res)
    {
      return false;
    }
    else
    {
      return true;
    }
  }

  /**
   * Destroy session record in database
   * 
   * @param mixed $ses_id
   * @return
   */
  function _destroy($ses_id)
  {
    $session_sql = "DELETE FROM " . $this->ses_table . " WHERE ses_id = '$ses_id'";
    $session_res = @mysql_query($session_sql, $this->link);
    if (!$session_res)
    {
      return false;
    }
    else
    {
      return true;
    }
  }

  /**
   * Garbage collection, deletes old sessions
   * 
   * @param mixed $life
   * @return
   */
  function _gc($life)
  {
    $ses_life = strtotime("-5 minutes");

    $session_sql = "DELETE FROM " . $this->ses_table . " WHERE ses_time < $ses_life";
    $session_res = @mysql_query($session_sql, $this->link);


    if (!$session_res)
    {
      return false;
    }
    else
    {
      return true;
    }
  }
}


$ses_class = new sessions;

/* Change the save_handler to use the class functions */
session_set_save_handler(array(&$ses_class, '_open'), array(&$ses_class, '_close'), array(&$ses_class, '_read'), array(&$ses_class, '_write'), array(&$ses_class, '_destroy'), array
  (&$ses_class, '_gc'));

/* Start session */
session_start();

?>
