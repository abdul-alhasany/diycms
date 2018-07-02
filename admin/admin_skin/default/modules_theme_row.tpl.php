<tr class="row">
<td class="cell" width="70%" onclick="window.location='sections.php?section=modules&file=templates&action=view_templates&modid={MODID}&module={MODULE}&themeid={THEME_ID}&{SESSION}'" title="Click to view theme templates">
{THEME}<br>
<?php echo lang('MODULES_THEME_TEMPLATES_NO'); ?>{TEMPLATES}
</td>

<td class="cell"><center>
<a href="sections.php?section=modules&file=templates&action=view_templates&modid={MODID}&module={MODULE}&themeid={THEME_ID}&{SESSION}">
<img border='0' title="<?php echo lang('MODULES_THEME_VIEW_TEMPLATES'); ?>" src="<#admin_images_path#>/template_view.png"></a>

<a href="sections.php?section=modules&file=templates&action=add_template_group&modid={MODID}&module={MODULE}&themeid={THEME_ID}&{SESSION}">
<img title='<?php echo lang('MODULES_THEME_ADD_TEMPLATE_GROUP'); ?>' border='0' src="<#admin_images_path#>/add_template_group.png"></a>

<a href="sections.php?section=modules&file=templates&action=add_template&modid={MODID}&module={MODULE}&themeid={THEME_ID}&{SESSION}">
<img title='<?php echo lang('MODULES_THEME_ADD_TEMPLATE'); ?>' border='0' src="<#admin_images_path#>/add_template.png"></a>

<a href="sections.php?section=modules&file=templates&action=export_theme&modid={MODID}&module={MODULE}&themeid={THEME_ID}&fullpage=1&{SESSION}">
<img title='<?php echo lang('MODULES_THEME_EXPORT'); ?>' border='0' src="<#admin_images_path#>/export.png"></a>

<a href="sections.php?section=modules&file=templates&action=delete_theme&modid={MODID}&module={MODULE}&themeid={THEME_ID}&{SESSION}" onClick="if (!confirm('<?php echo lang('MODULES_THEME_CONFIRM_DELETE'); ?>')) return false;">
<img title='<?php echo lang('MODULES_THEME_DELETE'); ?>' border='0' src="<#admin_images_path#>/delete.png"></a>
</td>
</tr>
