<?php 

session_start();

unset($_SESSION['admin_logat']);
unset($_SESSION['admin']);


header("Location: login.php");
?>