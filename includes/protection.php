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
 * Santizes all $_GET dataand prevent XSS Attacks
 * 
 * @package		Global
 * @subpackage	Functions
 * @author 		Abdul Al-Hasany
 * @copyright 	Abdul Al-hasany (c) 2011
 * @version 	2010
 * @access 		public
 */


// run functions to santize $_GET data

$_GET = array_func('prevenet_xss_attacks', $_GET);
block_hack();

/**
 * Check if $_GET is an array or not, then apply the appropiate function
 * 
 * @param 	mixed 		$func		Function
 * @param 	mixed 		$array		Array to be santized
 * @return	array|string			Santized data
 */
function array_func($func, $array)
{
	if (is_array($array)) {
		foreach ($array as $key => $val) {
			$return[$key] = $func($val);
		}
		return $return;
	} else {
		return $func($array);
	}
}


/**
 * Prevent XSS attacks
 * 
 * @param 	mixed $val 	Value to be santized
 * @return 	string		Santized value
 */
function prevenet_xss_attacks($val)
{
	$val    = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val);
	$search = 'abcdefghijklmnopqrstuvwxyz';
	$search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$search .= '1234567890!@#$%^&*()';
	$search .= '~`";:?+/={}[]-_|\'\\';
	for ($i = 0; $i < strlen($search); $i++) {
		$val = preg_replace('/(&#[x|X]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val); // with a ;
		$val = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val); // with a ;
	}
	
	$ra1 = array(
		'javascript',
		'vbscript',
		'expression',
		'applet',
		'meta',
		'xml',
		'blink',
		'link',
		'style',
		'script',
		'embed',
		'object',
		'iframe',
		'frame',
		'frameset',
		'ilayer',
		'layer',
		'bgsound',
		'title',
		'base'
	);
	$ra2 = array(
		'onabort',
		'onactivate',
		'onafterprint',
		'onafterupdate',
		'onbeforeactivate',
		'onbeforecopy',
		'onbeforecut',
		'onbeforedeactivate',
		'onbeforeeditfocus',
		'onbeforepaste',
		'onbeforeprint',
		'onbeforeunload',
		'onbeforeupdate',
		'onblur',
		'onbounce',
		'oncellchange',
		'onchange',
		'onclick',
		'oncontextmenu',
		'oncontrolselect',
		'oncopy',
		'oncut',
		'ondataavailable',
		'ondatasetchanged',
		'ondatasetcomplete',
		'ondblclick',
		'ondeactivate',
		'ondrag',
		'ondragend',
		'ondragenter',
		'ondragleave',
		'ondragover',
		'ondragstart',
		'ondrop',
		'onerror',
		'onerrorupdate',
		'onfilterchange',
		'onfinish',
		'onfocus',
		'onfocusin',
		'onfocusout',
		'onhelp',
		'onkeydown',
		'onkeypress',
		'onkeyup',
		'onlayoutcomplete',
		'onload',
		'onlosecapture',
		'onmousedown',
		'onmouseenter',
		'onmouseleave',
		'onmousemove',
		'onmouseout',
		'onmouseover',
		'onmouseup',
		'onmousewheel',
		'onmove',
		'onmoveend',
		'onmovestart',
		'onpaste',
		'onpropertychange',
		'onreadystatechange',
		'onreset',
		'onresize',
		'onresizeend',
		'onresizestart',
		'onrowenter',
		'onrowexit',
		'onrowsdelete',
		'onrowsinserted',
		'onscroll',
		'onselect',
		'onselectionchange',
		'onselectstart',
		'onstart',
		'onstop',
		'onsubmit',
		'onunload'
	);
	$ra  = array_merge($ra1, $ra2);
	
	$found = true; // keep replacing as long as the previous round replaced something
	while ($found == true) {
		$val_before = $val;
		for ($i = 0; $i < sizeof($ra); $i++) {
			$pattern = '/';
			for ($j = 0; $j < strlen($ra[$i]); $j++) {
				if ($j > 0) {
					$pattern .= '(';
					$pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?';
					$pattern .= '|(&#0{0,8}([9][10][13]);?)?';
					$pattern .= ')?';
				}
				$pattern .= $ra[$i][$j];
			}
			$pattern .= '/i';
			$replacement = substr($ra[$i], 0, 2) . '<x>' . substr($ra[$i], 2); // add in <> to nerf the tag
			$val         = preg_replace($pattern, $replacement, $val); // filter out the hex tags
			if ($val_before == $val) {
				$found = false;
			}
		}
	}
	return $val;
}

/**
 * Block hacking attempt throught url
 * 
 * @return null	Script will exit, writes error to a file and displays an error message
 */
