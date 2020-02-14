<?php

session_start();
require_once "dbconfig.php";
require("lib/sendgrid-php/sendgrid-php.php");

$sql = "UPDATE products SET quantity = ? WHERE product_ID = ?";
$sqlb = "SELECT on_order FROM products WHERE product_Id = ?;";
$sqlc = "UPDATE products SET on_order = '1' WHERE product_ID = ?";
$sqld = "select m.address from manufacturer m inner join products p on p.manufacturer_ID=m.manufacturer_ID where p.product_ID=?";
$sqle = "SELECT DISTINCT dept_Funds from departments d inner join users u on d.dept_ChargeCode=u.chargeCode where d.dept_ChargeCode=(SELECT chargeCode from users where user_ID=?)";


$max = sizeof($_SESSION["Cart"]);
$validtrans = true;
$receiptStringintro = "Thank you for your purchase an invoice of the items you ordered is listed below:";
$newline = "\n";
$receiptString = $receiptStringintro.$newline;


if($stmt = mysqli_prepare($link, $sqle)) {


    mysqli_stmt_bind_param($stmt, "i", $param_id);

    $param_id = intval($_SESSION["id"]);


    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $depfunds);
            if (mysqli_stmt_fetch($stmt)) {
                if ($depfunds < $_SESSION["cart_Price"]) {
                    $validtrans = false;
                    echo "Not enough money in department account";
                }
            }
        }
    }
}


if($stmt = mysqli_prepare($link, $sql)) {

    for ($row = 0; $row < $max; $row++) {
        $quantity = intval($_SESSION["Cart"][$row][5]) - intval($_SESSION["Cart"][$row][2]);

        if ($quantity < 0){
            $validtrans = false;
            echo "One or more of the items in your cart are not adequatly stocked";
        }
    }

    if ($validtrans == true){
        for ($row = 0; $row < $max; $row++) {
            mysqli_stmt_bind_param($stmt, "ii", $param_quantity, $param_productId);
            $param_quantity = intval($_SESSION["Cart"][$row][5]) - intval($_SESSION["Cart"][$row][2]);
            $param_productId = intval($_SESSION["Cart"][$row][3]);
            mysqli_stmt_execute($stmt);
            $receiptString = $receiptString.$_SESSION["Cart"][$row][0]."   ".strval($_SESSION["Cart"][$row][2]);
            $receiptString = $receiptString.$newline;
            $quantity = intval($_SESSION["Cart"][$row][5]) - intval($_SESSION["Cart"][$row][2]);


            if ($quantity < intval($_SESSION["Cart"][$row][6])){

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
                                                    $emailStringa = "we would like to order ";
                                                    $emailStringb = ($_SESSION["Cart"][$row][7]);
                                                    $emailStringc = ($_SESSION["Cart"][$row][0]);
                                                    $emailStringcomp = $emailStringa.$emailStringb." ".$emailStringc;
                                                    $from = new SendGrid\Email("NTU Store", "n0751891@ntu.ac.uk");
                                                    $subject = "Ordering Stock";
                                                    $to = new SendGrid\Email("Elmer", $companyEmail);
                                                    $content = new SendGrid\Content("text/plain", $emailStringcomp);
                                                    $mail = new SendGrid\Mail($from, $subject, $to, $content);
                                                    $apiKey = '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';
                                                    $sg = new \SendGrid($apiKey);
                                                    $response = $sg->client->mail()->send()->post($mail);


                                                }
                                            }
                                        }
                                    }

                                }
                            }
                        }
                    };
                }


            }


            }

        if ($quantity < intval($_SESSION["Cart"][$row][6])){

            if($stmtb = mysqli_prepare($link, $sqlb)) {

                mysqli_stmt_bind_param($stmtb, "i",  $param_productId);
                $param_productId = intval($_SESSION["Cart"][$row][3]);
                if(mysqli_stmt_execute($stmtb)){

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

        $sql = "CALL exec_trans(?,?)";
        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "id", $param_userId , $param_orderTotal);

            $param_userId= intval($_SESSION["id"]);
            $param_orderTotal = doubleval($_SESSION["cart_Price"]);
            mysqli_stmt_execute($stmt);
        }

        $receiptString = $receiptString.$newline."Total cost: ".strval($_SESSION["cart_Price"]);
        $_SESSION["Cart"] = array();
        $_SESSION["cart_Price"] = 0;
        echo "Transaction success";

        $from = new SendGrid\Email("NTU Store", "n0751891@ntu.ac.uk");
        $subject = "Your order";
        $to = new SendGrid\Email("Elmer", $_SESSION["username"]);
        $content = new SendGrid\Content("text/plain", $receiptString);
        $mail = new SendGrid\Mail($from, $subject, $to, $content);
        $apiKey = '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';
        $sg = new \SendGrid($apiKey);
        $response = $sg->client->mail()->send()->post($mail);


    } else {
        pass;
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