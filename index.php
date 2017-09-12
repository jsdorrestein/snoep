<?php session_start(); 
include('common.php');
?>   
    
    <!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $lang['PAGE_TITLE']; ?></title>
    <meta charset="utf-8">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Custom Theme files -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <!--webfont-->
    <link href='//fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Dorsa' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- start menu -->
    <link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="js/megamenu.js"></script>
    <script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
    <script src="js/jquery.easydropdown.js"></script>

    
    <!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <style>
    .container{padding: 50px;}
    .cart-link{width: 100%;text-align: right;display: block;font-size: 22px;}
    </style>
</head>
    


  <body data-spy="scroll" data-offset="0" data-target="#navbar-main">
		<header class="clearfix">
			<?php echo $_SERVER['SERVER_ADDR'];
            include("header.php");?>
		</header>
		<div class="container">
			<?php include("redirect.php"); ?>
		</div>		

	

 <div class="footer">
   	 <div class="container">
   		<div class="cssmenu">
		   <ul>
			<li class="active"><a href="index.php?content=sitemap">Sitemap</a></li>
			<li><a href="index.php?content=algemenevoorwaarden">Algemene voorwaarden</a></li>
			<li><a href="index.php?content=verzenden">Verzenden</a></li>
			<li><a href="index.php?content=betalings">Betalen</a></li>
            <li><a href="index.php?content=retouneren">Retouneren</a></li>
			<li><a href="index.php?content=contact">Contact</a></li>
		  </ul>
		</div>
		<ul class="social">
			<li><a href=""> <i class="instagram"> </i> </a></li>
			<li><a href=""><i class="fb"> </i> </a></li>
			<li><a href=""><i class="tw"> </i> </a></li>
	    </ul>
	    <div class="clearfix"></div>
	    <div class="copy">
           <p> &copy; 2017 The Sweet Tooth. All Rights Reserved | Design by Jelle Dorrestein</p>
	    </div>
   	</div>
   </div>
</body>
</html>