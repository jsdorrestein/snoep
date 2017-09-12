<div id="headerwrap" id="home" name="home">
<header class="clearfix">
<?php
	require_once("/classes/LoginClass.php");
	
	if (isset($_GET['emailadres']) && isset($_GET['wachtwoord']))
	{
		$activatedState = LoginClass::check_if_activated($_GET['emailadres'],$_GET['wachtwoord']);
		if ($activatedState == '0')
		{
			$action = "index.php?content=activate&emailadres=".$_GET['emailadres']."&wachtwoord=".$_GET['wachtwoord'];	
			
			if (LoginClass::check_if_email_password_exists($_GET['emailadres'], $_GET['wachtwoord'], '0'))
			{	
				if (isset($_POST['submit']))
				{
					// 2. Activeer het account en update het oude password naar het nieuwe password.
					LoginClass::activate_account_by_email($_GET['emailadres']);
					LoginClass::update_password($_GET['emailadres'], $_POST['wachtwoord_1']);
				}
				else
				{	
				
					echo "<h3>Uw account wordt geactiveerd.<br>
								Kies een nieuw wachtwoord</h3><br>";
	?> <form   method='post' >
						Type hier uw nieuwe wachtwoord <input type='password' name='wachtwoord_1' /><br>
						<input type='hidden' name='emailadres' value='<?php echo $_GET['emailadres']; ?>'/>
						<input type='submit' name='submit' />
					</form>
	<?php
				}
			}
			else
			{
				echo "U heeft geen rechten op deze pagina. Uw email/password combi is niet correct of uw account is al geactiveerd. U wordt doorgestuurd naar de homepagina<br>";
		
			}
		}
		else
		{
			echo "Uw account is al geactiveerd of uw email/password combi is niet correct u heeft daarom geen rechten op deze pagina. U wordt doorgestuurd naar de homepagina<br>";
		}
	}
	else
	{
		echo "Uw url is niet correct en daarom heeft u geen rechten op deze pagina. U wordt doorgestuurd naar de homepagina<br>";
	}
?>
               </header>
</div>