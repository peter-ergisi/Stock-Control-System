<?php

require_once "dbconfig.php";

$page = isset($_GET['p'])? $_GET['p'] : '' ;
if($page=='view'){
    $result = $link->query("SELECT * FROM category");
    while($row = $result->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $row['category_ID'] ?></td>
            <td><?php echo $row['category_Name'] ?></td>
        </tr>
        <?php
    }

}  else if($page=='products'){
    $result = $link->query("SELECT * FROM products");
    while($row = $result->fetch_assoc()){
        ?>
        <tr role="row">
            <td><?php echo $row['product_ID'] ?></td>
            <td><?php echo $row['product_Name'] ?></td>
            <td><?php echo $row['product_Price'] ?></td>
            <td><?php echo $row['category_ID'] ?></td>
            <td><?php echo $row['Quantity'] ?></td>
        </tr>
        <?php
    }
}
mysqli_close($link);

echo json_encode($input);
?>