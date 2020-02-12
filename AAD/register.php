<?php include("includes/header.php") ?>

<div id="stockform">
	
	<h1 id="stockText">Registration</h1>
	<form id="form" class="topBefore">
	
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