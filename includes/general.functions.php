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
 * general functions to manage different aspects of DiY-CMS
 * 
 * @package	Global
 * @subpackage	Functions
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	2010
 * @access 	public
 */

/**
 * Display navigation bar for control panel
 * 
 * @param 	string 	$extra	Add any extra element to the navigation bar
 * @return	mixed			Navigation bar templates
 */
function display_nav_bar($extra = '')
{
    global $templates;
	
    check_hook_function('display_nav_bar_extra', $extra);
	
    $sitetitle   = get_global_setting("sitetitle");
    $module_name = "<a href=control.php>".LANG_CONTROL_PANEL."</a>";
    if (is_array($extra)) {
        foreach ($extra as $key => $value) {
            if (is_numeric($key)) {
                $module_name .= "&nbsp;» $value";
            } else {
                $module_name .= "&nbsp;» <a href=$value> $key</a>";
            }
        }
    } elseif (!empty($extra)) {
        $module_name .= "&nbsp;» $extra";
    }
    
	$template_array = array('sitetitle' => $sitetitle, 'module_name' => $module_name);
    $template .= $templates->display_template('module_nav_bar', $template_array);
	
	 check_hook_function('display_nav_bar_end', $template);
	 
    return $template;
}


/**
 * Check whether email is a valid email or not
 * 
 * @param 	mixed 	$email	Email to be validated
 * @return 	boolean			False if email is invalid, true of it is valid
 */
function check_email_validity($email)
{
    if (ereg("^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$", $email))
        return true;
    else
        return false;
}

/**
 * Pagination function, allows for the pagination of huge data
 * 
 * @param 	integer	$numrows	Number of total rows
 * @param 	integer	$perpage	Number of rows per page
 * @param 	string 	$link		Link to be used when a page is clicked
 * @return	mixed				pagination template
 */
function pagination($numrows, $perpage, $link = '')
{
    global $templates;
	
    check_hook_function('pagination_numrows', $numrows);
	
    if ($numrows > "$perpage") {
		$pagenum .= $templates->display_template('pagination_start');

        if ($_GET['page'] > 1) {
            $prestart = ($_GET['page'] * $perpage) - (2 * $perpage);
            $prepage  = $_GET['page'] - 1;
			$pagenum .= $templates->display_template('pagination_first_page', array('link' => $link));
			$pagenum_prev = array('nextpage' => $nextpage,
								'link' => $link,
								'prestart' => $prestart,
								'prepage' => $prepage);
			$pagenum .= $templates->display_template('pagination_previous_page', $pagenum_prev);

            $pagenum .= "";
            
        }
        
        $pages = ceil($numrows / $perpage);
        
        if ($_GET['page'] == 0) {
            $_GET['page'] = 1;
        }
        
        if ($_GET['page'] > 0) {
            $_GET['page'] = $_GET['page'] - 2;
        }
        
        $maxpage = $_GET['page'] + 4;
        
        for ($i = $_GET['page']; $i <= $maxpage && $i <= $pages; $i++) {
            if ($i > 0) {
                $nextpag = $perpage * ($i - 1);
                if ($nextpag == $_GET['start']) {
				$pagenum .= $templates->display_template('pagination_current_page', array('i' => $i));
                } else {
				$pagenum_array = array('nextpag' => $nextpag,
										'link' => $link,
										'i' => $i
										);
				$pagenum .= $templates->display_template('pagination_available_pages', $pagenum_array);
                }
            }
        }
        
        if (!(($_GET['start'] / $perpage) == ($pages - 1)) && ($pages != 1)) {
            $nextpag   = ($pages * $perpage) - $perpage;
            // the $_GET['page'] is realted to the one above, for each number subsituted in the above number an extra one must be added to this
            $nextstart = ($_GET['page'] + 2) * $perpage;
            $nextpage  = $_GET['page'] + 3;
			$pagenum_array = array('nextpage' => $nextpage,
								'nextpag' => $nextpag,
								'link' => $link,
								'pages' => $pages,
								'nextstart' => $nextstart);
								
			$pagenum .= $templates->display_template('pagination_next_page', $pagenum_array);
			$pagenum .= $templates->display_template('pagination_last_page', $pagenum_array);
        }
		$pagenum .= $templates->display_template('pagination_last');
    }
	
	check_hook_function('pagination_end', $pagenum);
	
    return $pagenum;
}


