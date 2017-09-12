<div id="headerwrap" id="home" name="home">
	<header class="clearfix">
                
                <?php
	require_once("./classes/LoginClass.php");
	require_once("./classes/SessionClass.php");
	
	if ( !empty($_POST['emailadres']) && !empty($_POST['wachtwoord']))
	{
		// Als email/password combi bestaat en geactiveerd....
		if (LoginClass::check_if_email_password_exists($_POST['emailadres'], 
													   $_POST['wachtwoord'],
													   '1'))
		{
			$session->login(LoginClass::find_login_by_email_password($_POST['emailadres'], 														  $_POST['wachtwoord']));
			
			switch ($_SESSION['rol'])
			{
				case 'klant':
				include ('algemeneHomepage.php');
					break;
				case 'root':
				include ('rootHomepage.php');
					break;
				case 'eigenaar':
				include ('eigenaarHomepage.php');
					break;
				default :
				include ('index.php');			
			}
		}
		else
		{
			echo "Uw email/password combi bestaat niet of uw account is niet geactiveerd.";
				//  header("refresh:4;url=home.php");
		}	
	}
	else
	{
		echo "U heeft een van beide velden niet ingevuld, u wordt doorgestuurd<br>
		naar de inlogpagina. Of uw account is nog niet geactiveerd";
		//header("refresh:5;url=inloggen.php");
	}
?>


               </header>
</div>