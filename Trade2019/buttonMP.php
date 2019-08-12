<?php require_once('Connections/conexion.php'); ?>


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
  </head>
  <body>
    <form action="/procesar-pago" method="POST">
  <script
   src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
   data-public-key= "TEST-0b65752f-e5bd-4e23-9c3b-8ed0eff1cbe7"
   data-preference-id="<?php echo $preference->id; ?>">
  </script>
</form>
  </body>
</html>




















<?php /*?>/*
		//////////////////////////
		//PAGO POR MERCADO PAGO//
		////////////////////////
		if ($_POST["intPago"]==5)	
		{
			//MERCADO PAGO
			ConfirmacionPago(5, 0);

			//Formato precio
			$precioformateado = str_replace(",", ".", $_SESSION["Total"]);
			// SDK de Mercado Pago
			require __DIR__ .  '/vendor/autoload.php';

			// Agrega credenciales
			MercadoPago\SDK::setAccessToken('APP_USR-4396944682270097-080119-dadd908aa178f4aa37ae6c1fed1573dc-144556725');

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
  </head>
  <body>
    <a href="<?php echo $preference->init_point; ?>">Pagar con Mercado Pago</a>
  </body>
</html>
			<?php 

*/