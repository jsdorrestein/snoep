<?php
// include database configuration file
include 'config/dbConfig.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Artikel</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{padding: 50px;}
    .cart-link{width: 100%;text-align: right;display: block;font-size: 22px;}
    </style>
</head>
</head>


  <body data-spy="scroll" data-offset="0" data-target="#navbar-main">
		<header class="clearfix">
		</header>
		<div class="container">
		
<?php
	require("/classes/productClass.php");
  $query = "SELECT products.id, products.name, products.description, products.price, products.created ,products.modified, products.status, products.image FROM products WHERE id= '".$_GET['id']."'";
    $product = productClass::find_by_sql($query);
  	
?>
                
                        <h1><?php echo $product[0]->getName(); ?></h1>
                        <p><?php echo $product[0]->getDescription(); ?></p>
                        <p><?php echo $product[0]->getImage(); ?></p>
                        <p><?php echo $product[0]->getPrice(); ?></p>
		</div>		
		
	

	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/retina.js"></script>
	<script type="text/javascript" src="assets/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="assets/js/smoothscroll.js"></script>
	<script type="text/javascript" src="assets/js/jquery-func.js"></script>
  </body>
</html>

	  	

    
