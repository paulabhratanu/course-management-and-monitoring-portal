<!DOCTYPE>
<?php
include("includes/db.php");
global $con;



?>
<html>
<head>
<title>Inserting Product</title>
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>

</head>
<body bgcolor="skyblue">
<form action="insert_product.php"method="post" enctype="multipart/form-data">
<table align="center" width="700" border="2" bgcolor="orange">
<tr align="center">
<td colspan="6"><h2>Insert New Post Here</h2></td>
</tr>
<tr>
<td align="right"><b>Product Title:</b></td>
<td><input type="text" name="product_title" size="60"  /></td>
</tr>
<tr>
<td align="right"><b>Product type:</b></td>
<td>
<select name="product_type" >
<option>select the type</option>
<?php
global $con;

	$get_cats="select * from type";
	$run_cats= mysqli_query($con,$get_cats);

	while ($row_cats=mysqli_fetch_array($run_cats)){
		$type_id=$row_cats['type_id'];
		$type_value=$row_cats['type_value'];
		echo"<option value='$type_id'>$type_value</option>";
	}

?>
<tr>
<td align="right"><b>Product Category:</b></td>
<td>
<select name="product_cat" >
<option>select a category</option>
<?php
global $con;

	$get_cats="select * from categories";
	$run_cats= mysqli_query($con,$get_cats);

	while ($row_cats=mysqli_fetch_array($run_cats)){
		$cat_id=$row_cats['cat_id'];
		$cat_title=$row_cats['cat_title'];
		echo"<option value='$cat_id'>$cat_title</option>";
	}

?>
</select>
</td>
</tr>
<tr>
<td align="right"><b>Product Image:</b></td>
<td><input type="file" name="product_image" /></td>

</tr>
<tr>
<td align="right" ><b>Product Price:</b></td>
<td><input type="text" name="product_price"  /></td>
</tr>
<tr>
<td align="right"><b>Product Description:</b></td>
<td><textarea name="product_desc" cols="20" rows="10" ></textarea></td>
</tr>
<tr>
<td align="right"><b>Product Keywords:</b></td>
<td><input type="text" name="product_keywords" size="50" /></td>
</tr>

<tr align="center">

<td colspan="6"><input type="submit" name="insert_post" value="Insert Now" /></td>
</tr>




</table>


</form>
</body>
</html>
<?php
if(isset($_POST['insert_post'])){
	$product_title=$_POST['product_title'];
	$product_cat=$_POST['product_cat'];
	$product_price=$_POST['product_price'];
	$product_desc=$_POST['product_desc'];
	$product_keywords=$_POST['product_keywords'];

	$product_image=$_FILES['product_image']['name'];
	$product_image_tmp=$_FILES['product_image']['tmp_name'];
	move_uploaded_file($product_image_tmp,"product_images/$product_image");

    if($type_id==100)
    {
     $insert_product =" insert into products (product_cat,product_title,product_price,product_desc,product_image,product_keywords) values('$product_cat','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";
	}
	if($type_id==101)
	{
	  $insert_product =" insert into products_ece (product_cat,product_title,product_price,product_desc,product_image,product_keywords) values('$product_cat','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";
	}
	 $insert_pro= mysqli_query($con, $insert_product);
	 	 	 if($insert_pro){
		 echo "<script>alert('Product Has Been Inserted!')</script>";
		 echo"<script>window.open('insert_product.php','_self')";
	 }








}
?>
