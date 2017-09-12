<?php
	require_once("MySqlDatabaseClass.php");
	require_once("MailingClass.php");
    require_once("./config/config.php");
	class LoginClass
	{
	
		//Fields
		private $emailadres;
		private $wachtwoord;
		private $rol;
		private $geactiveerd;
        private $naam;
        private $achternaam;
        private $adres;
        private $postcode;
        private $woonplaats;
		//Properties
		public function getEmailadres() { return $this->emailadres;}
		public function getWachtwoord() { return $this->wachtwoord; }
		public function getRol() { return $this->rol; }
		public function getGeactiveerd() { return $this->geactiveerd;}
        public function getNaam() { return $this->naam; }
        public function getAchternaam() { return $this->achternaam; }
        public function getAdres() { return $this->adres; }
        public function getPostcode() { return $this->postcode; }
        public function getWoonplaats() { return $this->woonplaats; }
		
		public function setEmailadres($value) { $this->emailadres = $value;}
		public function setWachtwoord($value) { $this->wachtwoord = value; }
		public function setRol($value) { $this->rol = $value; }
		public function setGeactiveerd($value) { $this->geactiveerd = $value;}
        public function setNaam($value) { $this->setNaam = value; }
        public function setAchternaam($value) { $this->setAchternaam = value; }
        public function setAdres($value) { $this->setAdres = value; }
        public function setPostcode($value) { $this->setPostcode = value; }
        public function setWoonplaats($value) { $this->setWoonplaats = value; }
		//Constructor
		public function __construct() {}
		//Methods
		/* Hier komen de methods die de informatie in/uit de database stoppen/halen
		*/
		public static function find_by_sql($query)
		{
			// Maak het $database-object vindbaar binnen deze method
			global $database;
			// Vuur de query af op de database
			$result = $database->fire_query($query);
			// Maak een array aan waarin je LoginClass-objecten instopt
			$object_array = array();
			// Doorloop alle gevonden records uit de database
			while ( $row  = mysqli_fetch_array($result))
			{
				// Een object aan van de LoginClass (De class waarin we ons bevinden)
				$object = new LoginClass();
				// Stop de gevonden recordwaarden uit de database in de fields van een LoginClass-object
				$object->emailadres			= $row['emailadres'];
				$object->wachtwoord		= $row['wachtwoord'];
				$object->rol		= $row['rol'];
				$object->geactiveerd		= $row['geactiveerd'];
                $object->voornaam = $row['voornaam'];
                $object->achternaam = $row['achternaam'];
                $object->adres = $row['adres'];
                $object->postcode = $row['postcode'];
                $object->woonplaats = $row['woonplaats'];
                $object->emailadres = $row['emailadres'];
				$object_array[] = $object;
			}
			return $object_array;
		}
        
        //Hier zoekt het systeem het juiste emailadres bij het ingevoerde wachtwoord
		public static function find_login_by_email_password($emailadres, $wachtwoord)
		{
			$query = "SELECT *
					  FROM `gebruiker`
					  WHERE `emailadres` 	= '".$emailadres."'
					  AND	`wachtwoord`	= '".$wachtwoord."'";
			$loginClassObjectArray = self::find_by_sql($query);
			$loginClassObject = array_shift($loginClassObjectArray);
			return $loginClassObject;
		}
        
        //Zodra de klant zich heeft geregistreerd zorgt deze functie ervoor dat alle ingevulde info in de database gezet wordt
		public static function insert_into_database($post)
		{
			global $database;
			date_default_timezone_set("Europe/Amsterdam");
			$datum = date('Y-m-d H:i:s');
			$wachtwoord = ($post['emailadres'].date('Y-m-d H:i:s'));
			$query = "INSERT INTO `gebruiker`  (                                    `voornaam`,
										   `emailadres`,
										   `wachtwoord`,
										   `rol`,
										   `geactiveerd`,
                                           `adres`,
                                           `postcode`,
                                           `woonplaats`,
                                           `achternaam`)
					  VALUES			  (                '".$post['naam']."',
				'".$post['emailadres']."',
                                           '".$wachtwoord."',
                                             'klant',
                                            0,
                                            '".$post['adres']."',
                                             '".$post['postcode']."',
                                              '".$post['woonplaats']."',
                                    
                                               '".$post['achternaam']."')";
			$database->fire_query($query);
			$last_id = mysqli_insert_id($database->getDb_connection());
			self::send_email($last_id, $post, $wachtwoord);
			echo "Uw gegevens zijn verwerkt.";
            echo $query;
           // header("refresh:3;url=index.html?content=index.html");
		}
        
        //Deze functie zoekt of het emailadres dat bij het registreren is ingevuld al in de database staat
		public static function check_if_email_exists($emailadres)
		{
			global $database;
			$query = "SELECT `emailadres`
					  FROM	 `gebruiker`
					  WHERE	 `emailadres` = '".$emailadres."'";
			$result = $database->fire_query($query);
			//ternary operator
			return (mysqli_num_rows($result) > 0) ? true : false;
		}
        
        //Deze functie zorgt ervoor dat je alleen kan inloggen met een geldige combi van het juiste emailadres en het juiste wachtwoord
		public static function check_if_email_password_exists($emailadres, $wachtwoord, $geactiveerd)
		{	
			global $database;
			$query = "SELECT `emailadres`, `wachtwoord`, `geactiveerd`
					  FROM	 `gebruiker`
					  WHERE	 `emailadres` = '".$emailadres."'
					  AND	 `wachtwoord` = '".$wachtwoord."'";
			$result = $database->fire_query($query);
			$record = mysqli_fetch_array($result);
			return (mysqli_num_rows($result) > 0 && $record['geactiveerd'] == $geactiveerd) ? true : false;
		}
        
        //Deze functie kijkt of het account bij het inloggen al geregistreerd is, dit betekent dat de klant al een eigen wachtwoord heeft bedacht
		public static function check_if_activated($emailadres, $wachtwoord)
		{	
			var_dump($emailadres);
			var_dump($wachtwoord);
			global $database;
			$query = "SELECT `geactiveerd`
					  FROM	 `gebruiker`
					  WHERE	 `emailadres` = '".$emailadres."'
					  AND	 `wachtwoord` = '".$wachtwoord."'";
			$result = $database->fire_query($query);
			$record = mysqli_fetch_array($result);
			return ( $record['geactiveerd']);
		}
        
        //Deze functie stuurt een mail nadat de klant zich heeft geregistreerd
		private static function send_email($emailadres, $post, $wachtwoord)
		{
			$to = $post['emailadres'];
			$subject = "Activatiemail The Sweet Tooth.";
			$message = "Geachte heer/mevrouw <b>".$post['naam']."</b><br>";
			$message .= '<style>a { color:red;}</style>';
			$message .= "Hartelijk dank voor het registreren bij The Sweet Tooth."."<br>";
			$message .= "klik <a href='http://localhost/web/activate.php?content=activate&email="."&emailadres=".$post['emailadres']."&wachtwoord=".$wachtwoord."'>hier</a> om uw account te activeren"."<br>";
			$message .= "U kunt dan vervolgens een nieuw wachtwoord instellen."."<br>";
			$message .= "Met vriendelijke groet,"."<br>";
			$message .= "Jelle Dorrestein"."<br>";
			$headers = 'From: no-reply@project.nl'."\r\n";
			$headers .= 'Reply-To: info@project.nl'."\r\n";
			$headers .= 'Cc: admin@project.nl'."\r\n";
			$headers .= 'Bcc: accountant@project.nl'."\r\n";
			//$headers .= "MIME-version: 1.0"."\r\n";
			//$headers .= "Content-type: text/plain; charset=iso-8859-1"."\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1"."\r\n";
			$headers .= 'X-Mailer: PHP/' . phpversion();
			mail( $to, $subject, $message, $headers);
		}
        
        //Als de gebruiker zijn account eenmaal heeft geactiveerd zorgt deze functie ervoor dat er in de database wordt gezet dat het account geactiveerd is
		public static function activate_account_by_email($emailadres)
		{	var_dump($emailadres);
		 
		 	global $database;
			$query = "UPDATE `gebruiker`
					  SET `geactiveerd` = '1'
					  WHERE `emailadres` = '".$emailadres."'";
			$database->fire_query($query);
		}
        
        //Deze functie zorgt ervoor dat de klant in het mailtje dat de site stuurt na het registreren zijn wachtwoord kan veranderen
		public static function update_password($emailadres, $wachtwoord)
		{
			global $database;
			$query = "UPDATE `gebruiker`
					  SET	 `wachtwoord` =	'".$wachtwoord."'
					  WHERE	 `emailadres`		=	'".$emailadres."'";
			$database->fire_query($query);
			echo "Uw wachtwoord is succesvol gewijzigd.";
			header("refresh:4;url=index.php?content=login.");
		}
        
        //Deze functie checkt als de gebruiker zijn wachtwoord wil veranderen of het oude wachtwoord overeenkomt
		public static function check_old_password($oude_wachtwoord)
		{
			$query = "SELECT *
					  FROM	 `gebruiker`
					  WHERE	 `naam`	=	'".$_SESSION['naam']."'";
			$arrayLoginClassObjecten = self::find_by_sql($query);
			$loginClassObject = array_shift($arrayLoginClassObjecten);
			//var_dump($loginClassObject);
			//echo $loginClassObject->getPassword()."<br>";
			//echo ($old_password);
			if (!strcmp(($oude_wachtwoord),$loginClassObject->getWachtwoord()))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
?>