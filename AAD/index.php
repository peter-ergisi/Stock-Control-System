<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === 0){
    header("location: cart.php");
    exit;
} else if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === 1){
    header("location: dashboard.php");
    exit;

} else {
    header("location: login.php");
    exit;
}
?>