<?php

if (TURN_BLOCK_ON !== true)
{
  die("<center><h3>Error</h3></center>");
}

	$result = $diy_db->query("SELECT DISTINCT onlineip FROM diy_online WHERE user_online='Guest'");

    $resuser = $diy_db->query("SELECT DISTINCT onlineip FROM diy_online WHERE user_online !='Guest'");

    $not_user    = $diy_db->dbnumrows($result);

    $user_online = $diy_db->dbnumrows($resuser);
   
        $online = $not_user + $user_online;
	
	$content = "<ul><li>عدد الزوار: $not_user</li>";
	$content .= "<li>عدد الأعضاء: $user_online</li>";
	$content .= "<li>المجموع الكلي: $online</li></ul>";
	
echo $content;
?> 