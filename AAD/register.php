<?php
require_once "dbconfig.php";

$username = "";
$password = "";
$confirm_password = "";
$firstName = "";
$lastName = "";
$chargeCode = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["email"];
    $password = $_POST["password1"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $chargeCode = $_POST["chargeCode"];
    $isStaff = "0";


    $sql = "INSERT INTO users (username, password, firstName, lastName, chargeCode, isStaff) VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssii", $param_username, $param_password, $param_firstName, $param_lastName, $param_chargeCode, $param_isStaff);

        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $param_firstName = $firstName;
        $param_lastName = $lastName;
        $param_chargeCode = intval($chargeCode);
        $param_isStaff = intval($isStaff);

        if (mysqli_stmt_execute($stmt)) {
            header("location: login.php");
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($link);
?>

<?php include("includes/header.php") ?>

<div id="stockform">
	
	<h1 id="stockText">Registration</h1>
	<form id="form" class="topBefore" action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	
	  <input id="email" name="email" type="text" placeholder="Email Address" required>
	  <input id="password1" name="password1" type="password" placeholder="Password" required>
	  <input id="password2" name="password2" type="password" placeholder="Retype Password" required>
	  <input id="firstName" name="firstName" type="text" placeholder="First Name" required>
	  <input id="lastName" name="lastName" type="text" placeholder="Last Name" required>
	  
	  <select id="securityQuestions">
		  <option value="Q1">What was the city you grew up in?</option>
		  <option value="Q2">What is your mothers maiden name?</option>
		  <option value="Q3">What street did you grow up on?</option>
		  <option value="Q4">What was the name of your first pet?</option>
	  </select>
		
	  <input id="securityA" name="securityA" type="text" placeholder="Security Answer" required>
	  <input id="chargeCode" name="chargeCode" type="text" placeholder="Charge Code" required>
	  <input id="submit" type="submit" value="Register!">
      
      
	</form>
</div>
<?php include("includes/footer.php") ?>
