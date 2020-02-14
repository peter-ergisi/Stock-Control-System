<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


$_SESSION["Cart"] = array();
$_SESSION["cart_Price"] = 0;






?>




<?php include("includes/header.php") ?>
<link rel="stylesheet" href="styles/cart.css">

<h1 id="cartText">Shopping Cart!</h1>

<style>
    /* [COSMETICS - DOES NOT MATTER] */
    html, body {
        font-family: arial;
    }
    table {
        border-collapse: collapse;
    }
    table tr td {
        border: 1px solid #000;
        padding: 10px;
    }
</style>

<div id="cartSection">
    <table id="cartTable">
        <tbody id="cartBody">
        <tr>
            <th>Product name</th>
            <th>Price</th>
            <th>Quantity: </th>


        </tr>

    </table>
    <div id="container"></div>






</div>
<div id="controlContainer">
    <div id="cartControls">
        <p style="text-align: center"><input type="text" placeholder="Enter product code" id = "productId">
            <input type="text" placeholder="Quantity" id = "quantity">


        <button type="button" class="btn btn-warning" onclick="testTable()">Add to cart</button>
        </p>
        <p style="text-align: center">
        <button type="button" style="width:250px;text-align: center" class="btn btn-success" onclick="submitOrder()">Submit Order</button>
        </p>
    </div>
</div>
<?php include("includes/footer.php") ?>


<script>



    function updateTable(){
        var xhttp;

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("container").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "test2.php", true);
        xhttp.send();

        $(document).ready(function() {

            $('#example tr').click(function() {
                var href = $(this).find("a").attr("href");
                if(href) {
                    window.location = href;
                }
            });

        });


    }



    function testTable(){
        var xhttp;
        var xhttpb;
        var testbb = document.getElementById("productId").value;
        var quant = document.getElementById("quantity").value;



        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("container").innerHTML = this.responseText;

            }
        };
        xhttp.open("GET", "test2.php?q=" + testbb + "&p=" + quant , true);
        xhttp.send();
        getUpdated();





    }



    function deleteFromCart(idtodel){
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("container").innerHTML = this.responseText;

            }
        };
        xhttp.open("GET", "delete.php?d=" + idtodel, true);
        xhttp.send();
    }

    function submitOrder(){

        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);


            }
        };
        xhttp.open("GET", "submitOrder.php", true);
        xhttp.send();
    }




</script>
