<?php
session_start();

$dbhost = 'localhost'; 
$dbuser = 'root'; 
$dbpass = '';
$dbName = 'shopnew'; 

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbName); 

if(! $conn) 
{ 
	die('Could not connect: ' . mysql_error()); 
} 

$pId=$_GET["pId"];

$qty=$_GET["qty"];

$sql = "SELECT MinQty, MaxQty, Qty FROM Productdetail WHERE Productdetail.productId=" . $pId;
$result = $conn->query($sql);

if($row = $result->fetch_assoc()) 
{
	$isValid=1;
	
	if($qty < $row["MinQty"])
	{
		echo "Minimum Qty need to order is " . $row["MinQty"];
		$isValid=0;
	}
		
	if($qty > $row["MaxQty"])
	{
		echo "Maximum Qty you can order is " . $row["MaxQty"];
		$isValid=0;
	}

	if($qty > $row["Qty"])
	{
		echo "Qty in stock is only " . $row["Qty"];
		$isValid=0;
	}
	
	if($isValid==1)
	{
		$sql = "INSERT INTO cartDetail (ProductId, Qty, SessionId) VALUES (" . $pId . "," . $qty . ", '" . session_id() . "')";
	
		echo $sql;
		$conn->query($sql);
		
		header("location:viewcart.php");
	}
}
?>

