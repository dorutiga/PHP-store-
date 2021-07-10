<?php 
	require_once "conectare.php";

	if($_SESSION['admin_logat'] == false) {
		header("Location: login.php");
	}
	else {
		if(isset($_GET['id']) && is_numeric($_GET['id'])) {
			$sql2 = "DELETE FROM users WHERE id='".$_GET['id']."' LIMIT 1";
			$result = mysqli_query($con, $sql2);

			if($result) {
				header("Location: gestionare_clienti.php");
			}
			else {
				exit("Stergerea nu s-a putut realiza");
			}
		}
	}

	
 ?>
