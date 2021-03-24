<?php
	session_start();
  require '../Controller/loginController.php';
  $collectionObject = new loginController();
?>
<!DOCTYPE html5>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="../CSS/indexStyle.css">
</head>
  <body>

<div class="section">
    <form method= "post" class="container">
      <h1>Login</h1>
  			<?php
  				if(isset($_GET['error']))
  				{
  					if($_GET['error'] == "emptyfields")
  					{
  						echo '<p class= "signuperror"> Fill in all the fields! </p>';
  					}
  					else if ($_GET['error'] == "wrongwachtwoord")
  					{
  						echo '<p class= "signuperror"> Wrong password </p>';
  					}
  					else if ($_GET['error'] == "sqlerror")
  					{
  						echo '<p class= "signuperror"> Database connection failed try again </p>';
  					}
  					else if ($_GET['error'] == "nouser")
  					{
  						echo '<p class= "signuperror"> No user found </p>';
  					}
  					else if ($_GET['error'] == "ietsfout")
  					{
  						echo '<p class= "signuperror"> IK WEETT NIET WAT ER FOUT GAAT</p>';
  					}
  				}
  				else if(isset($_GET['succes']))
  				{
  					if($_GET['succes'] == "succes")
  					{
  						echo '<p class= "signupsucces"> Registration succeeded try to log in! </p>';
  					}
  					if($_GET['succes'] == "reset")
  					{
  						echo '<p class= "signupsucces"> Password has been reset you can now log in! </p>';
  					}
  				}
  			?>

      <label for="name"><b>Username</b></label>
      <input type="text" placeholder="Enter username" name="naam"  value="<?php if(isset($_COOKIE["naam"])) { echo $_COOKIE["naam"]; } ?>"required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="wachtwoord" value="<?php if(isset($_COOKIE["wachtwoord"])) { echo $_COOKIE["wachtwoord"]; } ?>"required>
  		<label class="box">Remember me
    		<input type="checkbox" checked="checked" name="remember">
    		<span class="checkmark"></span>
  		</label>
      <input type="submit" value = "Login" name= "signIn" class="btn">Login</input>
  	<hr>
  	<div class="signin">
  		<p>Don't have an account yet? <a href="register.php">Join us!</a><br></p><a href="View/wachtwoordForgot.php">Forgot your password?</a></p>

  	</div>
    </form>
	</div>

</body>
</html>
