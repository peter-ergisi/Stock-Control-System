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
} else {
    // Basic example of PHP script to handle with jQuery-Tabledit plug-in.

    header('Content-Type: application/json');

    $input = filter_input_array(INPUT_POST);

    if ($input['action'] == 'edit') {
        $link->query("UPDATE users SET username='" . $input['username'] . "', email='" . $input['email'] . "', avatar='" . $input['avatar'] . "' WHERE id='" . $input['id'] . "'");
    } else if ($input['action'] == 'delete') {
        $link->query("UPDATE users SET deleted=1 WHERE id='" . $input['id'] . "'");
    } else if ($input['action'] == 'restore') {
        $link->query("UPDATE users SET deleted=0 WHERE id='" . $input['id'] . "'");
    }

}
mysqli_close($link);

echo json_encode($input);
?>