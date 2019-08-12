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
        $parametro_orden= "idZona";
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

//FINAL DE LA PARTE SUPERIOR
$usuario = $_GET["id"];


///////////////////////////////////////////////////////////////////

//OBTENEMOS EL ID DEL PEDIDO PARA SACAR SOLO LOS PRODUCTOS DE ESA COMPRA
$numeroDePedido = $_GET["idPedido"];

/////////////////////////////////////////////////////////////////////


$query_DatosConsulta = sprintf("SELECT * FROM tblcarrito WHERE refUsuario=%s AND intTransaccionEfectuada=%s",
						$usuario,
						$numeroDePedido);

$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);

	
///////////////////////////////////////////////////////////////////

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


	
	
$query_DatosZona = sprintf("SELECT * FROM tblzona WHERE intEstado=1 AND refPadre=0 ORDER BY strNombre"
						  );

$DatosZona = mysqli_query($con,  $query_DatosZona) or die(mysqli_error($con));
$row_DatosZona = mysqli_fetch_assoc($DatosZona);
$totalRows_DatosZona = mysqli_num_rows($DatosZona);



///////////////////////////////////////////////////////////////////


$query_DatosConsulta2 = sprintf("SELECT * FROM tblcompra  WHERE intEstado!=0 AND idUsuario=%s	",
							   $usuario);
	

$DatosConsulta2 = mysqli_query($con,  $query_DatosConsulta2) or die(mysqli_error($con));
$row_DatosConsulta2 = mysqli_fetch_assoc($DatosConsulta2);
$totalRows_DatosConsulta2 = mysqli_num_rows($DatosConsulta2);

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
	<link href="../css/main-admin.css" rel="stylesheet">
<!-- InstanceEndEditable -->
</head>

<body>

    <!-- InstanceBeginEditable name="ContenidoAdmin" --><div id="wrapper">

        <!-- Navigation -->
        <div id="wrapper">
  <!-- Navigation -->
  <?php include("../includes/adm-menu.php"); ?>
	
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Inico</a></li>
				  <li class="active">Carrito de Compras</li>
				</ol>
			</div>

           
            

<?php if($totalRows_DatosConsulta>0)
	//REALIZO UN IF PARA SACAR LA TABLA DE PRODUCTOS EN EL CARRO
	
{
?>
		  <div class="table-responsive cart_info">
			<table class="table table-condensed table-striped table-hover">
					<thead>
						<tr class="cart_menu">
							<td class="image" >Producto</td>
							<td class="description"></td>
							<td class="price">Precio</td>
							<td class="price">Impuesto</td>
							<td class="quantity">Cantidad</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						
		<?php
	$totalcarrito=0;
	$totalimpuestos=0;
	$totalsinimpuestos=0;
	$totalpeso=0;
	
		do{
			//REALIZO EL DO WHILE PARA SACAR CADA PRODUCTO CON TODOS LOS DATOS
			
$query_DatosConsultaProducto = sprintf("SELECT * FROM tblproducto WHERE idProducto=%s",
				  $row_DatosConsulta["refProducto"]);

$DatosConsultaProducto = mysqli_query($con,  $query_DatosConsultaProducto) or die(mysqli_error($con));
$row_DatosConsultaProducto = mysqli_fetch_assoc($DatosConsultaProducto);
$totalRows_DatosConsultaProducto = mysqli_num_rows($DatosConsultaProducto);
			
	$linkProducto="producto-detalle.php?id=".$row_DatosConsultaProducto["idProducto"];
				
			
						?>
						<tr>
							<td width="10%" >
								<?php if ($row_DatosConsultaProducto["strImagen1"]!=""){?>
			<a href="<?php echo $linkProducto;?>">
	<img src="../images/productos/<?php echo $row_DatosConsultaProducto["strImagen1"];?>" alt="" id="imagenproducto<?php echo $row_DatosConsultaProducto["idProducto"];?>" width="70%"></a>
	<?php }
	else
	{?>
		<a href="<?php echo $linkProducto;?>"><img src="../images/productos/nodisponible.jpg" alt="" id="imagenproducto<?php echo $row_DatosConsultaProducto["idProducto"];?>"></a>
	<?php }?>
							</td>
							
							<td width="30%" >
							  <h4><a href="<?php echo $linkProducto;?>"><?php echo $row_DatosConsultaProducto["strNombre"];?></a></h4>
								<p><?php MostrarOpcionesProductoCarrrito($row_DatosConsulta["idContador"]);
									?></p>
							</td>
							
							<td width="10%" >
								<p><?php 
									$pesoproducto=$row_DatosConsultaProducto["dblPeso"];
									$pesoproducto=$pesoproducto*$row_DatosConsulta["intCantidad"];
									$precioproducto=CalcularPrecioProducto($row_DatosConsultaProducto["idProducto"], 1);
									echo '$'.number_format($precioproducto, 2, ".", "");?></p>
							</td>
							
							<td width="10%" >
								<p><?php 
									$impuestoproducto=CalcularImpuestoProducto($row_DatosConsultaProducto["idProducto"]);
			
									$totalimpuestos=$totalimpuestos+($impuestoproducto*$row_DatosConsulta["intCantidad"]);
										
										
									echo '$'.$impuestoproducto 
										
									 ?></p>
							</td>
							
							<td width="15%" >
								<div class="cart_quantity_button">
									
								<!--//OP=1 para sumar-->
									<input readonly class="cart_quantity_input" type="text" name="quantity" value="<?php echo $row_DatosConsulta["intCantidad"];?>" autocomplete="off" size="4">
									
								<!--//OP=2 para restar-->
								</div>
							</td>
							
							<td width="20%" >
							<?php 

					$TotalSinmultiplicar = $precioproducto + $impuestoproducto;
			
								?>
							<p class="cart_total_price">
							<?php
							'$'.$precioproductounidades=$TotalSinmultiplicar*$row_DatosConsulta["intCantidad"] ;
							$totalsinimpuestos=$totalsinimpuestos+($precioproducto*$row_DatosConsulta["intCantidad"]);
							echo '$'.number_format($precioproductounidades, 2, ",", "" );
							$totalcarrito= ($totalcarrito + $precioproductounidades);
							?>
							</p>
							
							
							<td width="5%">
								
							
							</td>
						</tr>
<?php 
	$totalpeso= $totalpeso+$pesoproducto;
	} while ($row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta)); 
