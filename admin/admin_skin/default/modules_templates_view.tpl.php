

	<table border="0" width="90%" cellspacing="0" cellpadding="0" align="center" class='table'>
<tr><td>
		<table border=0 width="100%" cellspacing="1" cellpadding="5" >
		<tr>
			<td colspan=5 align="center" class="form_header"><?php echo lang('MODULES_TEMPLATES_TEMP_GROUP'); ?>&nbsp;&nbsp;
			<a href="sections.php?section=modules&file=templates&action=edit_template_group&modid={MODID}&module={MODULE}&themeid={THEME_ID}&groupid={GROUP_ID}&{SESSION}">
<img height='15' title='Edit Templates Group' border='0' src="<#admin_images_path#>/edit.png"></a>&nbsp;

<a href="sections.php?section=modules&file=templates&action=delete_template_group&modid={MODID}&module={MODULE}&themeid={THEME_ID}&groupid={GROUP_ID}&{SESSION}" onClick="if (!confirm('Are you sure you want to delete this template group?\n All the templates under this group will be deleted?')) return false;">
<img height='15' title='Delete Templates Group' border='0' src="<#admin_images_path#>/delete_small.png"></a>
</td>
		</tr>
<tr>

{ROWS}

</table>
</td></tr>
</table>
<br>
