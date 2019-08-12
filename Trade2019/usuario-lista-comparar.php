<?php require_once('Connections/conexion.php'); ?>
<?php


$variable_Consulta = "0";
if (isset($VARIABLE)) {
  $variable_Consulta = $VARIABLE;
}
$resultadosporclick=3;



$query_DatosConsulta = sprintf("SELECT refProducto FROM tblcomparar WHERE refUsuario= %s",
		GetSQLValueString($_SESSION['tradeactivitiesFront_UserId'], "int"));
									
$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);


//FINAL DE LA PARTE SUPERIOR



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
				  <?php echo '<li >Mi Comparador</li>';
					?>
					
				</ol>
			</div>
			
      
       
       
        <div class="features_items"><!--features_items-->
						<h2 class="title text-center">Mi comparador</h2>
						
 <?php 
		//AQUI ES DONDE SE SACAN LOS DATOS, SE COMPRUEBA QUE HAY RESULTADOS
		if ($totalRows_DatosConsulta > 0) {  
			 do { 
              		?>
              		<div class="col-sm-4" id="deseomostrado<?php echo $row_DatosConsulta["refProducto"];?>">
							<?php 
						MostrarProducto($row_DatosConsulta["refProducto"], 2);
						?>
						</div>
              		
              		<?php
			  		 } while ($row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta)); 
			

		 } 
		else
		 { //MOSTRAR SI NO HAY RESULTADOS ?>
                No tienes productos para comparar.
                <?php } ?>
						
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