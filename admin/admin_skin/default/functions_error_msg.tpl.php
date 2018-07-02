<?php
echo "<HTML DIR={$CONF['dir']}>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
<META content=\"DiyCMS\" name=keywords>
<META content=\"DiyCMS , Powered by DiyCMS\" name=description>
<link rel=\"stylesheet\" type=\"text/css\" href=\"admin_skin/default/style.css\">
<title> ". lang('ERROR_MESSAGE') ."</title>
</head>
";
?>   

<body bgcolor='#9EC5E1'><br><div align='center'><br><br><br><br><br><br>
<center><table width='60%' style="border: 1px dashed #000;" bgcolor='#ffffff'>
<tr><td rowspan="2" width='20%' align='center'><img border='0' src="<#admin_images_path#>/error.png"></td>
<td width='80%' align='center'><b><font size="5"><br>{MSG}<br></font></td>
</tr>
<tr>
<td class="cell"><center><b><font size="3"><br>
<a href='{URL}'><?php echo lang('ERROR_MESSAGE_REDIRECT'); ?></a><br>&nbsp;</font></table></center></div>