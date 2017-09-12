<?php
// include database configuration file
include 'config/dbConfig.php';
?>
<!DOCTYPE html>
<html lang="en">

<body>
<div class="container">
    <h1>Products</h1>
    <a href="viewCart.php" class="cart-link" title="View Cart"><i class="glyphicon glyphicon-shopping-cart"></i></a>
    <div id="products" class="row list-group">
        <?php
        //get rows query
        $query = $db->query("SELECT * FROM products ORDER BY id DESC LIMIT 10");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
        ?>
        <div class="item col-lg-4">
            <div class="thumbnail">
                <div class="caption">
                    <h4 class="list-group-item-heading"><?php echo $row["name"]; ?></h4>
                    <p class="list-group-item-text"><?php echo $row["description"]; ?></p>
                    <br>
                   <!-- <p class="list-group-item-text"><?php echo $row["image"]; ?></p> -->
                    <img src="images/<?php echo $row['image']?>.jpg" class="productImage">
                     <br>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead"><?php echo '€'.$row["price"].''; ?></p>
                        
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-success" href="cartAction.php?action=favoriet&id=<?php echo $row["id"]; ?>">Favoriet</a>
                            <a class="btn btn-success" href="cartAction.php?action=addToCart&id=<?php echo $row["id"]; ?>">Add to cart</a>
                            <a class="btn btn-success" href="index.php?content=artikel&id=<?php echo $row["id"]; ?>">Artikelpagina</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } }else{ ?>
        <p>Product(s) not found.....</p>
        <?php } ?>
    </div>
</div>
</body>
</html>