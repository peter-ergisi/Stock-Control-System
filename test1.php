<?php
session_start();
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


<div id="totalPriceText">Total cost: $12.57
    <label id="totalPrice"> 0 </label>
</div>

<p><input type="text" value="hi" id = "productId">
<input type="text" value="hi" id = "quantity"></p>

<button type="button" onclick="testTable()">load Content</button>

<button type="button" onclick="testTable()">update Content</button>

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




</script>

<script>





</script>
