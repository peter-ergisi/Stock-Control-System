<?php
//action.php
$connect = mysqli_connect('localhost', 'root', 'zwofverOPZi21ME', 'storedb');

$input = filter_input_array(INPUT_POST);

$orderDate = mysqli_real_escape_string($connect, $input["order_Date"]);
$orderTotal = mysqli_real_escape_string($connect, $input["order_Total"]);

if($input["action"] === 'edit')
{
    $query = "
 UPDATE orders 
 SET orderDate = '".$orderDate."',
 orderTotal = '".$orderTotal."',
 WHERE order_ID = '".$input["uid"]."'
 ";

    mysqli_query($connect, $query);

}
if($input["action"] === 'delete')
{
    $query = "
 DELETE FROM orders
 WHERE order_ID = '".$input["uid"]."'
 ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>