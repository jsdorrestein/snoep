<?php
	require_once('MySqlDatabaseClass.php');
	
	class UsersClass
	{
		//Fields
		private $emailadres;
		private $naam;
		private $achternaam;
		private $adres;
        private $postcode;
        private $woonplaats;
        private $geactiveerd;
        private $rekeningBevestigd;
        private $rol;
        
		//Properties
		//getters
		public function getEmailadres() { return $this->emailadres; }
		public function getNaam() { return $this->naam; }
		public function getAchternaam() { return $this->achternaam; }
        public function getAdres() { return $this->adres; }
        public function getPostcode() { return $this->postcode; }
        public function getWoonplaats() { return $this->woonplaats; }
        public function getGeactiveerd() { return $this->geactiveerd; }
        public function getRekeningBevestigd() { return $this->rekeningBevestigd; }
        public function getRol() { return $this->rol; }
        
		//setters
		public function setEmailadres($value) { $this->emailadres = $value; }
		public function setNaam($value) { $this->naam = $value; }
		public function setAchternaam() { $this->achternaam = $value; }
		public function setAdres() { $this->adres = $value; }
        public function setPostcode() { $this->postcode = $value; }
        public function setWoonplaats() { $this->woonplaats = $value; }
        public function setGeactiveerd() { $this->geactiveerd = $value; }
        public function setRekeningBevestigd() { $this->rekeningBevestigd = $value; }
        public function setRol() { $this->rol = $value; }
		
		//Constuctor
		public function __construct() {}
		
		//Methods
		public static function find_by_sql($query)
		{
			// Maak het $database-object vindbaar binnen deze method
			global $database;
			
			// Vuur de query af op de database
			$result = $database->fire_query($query);
			
			// Maak een array aan waarin je UsersClass-objecten instopt
			$object_array = array();
			
			// Doorloop alle gevonden records uit de database
			while ( $row  = mysqli_fetch_array($result))
			{
				// Een object aan van de UsersClass (De class waarin we ons bevinden)
				$object = new UsersClass();
				
				// Stop de gevonden recordwaarden uit de database in de fields van een UsersClass-object
				$object->emailadres				    = $row['emailadres'];
				$object->naam		            = $row['voornaam'];
				$object->achternaam		        = $row['achternaam'];
                $object->adres		            = $row['adres'];
                $object->postcode		        = $row['postcode'];
                $object->woonplaats		        = $row['woonplaats'];
                $object->geactiveerd		    = $row['geactiveerd'];
                $object->rekeningBevestigd		= $row['rekeningBevestigd'];
			    $object->rol         		    = $row['rol'];
                
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function find_info_by_email($emailadres)
		{
			$query = "SELECT 	*
					  FROM 		`gebruiker`
					  WHERE		`emailadres`	=	".$emailadres;
			$object_array = self::find_by_sql($query);
			$usersclassObject = array_shift($object_array);
			//var_dump($usersclassObject); exit();
			return $usersclassObject;			
		}
		
		public static function insert_into_database($emailadres, $post)
		{
			global $database;
			$query = "INSERT INTO `gebruiker` (`emailadres`,
										   `voornaam`,
										   `achternaam`,
                                           `adres`,
                                           `postcode`, 
                                           `woonplaats`, 
                                           `geactiveerd`,
                                           `rekeningBevestigd`,
                                           `rol`)
					  VALUES			  ('".$emailadres."',
										   '".$post['voornaam']."',
										   '".$post['achternaam']."',
                                           '".$post['adres']."',
                                           '".$post['postcode']."',
                                           '".$post['woonplaats']."',
                                           '".$post['geactiveerd']."',
                                           '".$post['rekeningBevestigd']."',
                                           '".$post['rol']."')";
			
			$database->fire_query($query);
		}
        
      
}
?>