<?php
	if (isset($_POST['submit']))
	{
		require_once("./classes/KlachtClass.php");
		if (KlachtClass::check_if_klacht_exists($_POST['id']))
		{
			//Zo ja, geef een melding dat het emailadres bestaat en stuur
			//door naar register_form.php
			echo "Er is iets fout gegaan.<br>
				  Graag een nieuwe invoeren. U wordt doorgestuurd naar<br>
				  het invoeren";
			header("refresh:2;url=index.php?content=klachten");
		}
		else
		{
			KlachtClass::insert_into_database($_POST);
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
	   <form class="form-horizontal" method="post">
            <div class="form-group">
                 <div class="form-group">
                     <label class="control-label" for="exampleInputPassword1">Naam</label>
                     <input class="form-control" name="naam" placeholder="Naam" type="text">
                </div>
                <div class="form-group">
                    <label class="control-label" for="exampleInputPassword1">Email</label>
                    <input class="form-control" name="email" placeholder="Email" type="text">	
                </div>
                <div class="form-group">
                    <label class="control-label" for="exampleInputPassword1">Klacht</label>
                    <textarea class="form-control" name="klacht" placeholder="Voer hier uw klacht in" rows="6"></textarea>
                </div>
                     
                    
                       <input type='submit' name='submit' />
                     </div>
                  </form>
                
               </header>
               
</div>

<?php
	}
?>
