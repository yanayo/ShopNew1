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

if($id==0)
{
	$sql = "INSERT INTO categoryDetail (CategoryName, Status) VALUES ('" . $name . "', " . $st . ")";
}
else
{
	$sql = "UPDATE categoryDetail SET CategoryName='" . $name . "', Status=" . $st . " WHERE CategoryId=" . $id;
}
$conn->query($sql);

header("location:categoryList.php");

?>

</body>
</html>