/**
 * Displays pagination next to a topic title 
 * 
 * @param integer 	$numrows	Number of total rows to be paginatied
 * @param integer 	$perpage	Number of row per page
 * @param mixed		$link		Link to be viewed when a page is clicked
 * @return mixed				Topic pagination list
 */
function pagination_list($numrows, $perpage, $link)
{
	check_hook_function('pagination_list_start', $numrows);
    if ($numrows > "$perpage") {
        $start = 0;
        
        $pagenum = "<br><font class=fontablt>pages : ";
        
        $pages = ceil($numrows / $perpage);
        
        $maxpage = $page + 3;
        
        for ($i = 0; $i <= $maxpage && $i <= $pages; $i++) {
            if ($i > 0) {
                $nextpag = $perpage * ($i - 1);
                
                $pagenum .= "<font class=fontht><a href=$link&start=$nextpag&page=$i>[$i]</a></font>\n";
            }
        }
        if (!(($start / $perpage) == ($pages - 1)) && ($pages != 1)) {
            $nextpag = ($pages * $perpage) - $perpage;
            
            $pagenum .= "...<font class=fontht><a href=$link&start=$nextpag&page=$pages>[$pages]</a></font>\n";
        }
        $pagenum .= "</font>";
    }
	
	check_hook_function('pagination_list_end', $pagenum);
	
    return $pagenum;
}


/**
 * Check whether a certian value is an integer or not (useful for $_GET['ID'] value evaluation)
 * It also make the value a required entry (so if it does not exist an error message will be displayed
 * 
 * @param 	integer $value	value toi be evaluated
 * @return 	integer			Evaluated integer
 */
function set_id_int($value)
{
    $id = intval($_GET[$value]);
    
    if (!required_entries($id)) {
        error_message(LANG_ERROR_URL);
    }
    return $id;
}

/**
 * Convert size to the appropriate unit
 * 
 * @param 	mixed 	$filesize	Size to be formatted
 * @return 	integer				Formatted size
 */
function format_Size($filesize)
{
	check_hook_function('format_size_filesize', $filesize);
	
    $byteUnits = array(
        "GB",
        " MB",
        " KB",
        " bytes"
    );
    
    if ($filesize >= 1073741824) {
        $format_filesize = round($filesize / 1073741824 * 100) / 100 . $byteUnits[0];
    } elseif ($filesize >= 1048576) {
        $format_filesize = round($filesize / 1048576 * 100) / 100 . $byteUnits[1];
    } elseif ($filesize >= 1024) {
        $format_filesize = round($filesize / 1024 * 100) / 100 . $byteUnits[2];
    } else {
        $format_filesize = $filesize . $byteUnits[3];
    }
	
	check_hook_function('format_size_end', $format_filesize);
	
    return $format_filesize;
}


/**
 * Check if a cookie exist for the current user
 * 
 * @return	null 	an error message will be displayed if no cookie is found
 */
function checkcookie()
{
    extract($GLOBALS);
    
    unset($Login);
    
    if (($_COOKIE['clogin'] != 'DIY-CMS') && (!$_COOKIE['cid'] > 0 or $_COOKIE['cid'] == $CONF['Guest_id'])) {
        diy_page_header(LANG_TITLE_LOG_IN);
        
		print $templates->display_template('login_page');
        
        diy_page_footer($pageft);
        
        exit;
    }
}

/**
 * Display login form for restricted area
 * 
 * @return	mixed	Function will return login template
 */
function Login()
{
    extract($GLOBALS);
    diy_page_header(LANG_TITLE_LOG_IN);
    print $templates->display_template('login_page');
    diy_page_footer($pageft);
}


/**
 * Display page header
 * 
 * @param 	mixed 	$title		Title of the page
 * @param 	integer $Cache		If set to 0 it will override default cache control
 * @param 	string 	$pagekey	Page Keyword
 * @param 	string 	$pagedesc	Page Description
 * @return	null				Will return page header
 */
