                        <?php

	if (isset($_POST['payment']))
	{
		
		switch ($_POST['payment'])
		{  
            	 case "Maestro":
                 echo "U heeft betaald met Maestro";
                 break;
             case "Contant":
                 echo "U heeft betaald met Contant";
                 break;
             case "Visa":
                 echo "U heeft betaald met Visa";
                 break;
            case "Ideal":
                echo "U heeft betaald met Ideal";
                break;
        }
		

	}
?>