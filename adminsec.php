<?php
error_reporting(0);

$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {
	$_name = $_POST["name"];
	
	$image = $_FILES["uploadfile"]["name"];
	$_image = $_FILES["uploadfile"]["tmp_name"];
	$_price = $_POST["price"];
	$folder = "./shopping_cart/" . $image;
	

	$db = mysqli_connect("localhost", "root", "root1234", "wakshop");

	// Get all the submitted data from the form
	$sql = "INSERT INTO shop (name,image,price) VALUES ('$_name', '$image', '$_price')";

	// Execute query
	mysqli_query($db, $sql);

	// Now let's move the uploaded image into the folder: image
	if (move_uploaded_file($_image, $folder)) {
		echo "<h3> Image uploaded successfully!</h3>";
	} else {
		echo "<h3> Failed to upload image!</h3>";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Image Upload</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style11.css" />
	<link rel="stylesheet" type="text/css" href="wakstylehm1.css" />
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" type="text/javascript"></script>
</head>

<body>
	<div id="content">
		<h1>ADMIN</h1>
		<form method="POST" action="" enctype="multipart/form-data">
			<div class="form-group">
			<h5>Product's Name:</h5>
			<input type="text" name="name" value="" placeholder="product name"/><br/><br/>

			<h5>Choose product to add:</h5>
				<input class="form-control" type="file" name="uploadfile" value="" /><br/><br/>
				<h5>Product Amount:</h5>
                <input type="text" name="price" value="" placeholder="product amount" /><br/><br/>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
				<a href="shophome.php" ><h5>view page</h5></a>
				
 
	</div>
	
	</div>
	<?php
$db = mysqli_connect("localhost", "root", "root1234", "wakshop");


?>
	<div id="display-image">
    <table class="styled-table">
    <thead>
        <h5>AVALIABLE ITEMS</h3>
        <tr>
		   <th>wakshopid</th>
            <th>Name</th>
            <th>image</th>
			<th>price</th>
			<th>UDATE ITEM</th>
        </tr>
		</thead>
		<?php
		if(isset($_GET['shopid'])){
	        $shopid = $_GET['shopid'];
	        $delete = mysqli_query($db, "DELETE FROM shop WHERE shopid='$shopid'");
			$update = mysqli_query($db, "UPDATE FROM shop WHERE shopid='$shopid'");
		}
		
		$query = " SELECT * FROM shop ";

		$result = mysqli_query($db, $query);
		$num = mysqli_num_rows($result);
		if($num>0){

		while ($data = mysqli_fetch_assoc($result)) {
		
          echo "
        <tr>
            <td>".$data['shopid']."</td>
            <td>".$data['name']."</td>
			<td>".$data['image']."</td>
            <td>".$data['price']."</td>
			<td> 
			<a href='adminsec.php?shopid=".$data['shopid']."' class='btn' >Delete</a>
			<a href='adminsec.php?shopid=".$data['shopid']."' class='btn' >Update</a>
			</td>
        </tr>
    
		  ";
		}
		} ?>   
    </table>
	</div>
	<div id="display-image">
    <table class="styled-table">
    <thead>
        <h5>ORDERS</h3>
        
        <tr>
		   <th>id</th>
            <th>cname</th>
            <th>email</th>
			<th>Phoneno</th>
			<th>Location</th>
			<th>Update List</th>
        </tr>
		</thead>
		<?php


		if (isset($_GET['orderid'])) {
			$orderid = $_GET['orderid'];
			$delete = mysqli_query($db, "DELETE FROM orderdetails WHERE orderid='$orderid'");
		}
		$query = " SELECT * FROM orderdetails ";

		$result = mysqli_query($db, $query);
		$num = mysqli_num_rows($result);
		if($num>0){

		while ($data = mysqli_fetch_assoc($result)) {
		
          echo "
        <tr>
            <td>".$data['orderid']."</td>
            <td>".$data['Cname']."</td>
			<td>".$data['Email']."</td>
            <td>".$data['Phonenumber']."</td>
			<td>".$data['Location12']."</td>
			<td> 
			<a href='adminsec.php?orderid=".$data['orderid']."' class='btn' >Delete</a>
			</td>
			
        </tr>
    
		  ";
		}
		} ?>   
    </table>
	</div>
</body>
</html>