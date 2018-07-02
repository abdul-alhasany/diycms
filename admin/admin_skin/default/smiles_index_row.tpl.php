<tr class="row">
<td class="cell">
{IMAGE}
</td>

<td class="cell"><center>
{NAME}
</td>

<td class="cell"><center>
{CODE}
</td>

<td class="cell">
<center>
<a href="sections.php?section=smiles&file=edit_smile&smileid={SMILEID}&{SESSION}">
<img title='<?php echo lang('SMILES_INDEX_EDIT_SMILE'); ?>' border='0' src="<#admin_images_path#>/edit.png"></a>

<a href="sections.php?section=smiles&file=delete_smile&smileid={SMILEID}&{SESSION}" onClick="if (!confirm('<?php echo lang('SMILES_INDEX_CONFIRM_DELETE_SMILE'); ?>')) return false;">
<img title='<?php echo lang('SMILES_INDEX_DELETE_SMILE'); ?>' border='0' src="<#admin_images_path#>/delete_small.png"></a>
</center>
</td>
</tr>
