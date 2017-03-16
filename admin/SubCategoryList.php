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
?>
</td>
<td>
<h1>Sub Category List</h1>
<table cellpadding="3" cellspacing="0"><tr class=tblHead><td>&nbsp;</td><td>Sub Category Name</td><td>Category</td><td>Status</td></tr>
<?php
$sql = "SELECT subcategoryDetail.*, categoryDetail.CategoryName FROM subcategoryDetail, categoryDetail WHERE subcategoryDetail.CategoryId = categoryDetail.CategoryId ORDER BY subCatName";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) 
{
	echo "<tr><td><a href=SubCategoryForm.php?sCatId=" . $row["subCatId"] . ">Edit</a></td>";
	echo "<td>" . $row["subCatName"] . "</td>";	
	echo "<td>" . $row["CategoryName"] . "</td>";	
	if($row["Status"] == 0)
		echo "<td>Inactive</td>";
	else
		echo "<td>Active</td>";
	
	echo "</tr>";
}
?>
</table>
<a href=SubCategoryForm.php?sCatId=0>Add Sub Category</a>

</td></tr>
</table>
</body>
</html>
