<?php

if (TURN_BLOCK_ON !== true)
{
  die("<center><h3>Error</h3></center>");
}


$modules_array = $diy_db->query("SELECT * FROM diy_modules");
while($results = $diy_db->dbarray($modules_array))
{
extract($results);
$array[] = $mod_name;
}

$users_no = $diy_db->dbnumquery("diy_users","");
$content = "<ul><li>عدد الأعضاء: $users_no </li>";

if(in_array('download', $array))
{
$download = $diy_db->dbnumquery("diy_download_files","");
$content .= "<li>عدد الملفات: $download </li>";
}

if(in_array('forum', $array))
{
$forum = $diy_db->dbnumquery("diy_forum_threads","");
$content .= "<li>مشاركات المنتدى: $forum</li>";
}


$content .= "</ul>";
echo $content;
?>