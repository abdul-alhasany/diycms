<?php
/*
+===============================================================================+
|      					DIY-CMS V1.0.0 Copyright © 2011   						|
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
  * This file is part of users module
  * 
  * @package	Modules
  * @subpackage	Users
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */
checkcookie();
include("modules/".$mod->module."/settings.php");
require_once ('includes/module_templates_stream.class.php');

$perm = $mod->setting('allowed_pm', $_COOKIE['cgroup']);

//$mod->permission($perm);

$userid = (int) $_COOKIE['cid'];
$box = (int) $_GET['box'];

	
if(!$box)
$box = 1;
switch ($box)
{
	default:
	case '1':
	$index_middle .= $mod->nav_bar($lang['PM_INBOX']);
	
	// set array for tabs template and display the template
	$users_array = array('userid' => $userid, 'lang' => $lang);
    $index_middle .= $mod->get_template_code ( 'users_usercp_head', $users_array );
	
	$box_title = $lang['PM_INBOX'];
	$middle = $lang['PM_FROM'];

    eval("\$index_middle .= \" " . $mod->gettemplate ( 'users_pm_head' ) . "\";");
    
    $results = $diy_db->query("SELECT * FROM diy_messages WHERE
                                           msgbox='1' and userid='".$userid."'
                                           ORDER BY  msgdate DESC");
    if ($diy_db->dbnumrows($results) > 0)
    {
        while($row = $diy_db->dbarray($results))
        {
            extract($row);
			
            $msgicon     = '<img src="modules/users/images/unread.gif">';
			if($msgisread == '2')
			{
			$msgicon     = '<img src="modules/users/images/read.gif">';
			}elseif($msgisread == '3')
			{
			$msgicon     = '<img src="modules/users/images/reply.gif">';
			}
            $fromusername  = $fromname;
            $msgdate       = format_date ("$msgdate")." ".format_time($msgdate);

           eval ("\$msg_rows .= \" ".$mod->gettemplate("users_pm_msg_row")."\";");
        }
     }
			$usage = usage_bar($lang, $userid, '1');
			
			$pm_array = array('lang' => $lang, 'usage' => $usage, 'middle' => $middle, 'msg_rows' => $msg_rows, 'box' => $box);
			$index_middle .= $mod->get_template_code ( 'users_pm_list_table', $pm_array);
			
	break;
	
	case '2':
	$index_middle = $mod->nav_bar($lang['PM_OUTBOX']);
	
		// set array for tabs template and display the template
	$users_array = array('userid' => $userid, 'lang' => $lang);
    $index_middle .= $mod->get_template_code ( 'users_usercp_head', $users_array );
	
	
	$box_title = $lang['PM_OUTBOX'];
	$middle = $lang['PM_TO'];

    eval("\$index_middle .= \" " . $mod->gettemplate ( 'users_pm_head' ) . "\";");
	
   
    $results = $diy_db->query("SELECT * FROM diy_messages WHERE
                                           msgbox='2' and userid='".$userid."'
                                           ORDER BY  msgdate DESC");
    if ($diy_db->dbnumrows($results) > 0)
    {
        while($row = $diy_db->dbarray($results))
        {
            extract($row);
			
           $msgicon     = '<img src="modules/users/images/unread.gif">';
			if($msgisread == '2')
			{
			$msgicon     = '<img src="modules/users/images/read.gif">';
			}elseif($msgisread == '3')
			{
			$msgicon     = '<img src="modules/users/images/read.gif">';
			}
            $fromusername  = $fromname;
            $msgdate       = format_date ("$msgdate")." ".format_time($msgdate);

           eval ("\$msg_rows .= \" ".$mod->gettemplate("users_pm_msg_row")."\";");
        }
     }
			
			$usage = usage_bar($lang, $userid, '2');
			
			$pm_array = array('lang' => $lang, 'usage' => $usage, 'middle' => $middle, 'msg_rows' => $msg_rows);
			$index_middle .= $mod->get_template_code ( 'users_pm_list_table', $pm_array);

	break;
}
echo $index_middle;
?>