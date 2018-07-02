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
 * This calss handles bbcode formatting in all of the cms
 * 
 * @package	Global
 * @subpackage	Classes
 * @author 	Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	2010
 * @access 	public
 */

class bbcode
{
	/**
	 * This functions handels font formating.
	 * search for font bbcode tags and replaces them (bold, italics, align, size, color)
	 * 
	 * @param string $post	the contents of the post to be modified
	 * @return string			bbcode-formatted string
	 */
	function bbcode_font($post)
	{
		
		check_hook_function('bbcode_font_start', $post);
	
		$find    = array(
			'~\[B](.+?)\[/B]~is',
			'~\[I](.+?)\[/I]~is',
			'~\[U](.+?)\[/U]~is',
			'~\[align=(.+?)](.+?)\[/align]~is',
			'~\[face=(.+?)](.+?)\[/face]~is',
			'~\[color=(\S+?)](.+?)\[/color]~is',
			'~\[size=([0-9]+?)](.+?)\[/size]~is'
		);
		$replace = array(
			'<b>$1</b>',
			'<i>$1</i>',
			'<u>$1</u>',
			'<p align="$1">$2</p>',
			'<font face="$1">$2</font>',
			'<font color="$1">$2</font>',
			'<font size="$1">$2</font>'
		);
		
		$string = preg_replace($find, $replace, $post);
		
		check_hook_function('bbcode_font_end', $string);
		
		return $string;
	}
	
	
	/**
	 * This function handels links posted using bbcode
	 * 
	 * @param mixed $post	post containing urls to format
	 * @return string			formatted string
	 */
	function bbcode_url_mail($post)
	{
	
		check_hook_function('bbcode_url_mail_start', $post);
		
		$string       = preg_replace("#([\n ])([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)?[\w]+)#i", "\\1<a href=\"javascript:mailto:mail('\\2','\\3');\">\\2_(at)_\\3</a>", $post);
		$find    = array(
			'~\[url=(.+?)](.+?)\[/url]~is',
			'~(^|\s)(http|https|ftp)(://\S+)~i',
			'~(^|\s)(www.+[a-z0-9-_.])~i',
			'~(^|\s)([a-z0-9-_.]+@[a-z0-9-.]+\.[a-z0-9-_.]+)~i',
			'~\[img](http|https|ftp)://(.+?)\[/img]~i',
		);
		$replace = array(
			'<a href="$1" target=_blank>$2</a>',
			'$1<a href="$2$3" target="_blank">$2$3</a>',
			'$1<a href="http://$2" target="_blank">$2</a>',
			'$1<a href="mailto:$2">$2</a>',
			'<img src="$1://$2" border="0" alt="$1://$2">',
		);
		$string  = preg_replace($find, $replace, $post);
		
	
		check_hook_function('bbcode_url_mail_end', $string);
		
		return $string;
	}
	
	
	/**
	 * This function handels code fomrating (normal code, php code and qouting)
	 * 
	 * @param mixed $post	post to be formatted
	 * @return string			formated post
	 */
	function bbcode_code($post)
	{
	
		check_hook_function('bbcode_code_start', $post);
		
		$post = str_replace("\n", "", trim($post));
		
		$find[] = '~\[code](.+?)\[/code]~is';
		$find[] = '~\[php](.+?)\[/php]~is';
		$post  = preg_replace_callback($find, create_function(
            '$matches',
            '$output = "<center><table width=\'100%\'><tr><td valign=top class=\"diff-log\"><FIELDSET><LEGEND> Code </LEGEND><font size=2 color=#000000 face=Windows UI><table border=0 style=border-collapse: collapse bordercolor=333333 width=100% cellspacing=0 cellpadding=2 bordercolor=000000 bgcolor=#FFFFFF><tr><td width=100% align=left class=coded><span dir=ltr><div style =\"width: 100%; height:250; overflow: auto\">";
			$output .= $matches[1];
			$output .= "</div></td></tr></table></span></font></FIELDSET></td></tr></table></center>";
			return $output;'
        ),
		$post);
		
		check_hook_function('bbcode_code_end', $string);
		
		return $post;
	}
	
