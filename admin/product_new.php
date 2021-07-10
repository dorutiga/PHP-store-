<?php 
require_once "conectare.php";

if($_SESSION['admin_logat'] == false) {
	header("Location: login.php");
}

$name = $_POST['name'] ?? "";
$description = $_POST['description'] ?? "";
$price = $_POST['price'] ?? "";
$code = $_POST['code'] ?? "";
$image = $_POST['image'] ?? "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		$sql3 = "INSERT INTO tbl_product (`name`, `description`, `price`, `code`, `image`) VALUES ('".$name."', '".$description."', '".$price."', '".$code."', '".$image."')";
		$result = mysqli_query($con, $sql3);
		if($result) {
			header("Location: gestionare_produse.php");
		}
		else {
			echo "Eroare la adaugarea unui produs nou.";
		}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>NEW PRODUCT</title>
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

<h1>NEW PRODUCT</h1>

<form class="form-horizontal" action="product_new.php" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Name:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" autocomplete="off" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Description:</label>
    <div class="col-sm-5">
      <textarea class="form-control" rows="3" name="description" autocomplete="off" required><?php echo $description; ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Price:</label>
    <div class="col-sm-1">
       <input class="form-control" type="number" min="0" name="price" value="<?php echo $price; ?>" autocomplete="off" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Code:</label>
    <div class="col-sm-1">
       <input type="text" class="form-control" name="code" value="<?php echo $code; ?>" autocomplete="off" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Image:</label>
    <div class="col-sm-1">
      <input type="text" class="form-control" name="image" value="<?php echo $image; ?>" autocomplete="off" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Create</button>
    </div>
  </div>
</form>

</body>
</html>

<?php 
mysqli_close($con);
 ?>