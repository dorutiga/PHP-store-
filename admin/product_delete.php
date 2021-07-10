<?php 
	require_once "conectare.php";

	if(isset ($_POST['delete_id']) ) {
		$id = $_POST ['delete_id'];
		$sql2 = "DELETE FROM tbl_product WHERE id= $id ";
		if ($con->query($sql2) === TRUE) {
			echo "Record deleted successfully";
		  } else {
			echo "Error deleting record: " . $con->error;
		  }
		  
		
	
		}
	
 ?>
