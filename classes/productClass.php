<?php
require_once('/MySqlDatabaseClass.php');
require_once('./config/dbConfig.php');
require_once("/LoginClass.php");
// Maak je sql opdracht
class Productclass
{
    //Fields
    private $id;
    private $name;
    private $description;
    private $price;
    private $created;
    private $modified;
    private $status;
    private $image;
    private $dagProduct;
    //Properties
    //getters
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getCreated()
    {
        return $this->created;
    }
    public function getModified()
    {
        return $this->modified;
    }
    public function getStatus()
    {
        return $this->status;
    }
     public function getImage()
    {
        return $this->image;
    }
    public function getDagProduct()
    {
        return $this->dagProduct;
    }
    //setters
    public function setId($value)
    {
        $this->id = $value;
    }
    public function setName($value)
    {
        $this->name = $value;
    }
    public function setDescription()
    {
        $this->description = $value;
    }
    public function setPrice()
    {
        $this->price = $value;
    }
    public function setCreated()
    {
        $this->created = $value;
    }
    public function setModified()
    {
        $this->modified = $value;
    }
    public function setStatus()
    {
        $this->status = $value;
    }
    public function setImage()
    {
        $this->image = $value;
    }
    public function setDagProduct()
    {
        $this->dagProduct = $value;
    }
    
    //Constuctor
    public function __construct()
    {
    }
    
    //Methods
    public static function find_by_sql($query)
    {
        
        global $database;
        
        
        $result = $database->fire_query($query);
        
        
        $object_array = array();
        
        // Doorloop alle gevonden records uit de database
        while ($row = mysqli_fetch_array($result)) {
            // Een object aan van de OptredenClass (De class waarin we ons bevinden)
            $object = new productClass();
            
            // Stop de gevonden recordwaarden uit de database in de fields van een productClass-object
            $object->id                = $row['id'];
            $object->name              = $row['name'];
            $object->description      = $row['description'];
            $object->price             = $row['price'];
            $object->created            = $row['created'];
            $object->modified              = $row['modified'];
            $object->status = $row['status'];
            $object->image = $row['image'];
             $object->dagProduct = $row['dagProduct'];
            $object_array[]            = $object;
        }
        return $object_array;
    }
    
    //Deze fuctie zoekt in de database alle producten op ID, dit wordt onder andere gebruikt om ze te laten zien in de winkel
    public static function find_info_by_id($id)
    {
        $query            = "SELECT 	*
					  FROM 		`products`
					  WHERE		`id`	=	" . $id;
        $object_array     = self::find_by_sql($query);
        $productsclassObject = array_shift($object_array);
        return  $productsclassObject;
    }
    
    public static function check_if_product_exists($name)
    {
        global $database;
        $query  = "SELECT `name`
					  FROM	 `products`
					  WHERE	 `name` = '" . $name . "'";
        $result = $database->fire_query($query);
        //ternary operator
        return (mysqli_num_rows($result) > 0) ? true : false;
    }
    
    public static function delete_by_id($id)
    {
                
        $sql    = "DELETE FROM `products` WHERE `id` = '" . $id . "'";
        $link   = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASENAME);
        $result = mysqli_query($link, $sql);
                
        $yesOrNo = ($result) ? "" : "niet ";
				echo "Het verwijderen is " . $yesOrNo . "gelukt.<br>
					U wordt doorgestuurd naar de vorige pagina";
        header("refresh:1;url=index.php?content=verwijderen");
        
    }
    
    
    
    public static function insert_product_database($post)
    {
        global $database;
        $query = "INSERT INTO `products`  (                                    `name`,
										   `description`,
										   `price`,
										   `created`,
										   `modified`,
                                           `image`,
                                           `dagProduct`)
					  VALUES			  (                '".$post['name']."',
				'".$post['description']."',
                                           
                                            '".$post['price']."',
                                             '".$post['created']."',
                                              '".$post['modified']."',
                                              '".$post['dagProduct']."',
                                               '".$post['image']."')";
        
        $database->fire_query($query);
        echo "Uw gegevens zijn verwerkt.";
        echo var_dump($query);
        header("refresh:3;url=index.php?content=toevoegen");
    }

    //Dit mailtje wordt gestuurd als een klant een product heeft besteld
    public static function send_email($post)
		{
			$to = $post['emailadres'];
			$subject = "Aankoop bevestiging The Sweet Tooth.";
			$message = "Geachte heer/mevrouw <br>";
			$message .= "Hierbij heeft u uw aankoopbevestiging bij The sweet tooth"."<br>";
			$message .= "Met vriendelijke groet,"."<br>";
			$message .= "Jelle Dorrestein"."<br>";
			$headers = 'From: no-reply@project.nl'."\r\n";
			$headers .= 'Reply-To: info@project.nl'."\r\n";
			$headers .= 'Cc: admin@project.nl'."\r\n";
			$headers .= 'Bcc: accountant@project.nl'."\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1"."\r\n";
			$headers .= 'X-Mailer: PHP/' . phpversion();
			mail( $to, $subject, $message, $headers);
		}
        
            public static function check_if_email_exists($emailadres)
		{	
			var_dump($emailadres);
			global $database;
			$query = "SELECT `emailadres`,   FROM	 `gebruiker`
					  WHERE	 `emailadres` = '".$emailadres."'";
			$result = $database->fire_query($query);

			
		}
    
}
?>