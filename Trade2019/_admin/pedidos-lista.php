<?php require_once('../Connections/conexion.php'); 
RestringirAcceso("1,100");?>
<?php

$variable_Consulta = "0";
if (isset($VARIABLE)) {
  $variable_Consulta = $VARIABLE;
}

/**************************************************************/
/*ORDEN PARAMETROS*/
/*ESTO CAMBIARÁ SEGÚN A QUÉ TABLA*/
if (isset($_GET["valor"]))
{
	switch ($_GET["valor"]) {
    case 1:
        $parametro_orden= "idCompra";
        break;
    case 2:
        $parametro_orden= "strNombre";
        break;
    case 3:
        $parametro_orden= "fchCompra";
        break;
    case 4:
        $parametro_orden= "intZona";
        break;

	}
}
else
	$parametro_orden= "fchCompra"; //POR DEFECTO

if (isset($_GET["orden"]))
{
	switch ($_GET["orden"]) {
    case 1:
        $parametro_ordena_sentido= "ASC";
        break;
    case 2:
        $parametro_ordena_sentido= "DESC";
        break;
	}
}
else
	$parametro_ordena_sentido= "ASC"; //POR DEFECTO

$cadenaOrden=" ORDER BY ".$parametro_orden." ".$parametro_ordena_sentido;

/*ORDEN PARAMETROS*/
/**************************************************************/

/**************************************************************/
/**********************************         PAGINACION         /
/**************************************************************/

			
            $currentPage = $_SERVER["PHP_SELF"];
            
            $maxRows_DatosConsulta = 50; // Numero de registros por pagina
            $pageNum_DatosConsulta = 0;  // Seleccion de página actual
            $interval_page = 4; // desde la pagina actual - este valor hasta la pagina actual + este valor
            
            if (isset($_GET['pageNum_DatosConsulta'])) {
              $pageNum_DatosConsulta = $_GET['pageNum_DatosConsulta'];
            }
            $startRow_DatosConsulta = $pageNum_DatosConsulta * $maxRows_DatosConsulta;
/*************************************************************/
/*************************************************************/
/*************************************************************/

	$query_DatosConsulta = sprintf("SELECT * FROM tblcompra  WHERE (intEstado!=0 AND intEstado!=-1 AND intEstado!=-2 AND intEstado!=99)	".$cadenaOrden);
	

$query_limit_DatosConsulta = sprintf("%s LIMIT %d, %d", $query_DatosConsulta, $startRow_DatosConsulta, $maxRows_DatosConsulta);
$DatosConsulta = mysqli_query($con,  $query_limit_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);









/**************************************************************/
/**********************************         PAGINACION         /
/**************************************************************/

			
            $currentPage = $_SERVER["PHP_SELF"];
            
            $maxRows_DatosConsulta2 = 50; // Numero de registros por pagina
            $pageNum_DatosConsulta2 = 0;  // Seleccion de página actual
            $interval_page = 4; // desde la pagina actual - este valor hasta la pagina actual + este valor
            
            if (isset($_GET['pageNum_DatosConsulta'])) {
              $pageNum_DatosConsulta2 = $_GET['pageNum_DatosConsulta2'];
            }
            $startRow_DatosConsulta2 = $pageNum_DatosConsulta2 * $maxRows_DatosConsulta2;
/*************************************************************/
/*************************************************************/
/*************************************************************/

	$query_DatosConsulta2 = sprintf("SELECT * FROM tblcompra  WHERE (intEstado=-1 AND intEstado!=-2 AND intEstado!=99)".$cadenaOrden);
	

$query_limit_DatosConsulta2 = sprintf("%s LIMIT %d, %d", $query_DatosConsulta2, $startRow_DatosConsulta2, $maxRows_DatosConsulta2);
$DatosConsulta2 = mysqli_query($con,  $query_limit_DatosConsulta2) or die(mysqli_error($con));
$row_DatosConsulta2 = mysqli_fetch_assoc($DatosConsulta2);
$totalRows_DatosConsulta2 = mysqli_num_rows($DatosConsulta2);



/**************************************************************/
/**********************************         PAGINACION         /
/**************************************************************/
            if (isset($_GET['totalRows_DatosConsulta'])) {
              $totalRows_DatosConsulta = $_GET['totalRows_DatosConsulta'];
            } else {
              $all_DatosConsulta = mysqli_query($con,  $query_DatosConsulta);
              $totalRows_DatosConsulta = mysqli_num_rows($all_DatosConsulta);
            }
            $totalPages_DatosConsulta = ceil($totalRows_DatosConsulta/$maxRows_DatosConsulta)-1;
            
            
            
            $queryString_DatosConsulta = "";
            if (!empty($_SERVER['QUERY_STRING'])) {
              $params = explode("&", $_SERVER['QUERY_STRING']);
              $newParams = array();
              foreach ($params as $param) {
                if (stristr($param, "pageNum_DatosConsulta") == false && 
                    stristr($param, "totalRows_DatosConsulta") == false) {
                  array_push($newParams, $param);
                }
              }
              if (count($newParams) != 0) {
                $queryString_DatosConsulta = "&" . htmlentities(implode("&", $newParams));
              }
            }
            $queryString_DatosConsulta = sprintf("&totalRows_DatosConsulta=%d%s", $totalRows_DatosConsulta, $queryString_DatosConsulta);
