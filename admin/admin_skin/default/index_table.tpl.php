<div id='admin_note' width="50px";>

		<?php
		global $auth;
		
		$info['dir'] = $CONF['dir'];
        $admin_note = form_textarea(lang('INDEX_ADMIN_NOTE_DESC'), 'admin_note', get_global_setting("admin_note"), $info);

        $array = array(
           "action" => "index.php?action=index&" . $auth->get_sess(),
           "title" => lang('INDEX_ADMIN_NOTE_TITLE'),
           "name" => 'admin_note',
           "content" => $admin_note,
           "submit" => lang('SUBMIT')
        );
		echo form_output($array);
		?>
		
</div>


<table cellspacing="0" cellpadding="5" class='table' align="center" >
<tr><td class="table_header_cell" colspan="2"><?php echo lang('INDEX_INFO'); ?></td></tr>
{SPEC_ROWS}
</table>