<?php
	session_start();
  require '../Controller/registerController.php';
  $collectionObject = new registerController();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="../CSS/registerStyle.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
	<form  class="container" method = "post">
		<h1>Join us!</h1>
		<p>Please fill in this form to create an account.</p>
		<hr>
		<?php
			if(isset($_GET['error']))
			{
				if($_GET['error'] == "emptyfields")
				{
					echo '<p class= "signuperror"> Fill in all the fields! </p>';
				}
				else if ($_GET['error'] == "invalidmailnaam")
				{
					echo '<p class= "signuperror"> Unvalid mail and name </p>';
				}
				else if ($_GET['error'] == "invalidmail")
				{
					echo '<p class= "signuperror"> Unvalid mail </p>';
				}
				else if ($_GET['error'] == "invalidname")
				{
					echo '<p class= "signuperror"> Unvalid name </p>';
				}
				else if ($_GET['error'] == "wachtwoordcheck")
				{
					echo '<p class= "signuperror"> Passwords do not match </p>';
				}
				else if ($_GET['error'] == "sqlerror")
				{
					echo '<p class= "signuperror"> Connection failed to database try again </p>';
				}
				else if ($_GET['error'] == "naambezet")
				{
					echo '<p class= "signuperror"> This username is taken </p>';
				}
				else if ($_GET['error'] == "wachtwoordincorrect")
				{
					echo '<p class= "signuperror"> Password not correct should include: <br> - 8 characters<br> - one upper case letter<br> - one number<br> - one special character </p>';
				}
				else if ($_GET['error'] == "captcha")
				{
					echo '<p class= "signuperror"> Please confirm you are not a robot</p>';
				}
			}
		?>
		<label for="Naam"><b>Username</b></label>
		<input type="text" placeholder="Enter username" name="naam" required>

		<label for="Email"><b>Email</b></label>
		<input type="text" placeholder="Enter Email" name="Email" required>

		<label for="Wachtwoord"><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="Wachtwoord" required>

		<label for="ww-repeat"><b>Repeat Password</b></label>
		<input type="password" placeholder="Repeat Password" name="ww-repeat" required>
		<hr>
		<div class="g-recaptcha" data-sitekey="6Ldu1L8UAAAAAKYJoDvwxb3YcoIrZXyXZFxBO3LO" name="captcha" onclick="../Controller/captchaCheck"></div>
		<button type="submit" name= "reg_submit" class="btn">Register</button>
	  <hr>
	  <div class="signin">
		<p>Already have an account? <a href="../View/index.php">Sign in</a></p>
	  </div>
	</form>

</body>
</html>
