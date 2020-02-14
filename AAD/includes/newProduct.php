

<div id="stockform">

    <h1 id="stockText">New Product</h1>
    <form id="form" class="topBefore" action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <input id="name" name="name" type="text" placeholder="Product Name" required>
        <input id="quantity" name="quantity" type="text" placeholder="Quantity" required>
        <input id="price" name="price" type="text" placeholder="Price" required>
        <input id="category" name="category" type="text" placeholder="Category ID" required>
        <input id="manufacturer" name="manufacturer" type="text" placeholder="Manufacturer ID" required>
       <!-- <input type="file" name="myimage"> -->
        <input id="submit" type="submit" value="Add">


    </form>
</div>