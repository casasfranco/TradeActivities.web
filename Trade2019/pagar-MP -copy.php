<?php require_once('Connections/conexion.php'); ?>

<!DOCTYPE html>
<html lang="es"><!-- InstanceBegin template="/Templates/Principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<!-- InstanceBeginEditable name="doctitle" -->
    <title>Casas SRL</title>
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="css/extrafrontal.css" rel="stylesheet">
<!-- InstanceEndEditable -->
    <?php include("includes/cabecera.php"); ?>
<!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head><!--/head-->

<body>
<!-- InstanceBeginEditable name="Contenido" -->
<?php include("includes/header.php"); ?>

<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <?php include("includes/menuizquierda.php"); ?>
      </div>
      <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
			
			<?php
						//Formato precio
					$precioformateado = str_replace(",", ".", $_SESSION["Total"]);

					// SDK de Mercado Pago
					require __DIR__ .  '/vendor/autoload.php';

					// Agrega credenciales
					MercadoPago\SDK::setAccessToken('APP_USR-4772772836697835-080722-9d403a7fb17ab85ef66758b3865f4798-459190464');

					// Crea un objeto de preferencia
					$preference = new MercadoPago\Preference();

					// Crea un ítem en la preferencia
					$item = new MercadoPago\Item();
					$item->title = 'Casas SRL';
					$item->quantity = 1;
					$item->unit_price = $precioformateado;
					$preference->items = array($item);
					$preference->save();


					?>
					<!doctype html>
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
    <title>Casas SRL</title>
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="css/extrafrontal.css" rel="stylesheet">
<!-- InstanceEndEditable -->
	<meta name="description" content="">
    <meta name="author" content="">
	<?php include("includes/cabecera.php"); ?>
<!-- InstanceBeginEditable name="head" -->
    
<?php include("includes/header.php"); ?>

<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <?php include("includes/menuizquierda.php"); ?>
      </div>
      <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
			
			<?php
						//Formato precio
					$precioformateado = str_replace(",", ".", $_SESSION["Total"]);

					// SDK de Mercado Pago
					require __DIR__ .  '/vendor/autoload.php';

					// Agrega credenciales
					MercadoPago\SDK::setAccessToken('APP_USR-4772772836697835-080722-9d403a7fb17ab85ef66758b3865f4798-459190464');

					// Crea un objeto de preferencia
					$preference = new MercadoPago\Preference();

					// Crea un ítem en la preferencia
					$item = new MercadoPago\Item();
					$item->title = 'Casas SRL';
					$item->quantity = 1;
					$item->unit_price = $precioformateado;
					$preference->items = array($item);
					$preference->save();


					?>
					<!doctype html>
					<html>
					  	<head>
							<title>Pagar</title>
					  		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
						</head>
					  <body > 
						  <div class='alert alert-info'>
						  	<center> <br><br><br>
						<img src="https://imgmp.mlstatic.com/org-img/banners/ar/medios/online/575X40.jpg" title="MercadoPago - Medios de pago" alt="MercadoPago - Medios de pago" width="575" height="40"/><br><br><br>
						<img class="heartBeat" src="https://www.samic.com.uy/wp-content/uploads/2017/07/version-horizontal-large.png" width="300" height="85"/>
							  <br><br><br>	
						<form  action="/procesar-pago" method="POST"><br><br><br>
					  <script 
					   src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
					   data-public-key= "TEST-0b65752f-e5bd-4e23-9c3b-8ed0eff1cbe7"
					   data-preference-id="<?php echo $preference->id; ?>">
					  </script><br><br></center>
					</form>
						  </div>
					  </body>
					</html>
					
					</div><br><br><br><br><br><br>
        <?php include("includes/recomendados.php"); ?>
      </div>
    </div>
  </div>
</section>
<?php include("includes/pie.php"); ?>
<?php include("includes/piejs.php"); ?>
<!-- InstanceEndEditable -->
</head><!--/head-->

<body>
<!-- InstanceBeginEditable name="contenido" -->
<?php include("includes/header.php"); ?>
<?php include("includes/slider.php"); ?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <?php include("includes/slider.php"); ?>
      </div>
      <div class="col-sm-9 padding-right">
        <?php include("includes/slider.php"); ?>
        <?php include("includes/categoriasespeciales.php"); ?>
        <?php include("includes/recomendados.php"); ?>
      </div>
    </div>
  </div>
</section>
<?php include("includes/pie.php"); ?>
<?php include("includes/piejs.php"); ?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
//AÑADIR AL FINAL DE LA PÁGINA
mysqli_free_result($DatosConsulta);
?>

