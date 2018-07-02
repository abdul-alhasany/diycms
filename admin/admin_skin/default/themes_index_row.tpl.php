<tr class="row">
<td class="cell" width="60%" onclick="window.location='sections.php?section=themes&file=view_templates&themeid={THEME_ID}&{SESSION}'" title="Click to view theme templates">
{THEME}<br>
<?php echo lang('THEMES_INDEX_TEMP_NO'); ?>{TEMPLATES}
</td>

<td class="cell"><center>
<a href="sections.php?section=themes&file=view_templates&themeid={THEME_ID}&{SESSION}">
<img border='0' title="<?php echo lang('THEMES_INDEX_VIEW_TEMPLATES'); ?>" src="<#admin_images_path#>/template_view.png"></a>

<a href="sections.php?section=themes&file=templates_group&action=add_template_group&themeid={THEME_ID}&{SESSION}">
<img title='<?php echo lang('THEMES_INDEX_ADD_TEMPLATE_GROUP'); ?>' border='0' src="<#admin_images_path#>/add_template_group.png"></a>

<a href="sections.php?section=themes&file=templates&action=add_template&themeid={THEME_ID}&{SESSION}">
<img title='<?php echo lang('THEMES_INDEX_ADD_TEMPLATE'); ?>' border='0' src="<#admin_images_path#>/add_template.png"></a>


<a href="sections.php?section=themes&file=edit_css&themeid={THEME_ID}&{SESSION}">
<img title='<?php echo lang('THEMES_INDEX_EDIT_CSS'); ?>' border='0' src="<#admin_images_path#>/edit_css.png"></a>


<a href="sections.php?section=themes&file=theme_settings&themeid={THEME_ID}&{SESSION}">
<img title='<?php echo lang('THEMES_INDEX_EDIT_THEME_SETTINGS'); ?>' border='0' src="<#admin_images_path#>/edit_settings.png"></a>


<a href="sections.php?section=themes&file=themes&action=export_theme&themeid={THEME_ID}&fullpage=1&{SESSION}">
<img title='<?php echo lang('THEMES_INDEX_EXPORT_THEME'); ?>' border='0' src="<#admin_images_path#>/export.png"></a>

<a href="sections.php?section=themes&file=themes&action=delete_theme&themeid={THEME_ID}&theme={THEME}&{SESSION}" onClick="if (!confirm('<?php echo lang('THEMES_INDEX_CONFIRM_DELETE_THEME'); ?>')) return false;">
<img title='<?php echo lang('THEMES_INDEX_DELETE_THEME'); ?>' border='0' src="<#admin_images_path#>/delete.png"></a>
</td>
</tr>