function diy_page_header($title, $Cache = 0, $pagekey = '', $pagedesc = '')
{
    global $CONF, $mod, $templates;
    if ($CONF['gzip_compress'] == true) {
        if (strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
            if (extension_loaded('zlib')) {
                header('Content-Encoding: gzip');
                ob_start("ob_gzhandler");
            }
        }
    }
    
    header("Cache-Control: must-revalidate");
    $offset = 60 * 60 * 24 * -1;
    $ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
    header($ExpStr);
    
    $header = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
   \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
   <!ENTITY % HTMLspecial PUBLIC \"-//W3C//ENTITIES Special//EN//HTML\"
   \"http://www.w3.org/TR/REC-html40-971218/HTMLspecial.ent\">
<HTML DIR=" . $CONF['dir'] . ">
<head>";


    check_hook_function('page_header_head_tag_start', $header);
	
	$header .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
<META content=\"" . get_global_setting("keywords") . ',' . $pagekey . "\" name=\"keywords\">
<META content=\"" . get_global_setting("Description") . ' ' . $pagedesc . "\" name=\"description\">
<META NAME=\"COPYRIGHT\" CONTENT=\"Copyright© by DIY-CMS\">
<META content=\"ALL\" name=\"ROBOTS\">
<META NAME=\"REVISIT-AFTER\" CONTENT=\"1 DAYS\">
<META NAME=\"RATING\" CONTENT=\"GENERAL\">";
    
    
    $header .= "<title>" . $mod->mod_title . $title . " - " . get_global_setting("sitetitle") . " </title>";
    $header .= "
<link rel=\"shortcut icon\" href=\"images/favicon.png\" type=\"image/x-icon\">";
    if (file_exists($CONF['site_path'] . "/themes/" . $templates->themepath . "/style.css")) {
        $header .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"themes/" . $templates->themepath . "/style.css\">";
    } else {
        $header .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"html/css/" . $templates->css . ".css\">";
    }
   
    check_hook_function('page_header_head_tag_end', $header);
	
    $header .= "</head>";
    
	
	check_hook_function('page_header', $header);

    echo $header;
    flush();
}


/**
 * Display an information message and redirect the user to the link set by $url
 * 
 * @param mixed  $msg	Message to be displayed
 * @param string $url	The URL the user will be redircted to
 * @param string $time	Seconds before the user is transfered
 * @return	null		Return the information message template and exit the script
 */
function info_message($msg, $url = '', $time = '3')
{
    global $templates, $themepath;
	
	check_hook_function('info_message_message', $msg);
	
	check_hook_function('info_message_url', $url);
	
	check_hook_function('info_message_time', $time);
	
    if ($url == '') {
        $X_url = explode('/', $_SERVER['HTTP_HOST']);
        $Y_url = explode('/', $_SERVER['HTTP_REFERER']);
        $goto  = ($X_url[0] != $Y_url[2]) ? $goto = 'index.php' : $goto = $_SERVER['HTTP_REFERER'];
        
        header("Refresh:" . $time . "; url=" . $goto . "");
    } else {
        header("Refresh:" . $time . ";url=" . $url . "");
    }
    
	diy_page_header($msg);
	$template_array = array('msg' => $msg, 'url' => $url, 'time' => $time,);
	
	$template = $templates->display_template('body_msg', $template_array);
	check_hook_function('info_message_end', $template);
	echo $template;
	diy_page_footer();
    exit;
}


/**
 * Display error message
 * 
 * @param string $msg 	Error message to be displayed
 * @return null 		Reutrn Error message template and exit the rest of the script
 */
function error_message($msg)
{
    global $templates;
	
	check_hook_function('error_message_start', $msg);
	
    diy_page_header(LANG_TITLE_ERROR);
    $template = $templates->display_template('error_msg', array('msg' => $msg));
	check_hook_function('error_message_error', $template);
	echo $template;
	diy_page_footer();
    exit;
}

/**
 * Display a popup message
 * 
 * @param 	mixed 	$msg 	Content to be displayed in the popup window
 * @return	mixed			Pop Message Template
 */
function popup_window($msg)
{
    global $templates;
	check_hook_function('popup_window_msg', $msg);
	
	$popup = $templates->display_template('popup_msg', array('msg'=> $msg));
	
	check_hook_function('popup_window_end', $popup);
	echo $popup;
}


/**
 * Display page footer 
 * 
 * @return	Page Footer
 */
