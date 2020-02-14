<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($_SESSION["isStaff"] === 0) {
        header("location: cart.php");
    } else if($_SESSION["isStaff"] === 1){
        header("location: admin.php");
    }
}
else {
    header("location: login.php");
    exit;
}
?>

<?php include("includes/header.php") ?>
<div id="homeText"> <h1>Products!</h1></div>
<div id="searchBar">
    <form id="searchForm">
        <input name="search" type="text" placeholder="Search.." >
        <button type="submit">Search!</button>
    </form>
</div>

<div id="content" class="contentPre">

    <div id="stock">
        <table>
            <tr>
                <th>Product name</th>
                <td>image</td>
                <th>price</th>
                <td>
                    <form>
                        <input id="itemQTY" type="text" placeholder="Quantity" required>
                        <input id="submit" type="submit" value="Add to cart!">
                    </form>
                </td>
            </tr>
        </table>


    </div>

</div>

<?php include("includes/footer.php") ?>
