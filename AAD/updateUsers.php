<?php

session_start();
require_once "dbconfig.php";

$userAtt = $_GET['a'];
$userVal = $_GET['v'];

if ($userAtt == "username"){
    $sql = "UPDATE users SET username = ? WHERE user_ID = ?";

    $_SESSION["username"] = $userVal;
}

if ($userAtt == "first_name"){
    $sql = "UPDATE users SET firstName = ? WHERE user_ID = ?";

    $_SESSION["first_name"] = $userVal;
}

if ($userAtt == "last_name"){
    $sql = "UPDATE users SET lastName = ? WHERE user_ID = ?";

    $_SESSION["last_name"] = $userVal;
}

if ($userAtt == "charge_code"){
    $sql = "UPDATE users SET chargeCode = ? WHERE user_ID = ?";


}

if ($userAtt == "password"){
    $sql = "UPDATE users SET password = ? WHERE user_ID = ?";
    $userVal = password_hash($userVal, PASSWORD_DEFAULT);


}
if($stmt = mysqli_prepare($link, $sql)) {
    if ($userAtt == "charge_code"){
        mysqli_stmt_bind_param($stmt, "ii", $param_userVal, $param_userId);
        $param_userAtt = $userAtt;
        $param_userVal = intval($userVal);
        $param_userId = $_SESSION["id"];
        if (mysqli_stmt_execute($stmt)){

            $_SESSION["charge_code"] = $userVal;
        }
        else {
            echo "invalid charge code";
        }

    }else {
        mysqli_stmt_bind_param($stmt, "si", $param_userVal, $param_userId);
        $param_userAtt = $userAtt;
        $param_userVal = $userVal;
        $param_userId = $_SESSION["id"];
        mysqli_stmt_execute($stmt);
    }





}

