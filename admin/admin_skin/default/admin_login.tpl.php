
<HTML DIR= <?php echo $CONF[dir]; ?> >
              <head>
			  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
              <META content="DiyCMS" name=keywords>
              <META content="DiyCMS , Powered by DiyCMS" name=description>
              <link rel="stylesheet" type="text/css" href="admin_skin/default/<?php echo $CONF[dir]; ?>.css">
              <title> <?php echo lang(ADMIN_CP); ?> </title>
			  </head>
               
		
       <br><br><br><br><br><br>
            <form method=post action=index.php>
                <div align=center>
	<table width="50%" bgcolor="#b0ddff" style="border: 1px solid #006fcd;" cellspacing=1><tr><td>			
		<table border="0" width="100%" cellspacing=1 cellpadding=0 bgcolor=#a1bce1>
		<tr><td colspan="2" bgcolor="#87b0e8"><center><b><h3><font color='#001865'><?php echo lang('ADMIN_LOGIN_LOGIN'); ?></font></h3></td></tr>
	<tr>
	<td valign='middle'><img border='0' src="<#admin_images_path#>/admin_login.png"></a></td>
		<td width=70% valign='middle'><font size=3><b><br><font color='#001865'><?php echo lang('ADMIN_LOGIN_USERNAME'); ?></b></font> &nbsp; &nbsp;<input type=text size=20 name=user_name value=""><br>
		
	
		<font size=3><b><br><font color='#001865'><?php echo lang('ADMIN_LOGIN_PASSWORD'); ?></b></font>&nbsp; &nbsp;&nbsp;  <input type=password size=20 name=user_pass value=""></b></td>
	</tr>
	<tr><td align= center colspan=2><br>
        <input type=submit value="&nbsp;&nbsp;&nbsp;<?php echo lang('ADMIN_LOGIN_LOGIN'); ?>&nbsp;&nbsp;&nbsp;" class="button"> <br><br></td></tr>
</table>

		</td></tr>
</table>
</form>