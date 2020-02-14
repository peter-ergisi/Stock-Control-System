<?php
//action.php
$connect = mysqli_connect('localhost', 'root', 'zwofverOPZi21ME', 'storedb');

$input = filter_input_array(INPUT_POST);

$username = mysqli_real_escape_string($connect, $input["username"]);
$firstName = mysqli_real_escape_string($connect, $input["firstName"]);
$lastName = mysqli_real_escape_string($connect, $input["lastName"]);
$chargeCode = mysqli_real_escape_string($connect, $input["chargeCode"]);
$isStaff = mysqli_real_escape_string($connect, $input["isStaff"]);

if($input["action"] === 'edit')
{
    $query = "
 UPDATE users 
 SET username = '".$username."',
 firstName = '".$firstName."',
 lastName = '".$lastName."',
 chargeCode = '".$chargeCode."',
 isStaff = '".$isStaff."'
 WHERE user_ID = '".$input["uid"]."'
 ";

    mysqli_query($connect, $query);

}
if($input["action"] === 'delete')
{
    $query = "
 DELETE FROM users
 WHERE user_ID = '".$input["uid"]."'
 ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>