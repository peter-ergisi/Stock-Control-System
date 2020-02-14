<?php include("includes/header.php") ?>

<?php

session_start();

$username = $_SESSION["username"];
$fname = $_SESSION["first_name"];
$last_name = $_SESSION["last_name"];
$charge_code = $_SESSION["charge_code"];



?>

    <link rel="stylesheet" href="styles/cart.css">
	<link rel="stylesheet" href="styles/settings.css">
    <h1 id="cartText">Account settings</h1>



    <div id="settingsSection">
        <table id="settingsTable">
            <tr>
                <td>Email:</td>
                <td> <label id="usernamel"><?php echo $username; ?></label></td>
                <td> New Email:</td>
                <td><input id = "username" type="text" size="30"/></td>

                <td><button type="button" class="btn btn-success" onclick="updateUser('username')">Update</button></td>
            </tr>
            <tr>
                <td>First name:</td>
                <td> <label id="first_namel"> <?php echo $fname; ?> </label></td>
                <td> New First Name:</td>
                <td><input id = "first_name" type="text" size="30"/></td>

                <td><button type="button" class="btn btn-success" onclick="updateUser('first_name')">Update</button></td>
            </tr>
            <tr>
                <td>Last name:</td>
                <td> <label id="last_namel"><?php echo $last_name; ?></label></td>
                <td> New Last name:</td>
                <td><input id = "last_name" type="text" size="30"/></td>

                <td><button type="button" class="btn btn-success" onclick="updateUser('last_name')">Update</button></td>
            </tr>
            <tr>
                <td>Charge code:</td>
                <td> <label id="charge_codel"><?php echo $charge_code; ?></label></td>
                <td> New charge code:</td>
                <td><input id = "charge_code" type="text" size="30"/></td>

                <td><button type="button" class="btn btn-success" onclick="updateUser('charge_code')">Update</button></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td> <label id="passwordl"> password hidden </label></td>
                <td> New Password:</td>
                <td><input id = "passwordb" type="password" size="30"/></td>

                <td><button type="button" class="btn btn-success" onclick="updateUser('password')">Update</button></td>
            </tr>

        </table>

    </div>



    <script>

        function updateUser(attribute){
            if (attribute != "password"){
                var value = document.getElementById(attribute).value;
                var attstring = attribute.concat("l");
            } else{
                var value = document.getElementById("passwordb").value;
            }




            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    if (this.responseText == "invalid charge code"){
                        alert(this.responseText);
                    }else{
                        if (attribute != "password"){
                            document.getElementById(attstring).innerHTML = value;
                        }
                        else{
                            alert("Password changed");
                            document.getElementById("passwordb").value = "";
                        }

                    }

                }
            };
            xhttp.open("GET", "updateUsers.php?a=" + attribute + "&v=" + value , true);

            xhttp.send();
        }

    </script>



<?php include("includes/footer.php") ?>