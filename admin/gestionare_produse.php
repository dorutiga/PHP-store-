<?php  
require_once "conectare.php";

if($_SESSION['admin_logat'] == false) {
	header("Location: login.php");
}

$sql1 = "SELECT * FROM tbl_product ORDER BY id ASC";
$products = mysqli_query($con, $sql1);

?>
<!DOCTYPE html>
<html>
<head>

<script>
	function delete(){

	}
</script>
	<title>PRODUCTS</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style type="text/css">
		h1 {
			text-align: center;
		}
	</style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="gestionare_produse.php">PRODUCTS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="gestionare_clienti.php">CLIENTS</a>
            </li>
        </ul>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><button type="button" class="btn btn-outline-danger">LOGOUT</button></a>
            </li>
        </ul>
    </div>
</nav>

	<h1>MANAGE PRODUCTS</h1>
	<br><br>
	<a href="product_new.php"><button class="btn btn-primary">NEW PRODUCT</button></a><br><br>

	<div>
		<table class="table table-striped table-hover">
			<tr>
				<th>ID</th>
		        <th>Name</th>
		        <th>Description</th>
		  	    <th>Price</th>
		        <th>Code</th>
		        <th>Image</th>
		  	    <th></th>
		        <th></th>
			</tr>

			<?php while($product = mysqli_fetch_assoc($products)) { ?>
		        <tr>
			    	<td><?php echo $product['id']; ?></td>
			        <td><?php echo $product['name']; ?></td>
			        <td><?php echo strtok($product['description'], " ") . "..."; ?></td>
			    	<td><?php echo $product['price']; ?></td>
			        <td><?php echo $product['code']; ?></td>
			        <td><?php echo "<img src=../images/".$product['image']." style='width:50px' alt=".$product['image'].">"; ?></td>
			        <td><a class="action" href="<?php echo "product_edit.php?id=" .$product['id'];  ?>">Edit</a></td>
			        <td><a class="action" href="<?php echo "product_delete.php?id=" .$product['id'];  ?>">Delete</a></td>
		    	</tr>
     		<?php } ?>
		</table>
	</div>

</body>
</html>

<?php 
	mysqli_close($con);
 ?>