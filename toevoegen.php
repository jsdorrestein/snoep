  <div class="account-in">
   	  <div class="container">
   	     <?php
	if (isset($_POST['submit']))
	{
		require_once("/classes/productClass.php");
		if (productClass::check_if_product_exists($_POST['name']))
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
			productClass::insert_product_database($_POST);
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
	<h3>Toevoegen</h3>
		<form  method='post'>
            <div class="form-group">
			Naam: <input type='text' name='name' required="required" class="form-control"/><br>
            </div>
            <div class="form-group">
            Omschrijving: <input type='text' name='description' required="required" class="form-control"/><br>
                </div>
                <div class="form-group">
            Prijs: <input type='text' name='price'  required="required" class="form-control"/><br>
                    </div>
                    <div class="form-group">
            Gemaakt op: <input type='date' name='created' required="required" class="form-control"/><br>
                        </div>
                        <div class="form-group">
            Verandert op: <input type='date' name='modified'  required="required" class="form-control"/><br>
                            </div>
            <div class="form-group">
			Foto (pad van de foto): <input type='text' name='image' required="required" class="form-control"/><br>
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

