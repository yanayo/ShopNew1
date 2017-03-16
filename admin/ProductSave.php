<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Category List</title>
</head>
<body>
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
	
	$id=$_POST["txtId"];
	$name=$_POST["txtName"];
	$catList=$_POST["catList"];
	$st=$_POST["optStatus"];
	$sDesc=$_POST["txtShortDesc"];
	$desc=$_POST["txtDetail"];
	$price=$_POST["txtPrice"];
	$qty=$_POST["txtQty"];
	$minQty=$_POST["txtMinQty"];
	$maxQty=$_POST["txtMaxQty"];
$catId = 0;

$sql = "SELECT CategoryId FROM SubCategoryDetail WHERE subCatId=" . $catList;
$result = $conn->query($sql);
if($row = $result->fetch_assoc()) 
{
	$catId = $row["CategoryId"];
}
if($id == 0)
{
$sql = "INSERT INTO ProductDetail (ProductName, CategoryId, SubCategoryId, ShortDesc, ProductDesc, Price, Qty, MinQty, MaxQty,  Status) VALUES ('" . $name . "', " . $catId . ", " . $catList . ",'" . $sDesc . "','" . $desc . "', " . $price . ", " . $qty . ", " . $minQty . ", " . $maxQty . ", " . $st . ")";
}
else
{
$sql = "UPDATE ProductDetail SET ProductName='" . $name . "', CategoryId=" . $catId . ", SubCategoryId=" . $catList . ", ShortDesc='" . $sDesc . "', ProductDesc='" . $desc . "', Price=" . $price . ", Qty=" . $qty . ", MinQty=" . $minQty . ", MaxQty=" . $maxQty . ",  Status
=" . $st . " WHERE ProductId=" . $id;
}
$conn->query($sql);
//echo $sql;
header("location:ProductList.php");
?>
</body>
</html>
