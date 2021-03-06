<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="styles/main.css">
		<link rel="stylesheet" href="styles/login.css">
		<script type="text/javascript" src="JS/main.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta charset="utf-8">
		<meta name="author" content="Mathew Cutler">
		<title>Store system</title>
	</head>

	<body onload="setTimeout(loadNavBar)">
		<div id="wrapper">
			<header>
				<nav id="nav" class="navbarPost">
					
					<!-- Logo top right -->
					<div class="logo">
						<a href="index.php" style="text-decoration: none"><h1 id="stockText">Store System</h1></a>
					</div>
					
					<!-- Navbar - >1200px screens -->
					<ul class="menu">
							<a href="index.php">Home</a>
							<a href="cart.php">Cart</a>
							<a href="login.php">Login</a>
					</ul>
					
					<!-- Menu button - shows at <1200px screens -->
					<div id="menuTxt" onclick="toggleMenu()"><span>MENU</span></div>
					<div id="menuBtn" onclick="toggleMenu()">
						<div id="bar1"> </div>
						<div id="bar2"> </div>
						<div id="bar3"> </div>
						<div id="bar4"> </div>
					</div>
					
					<div id="mobileMenu">
						<div id="mobileLinks">
							<a href="index.php">Home</a>
							<a href="cart.php">Cart</a>
							<a href="login.php">Login</a>
						</div>
					</div>
					
					<div class="dropdownNav">
						<p id="settingsTxt">Settings</p>
						<i id="settingsCog" class="fa fa-gear"></i>
						<div class="dropdown-content">
							<a href="settings.php">User Settings</a>
							<a href="admin.php">Admin Panel</a>
						</div>
					</div>
					
				</nav>
			</header>