	/**
	 * This function handels viewing media that are contained in bbcode (audio, video or flash)
	 * 
	 * @param mixed $post	post contained media content
	 * @return string			formatted post
	 */
	function bbcode_media($post)
	{
	
		check_hook_function('bbcode_media_start', $post);
		
		$find    = array(
			'~\[media=audio](.+?)\[/media]~is',
			'~\[flash=W([0-9]{3})\|H([0-9]{3})\](.*?)\[/flash\]~i',
			'~\[media=video](.+?)\[/media]~is'
		);
		$replace = array(
			'<div align=center><br>
	<OBJECT id=\'rvocx\' classid=\'clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA\'
        width="320" height="240">
        <param name=\'src\' value="$1">
        <param name=\'autostart\' value="true">
        <param name=\'controls\' value=\'imagewindow\'>
        <param name=\'console\' value=\'video\'>
        <param name=\'loop\' value="true">

		<embed  src="$1" style="width:300px;height:60px;" type=\'audio/x-pn-realaudio-plugin\' controls=\'controlpanel,statusbar\' autostart=\'true\'>
		</object></div>
',
			'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="\\1" height="\\2" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0">
  <param NAME="movie" value="\\3" ref>
  <param NAME="quality" VALUE="High"><param NAME="scale" VALUE="NoBorder">
  <embed src="\\3" width="\\1" height="\\2" quality="High" scale="NoBorder" wmode="transparent" bgcolor="#000000" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
  </embed><param name="_cx" value="10583"><param name="_cy" value="9260">
  <param name="Src" value="\\3" ref><param name="Play" value="-1">
<param name="Loop" value="-1"></object>      
',
			
			' 
 <div align=center><br>
        <OBJECT><EMBED src="$3" width="$1" height="$2" loop="false" type=\'audio/x-pn-realaudio-plugin\' controls=\'imagewindow,ControlPanel,statusbar\' console=\'video\' autostart="true">
        </EMBED></OBJECT>
		 </div>'
		);
		$string  = preg_replace($find, $replace, $post);
		
		check_hook_function('bbcode_media_end', $string);
		
		return $string;
	}
	
	/**
	 * handles code viewing in a given post. Used within bbcode::bbcode_code
	 * 
	 * @param string $string
	 * @param string $title
	 * @return			fomratted string
	 */
	 function code($post)
	{
		check_hook_function('code_start', $post);
		
		$post = str_replace("\n", "", trim($post));
		
		$find[] = '~\[code](.+?)\[/code]~is';
		$find[] = '~\[php](.+?)\[/php]~is';
		$post  = preg_replace_callback($find, create_function(
            '$matches',
            '$output = "<center><table width=\'100%\'><tr><td valign=top class=\"diff-log\"><FIELDSET><LEGEND> Code </LEGEND><font size=2 color=#000000 face=Windows UI><table border=0 style=border-collapse: collapse bordercolor=333333 width=100% cellspacing=0 cellpadding=2 bordercolor=000000 bgcolor=#FFFFFF><tr><td width=100% align=left class=coded><span dir=ltr><div style =\"width: 100%; height:250; overflow: auto\">";
			$output .= $matches[1];
			$output .= "</div></td></tr></table></span></font></FIELDSET></td></tr></table></center>";
			return $output;'
        ),
		$post);
		
		check_hook_function('code_end', $post);
		
		return $post;
	}

	/**
	 * handles code viewing in a given post. Used within bbcode::bbcode_code
	 * 
	 * @param string $string
	 * @param string $title
	 * @return			fomratted string
	 */
	 function bbcode_qoute($post)
	{
		check_hook_function('bbcode_qoute_start', $post);
		
		$find = '#\[quote]((?:[^[]|\[(?!/?quote])|(?R))+)\[/quote]#';
		
		$post  = preg_replace_callback($find, create_function(
           '$matches',
            '$output = "<center><table width=\'100%\'><tr><td valign=top class=\"diff-log\"><FIELDSET><LEGEND> Qoute </LEGEND><font size=2 color=#000000 face=Windows UI><table border=0 style=border-collapse: collapse bordercolor=333333 width=100% cellspacing=0 cellpadding=2 bordercolor=000000 bgcolor=#FFFFFF><tr><td width=100% align=right class=coded><span dir=rtl><div style =\"width: 100%; height:250; overflow: auto\">";
			$output .= $matches[1];
			$output .= "</div></td></tr></table></span></font></FIELDSET></td></tr></table></center>";
			return $output;'
        ),
		$post);

		return $post;
	}
	
	
	/**
	 * This function is to be called in other files if bbcode formatting is required
	 * 
	 * @param mixed $post
	 * @return
	 */
	function format_bbcode($post)
	{
		check_hook_function('format_bbcode_start', $post);
		
		$string = preg_replace("/(onclick|ondblclick|onmousedown|'
                . 'onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|onkeydown|'
                . 'onkeyup|onfocus|onblur|onabort|onerror|onload|window\.location)/i", 'forbidden', $post);
		$string = $this->bbcode_code($string);
		$string = $this->bbcode_font($string);
		$string = $this->bbcode_url_mail($string);
		$string = $this->bbcode_media($string);
		$string = $this->bbcode_qoute($string);

		check_hook_function('format_bbcode_end', $string);
		
		return $string;
	}
	
}

?>