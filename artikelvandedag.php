
<?php
include 'classes/speciaalclass.php';
include 'config/dbConfig.php';
if (isset($_POST['update'])) {
                    echo "Het product is met deze korting beschikbaar tot 1 uur in de middag (Zolang de voorraad strekt).";

                    header("refresh:4;url=index.php?content=specialepagina");

                    require_once("./classes/SpeciaalClass.php");

                    speciaalclass::set_Product_Van_De_Dag($_POST);
                            
    
    
                    } 
                    else 
                    {
        $query = $db->query("SELECT * FROM products WHERE dagProduct = 1");      
        while ($query->fetch_assoc()) {
            echo "Het product is met deze korting beschikbaar tot 1 uur in de middag (Zolang de voorraad strekt).";
                   
                        
                
                
        //get rows query
        $query = $db->query("SELECT * FROM products ORDER BY id");
                        
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
        ?>
			<div class="portfolio logo" data-cat="logo">
							<div class="portfolio-wrapper">	
						   <img src="images/<?php echo $row['image']?>.jpg" class="productImage">
					<div class="label">
						<div class="label-text">
						   <h4 class="list-group-item-heading"><?php echo $row["name"]; ?></h4>
                    <p class="list-group-item-text"><?php echo $row["price"]; ?></p>  
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>				
		    <div class="row">
                        <div class="col-md-6">
                            <p class="lead"><?php echo 'Naam: '.$row["name"]; ?></p>
                             <p class="lead"><?php echo 'Beschrijving: '.$row["description"]; ?></p>
                            <p class="lead"><?php echo 'Oude Prijs: € '.$row["price"]; ?></p>
                        <?php
                         $query = $db->query("SELECT * , format(`price`,1) * `procentKortingDagProduct` as prijsDagProduct FROM `products` WHERE `dagProduct` = '1'");     
                         while($row = $query->fetch_assoc()){
                             
                ?>
                        <p class="lead"><?php echo 'Nieuwe prijs: € '.$row["prijsDagProduct"]; ?></p>
                        </div>
                        <div class="col-md-6">
                            <a class="button" href="cartAction.php?action=addToCartDiscount&id=<?php echo $row["id"]; ?>" >In winkelwagen</a>
                            
                        </div>
                    </div>
             
                  <?php }} }else{ ?>
        <p>Geen producten gevonden....</p>
        <?php }
        }
     ?>
                <?php } ?>
          