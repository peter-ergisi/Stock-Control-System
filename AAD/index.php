<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($_SESSION["isStaff"] === 0) {
        header("location: cart.php");
    } else if($_SESSION["isStaff"] === 1){
        header("location: dashboard.php");
    }
}
else {
    header("location: login.php");
    exit;
}
?>