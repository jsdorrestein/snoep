                        <?php
// initializ shopping cart class
include 'classes/cart.php';
$cart = new Cart;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>The Sweet Tooth</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    .container{padding: 50px;}
    input[type="number"]{width: 20%;}
    </style>
    <script>
    function updateCartItem(obj,id){
        $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }
    </script>
</head>
</head>
<body>
    <div class="container">
    <h1>Shopping Cart</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo '€'.$item["price"].''; ?></td>
            <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
            <td><?php echo '€'.$item["subtotal"].''; ?></td>
            <td>
                <a href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="5"><p>Your cart is empty.....</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
           
            <td colspan="2"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo '€'.$cart->total().''; ?></strong></td>
         
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    
</div>
<div class="container">
    <h1>Betaling</h1>


            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Totaal <?php echo '€ '.$cart->total(); ?> aan kosten</strong></td>

            <?php } ?>
    
<form action="" method="post">
<select name="payments" id="payments">
    <option value="Maestro">Maestro</option>
    <option value="Contant">Contant</option>
    <option value="Visa">Visa</option>
    <option value="Ideal">Ideal</option>
</select>
    <select name="deliveries" id="deliveries">
    <option value="ophalen">Zelf ophalen</option>
    <option value="verzenden">Verzenden</option>
</select>
<input type="submit" value="Betalen" href="index.php?content=algemeneHomepage"/>
<input type="hidden" name="button_a" value="1" />
</form>
    
    </div>

</div>
<?php

if(isset($_POST['button_a']))
{

$to      = ''; //can receive notification

$subject = 'Betaling';
$message = 'Beste Meneer/Mevrouw,'."\r\n";
$message .= 'Dankuwel voor het kiezen voor onze webshop'."\r\n";    
$message .= 'De totale kosten die u heeft betaald voor de artikelen zijn '.$cart->total().' euro'. "\r\n";
$message .= 'U heeft betaald met '.$_POST['payments']. "\r\n";
 $message .= 'U heeft aangegeven dat u de artikelen '.$_POST['deliveries']. "\r\n";
$message .= "Met vriendelijke groet,". "\r\n";
$message .= "Jelle Dorrestein". "\r\n";
$headers = 'From: no-reply@TheSweetTooth.nl'."\r\n";
$headers .= 'Reply-To: info@TheSweetTooth.nl'."\r\n";
$headers .= 'Cc: admin@TheSweetTooth.nl'."\r\n";
$headers .= 'Bcc: accountant@TheSweetTooth.nl'."\r\n";
//$headers = 'From: webmaster@orchids.com' . "\r\n" .
   // 'Reply-To: webmaster@orchids.com' . "\r\n" .
    //'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);


}

?>
    
     <div class="contact_form">
	 	<h2>Opmerkingen</h2>
	    <form>
			<div class="col-md-6 to">
             	<input type="text" class="text" value="Naam" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
			 	<input type="text" class="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}">
			 	<input type="text" class="text" value="Onderwerp" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Subject';}">
			</div>
			<div class="col-md-6 text">
               <textarea value="Bericht" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea>
            </div>
            <div class="clearfix"></div>
            
        </form>
     </div>
</div>
</body>
</html>