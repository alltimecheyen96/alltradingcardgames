<?php
require_once '../Model/collectionModel.php';
$collectionController = new collectionController();

if(isset($_POST['Add'])){
  $collectionController->AddCard();
}

Class collectionController {

function __construct()
{
$this->Object = new collectionModel();
}

function get_all()
{
   return $this->Object->get_allCards();
}

function get_GameSet($CardNumber)
{
   return $this->Object->get_GameSetModel($CardNumber);
}

function get_Rarity($CardNumber)
{
   return $this->Object->get_RarityModel($CardNumber);
}

function AddCard() {
  $CardID = $_POST['CardID'];
  $UserID = $_POST['UserID'];
  return $this->Object->get_AddCardModel($CardID, $UserID);
}

function get_allCollection($UserID)
{
   return $this->Object->get_allMyCollectionCards($UserID);
}


}
?>
