<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>e-Shop</title>
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
<?php
$dbhost = 'localhost'; 
$dbuser = 'root'; 
$dbpass = '';
$dbName = 'shopnew'; 

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbName); 

if(! $conn) 
{ 
	die('Could not connect: ' . mysql_error()); 
} 
?>
<table width=100% align="center">
<tr><td colspan="2" style="background-color:Gray; font-size:20px; text-align:center;">e-Shop</td></tr>
<tr valign="top"><td colspan=2>
<table width=100%>
<tr><td><a href=Index.php>Home</a></td>
	<td><a href=Profile.php>About Us</a></td>
	<td><a href=Catalog.php>Products</a></td>
	<td><a href=QueryForm.php>Enquiry</a></td>
	<td><a href=Contact.php>Contact Us</a></td></tr>
</table>
</td></tr>
<tr valign=top><td width=25%>
<h3>Browse Products</h3>
<ul>
<?php
$sql = "SELECT * FROM categoryDetail WHERE Status=1 ORDER BY CategoryName";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) 
{
	echo "<li><a href=Catalog.php?catId=" . $row["CategoryId"] . ">" . $row["CategoryName"] . "</a>";
	$sql1 = "SELECT * FROM subCategoryDetail WHERE Status=1 AND CategoryId=" .  $row["CategoryId"] . " ORDER BY subCatName";
	$result1 = $conn->query($sql1);
	echo "<ul>";
	while($row1 = $result1->fetch_assoc()) 
	{
		echo "<li><a href=Catalog.php?catId=" . $row["CategoryId"] . "&subCatId=" . $row1["subCatId"] . ">" . $row1["subCatName"];
	}
	echo "</ul>";}
?>
</ul>
</td>
<td width="75%">
<table width=100%>
<?php
$i=1;
$sql = "SELECT * FROM ProductDetail WHERE Status=1 ORDER BY ProductName";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) 
{
	if($i%3 == 1)
		echo "<tr>";
	echo "<td width=33%><p>" . $row["ProductName"] . "<br><img src=products/small/" . $row["ProductId"] . ".jpg height=125><br>Price: Rs." . $row["Price"] . "</p></td>";
	$i = $i+1;
}
?>
</table>

</td>
</table>
</body>
</html>
