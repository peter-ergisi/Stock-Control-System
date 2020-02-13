<?php

session_start();
require_once "dbconfig.php";

$sql = "SELECT product_Name, product_Price, quantity  FROM products WHERE product_ID = ?";
$productIdstr = $_GET['q'];
$cart_quant = $_GET['p'];
$productId = intval( $productIdstr );

if($stmt = mysqli_prepare($link, $sql)) {

    mysqli_stmt_bind_param($stmt, "i", $param_productId);

    $param_productId = $productId;
    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $prod_name, $prod_price, $prod_quant);
            mysqli_stmt_fetch($stmt);
            $newarray = array($prod_name, $prod_price, $cart_quant, $productId, "in stock");
            $size = sizeof($_SESSION["Cart"]);
            $dup = false;
            for ($row = 0; $row < $size; $row++) {
                if ($_SESSION["Cart"][$row][3] == $newarray[3]) {
                    $_SESSION["Cart"][$row][2] += $newarray[2];
                    $floatpri = floatval($newarray[1]) * floatval($newarray[2]);
                    $_SESSION["cart_Price"] += $floatpri;
                    $dup = true;
                    if ($_SESSION["Cart"][$row][2] > $prod_quant) {
                        $_SESSION["Cart"][$row][4] = "Not enough in store speak to a manager";
                    }
                }



            }
            if ($dup == false){
                if ($newarray[2] > $prod_quant) {
                    $newarray[4] = "Not enough in store speak to a manager";
                }
                $_SESSION["Cart"][$size] = $newarray;
                $floatpri = floatval($newarray[1])  * floatval($newarray[2]);
                $_SESSION["cart_Price"] += $floatpri;

            }



        }
    }
}


$test2 = $_GET['p'];


$tableName = "example";


$cars = array
(
    array("Volvo",22,18),
    array("BMW",15,13),
    array("Saab",5,2),
    array("Land Rover",17,15)
);

$max = sizeof($_SESSION["Cart"]);

echo "<table id=" .$tableName. ">";

for ($row = 0; $row < $max; $row++) {
    echo "<tr>";
    echo "<td>" . $_SESSION["Cart"][$row][0] . "</td>";
    echo "<td>" . $_SESSION["Cart"][$row][1] . "</td>";
    echo "<td>" . $_SESSION["Cart"][$row][2] . "</td>";
    echo "<td>" . $_SESSION["Cart"][$row][4] . "</td>";
    echo "<td> <button type='button' class = 'delete_btn' id='$row' onclick='deleteFromCart(this.id)' >Delete</button> </td>";
    echo "</tr>";
}

echo "<tr>";

echo "</tr>";
echo "<td> Total price: </td>";
echo "<td>" . $_SESSION["cart_Price"] ."</td>";
echo "</table>";
?>

