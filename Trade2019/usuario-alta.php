<?php require_once('Connections/conexion.php'); ?>
<?php



	if (comprobaremailnoexiste($_POST["strEmail"]))
	{


  $insertSQL = sprintf("INSERT INTO tblusuario(strEmail, strPassword, strNombre, intNivel, intEstado) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST["strEmail"], "text"),
                       GetSQLValueString(md5($_POST["strPassword"]), "text"),
                       GetSQLValueString($_POST["strNombre"], "text"),
                       0,
                       1);

  
  $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));

		
	}
	else
	{
		//EL EMAIL NO ES ÚNICO
		 $insertGoTo = "error.php?error=6";
  		 header(sprintf("Location: %s", $insertGoTo));
	}

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
<?php include("includes/header.php"); ?>
<?php //include("includes/slider.php"); ?>
<section>
  <div class="container">
    <div class="row">
	<div class="col-sm-3">
      <?php include("includes/menuizquierda.php"); ?>
	</div>
      <div class="col-sm-9 padding-right">
		  
		  
	 
		  <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Inicio</a></li>
					<?php echo'<li>Mi Comparador</li>';
					?>
					
				</ol>
			</div>

		  
        <div class="features_items"><!--features_items-->
						<h2 class="title text-center">Muchas Gracias</h2>
							<dl>
                                <dt>Tu registro fue exitoso.</dt>
                                <dd>Accede con tus datos para una mejor experiencia en nuestra tienda.&nbsp; <strong>Trade Activities</strong></dd>
                                
                            </dl>
			 
			
		</div>
	  
		  
        <?php //include("includes/categoriasespeciales.php"); ?>
        <?php //include("includes/recomendados.php"); ?>
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