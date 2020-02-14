<?php

session_start();
require_once "dbconfig.php";

$sql = "UPDATE products SET quantity = ? WHERE product_ID = ?";
$sqlb = "SELECT on_order FROM products WHERE product_Id = ?;";
$sqlc = "UPDATE products SET on_order = '1' WHERE product_ID = ?";
$sqld = "select m.address from manufacturer m inner join products p on p.manufacturer_ID=m.manufacturer_ID where p.product_ID=?";

$max = sizeof($_SESSION["Cart"]);
$validtrans = true;


if($stmt = mysqli_prepare($link, $sql)) {

    for ($row = 0; $row < $max; $row++) {
        $quantity = intval($_SESSION["Cart"][$row][5]) - intval($_SESSION["Cart"][$row][2]);

        if ($quantity < 0){

            $validtrans = false;



        }
    }
    if ($validtrans == true){
        for ($row = 0; $row < $max; $row++) {
            mysqli_stmt_bind_param($stmt, "ii", $param_quantity, $param_productId);
            $param_quantity = intval($_SESSION["Cart"][$row][5]) - intval($_SESSION["Cart"][$row][2]);
            $param_productId = intval($_SESSION["Cart"][$row][3]);
            mysqli_stmt_execute($stmt);
            echo "true";
            if ($quantity < 5){

                if($stmtb = mysqli_prepare($link, $sqlb)) {

                    mysqli_stmt_bind_param($stmtb, "i",  $param_productId);
                    $param_productId = intval($_SESSION["Cart"][$row][3]);
                    if(mysqli_stmt_execute($stmtb)){

                        mysqli_stmt_store_result($stmtb);
                        if(mysqli_stmt_num_rows($stmtb) == 1){

                            mysqli_stmt_bind_result($stmtb, $onOrderCheck);
                            if(mysqli_stmt_fetch($stmtb)){
                                if ($onOrderCheck == 0){
                                    if($stmtc = mysqli_prepare($link, $sqlc)) {
                                        mysqli_stmt_bind_param($stmtc, "i",  $param_productId);
                                        $param_productId = intval($_SESSION["Cart"][$row][3]);
                                        mysqli_stmt_execute($stmtc);
                                    }
                                    if($stmtd = mysqli_prepare($link, $sqld)) {

                                        mysqli_stmt_bind_param($stmtd, "i", $param_productId);
                                        $param_productId = intval($_SESSION["Cart"][$row][3]);
                                        if (mysqli_stmt_execute($stmtd)) {

                                            mysqli_stmt_store_result($stmtd);
                                            if (mysqli_stmt_num_rows($stmtd) == 1) {

                                                mysqli_stmt_bind_result($stmtd, $companyEmail);
                                                if (mysqli_stmt_fetch($stmtd)) {
                                                    echo($companyEmail);
                                                }
                                            }
                                        }
                                    }
                                    echo("would order more");
                                }
                            }
                        }
                    };
                }


            }
            $_SESSION["Cart"] = array();

            }
        if ($quantity < 5){

            if($stmtb = mysqli_prepare($link, $sqlb)) {

                mysqli_stmt_bind_param($stmtb, "i",  $param_productId);
                $param_productId = intval($_SESSION["Cart"][$row][3]);
                if(mysqli_stmt_execute($stmtb)){
                    echo($param_productId);
                    mysqli_stmt_store_result($stmtb);
                    if(mysqli_stmt_num_rows($stmtb) == 1){

                        mysqli_stmt_bind_result($stmtb, $onOrderCheck);
                        if(mysqli_stmt_fetch($stmtb)){
                            if ($onOrderCheck == 0){

                            }
                        }
                    }
                };
            }


        }
        $to_email_address = $_SESSION["username"];
        $subject = "Test email";
        $message = "This email is just for testing purposes";
        mail("n0775243@my.ntu.ac.uk",$subject,$message);

        date_default_timezone_set('Australia/Melbourne');
        $datetime = date('Y-m-d h:i:s', time());


        $sql = "INSERT INTO orders (order_Date, user_Id, order_Total) VALUES (CURRENT_TIMESTAMP() ,?, ?);";



        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "id", $param_userId , $param_orderTotal);

            $param_userId= intval($_SESSION["id"]);
            $param_orderTotal = doubleval($_SESSION["cart_Price"]);
            mysqli_stmt_execute($stmt);
        }

    } else {
        echo "false";
    }
    /*for ($row = 0; $row < $max; $row++) {
        mysqli_stmt_bind_param($stmt, "ii", $param_quantity, $param_productId);
        $param_quantity = intval($_SESSION["Cart"][$row][5]) - intval($_SESSION["Cart"][$row][2]);
        $param_productId = intval($_SESSION["Cart"][$row][3]);
        mysqli_stmt_execute($stmt);
    }*/

}

/*$to_email_address = $_SESSION["username"];
$subject = "Test email";
$message = "This email is just for testing purposes";
mail("n0775243@my.ntu.ac.uk",$subject,$message);

date_default_timezone_set('Australia/Melbourne');
$datetime = date('Y-m-d h:i:s', time());


$sql = "INSERT INTO orders (order_Date, user_Id, order_Total) VALUES (CURRENT_TIMESTAMP() ,?, ?);";



if($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "id", $param_userId , $param_orderTotal);

    $param_userId= intval($_SESSION["id"]);
    $param_orderTotal = doubleval($_SESSION["cart_Price"]);
    mysqli_stmt_execute($stmt);
}
*/





?>