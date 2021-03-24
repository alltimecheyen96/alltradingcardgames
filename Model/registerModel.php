<?php

require_once ('../Model/conndb.php');
$mysqli = Singleton::getInstance();

Class registerModel {

  function __construct()
    {
      // code...
    }

Function check_naamModel($naam)
{
  global $mysqli;
  $sql = "SELECT UserName FROM user WHERE UserName = ?";
  $stmt = $mysqli -> stmt_init();
  $stmt -> prepare($sql);
  $stmt ->bind_param("s",$naam);
  $stmt ->execute();
  return $stmt->get_result();
}

function registreerPersoon($naam, $mail, $wachtwoord)
{
  global $mysqli;
  $sql = "INSERT INTO user (UserName, Email, Password) VALUES (?,?,?)";
  $stmt = $mysqli ->stmt_init();
  $stmt -> prepare($sql);
  $hashww = password_hash($wachtwoord, PASSWORD_DEFAULT);
  $stmt ->bind_param("sss",$naam, $mail, $hashww);
  $stmt ->execute();
}

function get_profile($naam)
{
  global $mysqli;
  $sql = "SELECT UserID FROM user WHERE UserName=?";
  $stmt = $mysqli ->stmt_init();
  $stmt -> prepare($sql);
  $stmt ->bind_param("s",$naam);
  $stmt ->execute();
  return $stmt->get_result();
}
}
?>
