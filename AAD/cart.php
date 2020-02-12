<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<?php include("includes/header.php") ?>
    <link rel="stylesheet" href="styles/cart.css">

    <h1 id="cartText">Shopping Cart!</h1>

    <div id="cartSection">
        <table id="cartTable">
            <tbody id="cartBody">
            <tr>
                <th>Product name</th>
                <th>Price</th>
                <th>Quantity: </th>
                <td><img id="deleteImg"src="images/delete.png" /></td>
            </tr>
            </tbody>
        </table>



    </div>

    <div id="totalPriceText"><h2>Total cost: $12.57</h2></div>

<?php include("includes/footer.php") ?>