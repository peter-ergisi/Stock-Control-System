<?php
//action.php
$connect = mysqli_connect('localhost', 'root', 'zwofverOPZi21ME', 'storedb');

$input = filter_input_array(INPUT_POST);

$categoryName = mysqli_real_escape_string($connect, $input["category_Name"]);

if($input["action"] === 'edit')
{
    $query = "
 UPDATE category 
 SET category_Name = '".$categoryName."'
 WHERE category_ID = '".$input["id"]."'
 ";

    mysqli_query($connect, $query);

}
if($input["action"] === 'delete')
{
    $query = "
 DELETE FROM category
 WHERE category_ID = '".$input["id"]."'
 ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>
