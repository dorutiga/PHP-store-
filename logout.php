<?php
    session_start();
    
    unset($_SESSION['loggedin']);
    unset($_SESSION['name']);
    unset($_SESSION['id']);

    header('Location: magazin.php');
?>