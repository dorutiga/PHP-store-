<?php  
require_once "conectare.php";

$name = $_POST['username'] ?? "";
$password = $_POST['password'] ?? "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // nume: admin1 ; pw: admin
	$sql = "SELECT * FROM admins WHERE name='".$name."'";
	$result = mysqli_query($con, $sql);
	$admin = mysqli_fetch_assoc($result);
	if($admin) {
		if(password_verify($password, $admin['password'])) {
			$_SESSION['admin_logat'] = true;
			$_SESSION['admin'] = $name;
			header("location: index.php");
		}
		else {
			echo "Nume sau parola gresita.";
		}
	}
	else {
		echo "Nume sau parola gresita.";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Admin</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<style type="text/css">
		.login {
			text-align: center;
			font-family: Montserrat;
		}
		body {
			background-color: #e5e5e5;
		}
	</style>
</head>
<body>

<div class="login">
    <h1>ADMIN LOGIN</h1>
    <form action="login.php" method="post">
    <label for="username">
        <i class="fas fa-user"></i>
    </label>
    <input type="text" name="username" placeholder="Username" id="username" required><br><br>
    <label for="password">
        <i class="fas fa-lock"></i>
    </label>
    <input type="password" name="password" placeholder="Password" id="password" required><br><br>
    <input class="login" type="submit" value="Login">
    </form>
</div>

</body>
</html>

<?php 
	mysqli_close($con);
 ?>