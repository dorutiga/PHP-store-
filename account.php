<?php 
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "magazin2");

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if(!$con) {
	exit("Conncetion failed.");
}
session_start();
// Template
function template_header($title) {
    echo <<<EOT
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="utf-8">
    <title>$title</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet"
    href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="style.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body>
    <header>
    <div class="content-wrapper">
    <h1 style='font-weight:bold;'>༼ つ ◕_◕ ༽つ</h1>
    <nav>
    <a href="magazin.php" style='text-decoration: none;'>Products</a>
    <a href="account.php" style='text-decoration: none; margin-right:500px;'>Account</a>
    </nav>
    <div class="link-icons">
    <a href="cos.php">
    CART
    <i class="fas fa-shopping-cart"></i>
    </a>
    <a href='logout.php'><button type="button" class="btn btn-outline-danger" style='margin-left:30px;'>LOGOUT</button></a>
    </div>
    </div>
    </header>
    <main>
    EOT;
}
// Template footer
function template_footer() {
    $year = date('Y');
    echo <<<EOT
    </main>
    <footer>
    <div class="content-wrapper">
    <p>&copy; $year, Best Romanian Retailer.</p>
    </div>
    </footer>
    </body>
    </html>
    EOT;
}
template_header("Account");

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$member_id = $_SESSION['id'];
$sql = "SELECT * FROM orders WHERE member_id='".$member_id."'";
$set = mysqli_query($con, $sql);

?>
<style type="text/css">
	h1 {
		margin-left: 10px;
	}
</style>



<h1>YOUR ORDERS:</h1>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>
      <th scope="col">Products</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>

	<?php while($comanda = mysqli_fetch_assoc($set)) { ?>
		<tr>
			<td><?php echo $comanda['id']; ?></td>
		    <td><?php echo $comanda['order_date']; ?></td>
			<td><?php echo $comanda['status']; ?></td>
			<td><?php echo $comanda['products']; ?></td>
			<td><?php echo $comanda['total']; ?></td>
		</tr>
	<?php } ?>

  </tbody>
</table>




















<?php 
	template_footer();
?>