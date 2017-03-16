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
	$st=$_POST["optStatus"];
	$cat=$_POST["catList"];

if($id==0)
{
	$sql = "INSERT INTO subcategoryDetail (SubCatName, Status, CategoryId) VALUES ('" . $name . "', " . $st . "," . $cat . ")";
}
else
{
	$sql = "UPDATE subcategoryDetail SET SubCatName='" . $name . "', Status=" . $st . ", CategoryId=" . $cat . " WHERE SubCatId=" . $id;
}
echo $sql;
$conn->query($sql);

header("location:subcategoryList.php");

?>

</body>
</html>
