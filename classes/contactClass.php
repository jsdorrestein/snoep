<?php
	require_once("MySqlDatabaseClass.php");
    require_once("./config/config.php");

	class ContactClass
	{
	
		//Fields
		private $email;
		private $bericht;
		//Properties
		//getters
		public function getEmail() { return $this->email; }
		public function getBericht() { return $this->bericht; }
		//setters
		public function setEmail($value) { $this->email = $value; }
		public function setBericht() { $this->bericht = $value; }
		
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
			$object = new ContactClass();
				
				// Stop de gevonden recordwaarden uit de database in de fields van een OptredenClass-object
				$object->email 				= $row['email'];
				$object->bericht     		= $row['bericht'];
				$object_array[] = $object;
			}
			return $object_array;
		}
		
		public static function insert_into_database($post)
		{
			global $database;
		    $query = "INSERT INTO `contact` (
										   `email`,
										   `bericht`)
					  VALUES			  (
										   '".$post['email']."',
										   '".$post['bericht']."')";
			
			$database->fire_query($query);
			$last_id = mysqli_insert_id($database->getDb_connection());
			echo "Uw gegevens zijn verwerkt.";
			
		}
        
		public static function check_if_klacht_exists($id)
		{
           
		}
		}
?>