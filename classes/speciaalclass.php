<?php
require_once('MySqlDatabaseClass.php');
class speciaalclass
{
    //Fields
    private $id;
    private $name;
    private $description;
    private $category;
    private $price;
    private $picture;
    private $amount;
    private $dagproduct;
    
    //Properties
    //getters
    public function getId()   {   return $this->id;    }
    public function getName()   {   return $this->name;    }
    public function getDescription()  {  return $this->description;   }
    public function getCategory()    {   return $this->category;    }
    public function getPrice() {  return $this->price;  }
    public function getPicture()   {   return $this->picture;   }
    public function getAmount()    {  return $this->amount;  }
    public function getDagProduct()    {  return $this->dagproduct;  }

    //setters
    public function setId($value)    { $this->id = $value;   }
    public function setName($value)   {  $this->name = $value; }
    public function setDescription()   {   $this->description = $value; }
    public function setCategory()  { $this->category = $value; }
    public function setPrice()   {  $this->price = $value; }
    public function setPicture()  { $this->picture = $value; }
    public function setAmount()  { $this->amount = $value; }
    public function setDagProduct()  { $this->dagproduct = $value; }
    
    //Constuctor
    public function __construct() {}
    //Methods
    
    public static function find_by_sql($query)
    {
        // Maak het $database-object vindbaar binnen deze method
        global $database;
        // Vuur de query af op de database
        $result = $database->fire_query($query);
        // Maak een array aan waarin je ProductClass-objecten instopt
        $object_array = array();
        // Doorloop alle gevonden records uit de database
        while ($row = mysqli_fetch_array($result)) {
            // Een object aan van de ProductClass (De class waarin we ons bevinden)
            $object = new ProductClass();
            // Stop de gevonden recordwaarden uit de database in de fields van een ProductClass-object
            $object->id = $row['idProduct'];
            $object->naam = $row['naam'];
            $object->beschrijving = $row['beschrijving'];
            $object->prijs = $row['prijs'];
            $object->foto = $row['foto'];
            $object->beschikbaar = $row['beschikbaar'];
            $object->aantal = $row['aantalBeschikbaar'];
            $object->isAccessoire = $row['isAccessoire'];
            $object_array[] = $object;
        }
        return $object_array;
    }
    public static function find_info_by_id($idProduct)
    {
        $query = "SELECT 	*
					  FROM 		`producten`
					  WHERE		`idProduct`	=	" . $idProduct;
        $object_array = self::find_by_sql($query);
        $ProductclassObject = array_shift($object_array);
        return $ProductclassObject;
    }
    
public static function get_Product_Van_De_Dag($dagProduct)
    {
        global $database;

        $query = "SELECT * `price` * 0.5 as dagProduct 
                  FROM `products`
                  WHERE `dagProduct` = '1'";
        $result = $database->fire_query($query);
        // echo $query;

        return $result;
    }


public static function set_Product_Van_De_Dag($id)
    {
        global $database;

        $query = "UPDATE `products` SET `dagProduct` = 1 WHERE `id` = $id";
        // echo $query;
        $database->fire_query($query);
        self::remove_andere_producten_van_de_dag($idProduct);
    }
    
    public static function dagProductAanwezig()
    {

        global $database;

        $query = "SELECT * FROM `products` where `dagProduct` = 1 AND `id` =  ".$_SESSION['id']." ";
        // echo $query;
        $result = $database->fire_query($query);

        return $result;
    }
}
?>