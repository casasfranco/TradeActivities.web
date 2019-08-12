<?php require_once('Connections/conexion.php'); ?>
              
<!DOCTYPE html>
<html lang="es"><!-- InstanceBegin template="/Templates/Principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	
	
	<?php /* GOOGLE ADSENSE */?>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-3816716924498134",
    enable_page_level_ads: true
  });
</script>
	
	
	
<!-- InstanceBeginEditable name="doctitle" -->
    <title>Trade Activities</title>
    <!-- InstanceEndEditable -->
	<meta name="description" content="">
    <meta name="author" content="">
	<?php include("includes/cabecera.php"); ?>
<!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head><!--/head-->

<body>
<!-- InstanceBeginEditable name="contenido" -->

<?php include("includes/header.php"); ?>
<?php //include("includes/slider.php"); ?>
<section>
  <div class="container">
  	
  	<div class="row">
				<div class="col-sm-12 col-sm-offset-1">
				  <div class="login-form"><!--login form-->
						<h2>Muchas Gracias</h2>
						
					  <?php if ($_GET["tipo"]==3){	//Transferencia bancaria ?>
					  			<div class="col-sm-9 col-sm-offset-1" style="background-image: url('images/fondo-DELIVERY-gracias(2).png'); width: 100%; height: 100vh; background-repeat: no-repeat;"></div><br>

 								<!--<img src="images/logo-grande.png" width="180" height="180" alt=""/>-->
<?php }?>
					   <?php if ($_GET["tipo"]==5){	//Mercado Pago ?>
								 <div class="col-sm-9 col-sm-offset-1" style="background-image: url('images/fondo-DELIVERY-gracias(900x900).png'); width: 100%; height: 100vh; background-repeat: no-repeat;"></div><br>
<?php }?>
						
					</div><!--/login form-->
				</div>
	</div>
  </div>
</section>
<?php include("includes/pie.php"); ?>
<?php include("includes/piejs.php"); ?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>