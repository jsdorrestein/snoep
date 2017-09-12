  <ul class="nav navbar-nav">

	<li><a href='index.php?content=algemeneHomepage'>Home</a></li>
<?php
	if (isset($_SESSION['rol']))
	{
		echo "<li><a href='index.php?content=logout'>Logout</a></li>";
		switch ($_SESSION['rol'])
		{  
            	case "eigenaar":
				echo "<li><a href='index.php?content=eigenaarHomepage'>
                       Gegevens
                      </a>
                      </li>
                      <li>
                      <a href='index.php?content=toevoegen'>
                       Video's toevoegen
                      </a>
                      </li>
                    ";
                break;
				case "root":
				echo "<li><a href='index.php?content=rootHomepage'>
                        Gegevens
                        </a>
                      </li>";
                 break;
                case "klant":
               		echo "<li><a href='index.php?content=klantHomepage'>
                        Gegevens
                        </a>
                      </li>
                      <li>
                         <a href='index.php?content=collectie'>
                        Collectie
                        </a>
                      </li>
                         <li>
                         <a href='index.php?content=klachten'>
                        Klachten
                        </a>
                      </li>";
			break;
            	case "baliemedewerker":
				echo "<li><a href='index.php?content=baliemedewerkerHomepage'>
                        Gegevens
                        </a>
                      </li>
                        <li>
                          <a href='index.php?content=verwijderen'>
                       Video's verwijderen
                      </a>
                      </li>";
            break;
            	case "koerier":
				echo "<li><a href='index.php?content=koerierHomepage'>
                        Gegevens
                        </a>
                      </li>
                         <li>
                          <a href='index.php?content=koerier'>
                       Koerier
                      </a>
                      </li>";  
		}
	}
	else
	{
	echo "
		
		<li><a href='index.php?content=register'>Registreren</a></li>
		<li><a href='index.php?content=login'>Login</a></li>
        <li><a href='index.php?content=contact'>Contact</a></li>";
	}
?>
          
          
          
          
</ul>