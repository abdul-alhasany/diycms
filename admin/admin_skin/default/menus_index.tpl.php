<form action="sections.php?section=menus&{SESSION}" method="post" name="menu_update" enctype="multipart/form-data">

	<table cellspacing="0" cellpadding="3" class="table" align="center">
	<tr>
	<td class="table_header_cell" colspan=10><?php echo lang('MENUS_INDEX_TITLE'); ?></td></tr>
	<tr>
	<td class="division_cell" width="20%"><?php echo lang('MENUS_INDEX_MENU_TITLE'); ?></td>
	<td class="division_cell" width="20%"><?php echo lang('MENUS_INDEX_MENU_ORDER'); ?></td>
	<td class="division_cell" width="30%"><?php echo lang('MENUS_INDEX_MENU_SIDE'); ?></td>
	<td class="division_cell" width="20%"><?php echo lang('MENUS_INDEX_MENU_STAUTS'); ?></td>
	<td class="division_cell" width="10%"><?php echo lang('MENUS_INDEX_MENU_OPTIONS'); ?></td>
	</tr>
	{ROWS}
	</table>
<center><input type=submit name='submit' value="<?php echo lang('SUBMIT'); ?>"></center>
</form>