<?php

session_start();
require_once "dbconfig.php";
$delIdstr = $_GET['d'];
$delId = intval($delIdstr);
$_SESSION["cart_Price"] = $_SESSION["cart_Price"] - $_SESSION["Cart"][$delId][1]*$_SESSION["Cart"][$delId][2];

//array_splice($_SESSION["Cart"], delId, 1);
unset($_SESSION["Cart"][$delId]);
$_SESSION["Cart"] = array_values($_SESSION["Cart"]);

$max = sizeof($_SESSION["Cart"]);

echo "<table id=" .$tableName. ">";

for ($row = 0; $row < $max; $row++) {
    echo "<tr>";
    echo "<td>" . $_SESSION["Cart"][$row][0] . "</td>";
    echo "<td>" . $_SESSION["Cart"][$row][1] . "</td>";
    echo "<td>" . $_SESSION["Cart"][$row][2] . "</td>";
    echo "<td>"  . $_SESSION["Cart"][$row][4] . "</td>";
    echo "<td> <button type='button' class = 'delete_btn' id='$row' onclick='deleteFromCart(this.id)' >Delete</button> </td>";
    echo "</tr>";
}

if ($max > 0){
    echo "<tr>";

    echo "</tr>";
    echo "<td> Total price: </td>";
    echo "<td>" . $_SESSION["cart_Price"] ."</td>";
}

echo "</table>";
?>
