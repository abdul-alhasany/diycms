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
  * Post functions that 
  * 
  * @package	Global
  * @subpackage	Functions
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	2010
  * @access 	public
  */
  

/**
 * Remove all malicious code in post data
 * 
 * @param 	mixed 	$Str	String to be cleaned
 * @return	mixed			Cleaned post
 */
function santize_post_data($Str)
{
  $Str = preg_replace("#(\?|&amp;|&)(PHPSESSID|s|S)=([0-9a-zA-Z]){32}#e", "", $Str);
  $Str = str_replace(array("&amp;", "&lt;", "&gt;"), array("&amp;amp;", "&amp;lt;", "&amp;gt;", ), $Str);
  $Str = preg_replace('#(<[^>]+)style[\x00-\x20]*=[\x00-\x20]*([\`\'\"]*).*expression[\x00-\x20]*\([^>]*>#iU', "$1>", $Str);
  $Str = preg_replace('#(<[^>]+)style[\x00-\x20]*=[\x00-\x20]*([\`\'\"]*).*behaviour[\x00-\x20]*\([^>]*>#iU', "$1>", $Str);
  if (version_compare(phpversion(), "5.0.0", "<"))
  {
    $Str = preg_replace('#(<[^>]+)style[\x00-\x20]*=[\x00-\x20]*([\`\'\"]*).*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*>#iUu', "$1>", $Str);
    $Str = preg_replace('#(&\#*\w+)[\x00-\x20]+;#u', "$1;", $Str);
    $Str = preg_replace('#(&\#x*)([0-9A-F]+);*#iu', "$1$2;", $Str);
    $Str = preg_replace('#(<[^>]+[\x00-\x20\"\'])(on|xmlns)[^>]*>#iUu', "$1>", $Str);
    $Str = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([\`\'\"]*)[\\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iUu',
      '$1=$2nojavascript...', $Str);
    $Str = preg_replace('#([a-z]*)[\x00-\x20]*=([\'\"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iUu',
      '$1=$2novbscript...', $Str);
  }

  $Str = preg_replace('#</*\w+:\w[^>]*>#i', "", $Str);
  $Str =  preg_replace("/(onclick|ondblclick|onmousedown|'
                . 'onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|onkeydown|'
                . 'onkeyup|onfocus|onblur|onabort|onerror|onload)/i"
                , 'forbidden'
                , $Str );
  do
  {
    $oldstring = $Str;
    $string = preg_replace('#</*(applet|meta|xml|blink|link|style|script|embed|object|iframe|frame|frameset|ilayer|layer|bgsound|title|base)[^>]*>#i', "", $Str);
  } while ($oldstring != $Str);

  return $Str;
}


/**
 * Santize data agains mysql injection
 * 
 * @param 	mixed 	$post	Post to be santized
 * @return	mixed			Santized post
 */
function escape_string($post)
{
  if (get_magic_quotes_gpc())
  {
    $post = stripslashes($post);
  }
  $post = mysql_real_escape_string($post);
  return $post;
}


/**
 * Clean post from mailicous code
 * 
 * @param 	mixed 	$text 	Post to be cleaned
 * @return	mixed				Cleaned post
 */
function format_post($text)
{
  check_hook_function('format_post_start', $text);
  
  // replace php and comments tags so they do not get stripped  
  $text = preg_replace("@<\?@", "#?#", $text);
  $text = preg_replace("@<!--@", "#!--#", $text);
  
  // strip tags normally
  $text = strip_tags($text, get_group_setting('allowed_html_tags'));
  
  // return php and comments tags to their origial form
  $text = preg_replace("@#\?#@", "<?", $text);
  $text = preg_replace("@#!--#@", "<!--", $text);
  
  $text = trim($text);
  
  check_hook_function('format_post_end', $text);
  
  return $text;
}

/**
 * Proccess data before sending it to the database
 * 
 * @param mixed $string
 * @return
 */
function format_data($string)
{
  if (is_array($string))
  {
    foreach ($string as & $value)
    {
      $value = santize_post_data(escape_string(stripslashes($value)));
    }
  }
  else
  {
    $string = santize_post_data(escape_string(stripslashes($string)));
  }
	
 return $string;
}

/**
 * Proccess data before viewing it in the browser
 * 
 * @param 	mixed 	$string		String to be proccessed
 * @return	mixed				String
 */
function format_data_out($string)
{
	
  if (is_array($string))
  {
    foreach ($string as &$value)
    {
      $value = preg_replace("#(\?|&amp;|&)(PHPSESSID|s|S)=([0-9a-zA-Z]){32}#e", "", $value);
   //   $value = trim(nl2br(stripslashes($value)));
    }

    return $string;
  }
  else
  {
    $string = preg_replace("#(\?|&amp;|&)(PHPSESSID|s|S)=([0-9a-zA-Z]){32}#e", "", $string);
  //  return trim(nl2br(stripslashes($string)));
   return $string;
  }
}


/**
 * Formate post: replace bbcode, stripslaes and convert lines
 * 
 * @param 	mixed 	$post		post to be evaluated
 * @param 	string 	$editor		Editor used bbcode or html
 * @param	integer $wrap		Number of characters to wrap
 * @return 	mixed				Fomratted post
 */
function post_output($post, $editor = 'bbcode', $wrap = '100000')
{

  check_hook_function('post_output_start', $post);
  
  $string = preg_replace("#(\?|&amp;|&)(PHPSESSID|s|S)=([0-9a-zA-Z]){32}#e", "", $post);
  
  $string = wordwrap($string, $wrap, "\n", 0);
  $string = htmlspecialchars($string);
  

  if ($editor == 'bbcode')
  {
	$bbcode = new bbcode;
	$string = $bbcode->format_bbcode($string);
	$string = nl2br(stripslashes($string));
  }
  elseif ($editor == 'html')
  {
	$string = htmlspecialchars_decode($string, ENT_QUOTES);
  }
  else
  {
	$string = nl2br(stripslashes($string));
  }
  
  check_hook_function('post_output_end', $string);
  
  return $string;
}

/**
 * Replace censored words
 * 
 * @param mixed $string		String in which the function will look for censored words
 * @return mixed			Post with censored words removed
 */
function replace_censored_words($string)
{
  $bad_words = get_global_setting('bad_words');
  if ($bad_words !== '')
  {
    $arr_badword = explode("\n", $bad_words);
    $replacment = ' <font color=red>***</font> ';
    for ($i = 0; $i < count($arr_badword); $i++)
    {
      $arr_badword[$i] = trim($arr_badword[$i]);
      $string = eregi_replace($arr_badword[$i], $replacment, $string);
    }
  }
  return $string;
}

/**
 * This function checks the maximum time allowed to edit a post
 * 
 * @param integer $post_time		Post publishing time
 * @param integer $max_edit_time	Maximum edit time
 * @return booalen					True if user still able to edit, or false if otherwise
 */
function check_edit_time($post_time, $max_edit_time)
{
  $max_edit_time = $max_edit_time * 60;
  $post_time_max = $post_time + $max_edit_time;
  $now = time();

  if (($post_time_max > $now) || ($max_edit_time == 0))
    return true;
  else  return false;
}



/**
 * This function handles image upload
 * 
 * @param string $inputname		Image Input name
 * @param integer $width		Width if the image
 * @param integer $height		Height of the image
 * @param string $new_name		New image name
 * @param integer $size_limit	Size limit
 * @param array $types			Array of image types that are allowed to be uploaed
 * @param array $extensions		Array of image extensions that are allowed to be uploaed
 * @param mixed $module			Module of which the image belongs to
 * @return null					Function will move image to the upload folder
 */
function upload_image($inputname, $width = '200', $height = '200', $new_name, $size_limit = '30', $types = array(), $extensions = array(), $module ='')
{
  global $CONF, $mod;
  if($module == '')
	$module = $mod->modInfo['mod_name'];
	
  if ($_FILES["$inputname"]["tmp_name"] != '')
  {
    if (empty($extensions))
    {
      $extensions = array('.gif', '.png', '.jpg');
    }
    if (empty($types))
    {
      $types = array('image/jpeg', 'image/jpg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif');
    }


    $file = $_FILES["$inputname"]["tmp_name"];
    $size = $_FILES["$inputname"]["size"];
    $type = $_FILES["$inputname"]["type"];
    $fname = $_FILES["$inputname"]["name"];
    $ext = strtolower(strrchr($fname, '.'));
    $size = intval($size / 1024);
    $allow_e = in_array($ext, $extensions);
    $allow_t = in_array($type, $types);
    $imsize = getimagesize($file);
    $x = $imsize[0];
    $y = $imsize[1];

    if ($x > $width)
    {
      error_message("Image's width can not exceed $width");
    } elseif ($y > $height)
    {
      error_message("Image's height can not exceed $height");
    } elseif (!$allow_e)
    {
      error_message("You can not upload this type of files");
    } elseif (!$allow_t)
    {
      error_message("You can not upload this type of extensiosns");
    } elseif ($size > $size_limit)
    {
      error_message("Image's size can not exceed $size_limit KB");
    }
    else
    {
      if (is_uploaded_file($file))
      {
        $avatarfile = get_file_path($new_name, $module);
        $do = move_uploaded_file($file, "$avatarfile");
      }
    }
    return $do;
  }
}


/**
 * Check for required post entries
 * 
 * @param mixed $form	values to be checked
 * @return	booalen		True if all values pass, or false if any one of them is empty
 */
function required_entries($form)
{
  if (!is_array($form))
  {
    $form = trim($form);
    if (empty($form))
    {
      return false;
    }
  }
  else
  {
    foreach ($form as $key => $value)
    {
      if (!isset($key) || (trim($value) == "")) return false;
    }
  }
  return true;
}

 
/**
 * Check the maximum amount allowed of text
 * 
 * @param mixed $txt	Text to be evaluated
 * @param mixed $mxs	Maximum allowed characters
 * @return	booalen		True if characters are less than the maxium, false otherwise
 */
function maximum_allowed($txt, $mxs)
{
  if (strlen($txt) > $mxs)
  {
    return false;
  }
  return true;
}



/**
 * Add http:// to url if it does not exist
 * 
 * @param mixed $str	URL to be evaluated
 * @return	mixed		URL with http:// attached
 */
function add_to_url($str)
{
  if (!strstr($str, 'http://'))
  {
    $str = "http://$str";

  }
  return stripslashes($str);
}


/**
 * Limit the view text characters, used in post headers
 * 
 * @param mixed 	$text		Text to be evaluated
 * @param integer 	$char_num	Maximum number of characters to be viewed
 * @return	mixed				New limited text
 */
function limit_text_view($text, $char_num = '50')
{
  if (strlen($text) > $char_num)
  {
    $new_text = substr($text, 0, $char_num);

    if ($text[$char_num] != " ")
    {
      $new_text = substr($new_text, 0, $char_num - strlen(strrchr($new_text, " ")));
    }

    $text = "$new_text ...";
  }
  return $text;
}

/**
 * This function highlights a word when a search is done
 * 
 * @param 	mixed 	$text		text to be evaluated
 * @return	mixed				Highlighted text
 */
function highlight_words($text)
{
	check_hook_function('highlight_words_start', $text);
  if (isset($_GET['highlight']))
  {
    $highlight = urldecode($_GET['highlight']);
    $text = ereg_replace($highlight, "<font color=\"#FF0000\">\\0</font>", $text);
  }
  check_hook_function('highlight_words_end', $text);
  return $text;
}

  /**
   * Replace smiles images in a post
   * 
   * @param 	mixed 	$post		Text to be evaluated
   * @return	mixed				Text with smiles images replaced
   */
  function replace_smile_images($post)
  {
	global $diy_db;
	$cahce = $diy_db->check_query_cache_file('smile_images');
	
     if ($cahce)
	 {
     $smils = $diy_db->get_query_cache_file('smile_images');
      }
else
{	  
		
	$result = $diy_db->query("SELECT * FROM diy_smileys ORDER BY id");
    while ($row = $diy_db->dbarray($result))
    {
      extract($row);
      $smils[$code] = $smile;
    }
}	
    foreach ($smils as $code => $smile)
    {
      $post = str_replace($code, "<img src='images/smiles/$smile' border='0'>", $post);
    }
    return $post;
  }

?>