function diy_page_footer($r = '')
{
    global $diy_db, $CONF;
    $diy_db->close();
	

    check_hook_function('page_footer', $empty);
	    
	
    if ($CONF['gzip_compress'] == true) {
		$contents = ob_get_contents();
		ob_end_clean();
		check_hook_function('page_footer_gzcontent', $contents);
        $gzip_size     = strlen($contents);
        $gzip_crc      = crc32($gzip_contents);
        $gzip_contents = gzcompress($gzip_contents, 9);
        $gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);
        echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
        echo $gzip_contents;
        echo pack('V', $gzip_crc);
        echo pack('V', $gzip_size);
    }
	if($CONF['show_queries'] == 1)
	{
    echo "<font size=4>" . $diy_db->queryNum. "<br>";
    echo "<font size=4>" . $diy_db->query_echo . "<br>";
    echo format_size(memory_get_usage()) . "<br>";
    echo format_size(memory_get_peak_usage()) . "<br>";
	}
    exit;
}

//---------------------------------------------------

/**
 * Implode data
 * 
 * @param 	mixed 	$array	array to be imploded
 * @return	mixed			Imploded Data
 */
function implode_data($array)
{
    if (isset($array)) {
        foreach ($array as $arrid) {
            $arr_id .= $arrid . ",";
        }
        return substr($arr_id, 0, strlen($arr_id) - 1);
    }
}


/**
 * This function check the website the user came from
 * 
 * @return	null
 */
function check_referer()
{
    global $CONF;
    $CONF['parked_domain'][] = $_SERVER['SERVER_NAME'];
    if (count($CONF['parked_domain']) > 0) {
        foreach ($CONF['parked_domain'] as $pdomain) {
            if (!strcmp(get_host_name($pdomain), get_host_name($_SERVER['HTTP_REFERER']))) {
                $result = true;
            }
        }
    }
    if ($result != true)
        error_message(LANG_ERROR_URL . "<br>" . $_SERVER['HTTP_REFERER']);
}

/**
 * Get the host name
 * 
 * @param 	mixed 	$str
 * @return	String host name
 */
function get_host_name($str)
{
    preg_match("/^(http:\/\/)?([^\/]+)/i", $str, $matches);
    $host = $matches[2];
    if (!eregi('^[0-9]{1,3}[\.\/]{1}[0-9]{1,3}[\.\/]{1}[0-9]{1,3}[\.\/]{1}[0-9]{1,3}$', $host)) {
        preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
        return strtolower("www." . $matches[0]);
    } else {
        $Strhost = strtolower(gethostbyaddr($host));
        if (!strstr($Strhost, "www."))
            $Strhost = "www." . $Strhost;
        return $Strhost;
    }
}



/**
 * Format data
 * 
 * @param 	mixed 	$timestamp	Timesatmp to be formated
 * @return	mixed				Formatted date
 */
function format_date($timestamp)
{
    global $CONF;
	
	check_hook_function('format_date_timestamp', $timestamp);
	$time  = date($CONF['date_format'], $timestamp);
	
	$days = array('Monday', 'Tuesday', 'Wednesday','Thursday', 'Friday', 'Saturday', 'Sunday');
    $newdays = array(DAY_MONDAY, DAY_TUESDAY, DAY_WEDNESDAY, DAY_THURSDAY, DAY_FRIDAY, DAY_SATURDAY, DAY_SUNDAY);
	 
	$months = array("January","February","March","April","May","June","July","August","September","October","November","December");
    $newMonths = array(MONTH_JANUARY,MONTH_FEBRUARY,MONTH_MARCH,MONTH_APRIL,MONTH_MAY,MONTH_JUNE,MONTH_JULY,MONTH_AUGUST,MONTH_SEPTEMBER,MONTH_OCTOBER,MONTH_NOVEMBER,MONTH_DECEMBER);
		 
	$date = str_replace($days, $newdays, $time);
	$date = str_replace($months, $newMonths, $date);
	
	check_hook_function('format_date_end', $time);
	return $date;
}


/**
 * Get time out of timestamp
 * 
 * @param 	mixed 	$timestamp	Timestamp to be formatted
 * @return	mixed				Formatted Timestamp
 */
function format_time($timestamp)
{
	check_hook_function('format_time_timestamp', $timestamp);
    
    $timedates = date("h:i a", $timestamp);
    
    $timedates = str_replace("am", TIME_AM, $timedates);
    
    $timedates = str_replace("pm", TIME_PM, $timedates);
	
    check_hook_function('format_time_end', $timedates);
	
    return $timedates;
}



/**
 * Add slahes to URLs
 * 
 * @param	 mixed	 $url	URL to be slashed
 * @return	 mixed			Slahsed URL
 */
