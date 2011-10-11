<div id="login-form">
	<form action="<?php echo base_url('login'); ?>" method="post">
		<input id="back_url" name="back_url" type="hidden" value="">
		<table>
			<tr>
				<td align="right"><label for="username">Login:</label></td>
				<td align="left"><input id="username" name="username" tabindex="1" type="text"></td>
			</tr>
			<tr>
				<td align="right"><label for="password">Password:</label></td>
				<td align="left"><input id="password" name="password" tabindex="2" type="password"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td align="left"><label><input id="autologin" name="autologin" tabindex="3" type="checkbox" value="1"> Stay logged in</label></td>
			</tr>
			<tr>
				<td align="left"><a href="">Lost password</a></td>
				<td align="right"><input name="login" value="Login &#187;" tabindex="4" type="submit"</td>
			</tr>
		</table>
	</form>
</div>
