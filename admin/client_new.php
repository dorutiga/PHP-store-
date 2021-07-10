<?php 
require_once "conectare.php";

if($_SESSION['admin_logat'] == false) {
	header("Location: login.php");
}

$username = $_POST['username'] ?? "";
$email = $_POST['email'] ?? "";
$password = $_POST['password'] ?? "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //verific unicitate nume
    $sqll = "SELECT * FROM users WHERE username='".$username."'";
    $rez = mysqli_query($con, $sqll);
    $userr = mysqli_fetch_assoc($rez);
    
    //daca nu sunt 2 useri la fel
    if($userr['username'] != $username) {
      $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
      $sql7 = "INSERT INTO users (`username`, `password`, `email`) VALUES ('".$username."', '".$hashedpassword."', '".$email."')";
      $result = mysqli_query($con, $sql7);
      if($result) {
        header("Location: gestionare_clienti.php");
      }
      else {
        echo "Eroare la adaugare user.";
      }
    }
    else {
      echo "Userul exista deja.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>NEW CLIENT</title>
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

<h1>NEW CLIENT</h1>

<form class="form-horizontal" action="client_new.php" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Name:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" autocomplete="off" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Password:</label>
    <div class="col-sm-5">
      <input type="password" class="form-control" name="password" value="" autocomplete="off" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Email:</label>
    <div class="col-sm-5">
      <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" autocomplete="off" required>
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