?>

					</tbody>
			  </table>
			  <div class="col-lg-7"></div>		
			  
		    <div class="col-lg-4">
				
				<table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Aceptar Envio</th>
											<th>Cacelar Envio</th>	
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            
											<!--//OP=1 para Aceptar Envio-->
                                            <td class="success">
												<a href="carrito-operar.php?id=<?php echo $row_DatosConsulta["idCompra"]?>&op=1">
													<center><button type="button" class="btn btn-info btn-circle btn-xl fa fa-truck" ></button></center>
												</a>
												
											</td>
											<!--//OP=2 para Cancelar Envio-->
											<td class="danger">
												<a href="carrito-operar.php?id=<?php echo $row_DatosConsulta["idCompra"]?>&op=2">
													<center><button type="button" class="btn btn-info btn-circle btn-xl fa fa-truck" ></button></center>
												</a>
											</td>
										</tr>
                                        
                                    </tbody>
                                </table>

			  </div>
			  <div class="col-lg-2">	</div>
			  
				<center>
			<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Datos Pedido
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nº Orden</th>
                                            <th>Nombre/usuario</th>
                                            <th>Telefono</th>
											<th>DNI</th>
                                            <th>Email</th>
											<th>Direccion de envio</th>
											<th>Cod. Postal</th>
											<th>Fecha compra</th>										
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row_DatosConsulta2["idCompra"];?></td>
                                            <td><?php echo $row_DatosConsulta2["strNombre"];?></td>
                                            <td><?php echo $row_DatosConsulta2["strTelefono"];?></td>
                                            <td><?php echo $row_DatosConsulta2["strDNI"];?></td>
											<td><?php echo $row_DatosConsulta2["strEmail"];?></td>
                                            <td><?php echo $row_DatosConsulta2["strDireccion"];?></td>
                                            <td><?php echo $row_DatosConsulta2["strCP"];?></td>
                                            <td><?php echo $row_DatosConsulta2["fchCompra"];?></td>
										</tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
					
					</center>
<?php } ?>
		</div>
	</section>
	
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                
            </div>
	</div>
        <!-- /#page-wrapper -->

    </div><!-- InstanceEndEditable -->
    <!-- /#wrapper -->
	<?php include("../includes/adm-pie.php"); ?>

    
</body>

<!-- InstanceEnd --></html>


<?php
//AÑADIR AL FINAL DE LA PÁGINA
mysqli_free_result($DatosConsulta);
?>
