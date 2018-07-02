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

define("MYSQLERROR_ERROR", "Error");
define("MYSQLERROR_NUMBER", "Error No");

/**
  * Handles database-related functions
  * 
  * @package	Global
  * @subpackage	Classes
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	2010
  * @access 	public
  */

class mysql extends mysql_cache
{
  var $diy_dbserver = '';
  var $diy_dbconntype = '';
  var $diy_dbuser = '';
  var $diy_dbpword = '';
  var $diy_dbname = '';
  var $link = null;
  var $queryNum = 0;
  var $result = false;
  var $query_echo;

  /**
   * Constructor: load database configurations and connect to the database
   * 
   * @return null	connect to database
   */
  function mysql()
  {
    global $CONF;
	
	parent::mysql_cache();
	
    $this->dbconntype = $CONF['dbconntype'];
    $this->dbserver = $CONF['dbserver'];
    $this->dbuser = $CONF['dbuser'];
    $this->dbpword = $CONF['dbpword'];
    $this->dbname = $CONF['dbname'];
    $this->connect();
	
  }

  /**
   * Connect to database 
   * 
   * @return null 	function will connect to database
   */
  function connect()
  {
    if ($this->dbconntype == 0)
	$this->link = mysql_connect($this->dbserver, $this->dbuser, $this->dbpword);
    else 
	$this->link = mysql_pconnect($this->dbserver, $this->dbuser, $this->dbpword);

    if (!$this->link)
    {
      $this->print_error("Could not connect to the server $this->dbserver");
    }

    if (!mysql_select_db($this->dbname, $this->link))
    {
      $this->print_error("Could connect to the database ($this->dbname) ");
    }
	
	mysql_set_charset('utf8',$this->link);

	
    return $this->link;
  }

  /**
   * Close mysql connection
   * 
   * @return 	null
   */
  function close()
  {
    if ($this->dbconntype == 0)
    {
      if (!mysql_close($this->link)) return false;
    }
  }


  /**
   * query the database
   * 
   * @param mixed $query		Query to be sent to the database
   * @param booalen $repair		if set to true then the table will be repaied
   * @return
   */
  function query($query)
  {
	check_hook_function('mysql_query_start', $query);
	
    $this->result = mysql_query($query, $this->link) or die($this->print_error("\n" . $query));

    
    $this->queryNum++;
    $this->query_echo .= "<p>".$this->queryNum . "  " . $query."</p>";
    // $this->query_echo .= $query."<br>";

    $result = $this->result;
	
	check_hook_function('mysql_query_end', $this->result);
	
	return $result;
  }

  /**
   * add query results to an array
   * 
   * @param 	mixed 	$result	results
   * @return 	array 			results array
   */
  function dbarray($resoruce, $type = '')
  {
	switch($type)
	{
		default:
		$result = mysql_fetch_array($resoruce);
		break;
		
		case 'NUM':
		$result = mysql_fetch_row($resoruce);
		break;
		
		case 'ASSOC':
		$result = mysql_fetch_assoc($resoruce);
		break;
	}
	
    return $result;
  }

  /**
   * query database and return results in an array
   * 
   * @param 	mixed 	$query	Query to be proccessed
   * @return	array	results array
   */
  function dbfetch($query, $type = '')
  {
    if ($result = $this->query($query))
	return $this->dbarray($result, $type);
  }

  /**
   * Count query rows number
   * 
   * @param 	string 	$ret	Query rows to be counted
   * @return 	integer 		Query rows number
   */
  function dbnumrows($ret = "")
  {
    if ($ret)
	$this->result = $ret;
    $resultNum = mysql_num_rows($this->result);
    $this->queryNum++;
    return $resultNum;
  }

  /**
   * count rows number in a query given by $tabel, $where and $field
   * 
   * @param mixed $table	table in the database to query
   * @param string $where	what to query
   * @param string $field	query scope
   * @return int			number of results
   */
  function dbnumquery($table, $where = "", $field = '')
  {
    $field = $field ? $field : '*';
    if ($where == "")
    {
      $result = $this->query("SELECT $field FROM $table");
    }
    else
    {
      $result = $this->query("SELECT $field FROM $table WHERE $where");
    }

    $results = $this->dbnumrows($result);

    return $results;
  }

  /**
   * retrive the id of the last row inserted
   * 
   * @return int the id of the last row
   */
  function insertid()
  {
    if (mysql_affected_rows() > 0)
    {
      $id = mysql_insert_id();
    }
    return $id;
  }

  
  
  /**
   * print query error when it occurs
   * 
   * @param 	string 	$err	title message
   * @return 	null			error message is printed
   */
  function print_error($err = "")
  {
    $this->error = mysql_error();
    $this->errno = mysql_errno();
    $_error = MYSQLERROR_ERROR . " : " . mysql_error() . "\n";
    $_error .= MYSQLERROR_NUMBER . ": " . $this->errno . "\n";
    $_error .= "Date: " . date("l dS of F Y h:i:s A") . "\n";
    $_error .= "\n---------------Query---------------";
    $output = "<html><head>
                  <title>DIY-CMS Database Error</title>
    		      <style>P,BODY{ font-family:Windows UI,arial; font-size:12px; }</style>
                  </head>
                  <body>
    		      <br><br><blockquote><b>There was an error querying the database.</b><br>
    		     Try reolding the page by clicking on this link <a href=\"javascript:window.location=window.location;\">HERE</a>
    		      If the problem presists please contact adminstrator at <a href='mailto:" . $CONF['site_mail'] . "?subject=Error in database'>this email </a>
    		      <br><br><b>Error Query</b><br>
    		      <form name='mysql'><textarea dir=\"ltr\" rows=\"15\" cols=\"70\">" . $_error . "\n$err</textarea></form></blockquote><br>
                  <p><b><a href=\"http://www.diy-cms.com/\" target=\"_blank\">Powered by: DIY-CMS</a></b></p></body></html>";
    print $output;
    exit;
  }

}

?>