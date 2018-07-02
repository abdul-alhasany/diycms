<tr class="row" title="Click to view template">
<td class="cell" width="80%" onclick="window.location='sections.php?section=modules&file=templates&action=edit_template&modid={MODID}&module={MODULE}&themeid={THEME_ID}&tempid={TEMP_ID}&groupid={GROUP_ID}&{SESSION}'">
{TEMP_TITLE}
</td>

<td class="cell"><center>
<a href='#' onclick="window.open('sections.php?section=modules&file=templates&action=display_template&modid={MODID}&module={MODULE}&themeid={THEME_ID}&tempid={TEMP_ID}&fullpage=1&{SESSION}', '', 'HEIGHT=400, resizable=yes, WIDTH=550, screenX=313,screenY=259,left=190,top=90');return false;">
<img border='0' title="<?php echo lang('MODULES_TEMPLATES_VIEW_TEMPLATE'); ?>" src="<#admin_images_path#>/template_view_small.png"></a>

<a href="sections.php?section=modules&file=templates&action=edit_template&modid={MODID}&module={MODULE}&themeid={THEME_ID}&tempid={TEMP_ID}&groupid={GROUP_ID}&{SESSION}">
<img title='<?php echo lang('MODULES_TEMPLATES_EDIT_TEMPLATE'); ?>' border='0' src="<#admin_images_path#>/edit.png"></a>

<a href="sections.php?section=modules&file=templates&action=delete_template&modid={MODID}&module={MODULE}&themeid={THEME_ID}&tempid={TEMP_ID}&{SESSION}" onClick="if (!confirm('<?php echo lang('MODULES_TEMPLATES_CONFIRM_DELETE_TEMPLATE'); ?>')) return false;">
<img title='<?php echo lang('MODULES_TEMPLATES_DELETE_TEMPLATE'); ?>' border='0' src="<#admin_images_path#>/delete_small.png"></a>
</td>
</tr>