function block_hack()
{
	global $_SERVER;
	
	check_hook_function('block_hack_attempt_start', $empty);
	
	$cracktrack = $_SERVER['QUERY_STRING'];
	$ct_rules   = array(
		'chr(',
		'chr=',
		'chr%20',
		'%20chr',
		'wget%20',
		'%20wget',
		'wget(',
		'cmd=',
		'%20cmd',
		'cmd%20',
		'rush=',
		'%20rush',
		'rush%20',
		'union%20',
		'%20union',
		'union(',
		'union=',
		'echr(',
		'%20echr',
		'echr%20',
		'echr=',
		'esystem(',
		'esystem%20',
		'cp%20',
		'%20cp',
		'cp(',
		'mdir%20',
		'%20mdir',
		'mdir(',
		'mcd%20',
		'mrd%20',
		'rm%20',
		'%20mcd',
		'%20mrd',
		'%20rm',
		'mcd(',
		'mrd(',
		'rm(',
		'mcd=',
		'mrd=',
		'mv%20',
		'rmdir%20',
		'mv(',
		'rmdir(',
		'chmod(',
		'chmod%20',
		'%20chmod',
		'chmod(',
		'chmod=',
		'chown%20',
		'chgrp%20',
		'chown(',
		'chgrp(',
		'locate%20',
		'grep%20',
		'locate(',
		'grep(',
		'diff%20',
		'kill%20',
		'kill(',
		'killall',
		'passwd%20',
		'%20passwd',
		'passwd(',
		'telnet%20',
		'vi(',
		'vi%20',
		'insert%20into',
		'select%20',
		'nigga(',
		'%20nigga',
		'nigga%20',
		'fopen',
		'fwrite',
		'%20like',
		'like%20',
		'$_request',
		'$_get',
		'$request',
		'$get',
		'.system',
		'HTTP_PHP',
		'&aim',
		'%20getenv',
		'getenv%20',
		'new_password',
		'/etc/password',
		'/etc/shadow',
		'/etc/groups',
		'/etc/gshadow',
		'HTTP_USER_AGENT',
		'HTTP_HOST',
		'/bin/ps',
		'wget%20',
		'uname\x20-a',
		'/usr/bin/id',
		'/bin/echo',
		'/bin/kill',
		'/bin/',
		'/chgrp',
		'/chown',
		'/usr/bin',
		'g\+\+',
		'bin/python',
		'bin/tclsh',
		'bin/nasm',
		'perl%20',
		'traceroute%20',
		'ping%20',
		'.pl',
		'/usr/X11R6/bin/xterm',
		'lsof%20',
		'/bin/mail',
		'.conf',
		'motd%20',
		'HTTP/1.',
		'.inc.php',
		'config.php',
		'cgi-',
		'.eml',
		'file\://',
		'window.open',
		'<SCRIPT>',
		'javascript\://',
		'img src',
		'img%20src',
		'.jsp',
		'ftp.exe',
		'xp_enumdsn',
		'xp_availablemedia',
		'xp_filelist',
		'xp_cmdshell',
		'nc.exe',
		'.htpasswd',
		'servlet',
		'/etc/passwd',
		'wwwacl',
		'~root',
		'~ftp',
		'.js',
		'.jsp',
		'.history',
		'bash_history',
		'.bash_history',
		'~nobody',
		'server-info',
		'server-status',
		'reboot%20',
		'halt%20',
		'powerdown%20',
		'/home/ftp',
		'/home/www',
		'secure_site, ok',
		'chunked',
		'org.apache',
		'/servlet/con',
		'<script',
		'/robot.txt',
		'/perl',
		'mod_gzip_status',
		'db_mysql.inc',
		'.inc',
		'select%20from',
		'select from',
		'drop%20',
		'.system',
		'getenv',
		'http_',
		'_php',
		'<?php',
		'?>',
		'sql=',
		'_global',
		'global_',
		'global[',
		'_server',
		'server_',
		'server[',
		'phpadmin',
		'root_path',
		'_globals',
		'globals_',
		'globals[',
		'ISO-8859-1',
		'http://www.google.de/search',
		'?hl=',
		'.txt',
		'.exe',
		'google.de/search',
		'yahoo.de',
		'lycos.de',
		'fireball.de',
		'ISO-'
	);
	
	$cracktrack = strtolower($cracktrack);
	$checkworm  = str_replace($ct_rules, '*', $cracktrack);
	
	if ($cracktrack != $checkworm) {
		require_once('includes/files.class.php');
		Files::write("html/bugs.txt", "\n\r\n" . time() . ' :: ' . $_SERVER['REMOTE_ADDR'] . ' :: ' . $_SERVER['REQUEST_URI'], 'a+', 'NoError');
		
		check_hook_function('block_hack_attempt_checkworm', $checkworm);
		check_hook_function('block_hack_attempt_cracktrack', $cracktrack);
		
		die("<center><h3>Nice Try. We got you</h3></center>");
		exit;
	}
	unset($cracktrack, $ct_rules, $checkworm);
}

?>