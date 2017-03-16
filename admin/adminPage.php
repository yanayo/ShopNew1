<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>
<body>
<?php
session_start();

	if(isset($_POST["txtUserId"]) && isset($_POST["txtPwd"]))
	{
		$UserId = $_POST["txtUserId"];
		$pwd = $_POST["txtPwd"];
	}
	else
	{
		if(isset($_SESSION["AdminUser"]) && isset($_SESSION["AdminPassword"]))
		{
			$UserId = $_SESSION["AdminUser"];
			$pwd = $_SESSION["AdminPassword"];
		}
		else
		{
			header("location:Login.php?msg=Session is Expired, please Relogin");
		}
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
	$_SESSION["AdminUser"] = $row["AdminUser"];
	$_SESSION["AdminPassword"] = $row["AdminPassword"];
	echo "<p>Welcome, administrator</p>";
	echo "<p><a href=categoryList.php>Category List</a></p>";
	echo "<p><a href=SubCategoryList.php>Sub Category List</a></p>";
	echo "<p><a href=ProductList.php>Product List</a></p>";
	echo "<p><a href=ChangePasswordForm.php>Change Password</a></p>";
	echo "<p><a href=Logout.php>Logout</a></p>";		
}
else
{
	header("location:Login.php?msg=Invalid Login Id and or Password");
}
?>

</body>
</html>
