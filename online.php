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
  * Check who is online
  * 
  * @package	Global
  * @subpackage	Files
  * @author 	Abdul Al-Hasany
  * @copyright 	Abdul Al-hasany (c) 2011
  * @version 	1.1
  * @access 	public
  */

include ('global.php');
unset($ads_head, $ads_foot);

$menu = new menu;
$menu->menuid = get_global_setting("index_menuid");

$left_menu = $menu->show_menus(2);
$right_menu = $menu->show_menus(1);
$middle_menu_count = get_global_setting("count_middle_menu");
$middle_menu = "<table border=0 cellpadding=0 cellspacing=0 width=100%><tr valign=top>";
$middle_menus = $menu->show_menus(3);
$ex = @explode('<!-- BLOCK END -->', $middle_menus);
$m = 0;
foreach ($ex as $amenu)
{
  $middle_menu .= '<td valign=top>' . $amenu . '</td>';
  $m++;
  if ($m == $middle_menu_count) $middle_menu .= "</tr>";
}
$middle_menu .= "</tr></table><br>";

diy_page_header("Online");

$searchEngine = array("Google" => "google", "DMOZ" => "dmoz\.org", "Yahoo" => "yahoo", "MSN" => "msn\.com", "LookSmart" => "looksmart\.com", "AlltheWeb" => "alltheweb\.com",
  "Lycos" => "lycos\.com", "Netscape" => "netscape\.com", "HotBot" => "hotbot\.com", "Altavista" => "altavista\.com", "ArabyBot" => "araby\.com");


$result = $diy_db->query("SELECT DISTINCT onlineip,onlinepage,onlinefile,user_online,useronlineid FROM diy_online  ORDER BY useronlineid DESC");

while ($row = $diy_db->dbarray($result))
{
  $user_online = $row[user_online];
  $useronlineid = $row[useronlineid];
  $useragent = $row[user_agent];
  $onlinefile = $row[onlinefile];
  $onlinefile = explode("/", $onlinefile);
  $onlinefile = $onlinefile[count($onlinefile) - 1];
  $onlinepage = $row[onlinepage];
  $onlinepage = explode("/", $onlinepage);
  $onlinepage = $onlinepage[count($onlinepage) - 1];


  if ($onlinefile == 'forum.php')
  {
    $text = 'forum';
  } elseif ($onlinefile == 'download.php')
  {
    $text = 'Downloads';
  } elseif ($onlinefile == 'link.php')
  {
    $text = 'Links';
  } elseif ($onlinefile == 'news.php')
  {
    $text = 'News';
  } elseif ($onlinefile == 'online.php')
  {
    $text = 'Online';
  } elseif ($onlinefile == 'mail.php')
  {
    $text = 'Mail us';
  } elseif ($onlinefile == 'mod.php')
  {
    $text = 'Module';
  } else
  {
    $text = '-----';
  }

  foreach ($searchEngine as $key => $value)
  {
    if (preg_match("/" . $value . "/i", $useragent))
    {
      $user_online = 'Search Engine ' . $key;
    }
  }

  if ($_COOKIE['cadmin'] > '0')
  {
    $onlineip = $row[onlineip];
  }
  else
  {
    $onlineip = "---";
  }
  if ($useronlineid == $CONF['Guest_id'])
  {
    $user_online = "Vistors";
  }

  $index_middle .= " <center><table border=\"0\" width=\"90%\"><tr>
    <td width=\"7%\" bgcolor=\"$color\" align=\"center\">$userid </td>
    <td width=\"30%\" bgcolor=\"$color\"><font class=fontablt>  </font><font class=fontablt>$user_online</font></td>
    <td width=\"33%\" bgcolor=\"$color\"><font class=fontablt><a href=\"$onlinepage\">Available at $text</a></font></td>
    <td width=\"40%\" bgcolor=\"$color\" align=\"center\"><font class=fontablt>$onlineip
    </font></td></tr></table></center>";
}

$templates->page_output($left_menu);

?>
