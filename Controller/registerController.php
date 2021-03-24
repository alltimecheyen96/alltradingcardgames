<?php
require_once '../Model/registerModel.php';
$registerController = new registerController();

if(isset($_POST['reg_submit'])){
  $registerController->Register();
}

Class registerController {

  function __construct()
  {
    $this->Object = new registerModel();
  }

  function Register() {

		$naam = $_POST['naam'];
		$mail = $_POST['Email'];
		$wachtwoord = $_POST['Wachtwoord'];
		$wwrepeat = $_POST['ww-repeat'];
		$catchCapta = $_POST['g-recaptcha-response'];

		$uppercase = preg_match('@[A-Z]@',$wachtwoord);
		$lowercase = preg_match('@[a-z]@',$wachtwoord);
		$number = preg_match('@[0-9]@',$wachtwoord);
		$specialChars = preg_match('@[^\w]@',$wachtwoord);

		//check of er lege velden zijn
		if(empty($mail) || empty($wachtwoord) || empty($wwrepeat) || empty($naam))
		{
			header("location: ../View/register.php?error=emptyfields&Email=".$mail."&naam=".$naam);
			exit();
		}
		//check email en naam
		else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)&&!preg_match("/^[a-zA-Z0-9]*$/",$naam))
		{
			header("location: ../View/register.php?error=invalidmailnaam");
			exit();
		}
		//check email
		else if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
		{
			header("location: ../View/register.php?error=invalidmail&naam=".$naam);
			exit();
		}
		//check naam
		else if (!preg_match("/^[a-zA-Z0-9]*$/",$naam))
		{
			header("location: ../View/register.php?error=invalidname&Email=".$mail);
			exit();
		}
		//check sterkte wachtwoord
		else if(!$uppercase|| !$lowercase|| !$number ||!$specialChars || strlen($wachtwoord)<8)
		{
			header("location: ../View/register.php?error=wachtwoordincorrect&Email=".$mail."&naam=".$naam);
			exit();
		}
		//check of wachtwoorden gelijk zijn
		else if($wachtwoord !== $wwrepeat)
		{
			header("location: ../View/register.php?error=wachtwoordcheck&Email=".$mail."&naam=".$naam);
			exit();
		}
		else if ($catchCapta.Length == 0)
		{
			header("location: ../View/register.php?error=captcha&Email=".$mail."&naam=".$naam);
			exit();
		}
		else
		{
			$result = $this->Object->check_naamModel($naam);
			$count = mysqli_num_rows($result);
			if($count > 0)
	    {
	      header("location: ../View/register.php?error=naambezet&Email=".$mail);
	      exit();
	    }
			else
			{
				$this->Object->registreerPersoon($naam, $mail, $wachtwoord);
					header("location: ../View/index.php?succes=succes");
					exit();
			}
		}
}

}
?>