/*************************************************************/
/*************************************************************/
/*************************************************************/
//FINAL DE LA PARTE SUPERIOR

//FINAL DE LA PARTE SUPERIOR
?>
      
<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/Administracion.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>

	
		
	<?php /* GOOGLE ADSENSE */?>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-3816716924498134",
    enable_page_level_ads: true
  });
</script>
	
	
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Administracion Casas</title>
    <!-- InstanceEndEditable -->
    <!-- Bootstrap Core CSS -->
	<?php include("../includes/adm-cabecera.php"); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>

    <!-- InstanceBeginEditable name="ContenidoAdmin" -->

        <!-- Navigation -->
        <div id="wrapper">
  <!-- Navigation -->
  <?php include("../includes/adm-menu.php"); ?>
  <div id="page-wrapper" >
     <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gestión de Pedidos</h1>
                </div>
                <!-- /.col-lg-12 -->
		 Por favor, para poder administrar los pedidos hacer click sobre "el ojo" (donde dice ver) que se encuentra en el recuadro correspondiente, en la columna "acciones"
     </div>

           
           

            <br>
<div class="row">
	<center><button type="button" class="btn btn-success" style='width:600px; height:55px'>Pedidos para preparar y cobrar al entregar</button></center>
<br>
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Resultado
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                               <?php if ($totalRows_DatosConsulta > 0) {  ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id <?php
	$consultaextendidaparaordenacion="";
													//BLOQUE ORDENACIÓN
													//SI HAY PARÁMETROS, HAY QUE SABER SI SON DE ORDEN
													$parametroparaprocesar="1";
													if (!isset($_GET["orden"])) {
														$orden=0;
														$valor=0;
													}
													else {
														$orden=$_GET["orden"];
														$valor=$_GET["valor"];
													}
													MostrarOrdenCampo($parametroparaprocesar, $orden, $valor,$currentPage, $consultaextendidaparaordenacion);
												?></th>
                                            
                                            <th>Nombre <?php
													//BLOQUE ORDENACIÓN
													//SI HAY PARÁMETROS, HAY QUE SABER SI SON DE ORDEN
													$parametroparaprocesar="2";
													if (!isset($_GET["orden"])) {
														$orden=0;
														$valor=0;
													}
													else {
														$orden=$_GET["orden"];
														$valor=$_GET["valor"];
													}
													MostrarOrdenCampo($parametroparaprocesar, $orden, $valor,$currentPage, $consultaextendidaparaordenacion);
												?></th>
                                            
                                            <th>Fecha <?php
													//BLOQUE ORDENACIÓN
													//SI HAY PARÁMETROS, HAY QUE SABER SI SON DE ORDEN
													$parametroparaprocesar="3";
													if (!isset($_GET["orden"])) {
														$orden=0;
														$valor=0;
													}
													else {
														$orden=$_GET["orden"];
														$valor=$_GET["valor"];
													}
													MostrarOrdenCampo($parametroparaprocesar, $orden, $valor,$currentPage, $consultaextendidaparaordenacion);
												?></th>
											<th>Zona <?php
													//BLOQUE ORDENACIÓN
													//SI HAY PARÁMETROS, HAY QUE SABER SI SON DE ORDEN
													$parametroparaprocesar="4";
													if (!isset($_GET["orden"])) {
														$orden=0;
														$valor=0;
													}
													else {
														$orden=$_GET["orden"];
														$valor=$_GET["valor"];
													}
													MostrarOrdenCampo($parametroparaprocesar, $orden, $valor,$currentPage, $consultaextendidaparaordenacion);
												?></th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
		//AQUI ES DONDE SE SACAN LOS DATOS, SE COMPRUEBA QUE HAY RESULTADOS
		
			 do { 
              		?>
              		
				<tr>
						<td><?php echo $row_DatosConsulta["idCompra"];?></td>
						
					<td><strong><?php echo $row_DatosConsulta["strNombre"];?></strong></td>
						
						<td><?php echo $row_DatosConsulta["fchCompra"];?></td>
						<td><?php echo ObtenerZonaPedidoCarrito($row_DatosConsulta["intZona"]);?></td>
						<td><a href="pedido-ver.php?id=<?php echo $row_DatosConsulta["idUsuario"];?>&idPedido=<?php echo $row_DatosConsulta["idCompra"];?>" class="fa fa-eye">&nbsp;Ver </a> </td>
					
				</tr>
              		
              		<?php
              		 } while ($row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta)); 
	?>
   
                                    </tbody>
                                </table>
                                <ul class="pagination">
		<?php if ($pageNum_DatosConsulta > 0) { // Show if not first page ?>
			<li><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, 0, $queryString_DatosConsulta); ?>" title="Primero">Primero</a></li>
		<?php } // Show if not first page ?>
		<?php if ($pageNum_DatosConsulta > 0) { // Show if not first page ?>
                	<li><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, max(0, $pageNum_DatosConsulta - 1), $queryString_DatosConsulta); ?>" title="Anterior">&laquo;</a></li> 								
		<?php } // Show if not first page 
                if ($pageNum_DatosConsulta-$interval_page<1){
		 $inicio = 0;
		 } else{
		 $inicio = $pageNum_DatosConsulta-$interval_page;
		 }
		 if ($pageNum_DatosConsulta+$interval_page>=$totalPages_DatosConsulta){
			$final = $totalPages_DatosConsulta;
			} else{
			 $final = $pageNum_DatosConsulta+$interval_page;
			}
			for ($pagina=$inicio; $pagina<=$final; ++$pagina){
				if ($pagina==$pageNum_DatosConsulta){
					$clase = "active";
				} 
				else 
				{
					$clase = "";
				}?>
				<li class="<?php echo $clase; ?>"><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, min($totalPages_DatosConsulta,$pagina), $queryString_DatosConsulta); ?>"  title="<?php echo $pagina+1; ?>"><?php echo $pagina+1; ?></a></li>				<?php }?>
                        <?php if ($pageNum_DatosConsulta < $totalPages_DatosConsulta) { // Show if not last page ?>
			<li class="disabled"><a href="#">...</a></li>								
			<li><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, min($totalPages_DatosConsulta, $pageNum_DatosConsulta + 1), $queryString_DatosConsulta); ?>" title="Siguiente">&raquo;</a></li>									<?php } // Show if not last page ?>
			<?php if ($pageNum_DatosConsulta < $totalPages_DatosConsulta) { // Show if not last page ?>							<li><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, $totalPages_DatosConsulta, $queryString_DatosConsulta); ?>" title="Ultimo">Último</a></li>							
			<?php } // Show if not last page ?>       
	</ul>
                          <?php      
        } 
		else
		 { //MOSTRAR SI NO HAY RESULTADOS ?>
                No hay resultados.
                <?php } ?>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div><br><br><br>
                    <!-- /.panel -->
					
	

                </div>
                <!-- /.col-lg-6 -->
                
          
	  
	  	<?php 				
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////************************************************/////////////////////////////////////////////////////////////////////////** TABLA DE PEDIDOS QUE SE ABONAN AL ENTREGAR **/////////////////////////////////////
////////////////////////////////////************************************************//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	 ?>		
  	  
