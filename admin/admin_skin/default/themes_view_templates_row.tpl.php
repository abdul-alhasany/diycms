<tr class="row">
<td class="cell" width="80%" onclick="window.location='sections.php?section=themes&file=templates&action=edit_template&themeid={THEME_ID}&tempid={TEMP_ID}&{SESSION}'" title="Click to view template">
{TEMP_TITLE}
</td>

<td class="cell"><center>
<a href='#' onclick="window.open('sections.php?section=themes&file=templates&action=display_template&themeid={THEME_ID}&tempid={TEMP_ID}&fullpage=1&{SESSION}', '', 'HEIGHT=400, resizable=yes, WIDTH=550, screenX=313,screenY=259,left=190,top=90');return false;">
<img border='0' title="<?php echo lang('THEMES_TEMPLATES_VIEW_TEMPLATE'); ?>" src="<#admin_images_path#>/template_view_small.png"></a>

<a href="sections.php?section=themes&file=templates&action=edit_template&themeid={THEME_ID}&tempid={TEMP_ID}&{SESSION}">
<img title='<?php echo lang('THEMES_TEMPLATES_EDIT_TEMPLATE'); ?>' border='0' src="<#admin_images_path#>/edit.png"></a>

<a href="sections.php?section=themes&file=templates&action=delete_template&themeid={THEME_ID}&tempid={TEMP_ID}&{SESSION}" onClick="if (!confirm('<?php echo lang('THEMES_TEMPLATES_CONFIRM_DELETE_TEMPLATE'); ?>')) return false;">
<img title='<?php echo lang('THEMES_TEMPLATES_DELETE_TEMPLATE'); ?>' border='0' src="<#admin_images_path#>/delete_small.png"></a>
</td>
</tr>
