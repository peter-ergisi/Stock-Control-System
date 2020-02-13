<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($_SESSION["isStaff"] === 0){
        header("location: cart.php");
    } else if ($_SESSION["isStaff"] === 1)
        header("location: admin.php");
    exit;
}

require_once "dbconfig.php";

$username = $password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT user_ID, username, password, isStaff FROM users WHERE username = ?";

    if($stmt = mysqli_prepare($link, $sql)){

        mysqli_stmt_bind_param($stmt, "s", $param_username);

        $param_username = $username;


        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $isStaff);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                        if($isStaff === 1) {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["isStaff"] = 1;

                            header("location: admin.php");

                        } else if($isStaff === 0){
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["isStaff"] = 0;
                            header("location: cart.php");
                        }
                    }
                }
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
mysqli_close($link);

?>

<?php include("includes/header.php") ?>

<div id="stockform">

    <h1 id="stockText">Login</h1>
    <form id="form" class="topBefore" action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="post">>

        <input id="email" name="email" type="text" placeholder="Email Address" required>
        <input id="password" name="password" type="password" placeholder="Password" required>
        <input id="submit" type="submit" value="GO!">
        <a href="register.php" id="registerText">Register here!</a>


    </form>
    </div>
			
<?php include("includes/footer.php") ?>