<?php
//action.php
$connect = mysqli_connect('localhost', 'root', 'zwofverOPZi21ME', 'storedb');

$input = filter_input_array(INPUT_POST);

$productName = mysqli_real_escape_string($connect, $input["product_Name"]);
$productQ = mysqli_real_escape_string($connect, $input["quantity"]);
$productP = mysqli_real_escape_string($connect, $input["product_Price"]);
$categoryID = mysqli_real_escape_string($connect, $input["category_ID"]);

if($input["action"] === 'edit')
{
    $query = "
 UPDATE products 
 SET product_Name = '".$productName."',
 quantity = '".$productQ."',
 product_Price = '".$productP."'
 WHERE product_ID = '".$input["product_ID"]."'
 ";

    mysqli_query($connect, $query);

}
if($input["action"] === 'delete')
{
    $query = "
 DELETE FROM products
 WHERE product_ID = '".$input["product_ID"]."'
 ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>