function add_url_slash($url)
{
    if (substr($url, -1) != '/') {
        $url = $url . '/';
    }
    return $url;
}


/**
 * Get the user rank
 * 
 * @param 	mixed 		$rank_array		Rank Array
 * @param 	integer 	$posts			Number of users posts
 * @return	mixed						Title of user and his rank
 */
function get_user_rank($rank_array, $posts)
{
    foreach ($rank_array as $posts_no => $value) {
        // Check if the userposts have reached a certain rank
        if ($posts_no < $posts) {
            foreach ($value as $title => $repeate) {
                $ratingimg = "<img src=images/user_rank.gif border=0>";
                $rank      = str_repeat($ratingimg, $repeate);
                $userrank  = "$title<br>$rank";
            }
        }
    }
    
    return $userrank;
    
}

/**
 * This function returens the group title of a particular user
 * 
 * @param mixed 	$array		Groups array
 * @param integer 	$usergid	User groupid
 * @return
 */
function get_user_group($array, $usergid)
{
    foreach ($array as $gid => $title) {
        if ($gid == $usergid) {
            return $title;
        }
    }
}

/**
 * Get user infomration and put them in an object
 * 
 * @param 	integer $userid		Userid
 * @return	mixed				User information
 */
function get_user_info($userid)
{
    global $diy_db;
    $result = $diy_db->query("SELECT * FROM diy_users WHERE userid='$userid'");
    $record = mysql_fetch_object($result);
    return $record;
}


/**
 * Get message from the html/messag folder
 * 
 * @param 	mixed 	$message	Message title (has to be the same one in html/message folder
 * @param 	string 	$htm		1 for html mssage and 0 for text message
 * @param 	mixed 	$replace	Array to replace the values in the message
 * @return	mixed				Message to be sent			
 */
function get_message($message, $htm = '1', $replace = array())
{
    if ($htm == '1') {
        $path = "html/message/" . $message . ".htm";
    } else {
        $path = "html/message/" . $message . ".txt";
    }
    $fp   = fopen($path, "r");
    $read = fread($fp, filesize($path));
    fclose($fp);
    foreach ($replace as $key => $value) {
        $read = str_replace($key, $value, $read);
    }
    return $read;
}

/**
 * Replce callback functions
 * 
 * @use <!--RFF dir="menu" file="count.html" -->
 * @use <!--RFF dir="URL" file="http://127.0.0.1/clean/menu/count.php" -->
 * @use <!--INC dir="menu" file="count.php" -->
 *
 * @param 	mixed 	$string		String in which pattern exist
 * @return	mixed				String with the callback functions called
 */
function replace_callback($string)
{
    $string = preg_replace_callback('/<!--RFF dir="(.+?)" file="(.+?)" -->/', "ReadFromFile", $string);
    $string = preg_replace_callback('/<!--INC dir="(.+?)" file="(.+?)" -->/', "includeFile", $string);
    return $string;
}


/**
 * Include a function when the replace_callback is called
 * 
 * @param 	mixed 	$matches	Matches from the replace_callback function
 * @return	mixed				Included file
 */
