<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Watches Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<!--webfont-->
<link href='//fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Dorsa' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<!-- start menu -->
<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<script src="js/jquery.easydropdown.js"></script>
<script src="js/simpleCart.min.js"> </script>
</head>

    <div class="account-in">
   	  <div class="container">
   	     <?php
	if (isset($_POST['submit']))
	{
		require_once("/classes/LoginClass.php");
		if (LoginClass::check_if_email_exists($_POST['emailadres']))
		{
			//Zo ja, geef een melding dat het emailadres bestaat en stuur
			//door naar register_form.php
			echo "Het door u gebruikte emailadres is al in gebruik.<br>
				  Gebruik een ander emailadres. U wordt doorgestuurd naar<br>
				  het registratieformulier";
			header("refresh:2;url=index.php?content=register_form");
		}
		else
		{
			LoginClass::insert_into_database($_POST);
            // echo "Op naar de loginclass::insert into database!";
		}
        //echo "Er is op de submit knop gedrukt!";
	}
	else
	{
?>
<!DOCTYPE html>

           <div id="headerwrap" id="home" name="home">
			<header class="clearfix">
	<h3>Registratieformulier</h3>
		<form  method='post'>
            <div class="form-group">
			Naam: <input type='text' name='naam' required="required" class="form-control"/><br>
            </div>
            <div class="form-group">
            Achternaam: <input type='text' name='achternaam' required="required" class="form-control"/><br>
                </div>
                <div class="form-group">
            Adres: <input type='text' name='adres'  required="required" class="form-control"/><br>
                    </div>
                    <div class="form-group">
            Postcode: <input type='text' name='postcode' required="required" class="form-control"/><br>
                        </div>
                        <div class="form-group">
            Woonplaats: <input type='text' name='woonplaats'  required="required" class="form-control"/><br>
                            </div>
                            <div class="form-group">
			Emailadres: <input type='text' name='emailadres' required="required" class="form-control"/><br>
                                </div>
			<input type='submit' name='submit' style="background-color: green" />
		</form>
               </header>
</div>

<?php
	}
?>

		<div class="clearfix"> </div>
		<div class="register-but">
		   <form>
			   <div class="clearfix"> </div>
		   </form>
		</div>
	   </div>
   </div>
  
</body>
</html>		