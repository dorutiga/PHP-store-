<?php 

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "magazin2");

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if(!$con) {
	exit("Nu s-a putut realiza conectarea la database.");
}

session_start();


 ?>