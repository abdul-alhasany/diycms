<?php

if (TURN_BLOCK_ON !== true)
{
  die("<center><h3>Error</h3></center>");
}


$userid = $_COOKIE['cid'];
$member_name = $_COOKIE['cname'];
echo "<ul>";
if(($_COOKIE['cgroup'] == 1) || ($_COOKIE['cgroup'] == 2))
{
echo "<li><a href=control.php>لوحة التحكم</b></font></a>";
}
echo "
	<li><a href=mod.php?mod=users&modfile=usercp&userid=$userid>الملف الشخصي</b></font></a>

<li><a href=mod.php?mod=users&dir=pm>الرسائل الخاصة</b></font></a>

<li><a href=mod.php?mod=users&modfile=misc&action=logout>تسجيل الخروج</b></font></a></ul>
";

?>