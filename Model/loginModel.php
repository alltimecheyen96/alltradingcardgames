<?php

require_once ('../Model/conndb.php');
$mysqli = Singleton::getInstance();

Class loginModel {

  function __construct()
    {
      // code...
    }

    Function check_gegevensModel($naam)
    {
      global $mysqli;
      $sql = "SELECT * FROM user WHERE UserName = ?";
      $stmt = $mysqli->stmt_init();
      $stmt->prepare($sql);
      $stmt->bind_param("s",$naam);
      $stmt->execute();
      $result = $stmt->get_result();
      return $row = mysqli_fetch_assoc($result);
    }
}
?>
