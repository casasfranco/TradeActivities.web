<?php require_once('Connections/conexion.php'); ?>
     
<?php 
//Pagina de pago de Mercado Pago Funcionando


	//Conseguimos la FECHA DE HOY
	@$fecha = date("Y-m-d H:i:s",time());
	$date = new DateTime($fecha, new DateTimeZone('America/Argentina/Buenos_Aires'));
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$zonahoraria = date_default_timezone_get();
		//LE DAMOS EL FORMATO DESEADO (HORAS)
	@$fecha=date("H:i:s",time());

?>



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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<?php include("includes/header.php"); ?>
<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <?php include("includes/menuizquierda.php"); ?>
      </div>
      <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
			<h2 class="title text-center">Pagar con Mercado Pago</h2>
						
 <?php 
		//AQUI ES DONDE SE SACAN LOS DATOS, SE COMPRUEBA QUE HAY RESULTADOS
			
					//Formato precio
					$precioformateado = str_replace(",", ".", $_SESSION["Total"]);

					// SDK de Mercado Pago
					require __DIR__ .  '/vendor/autoload.php';

					// Agrega credenciales
					MercadoPago\SDK::setAccessToken('APP_USR-4772772836697835-080722-9d403a7fb17ab85ef66758b3865f4798-459190464');


//// Crea un objeto de preferencia
//	 $payer = new MercadoPago\Payer();
//
// // Crea un ítem en la preferencia
//	 $payer->name = $_POST["strNombre"];
//	 $payer->surname = $_POST["strNombre"];
//	 $payer->email = $_POST["strEmail"];
//	 $payer->date_created = $fecha;
//	 $payer->phone = array(
//	 "area_code" => "+54 ",
//	 "number" => $_POST["strTelefono"]
//	  );
			
//	  $payer->identification = array(
//		"type" => "DNI",
//		"number" => $_POST["strDNI"]
//		 );
//		 $payer->address = array(
//		"street_name" => $_POST["strDireccion"],
//		"street_number" => "",
//		"zip_code" => $_POST["strCP"]
//		 );
//

			
			
			$mp = new \MP ($key->mp_client_id, $key->mp_client_secret);

			$preference_data = [
				"items" => [
					[
						"title" => $plan->product->name,
						"description" => $plan->title,
						"quantity" => 1,
						"picture_url" => $plan->product->image,
						"currency_id" => "ARS",
						"unit_price" => (int)$precioformateado
					],
				],
				"operation_type" => "regular_payment",
				"notification_url" => 'http://api.tuweb.com/payments/ipn',
				"external_reference" => "[" . $client->id . "," . $quota . "]",
				"client_id" => $key->mp_client_id
			];
			
			
//			
					// Crea un objeto de preferencia
					$preference = new MercadoPago\Preference();

					// Crea un ítem en la preferencia
					$item = new MercadoPago\Item();
					$item->title = 'Casas SRL';
					$item->quantity = 1;
					$item->unit_price = $precioformateado;
					$preference->items = array($item);
					$preference->payer = array($payer);
					$preference->back_urls = array(
					"success" => "",
					"failure" => "http://www.tu-sitio/failure",
					"pending" => "http://www.tu-sitio/pending"
					);
					$preference->auto_return = "approved";
					$preference->save();

		?>
			
			
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
			
						
					</div>	<br>

	
		  
		  <?php
			if (isset($_SESSION['tradeactivitiesFront_UserId']))
			include("includes/recomendados.php"); ?>
      </div>
    </div>
  </div>
</section>
<?php include("includes/pie.php"); ?>
<?php include("includes/piejs.php"); ?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>