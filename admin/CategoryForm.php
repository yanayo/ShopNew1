<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Category List</title>
<style>
.tblHead
{
	background-color:#333333;
	color:White;
	font-weight:bold;
	font-size:12pt;
}
	
</style>

</head>
<body>

<table width=100% align="center">
<tr><td colspan="2" style="background-color:Gray; font-size:20px; text-align:center;">e-Shop Admin Section
</td></tr>
<tr valign="top"><td>
	<p>Welcome, administrator</p>
	<p><a href=categoryList.php>Category List</a></p>
	<p><a href=SubCategoryList.php>Sub Category List</a></p>
	<p><a href=ProductList.php>Product List</a></p>
	<p><a href=ChangePasswordForm.php>Change Password</a></p>
	<p><a href=Logout.php>Logout</a></p>


<?php
	session_start();

	if(isset($_SESSION["AdminUser"]) && isset($_SESSION["AdminPassword"]))
	{
		$UserId = $_SESSION["AdminUser"];
		$pwd = $_SESSION["AdminPassword"];
	}
	else
	{
		header("location:Login.php?msg=Session is Expired, please Relogin");
	}

$dbhost = 'localhost'; 
$dbuser = 'root'; 
$dbpass = '';
$dbName = 'shopnew'; 

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbName); 

if(! $conn) 
{ 
	die('Could not connect: ' . mysql_error()); 
} 

$sql = "SELECT * FROM adminuser WHERE AdminUser='" . $UserId . "' AND AdminPassword='" . $pwd . "'";
$result = $conn->query($sql);
if($row = $result->fetch_assoc()) 
{
}
else
{
	header("location:Login.php?msg=Invalid Login Id and or Password");
}
$catId = $_GET["catId"];
?>
</td>
<td>
<h1>Category detail</h1>
<?php
if($catId==0)
{
?>
<form action=CategorySave.php method="post">
<table>
<tr><td>Category Name</td>
<td><input type="text" maxlength="50" name="txtName" />
<input type="hidden" name="txtId" value="0" /></td></tr>
<tr><td>Status</td>
<td><input type="radio" name="optStatus" checked="checked" value="1" /> Active
<input type="radio" name="optStatus" value="0" /> Inactive</td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Add Category" /></td></tr>
</table>
</form>
<?php
}
else if($catId>0)
{
$sql = "SELECT * FROM Categorydetail WHERE CategoryId=" . $catId;
$result = $conn->query($sql);
if($row = $result->fetch_assoc()) 
{
?>
<form action=CategorySave.php method="post">
<table>
<tr><td>Category Name</td>
<td><input type="text" maxlength="50" name="txtName" value="<?php echo $row["CategoryName"] ?>" />
<input type="hidden" name="txtId" value="<?php echo $row["CategoryId"] ?>" />
</td></tr>
<tr><td>Status</td>
<td>
<?php
if($row["Status"] == 1)
{
?>
<input type="radio" name="optStatus" checked="checked" value="1" /> Active
<input type="radio" name="optStatus" value="0" /> Inactive
<?php
}
else
{?>
<input type="radio" name="optStatus" value="1" /> Active
<input type="radio" name="optStatus" checked="checked" value="0" /> Inactive
<?php
}
?>
</td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Update Category" /></td></tr>
</table>
</form>
<?php
}
}
?>

</body>
</html>
