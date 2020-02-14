<?php

session_start();
require_once "dbconfig.php";

$sql = "UPDATE products SET quantity = ? WHERE product_ID = ?";

$max = sizeof($_SESSION["Cart"]);

if($stmt = mysqli_prepare($link, $sql)) {

    for ($row = 0; $row < $max; $row++) {
        mysqli_stmt_bind_param($stmt, "ii", $param_quantity, $param_productId);
        $param_quantity = intval($_SESSION["Cart"][$row][5]) - intval($_SESSION["Cart"][$row][2]);
        $param_productId = intval($_SESSION["Cart"][$row][3]);
        mysqli_stmt_execute($stmt);
    }

}

$sql = "INSERT INTO orders (order_Date, user_Id, order_Total) VALUES (2020-02-07 00:00:00, ?, ?);";


if($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "id", $param_userId, $param_orderTotal);
    $param_userId= intval(3);
    $param_orderTotal = doubleval($_SESSION["cart_Price"]);
    mysqli_stmt_execute($stmt);
}






?>