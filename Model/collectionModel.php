<?php

require_once ('../Model/conndb.php');
$mysqli = Singleton::getInstance();

Class collectionModel {

  function __construct()
    {
      // code...
    }

Function get_allCards()
{
  global $mysqli;
  $cards = array();
  $stmt = $mysqli->query('SELECT * FROM cardlotr');
  if($stmt != ''){
    while ($item=mysqli_fetch_object($stmt)){
      array_push($cards, $item);
    }
  }
  return $cards;
}

Function get_GameSetModel($CardNumber)
{
  global $mysqli;
  $sql = "SELECT SetTypeName FROM settype JOIN cardlotr ON cardlotr.GameSet = settype.SetTypeID WHERE CardNumber= ?";
  $stmt = $mysqli->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param("s",$CardNumber);
  $stmt->execute();
  $result = $stmt->get_result();
  return $row = mysqli_fetch_assoc($result);
}

Function get_RarityModel($CardNumber)
{
  global $mysqli;
  $sql = "SELECT RarityName FROM rarity JOIN cardlotr ON cardlotr.Rarity = rarity.RarityID WHERE CardNumber= ?";
  $stmt = $mysqli->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param("s",$CardNumber);
  $stmt->execute();
  $result = $stmt->get_result();
  return $row = mysqli_fetch_assoc($result);
}

Function get_AddCardModel($CardID, $UserID) {
  global $mysqli;
  $sql = "INSERT INTO mycollection (`UserID`, `CardID`) VALUES (? , ?)";
  $stmt = $mysqli->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param("ii",$UserID, $CardID);
  $stmt->execute();
}

Function get_allMyCollectionCards($UserID)
{
  global $mysqli;
  $cards = array();
  $sql = "SELECT * FROM mycollection JOIN cardlotr ON cardlotr.CardID = mycollection.CardID WHERE UserID = ? GROUP BY CardNumber";
  $stmt = $mysqli->stmt_init();
  $stmt->prepare($sql);
  $stmt->bind_param("i",$UserID);
  $stmt->execute();
  $stmt = $stmt->get_result();
  if($stmt != ''){
    while ($item=mysqli_fetch_object($stmt)){
      array_push($cards, $item);
    }
  }
  return $cards;
}

}

?>
