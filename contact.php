 <?php
	if (isset($_POST['submit']))
	{
		require_once("/classes/contactClass.php");
		if (contactClass::check_if_klacht_exists($_POST['bericht']))
		{
			//Zo ja, geef een melding dat het emailadres bestaat en stuur
			//door naar register_form.php
			echo "Het door u gebruikte emailadres is al in gebruik.<br>
				  Gebruik een ander emailadres. U wordt doorgestuurd naar<br>
				  het registratieformulier";
			header("refresh:2;url=index.php?content=toevoegen");
		}
		else
		{
			contactClass::insert_into_database($_POST);
            // echo "Op naar de loginclass::insert into database!";
		}
        //echo "Er is op de submit knop gedrukt!";
	}
	else
	{
?>
<!DOCTYPE HTML>
<html>

   <div class="men">
   	 <div class="container">
   	  <div class="grid_1">
	   	  <h1>Contact Info</h1>
	   	 Heb je een vraag, opmerking of wil je een artikel retour sturen? Maak dan gebruik van onderstaand contactformulier of stuur een email naar info@fashion-click.nl

Wij proberen binnen 24 uur te reageren op alle emails;
Kan het echt niet wachten? Dan zijn wij op werkdagen telefonisch tussen 10.00 en 17.00 bereikbaar op:
06-41 308 936 

Bedrijfsadres
The Sweeth Tooth
Langestraat 23
3624 XP

LET OP : Dit is geen bezoekersadres.

Telefoon: 030-2944919  ( tussen 10.00 en 17.00 bereikbaar )
E-mail: snoep@shop.nl

Bedrijfsgegevens
KvK-nr: 62895532
BTW-nr: NL 133471111 B01
      </div>
      <div class="grid_4">
      <div class="grid_2 preffix_1">
	      <ul class="iphone">
	      	<i class="phone"> </i>
	      	<li class="phone_desc">Telefoon: 030-2944919 </li>
	      	<div class="clearfix"> </div>
	      </ul>
	      <ul class="iphone">
	      	<i class="flag"> </i>
	        <li class="phone_desc">Website : <a href="mailto:mail@demolink.org">www.thesweettooth.nl</a></li>
	      	<div class="clearfix"> </div>
	      </ul>
	  </div>
	  <div class="grid_3">
	      <ul class="iphone">
	      	<i class="msg"> </i>
	        <li class="phone_desc">Email : <a href="mailto:mail@demolink.org">snoep@shop.com</a> </li>
	      	<div class="clearfix"> </div>
	      </ul>
	      <ul class="iphone">
	      	<i class="home"> </i>
	        <li class="phone_desc">Adress : Langestraat 23 </li>
	      	<div class="clearfix"> </div>
	      </ul>
	  </div>
	  <div class="clearfix"> </div>
	 </div>
	     <div id="headerwrap" id="home" name="home">
			<header class="clearfix">
	<h3>Contactformulier</h3>
		<form  method='post'>
            <div class="form-group">
			Email: <input type='text' name='email' required="required" class="form-control"/><br>
            </div>
            <div class="form-group">
            Bericht: <input type='text' name='bericht' required="required" class="form-control"/><br>
                </div>
			<input type='submit' name='submit' style="background-color: green" />
		</form>
               </header>
</div>
    </div>
   </div>
<?php
	}
?>

</body>
</html>		