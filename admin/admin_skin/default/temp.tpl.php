<div id='header'>
<div id='logo_image'><img border="0" src="<#admin_images_path#>/logo.png" alt="CMS logo"></div>
<div id='buttons'>
<div class='action_buttons'>

<div class='buttons'>
<a id='home_link' target="_blank" href="<?php echo get_global_setting('siteURL'); ?>/index.php">
<img border="0" src="<#admin_images_path#>/home_page.png"></a>
<a id='website' target='_blank' href="<?php echo lang('TEMP_DIY_LINK'); ?>">
<img border="0" src="<#admin_images_path#>/website.png"></a>
<a id='help' target='_blank' href="<?php echo lang('TEMP_SUPPORT_FORUMS_LINK'); ?>">
<img border="0" src="<#admin_images_path#>/help.png"></a>
<a id='logout' href=index.php?logout={SESSION}>
<img border="0" src="<#admin_images_path#>/logout.png"></a>
</div>
<span class='home_link'><?php echo lang('TEMP_MAIN_WEBSITE'); ?></span>
<span class='logout'><?php echo lang('TEMP_LOGOUT'); ?></span>
<span class='website'><?php echo lang('TEMP_DIY_WEBSITE'); ?></span>
<span class='help'><?php echo lang('TEMP_SUPPORT_FORUMS'); ?></span>

</div>
</div>
<div style='clear: both'></div>
</div>


<table cellspacing="0" cellpadding="0" class='main_table' width=100%>
	   <tr><td bgcolor="#acbfd9" colspan='2' height=30></td></tr>
		<tr><td bgcolor="#acbfd9" colspan='2' height=10></td></tr>
		<tr><td width="170px" valign=top align=center>{SIDENAVE}</td>
			<td height=100% colspan='2'>
			<table cellspacing="0" cellpadding="0" width=100% border='0' height=100%>

			<tr>
				
				<td bgcolor="#ffffff" valign='top'><br><br>{CONTENT}</td>
				
			</tr>

			</table>
<br><br><br><br>
</td></tr>
<tr><td colspan="50">{FOOT}</td></tr></table>