<center><button type="button" class="btn btn-info " style='width:600px; height:55px'>Pedidos para preparar y cobrar al entregar</button></center>
<br>
	 <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            PAGO AL ENTREGAR
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                               <?php if ($totalRows_DatosConsulta > 0) {  ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id <?php
	$consultaextendidaparaordenacion="";
													//BLOQUE ORDENACIÓN
													//SI HAY PARÁMETROS, HAY QUE SABER SI SON DE ORDEN
													$parametroparaprocesar="1";
													if (!isset($_GET["orden"])) {
														$orden=0;
														$valor=0;
													}
													else {
														$orden=$_GET["orden"];
														$valor=$_GET["valor"];
													}
													MostrarOrdenCampo($parametroparaprocesar, $orden, $valor,$currentPage, $consultaextendidaparaordenacion);
												?></th>
                                            
                                            <th>Nombre <?php
													//BLOQUE ORDENACIÓN
													//SI HAY PARÁMETROS, HAY QUE SABER SI SON DE ORDEN
													$parametroparaprocesar="2";
													if (!isset($_GET["orden"])) {
														$orden=0;
														$valor=0;
													}
													else {
														$orden=$_GET["orden"];
														$valor=$_GET["valor"];
													}
													MostrarOrdenCampo($parametroparaprocesar, $orden, $valor,$currentPage, $consultaextendidaparaordenacion);
												?></th>
                                            
                                            <th>Fecha <?php
													//BLOQUE ORDENACIÓN
													//SI HAY PARÁMETROS, HAY QUE SABER SI SON DE ORDEN
													$parametroparaprocesar="3";
													if (!isset($_GET["orden"])) {
														$orden=0;
														$valor=0;
													}
													else {
														$orden=$_GET["orden"];
														$valor=$_GET["valor"];
													}
													MostrarOrdenCampo($parametroparaprocesar, $orden, $valor,$currentPage, $consultaextendidaparaordenacion);
												?></th>
											<th>Zona <?php
													//BLOQUE ORDENACIÓN
													//SI HAY PARÁMETROS, HAY QUE SABER SI SON DE ORDEN
													$parametroparaprocesar="4";
													if (!isset($_GET["orden"])) {
														$orden=0;
														$valor=0;
													}
													else {
														$orden=$_GET["orden"];
														$valor=$_GET["valor"];
													}
													MostrarOrdenCampo($parametroparaprocesar, $orden, $valor,$currentPage, $consultaextendidaparaordenacion);
												?></th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
		//AQUI ES DONDE SE SACAN LOS DATOS, SE COMPRUEBA QUE HAY RESULTADOS
		
			 do { 
              		?>
              		
				<tr>
						<td><?php echo $row_DatosConsulta2["idCompra"];?></td>
						
					<td><strong><?php echo $row_DatosConsulta2["strNombre"];?></strong></td>
						
						<td><?php echo $row_DatosConsulta2["fchCompra"];?></td>
						<td><?php echo ObtenerZonaPedidoCarrito($row_DatosConsulta2["intZona"]);?></td>
						<td><a href="pedido-ver.php?id=<?php echo $row_DatosConsulta2["idUsuario"];?>&idPedido=<?php echo $row_DatosConsulta2["idCompra"];?>" class="fa fa-eye">&nbsp;Ver </a> </td>
					
				</tr>
              		
              		<?php
              		 } while ($row_DatosConsulta2 = mysqli_fetch_assoc($DatosConsulta2)); 
	?>
   
                                    </tbody>
                                </table>
                                <ul class="pagination">
		<?php if ($pageNum_DatosConsulta > 0) { // Show if not first page ?>
			<li><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, 0, $queryString_DatosConsulta); ?>" title="Primero">Primero</a></li>
		<?php } // Show if not first page ?>
		<?php if ($pageNum_DatosConsulta > 0) { // Show if not first page ?>
                	<li><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, max(0, $pageNum_DatosConsulta - 1), $queryString_DatosConsulta); ?>" title="Anterior">&laquo;</a></li> 								
		<?php } // Show if not first page 
                if ($pageNum_DatosConsulta-$interval_page<1){
		 $inicio = 0;
		 } else{
		 $inicio = $pageNum_DatosConsulta-$interval_page;
		 }
		 if ($pageNum_DatosConsulta+$interval_page>=$totalPages_DatosConsulta){
			$final = $totalPages_DatosConsulta;
			} else{
			 $final = $pageNum_DatosConsulta+$interval_page;
			}
			for ($pagina=$inicio; $pagina<=$final; ++$pagina){
				if ($pagina==$pageNum_DatosConsulta){
					$clase = "active";
				} 
				else 
				{
					$clase = "";
				}?>
				<li class="<?php echo $clase; ?>"><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, min($totalPages_DatosConsulta,$pagina), $queryString_DatosConsulta); ?>"  title="<?php echo $pagina+1; ?>"><?php echo $pagina+1; ?></a></li>				<?php }?>
                        <?php if ($pageNum_DatosConsulta < $totalPages_DatosConsulta) { // Show if not last page ?>
			<li class="disabled"><a href="#">...</a></li>								
			<li><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, min($totalPages_DatosConsulta, $pageNum_DatosConsulta + 1), $queryString_DatosConsulta); ?>" title="Siguiente">&raquo;</a></li>									<?php } // Show if not last page ?>
			<?php if ($pageNum_DatosConsulta < $totalPages_DatosConsulta) { // Show if not last page ?>							<li><a href="<?php printf("%s?pageNum_DatosConsulta=%d%s", $currentPage, $totalPages_DatosConsulta, $queryString_DatosConsulta); ?>" title="Ultimo">Último</a></li>							
			<?php } // Show if not last page ?>       
	</ul>
                          <?php      
        } 
		else
		 { //MOSTRAR SI NO HAY RESULTADOS ?>
                No hay resultados.
                <?php } ?>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
					
                </div> 
	  </div>
	</div>
        <!-- /#page-wrapper -->
</div>
	</div><!-- InstanceEndEditable -->
    <!-- /#wrapper -->
	<?php include("../includes/adm-pie.php"); ?>

    
</body>

<!-- InstanceEnd --></html>


<?php
//AÑADIR AL FINAL DE LA PÁGINA
mysqli_free_result($DatosConsulta);
?>

