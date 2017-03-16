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
session_start();
$sId = session_id();


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
<form action="calcCart.php" method="post">

<table width=100%>
<?php
$sql = "SELECT cartDetail.*, ProductDetail.ProductName, ProductDetail.Price FROM CartDetail, ProductDetail WHERE CartDetail.ProductId = ProductDetail.ProductId AND cartDetail.SessionId='" . $sId . "'";


$result = $conn->query($sql);
while($row = $result->fetch_assoc()) 
{

echo "<table cellpadding=5 cellspacing=0 border=1 width=90% align=center><tr class=tblHead><td>&nbsp;</td><td>Product Name</td><td>Price (Rs.)</td><td>Qty.</td><td>Amount (Rs.)</td></tr>";
$result = $conn->query($sql);
$i=1;
$tAmt=0;
while($row = $result->fetch_assoc()) 
{
	$amt = $row["Price"]*$row["Qty"];
	$tAmt += $amt;
	
	echo "<tr><td align=center><img src=products/small/" . $row["ProductId"] . ".jpg height=100 border=0><br><a href=removeProduct.php?pId=" . $row["SNo"] . "><font color=red>X</font></a></td><td>" . $row["ProductName"] . "</td><td align=right>" . $row["Price"] . "</td><td align=right><input type=text name=qty" . $i . " value=" . $row["Qty"] . " size=3><input type=hidden name=Id" . $i . " value=" . $row["SNo"] . "></td><td align=right>" . $amt . "</td></tr>";
	$i = $i+1;
}	
$i--;
echo "<input type=hidden name=totR value=" . $i . ">";
echo "<tr><td colspan=4 align=center><b>Total</b></td><td align=right>" . $tAmt . "</td></tr>";
echo "</table>";

}
?>
<center><input type="submit" name="Button1" value="Update Cart" />
</form>
</td>
</table>
</body>
</html>