function includeFile($matches)
{
    global $diy_db;
    
    $getFile = $matches[1] . "/" . $matches[2];
    
    if (file_exists($getFile)) {
        $block =& $this;
        
        ob_start();
        require_once($getFile);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    return $getFile;
}


/**
 * Read from a file or a link
 * 
 * @param mixed $matches
 * @return
 */
function ReadFromFile($matches)
{
    //  global $block;
    
    $block =& $this;
    
    if ($matches[1] == 'URL') {
        $getFile = $matches[2];
        
        if (!$fd = @fopen($getFile, "r"))
            return;
        
        while (!feof($fd)) {
            $buffer .= fgets($fd, 4096);
        }
        
        fclose($fd);
        
        return $buffer;
    } else {
        $getFile = $matches[1] . "/" . $matches[2];
    }
    
    if (file_exists($getFile)) {
        $fd = fopen($getFile, "r");
        
        $buffer = fread($fd, filesize($getFile));
        
        fclose($fd);
        
        return $buffer;
    }
    
}

/**
 * Put all website settings into an array
 * 
 * @return	array	Settings array
 */
function diy_global_settings_array()
{
    global $diy_db;
    
	$cahce = $diy_db->check_query_cache_file('global_settings');
	if($cahce)
	{
	return $diy_db->get_query_cache_file('global_settings');
	}
	
    $result = $diy_db->query("SELECT variable,value FROM diy_settings");
    
    while ($row = $diy_db->dbarray($result, $i++)) {
        $key         = $row['variable'];
        $array[$key] = $row['value'];
    }
    return $array;
}

/**
 * Put all groups permissions into a single array for better performance
 * 
 * @return	array	permissions array
 */
function diy_group_permissions_array()
{
    global $diy_db;
    
	$cahce = $diy_db->check_query_cache_file('global_groups_permissions');
	if($cahce)
	{
	return $diy_db->get_query_cache_file('global_groups_permissions');
	}
	
    $result  = $diy_db->query("SELECT groupid, variable, value FROM diy_groups_privileges");
    while($row = $diy_db->dbarray($result))
	{
		extract($row);
		$array[$groupid][$variable] = $value;
	}
	return $array;
	
}


/**
 * Get a single global setting
 * 
 * @param mixed $setting
 * @return
 */
function get_global_setting($setting)
{
	global $diy_global_settings_array;
	return  $diy_global_settings_array[$setting];
}

/**
 * Get a setting for a spcified group
 * 
 * @param 	mixed	 $setting	Setting to be retrived
 * @return	mixed				The value of the setting
 */
function get_group_setting($setting)
{	
	global $diy_group_permissions_array;
	$groupid = (int)$_COOKIE['cgroup'];
    return $diy_group_permissions_array[$groupid][$setting];
}


/**
 * Get user IP
 * 
 * @return	mixed	User IP
 */
function get_user_ip()
{
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : $_ENV['REMOTE_ADDR'];
    return $ip;
}

/**
 * Get path for uploaded images or files
 * 
 * @param 	mixed 	$upload_name	Name of the file
 * @param 	string 	$module			Module of which the file belongs to
 * @param 	mixed 	$dir_path		Folder at which the file resides, if left empty the default path will be used
 * @return
 */
function get_file_path($upload_name, $module = '', $dir_path = '')
{
    global $CONF, $mod;
    if ($module == '')
        $module = $mod->modInfo['mod_name'];
    
    if ($dir_path == '')
        $dir_path = $CONF['upload_path'];
    
    $file_path = $dir_path . "/" . $module . "/" . $upload_name;
    return $file_path;
}


//---------------------------------------------------
// function created by ArabGenius
//---------------------------------------------------
function get_contents($link)
{
    if (function_exists('curl_init')) {
        $curl    = curl_init();
        $timeout = 0;
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
        $buffer = curl_exec($curl);
        curl_close($curl);
        return $buffer;
    } elseif (function_exists('file_get_contents')) {
        $buffer = file_get_contents($link);
        return $buffer;
    } elseif (function_exists('file')) {
        $buffer = implode('', @file($link));
        return $buffer;
    } else {
        return 0;
    }
}

function diy_error_handler($errno, $errstr, $errfile, $errline)
{
    switch ($errno) {
    case E_USER_ERROR:
        echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
        echo "  Fatal error on line $errline in file $errfile";
        echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
        echo "Aborting...<br />\n";
        exit(1);
        break;

    case E_USER_WARNING:
	error_message("<b>Warning</b> [$errno] $errstr<br />\n");
        break;

    case E_USER_NOTICE:
        echo "<b>User Notice</b> [$errno] $errstr<br />\n";
        break;
		
    case E_ERROR:
    case E_CORE_ERROR:
    case E_COMPILE_ERROR:
    case E_USER_ERROR:
        error_message("<b>Error</b> [$errno] $errstr<br />\n");
        break;
		
    case E_PARSE:
        error_message("<b>Parse</b> [$errno] $errstr<br />\n");
        break;
		
    case E_NOTICE:
    //    error_message("<b>Notice</b> [$errno] $errstr<br />\n");
        break;
		
    case E_ALL:
       error_message("<b>General</b> [$errno] $errstr<br />\n");
     break;

    default:
    //   error_message("Unknown error type: [$errno] $errstr<br />\n");
        break;
    }

    /* Don't execute PHP internal error handler */
    return true;
}

function get_diycms_version($minor = false)
{
	$version = ($minor == true) ? "1.1.2" : "1.1";
	
	return $version;
}
?>