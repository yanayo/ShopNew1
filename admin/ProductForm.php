<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Product</title>
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

<?php
$id=$_GET["pId"];
?>
<h1>Product Detail</h1>

<?php
if($id==0)
{
?>
<form action=ProductSave.php method="post">
<table>
<tr><td>Product Name</td>
<td><input type="text" maxlength="50" name="txtName" /><input type="hidden" name="txtId" value="0" /></td></tr>

<tr><td>Category</td>
<td><select name=catList>
<?php
$sql1 = "SELECT subcategoryDetail.subCatId, subcategoryDetail.subCatName, categoryDetail.CategoryId, categoryDetail.CategoryName FROM subcategoryDetail, categoryDetail WHERE subcategoryDetail.CategoryId = categoryDetail.CategoryId ORDER BY CategoryName, subCatName";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) 
{
	echo "<option value=" . $row1["subCatId"] . ">" .  $row1["CategoryName"] . " : " .  $row1["subCatName"] . "</option>";
}
?>

</select>
</td></tr>
<tr><td>Short Description</td>
<td><textarea maxlength="250" name="txtShortDesc" rows="3" cols="50" ></textarea></td></tr>
<tr><td>Detail Description</td>
<td><textarea maxlength="250" name="txtDetail" rows="5" cols="50" ></textarea></td></tr>
<tr><td>Price</td>
<td><input type="text" maxlength="8" name="txtPrice" /></td></tr>
<tr><td>Qty</td>
<td><input type="text" maxlength="3" name="txtQty" /></td></tr>
<tr><td>Minimum Qty</td>
<td><input type="text" maxlength="3" name="txtMinQty" value="1" /></td></tr>
<tr><td>Maximum Qty</td>
<td><input type="text" maxlength="3" name="txtMaxQty" value="1" /></td></tr>

<tr><td>Status</td>
<td><input type="radio" name="optStatus" checked="checked" value="1" /> Active
<input type="radio" name="optStatus" value="0" /> Inactive</td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Add Product" /></td></tr>
</table>
</form>
<?php
}
else
{
$sql = "SELECT * FROM ProductDetail WHERE ProductId=" . $id;
$result = $conn->query($sql);
if($row = $result->fetch_assoc()) 
{

?>
<form action=ProductSave.php method="post">
<table>
<tr><td>Product Name</td>
<td><input type="text" maxlength="50" name="txtName" value='<?php echo $row["ProductName"]; ?>' /><input type="hidden" name="txtId" value='<?php echo $row["ProductId"]; ?>' /></td></tr>

<tr><td>Category</td>
<td><select name=catList>
<?php
$sql1 = "SELECT subcategoryDetail.subCatId, subcategoryDetail.subCatName, categoryDetail.CategoryId, categoryDetail.CategoryName FROM subcategoryDetail, categoryDetail WHERE subcategoryDetail.CategoryId = categoryDetail.CategoryId ORDER BY CategoryName, subCatName";
$result1 = $conn->query($sql1);
while($row1 = $result1->fetch_assoc()) 
{
	if($row1["subCatId"] == $row["SubCategoryId"])
		echo "<option selected value=" . $row1["subCatId"] . ">" .  $row1["CategoryName"] . " : " .  $row1["subCatName"] . "</option>";
	else
		echo "<option value=" . $row1["subCatId"] . ">" .  $row1["CategoryName"] . " : " .  $row1["subCatName"] . "</option>";
	
}
?>

</select>
</td></tr>
<tr><td>Short Description</td>
<td><textarea maxlength="250" name="txtShortDesc" rows="3" cols="50" ><?php echo $row["ShortDesc"]; ?></textarea></td></tr>
<tr><td>Detail Description</td>
<td><textarea maxlength="250" name="txtDetail" rows="5" cols="50" ><?php echo $row["ProductDesc"]; ?></textarea></td></tr>
<tr><td>Price</td>
<td><input type="text" maxlength="8" name="txtPrice" value=<?php echo $row["Price"]; ?> /></td></tr>
<tr><td>Qty</td>
<td><input type="text" maxlength="3" name="txtQty" value=<?php echo $row["Qty"]; ?> /></td></tr>
<tr><td>Minimum Qty</td>
<td><input type="text" maxlength="3" name="txtMinQty" value="1" value="<?php echo $row["MinQty"]; ?>" /></td></tr>
<tr><td>Maximum Qty</td>
<td><input type="text" maxlength="3" name="txtMaxQty" value="1" value="<?php echo $row["MaxQty"]; ?>" /></td></tr>

<tr><td>Status</td>
<td>
<?php if ($row["Status"] == 1)
{
 ?>
	<input type="radio" name="optStatus" checked="checked" value="1" /> Active
	<input type="radio" name="optStatus" value="0" /> Inactive
<?php 
}
else
{
 ?>
	<input type="radio" name="optStatus" value="1" /> Active
	<input type="radio" name="optStatus" checked="checked" value="0" /> Inactive
<?php 
}
 ?>
</td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Update Product" /></td></tr>

</table>
</form>
<?php
}
}
?>

</td></tr>
</table>
</body>
</html>