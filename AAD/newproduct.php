<?php
require_once "dbconfig.php";

$name = "";
$quantity = "";
$price = "";
$category = "";
$manufacturer = "";
$imagename = "";
$imagetmp = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $pname = $_POST["name"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $category = $_POST["category"];
    $manufacturer = $_POST["manufacturer"];
    $imagename = $_FILES["myimage"]["name"];
    $imagetmp = addslashes (file_get_contents($_FILES['myimage']['tmp_name']));


    $sql = "INSERT INTO products (product_Name, product_Image, product_Price, category_ID, quantity, manufacturer_ID) VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "sbdiii", $param_Name, $param_Image, $param_Price, $param_categoryID, $param_quantity, $param_manufacturerID);

        $param_Name = $pname;
        $param_Image = $imagetmp;
        $param_Price = $price;
        $param_categoryID = $category;
        $param_quantity = $quantity;
        $param_manufacturerID = $manufacturer;

        if (mysqli_stmt_execute($stmt)) {
            header("location: admin.php");
        } else {
            echo "Something went wrong. Please try again later.";
            printf(" Error message: %s\n", $link->error);
        }
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($link);
?>

<div id="newproductform">

    <h1 id="stockText">New Product</h1>
    <form id="form" class="topBefore" action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <input id="name" name="name" type="text" placeholder="Product Name" required>
        <input id="quantity" name="quantity" type="text" placeholder="Quantity" required>
        <input id="price" name="price" type="text" placeholder="Price" required>
        <input id="category" name="category" type="text" placeholder="Category ID" required>
        <input id="manufacturer" name="manufacturer" type="text" placeholder="Manufacturer ID" required>
        <input type="file" name="myimage">
        <input id="submit" type="submit" value="Add">


    </form>
</div>