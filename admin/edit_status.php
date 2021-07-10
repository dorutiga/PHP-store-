<?php 

require_once "conectare.php";

if($_SESSION['admin_logat'] == false) {
    header("Location: login.php");
}

$id = $_GET['id'] ?? "";

$sql = "SELECT * FROM orders WHERE id='".$id."'";
$res = mysqli_query($con, $sql);
$order = mysqli_fetch_assoc($res);
if(!$order) {
	exit("Order doesn't exist");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$status = $_POST['status'];
	$sql1 = "UPDATE orders SET status='".$status."' WHERE id='".$id."' LIMIT 1";
	$rez = mysqli_query($con, $sql1);
	if($rez) {
		header("Location: gestionare_clienti.php");
	}
	else {
		exit("Error changing status.");
	}
}

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

<br>
<form class="form-horizontal" action="edit_status.php?id=<?php echo $id; ?>" method="post">
  <div class="form-group">
    <label for="exampleFormControlSelect1" style='font-size: 20px'>Change status</label>
    <select class="form-control" id="exampleFormControlSelect1" value="" name="status">
      <option <?php if($order['status'] == "processing") echo "selected"; else echo "disabled"; ?>>processing</option>
      <option <?php if($order['status'] == "processed") echo "selected"; elseif($order['status'] != "processing") echo "disabled"; ?>>processed</option>
      <option <?php if($order['status'] == "shipped") echo "selected"; ?>>shipped</option>
      <option <?php if($order['status'] == "delivered") echo "selected"; ?>>delivered</option>
    </select>
    <br>
      <button type="submit" class="btn btn-primary">Change</button>
  </div>
</form>

</body>
</html>

<?php 
    mysqli_close($con);
 ?>