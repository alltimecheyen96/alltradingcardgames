<?php
require_once '../Model/loginModel.php';
$loginController = new loginController();

if(isset($_POST['signIn'])){
  $loginController->Login();
}

Class loginController {

  function __construct()
  {
    $this->Object = new loginModel();
  }

  function Login() {
		$naam = $_POST['naam'];
		$wachtwoord = $_POST['wachtwoord'];

		//check of er lege velden zijn
		if(empty($wachtwoord) || empty($naam))
		{
			header("location: ../View/index.php?error=emptyfields");
			exit();
		}
    else
  {
    $result = $this->Object->check_gegevensModel($naam);
    if($result == NULL)
      {
        header("location: ../View/index.php?error=nouser");
        exit();
      }
    else
      {
        $wachtwoordcheck = password_verify($wachtwoord,$result['Password']);
        if($wachtwoordcheck == false)
        {
          header("location: ../View/index.php?error=wrongwachtwoord");
          exit();
        }
        else if($wachtwoordcheck == true)
        {
          if(!empty($_POST["remember"]))
          {
            setcookie ("naam",$_POST["naam"],time()+ 3600);
            setcookie ("wachtwoord",$_POST["wachtwoord"],time()+ 3600);
            session_start();
            $_SESSION['naam'] = $result['UserName'];
            $_SESSION['id'] = $result['UserID'];
            header("location: ../View/home.php");
            exit();
          }
          else
          {
            session_start();
            $_SESSION['naam'] = $result['UserName'];
            $_SESSION['id'] = $result['UserID'];
            header("location: ../View/home.php");
            exit();
          }

        }
      }
  }
  }
}
?>
