<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($_SESSION["isStaff"] === 0) {
        header("location: cart.php");
    } else if($_SESSION["isStaff"] === 1){

    }
}
else {
    header("location: login.php");
    exit;
}
?>

<?php include("includes/header.php") ?>
<?php include("includes/sidebar.php") ?>
	<link rel="stylesheet" href="styles/admin.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script>
	var trigger;
	var container;
	function loadPHP()
	{
		var $this = $(this);
		//get variable name
		var target = $this.data('target');
		//loads page into container
		container.load('includes/' + target + '.php');
		console.log(target);
	}
	function loadVar()
	{
		//set trigger
		trigger = $('#sideNav ul li a');
		//set container
        container = $('#adminPanel');
        trigger.on('click',loadPHP);
	}
  	$(document).ready(loadVar);
    </script>

	<div id="adminPanel">
		<?php include("includes/dashboard.php") ?>
	</div>

<?php include("includes/footer.php") ?>
<?php include("includes/bootstrap.php") ?>