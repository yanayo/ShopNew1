<html>
<body>

<table width=75% align="center">
<tr><td style="background-color:Gray; font-size:20px; text-align:center;">e-Shop Admin Section
</td></tr>
<tr><td>
<form action=adminPage.php method="post">
<center>
<?php
if(isset($_GET["msg"]))
	echo "<font color=red><b>" . $_GET["msg"] . "</b></font>";
?>
</center>
<table cellpadding="10" align="center">
<tr><td>Login Id</td><td><input type="text" maxlength="50" name=txtUserId></td></tr>
<tr><td>Password</td><td><input type="password" maxlength="15" name=txtPwd></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Login"></td></tr>
</table>

</form>
</td></tr>
</table>
</body>
</html>
