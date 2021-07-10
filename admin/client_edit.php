<?php 
require_once "conectare.php";

if($_SESSION['admin_logat'] == false) {
	header("Location: login.php");
}

// cautare client cu id-ul din POST in db
$id = $_GET['id'] ?? "";
$sql7 = "SELECT * FROM users WHERE id='". $id ."'";
$rezultat = mysqli_query($con, $sql7);
$client = mysqli_fetch_assoc($rezultat);

if($client) {
  $username = $client['username'];
  $email = $client['email'];
}
else {
  exit("Clientul nu exista");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // sa nu poti pune un nume care exista deja in db
  $sql8 = "SELECT * FROM users WHERE username='". $_POST['username'] ."'";
  $rezz = mysqli_query($con, $sql8);
  $clientexistent = mysqli_fetch_assoc($rezz);
  if($clientexistent && $clientexistent['id'] != $id ) {
    exit("exista deja un client numit asa");
  }

  $hashedpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$sql3 = "UPDATE users SET username='".$_POST['username']."', ";

  //daca parola e lasata goala sa nu o modificam
  if($_POST['password'] != "") {
    $sql3.= "password='sebastian', ";
  }
  
  $sql3.= "email='".$_POST['email']."' WHERE id='".$id."' LIMIT 1";

	$result = mysqli_query($con, $sql3);
	if($result) {
		header("Location: gestionare_clienti.php");
	}
	else {
		echo "Eroare la editarea clientului.";
	}  
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>EDIT CLIENT</title>
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

<h1>EDIT CLIENT</h1>

<form class="form-horizontal" action="client_edit.php?id=<?php echo $id; ?>" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Username:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="username" value="<?php echo $username ?>" autocomplete="off" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="">New Password:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="password" value="sebastian" autocomplete="off">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Email:</label>
    <div class="col-sm-5">
      <input type="email" class="form-control" name="email" value="<?php echo $email ?>" autocomplete="off" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">EDIT</button>
    </div>
  </div>
</form>

</body>
</html>

<?php 
  mysqli_close($con);
?>