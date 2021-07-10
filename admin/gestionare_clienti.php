<?php 

require_once "conectare.php";

if($_SESSION['admin_logat'] == false) {
	header("Location: login.php");
}

$sql6 = "SELECT * FROM users ORDER BY id ASC";
$clients = mysqli_query($con, $sql6);

$sql7 = "SELECT * FROM orders ORDER BY id ASC";
$orders = mysqli_query($con, $sql7);

?>

<!DOCTYPE html>
<html>
<head>
	<title>CLIENTS</title>
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

<h1>MANAGE CLIENTS</h1>
<a href="client_new.php"><button class="btn btn-primary">NEW CLIENT</button></a><br><br>

<div>
	<table class="table table-striped table-hover">
		<tr>
			<th>ID</th>
	        <th>Username</th>
	        <th>Email</th>
	  	    <th></th>
	        <th></th>
		</tr>

		<?php while($client = mysqli_fetch_assoc($clients)) { ?>
	        <tr>
		    	<td><?php echo $client['id']; ?></td>
		        <td><?php echo $client['username']; ?></td>
		    	<td><?php echo $client['email']; ?></td>
		        <td><a class="action" href="<?php echo "client_edit.php?id=" .$client['id'];  ?>">Edit</a></td>
		        <td><a class="action" href="<?php echo "client_delete.php?id=" .$client['id'];  ?>">Delete</a></td>
	    	</tr>
 		<?php } ?>
	</table>
</div>
<br>
<h1>MANAGE ORDERS</h1>
<div>
	<table class="table table-striped table-hover">
		<tr>
			<th scope="col">#</th>
			<th scope="col">Client_id</th>
		    <th scope="col">Date</th>
		    <th scope="col">Status</th>
		    <th scope="col">Products</th>
		    <th scope="col">Total</th>
		    <th></th>
		</tr>

		<?php while($order = mysqli_fetch_assoc($orders)) { ?>
        	<tr>
		    	<td><?php echo $order['id']; ?></td>
		    	<td><?php echo $order['member_id']; ?></td>
		        <td><?php echo $order['order_date']; ?></td>
		    	<td><?php echo $order['status']; ?></td>
		    	<td><?php echo $order['products']; ?></td>
		    	<td><?php echo $order['total']; ?></td>
		    	<?php if($order['status'] != "delivered"): ?>
		        <td><a class="action" href="<?php echo "edit_status.php?id=" .$order['id'];  ?>">Edit status</a></td>
		    	<?php else: ?>
		    	<td></td>
	   			<?php endif; ?>
    		</tr>
		<?php } ?>
	</table>
</div>

</body>
</html>

<?php 
	mysqli_close($con);
 ?>