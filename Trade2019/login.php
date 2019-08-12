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
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Acceder a tu cuenta</h2>
						<form action="acceso.php" method="post">
							<input name="strEmail"  type="email" id="strEmail" placeholder="email" />
							<input name="strPassword" id="strPassword" type="password" placeholder="Contraseña" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Mantenerme logueado en la página
							</span>
							<button type="submit" class="btn btn-default">Acceder</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Ó</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Registrar nuevo usuario</h2>
						Estar registrado es necesario para agregar porductos a "Tus favoritos" y para utilizar el comparador de productos.
						<form action="usuario-alta.php" method="post">
							<input name="strNombre" type="text" id="strNombre" placeholder="Nombre" required/>
							<input name="strEmail" type="email" id="strEmail" placeholder="Email" required/>
							<input name="strPassword" type="password" id="strPassword" placeholder="Contraseña" required/>
							<button type="submit" class="btn btn-default">Registrarse</button><br>
<br>

						</form>
					</div><!--/sign up form-->
				</div>
			</div>
  </div>
</section>
<?php include("includes/pie.php"); ?>
<?php include("includes/piejs.php"); ?>
<script type="text/javascript" src="js/jquery.mlens-1.6.min.js"></script>

<script type="text/javascript">
$(document).ready(function()
{
    $("#placeholder").mlens(
    {
        imgSrc: $("#placeholder").attr("data-big"),   // path of the hi-res version of the image
        lensShape: "circle",                // shape of the lens (circle/square)
        lensSize: 180,                  // size of the lens (in px)
        borderSize: 4,                  // size of the lens border (in px)
        borderColor: "#fff",                // color of the lens border (#hex)
        borderRadius: 0,                // border radius (optional, only if the shape is square)
		responsive: true      
    });
});

</script>
<script type="text/javascript" language="javascript">
function showPic (whichpic) {
 if (document.getElementById) {
  document.getElementById('placeholder').src = whichpic.href;
	 document.getElementById('placeholder').setAttribute("data-big", whichpic.href);
	 
	  $("#placeholder").mlens(
    {
        imgSrc: $("#placeholder").attr("data-big"),   // path of the hi-res version of the image
        lensShape: "circle",                // shape of the lens (circle/square)
        lensSize: 180,                  // size of the lens (in px)
        borderSize: 4,                  // size of the lens border (in px)
        borderColor: "#fff",                // color of the lens border (#hex)
        borderRadius: 0,                // border radius (optional, only if the shape is square)
		responsive: true      
    });
	 
	 
	 //$("#placeholder").attr("data-big") = whichpic.href;
  return false;
 } else {
  return true;
 }
}
</script>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
//AÑADIR AL FINAL DE LA PÁGINA
mysqli_free_result($DatosConsulta);
?>