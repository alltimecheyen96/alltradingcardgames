<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset= "utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../CSS/headerStyle.css">
  <body>
    <header class="header"></header>

    <nav class="navbar">
      <a href="home.php">HOME</a>
			<a href="collection.php">SEARCH COLLECTION</a>
      <a href="mycollection.php">MY COLLECTION</a>
      <a href="selling.php">MARKET PLACE</a>
      <a href="cart.php">CART</a>
			<a href="contact.php">CONTACT</a>
      <nav class="dropdown">
        <button href="#" class="dropbtn">ACCOUNT</button>
        <div class="dropdown-content">
          <a href="Account.php">Settings</a>
          <a href="../Controller/logoutController.php">Log out</a>
        </div>
      </nav>
    </nav>

  </body>
</html>
