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

	$sql = "DELETE FROM cartDetail WHERE SNo=" . $pId . " AND SessionId='" . session_id() . "'";
	
		//echo $sql;
	$conn->query($sql);
		
	header("location:viewcart.php");
?>

