<?php
$_SESSION["Cart"] = [
    "one" => "cat",
    "two" => "dog",
    "three" => "mouse",

];



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

<div id="totalPriceText"><h2>Total cost: $12.57</h2></div>
<p><input type="text" value="hi" name = "productId"></p>
<label name="testlab">oldText</label>

<button type="button" onclick="loadDoc()">load Content</button>

<button type="button" onclick="updateTable()">update Content</button>

<?php include("includes/footer.php") ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script>
    function loadDoc() {

        var data = ["Saab", "Volvo", "BMW"];
        var html;
        var testc;

        html = "<b>";
        var textboxvalue = $('input[name="route_no"]').val();
        html += "</b>";



        document.getElementById("container").innerHTML = testc;
        document.getElementById("testlab").innerHTML = textboxvalue;

    }


    function updateTable(str){
        var xhttp;

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("container").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "test2.php?q="+str, true);
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




</script>