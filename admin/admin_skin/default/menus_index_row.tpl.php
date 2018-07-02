<tr class="row">
<td class="cell">

{TITLE}

</td>

<td class="cell">
<center>
{ORDER}
</center>
</td>


<td class="cell">
<center>
{ALIGN}
</center>
</td>


<td class="cell">
<center>
{STATUS}
</center>
</td>


{HIDDEN}
<td class="cell"><center>
<a href="sections.php?section=menus&file=edit_menu&menuid={MENUID}&{SESSION}">
<img title='<?php echo lang('MENUS_INDEX_EDIT_MENU'); ?>' border='0' src="<#admin_images_path#>/edit.png"></a>

<a href="sections.php?section=menus&file=delete_menu&menuid={MENUID}&{SESSION}" onClick="if (!confirm('<?php echo lang('MENUS_INDEX_CONFIRM_DELETE_MENU'); ?>')) return false;">
<img title='<?php echo lang('MENUS_INDEX_DELETE_MENU'); ?>' border='0' src="<#admin_images_path#>/delete_small.png"></a>
</td>
</tr>
