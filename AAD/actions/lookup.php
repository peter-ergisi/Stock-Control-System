<?php
//action.php
$connect = mysqli_connect('localhost', 'root', 'zwofverOPZi21ME', 'storedb');

$id = $_REQUEST["id"];

mysqli_query($connect, $query);
$output = array();
$xyz = array();
$result = mysqli_query($connect, "CALL show_order_products(1)");
$counter = 0;
while($row = mysqli_fetch_array($result))
{
    $output[$counter]['product_Name'] = $row["Product Name"];
    $output[$counter]['product_Quantity'] = $row["Quantity"];
    $output[$counter]['product_Price'] = $row["Price"];
    $counter++;
}

echo json_encode($output);

?>