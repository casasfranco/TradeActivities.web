<?php require_once('Connections/conexion.php'); ?>
<?php 
if ((isset($_SESSION['tradeactivitiesFront_UserId'])) || (isset($_SESSION['MM2_Temporal'])))
{
	
if ($_SESSION['MM2_Temporal']=="ELEVADO")
{
	$usuariotempoactivo=$_SESSION['tradeactivitiesFront_UserId'];
	$_SESSION["usuariotempoactivo"]=$_SESSION['tradeactivitiesFront_UserId'];
    $insertGoTo = "index.php";
}
	else
	{
	$usuariotempoactivo=$_SESSION['MM2_Temporal'];
	$_SESSION["usuariotempoactivo"]=$_SESSION['MM2_Temporal'];
    $insertGoTo = "index.php";
}
	
	//isset cuando esta seteado, no es la primera vez que ingreso la zona 
	// !isset cuando no esta seteado, primera vez que ingreso la zona
	
if (!isset($_SESSION["zonaactiva"]))
	$_SESSION["zonaactiva"]=0;
if (isset($_GET["zona"]))
	$_SESSION["zonaactiva"]=$_GET["zona"];
	//echo $_SESSION["zonaactiva"];
	
$query_DatosConsulta = sprintf("SELECT * FROM tblcarrito WHERE refUsuario=%s AND intTransaccionEfectuada=0",
						$usuariotempoactivo);

$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);

}	
	
	
$query_DatosZona = sprintf("SELECT * FROM tblzona WHERE intEstado=1 AND refPadre=0 ORDER BY strNombre"
						  );

$DatosZona = mysqli_query($con,  $query_DatosZona) or die(mysqli_error($con));
$row_DatosZona = mysqli_fetch_assoc($DatosZona);
$totalRows_DatosZona = mysqli_num_rows($DatosZona);
	

	

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
	
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
	
    <!-- InstanceEndEditable -->
	<meta name="description" content="">
    <meta name="author" content="">
	<?php include("includes/cabecera.php"); ?>
<!-- InstanceBeginEditable name="head" -->
    <script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='carrito.php?zona="+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
    </script>
<!-- InstanceEndEditable -->
</head><!--/head-->

<body>
<!-- InstanceBeginEditable name="contenido" -->

<?php include("includes/header.php"); ?>
<?php //include("includes/slider.php"); ?>
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
				<table class="table table-condensed">
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
	<img src="images/productos/<?php echo $row_DatosConsultaProducto["strImagen1"];?>" alt="" id="imagenproducto<?php echo $row_DatosConsultaProducto["idProducto"];?>" width="70%"></a>
	<?php }
	else
	{?>
		<a href="<?php echo $linkProducto;?>"><img src="images/productos/nodisponible.jpg" alt="" id="imagenproducto<?php echo $row_DatosConsultaProducto["idProducto"];?>"></a>
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
									<a class="cart_quantity_up" href="carrito-operar.php?id=<?php echo $row_DatosConsulta["idContador"]?>&op=1"> + </a>
								<!--//OP=1 para sumar-->
									<input readonly class="cart_quantity_input" type="text" name="quantity" value="<?php echo $row_DatosConsulta["intCantidad"];?>" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="carrito-operar.php?id=<?php echo $row_DatosConsulta["idContador"]?>&op=2&actual=<?php echo $row_DatosConsulta["intCantidad"];?>"> - </a>
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
							</td>
							
							<td width="5%">
								<a class="cart_quantity_delete" href="carrito-operar.php?id=<?php echo $row_DatosConsulta["idContador"]?>&op=3"><i class="fa fa-times"></i></a>
							<!--//OP=3 para eliminar-->
							</td>
						</tr>
<?php 
	$totalpeso= $totalpeso+$pesoproducto;
	} while ($row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta)); 
?>

					</tbody>
				</table>
		  </div><a class="cart_quantity_delete" href="carrito-operar.php?id=<?php echo $row_DatosConsulta["idContador"]?>&op=4">Vaciar Carrito</a>
		  <?php
} else echo "<div class='alert alert-danger'>Carrito Vacio.</div>
 <a href='index.php'><i class='fa fa-arrow-circle-left'></i> Volver a la lista de productos</a><br>
<br>";?>
		</div>
	</section>
	
<?php if($totalRows_DatosConsulta>0)
	//REALIZO UN IF PARA SACAR LA TABLA INFERIOR CON DATOS DE ENVIO/TOTALES EN EL CARRO
	
{
?>
<section id="do_action">
		<div class="container">
			<div class="heading">
				
			</div>
			<div class="row">
				<div class="col-sm-6 ">
					<div class="chose_area">
				<form action="pagar.php" method="post">
					<ul class="user_option ">
							<h2 class="section__title">
         				 		Dirección de Envío
							</h2><br>
							<li placeholder="zona">
								<select name="intZona" class="form-control" id="intZona" onChange="MM_jumpMenu('parent',this,0)">
									
									<option value="0" <?php if ($_SESSION["zonaactiva"]==0) echo "selected";?> >Selecciona la Zona de envío</option>
								<?php do { 
														?>
									<option value="<?php echo $row_DatosZona["idZona"]?>" <?php if ($row_DatosZona["idZona"]==$_SESSION["zonaactiva"]) echo "selected"; ?>><?php echo $row_DatosZona["strNombre"]?></option>

									<?php } while ($row_DatosZona = mysqli_fetch_assoc($DatosZona)); ?>
								</select>
							</li>
						</ul>
					
						
<?php
 
 	 $strNombre = "";
 	 $strDNI = "";
	 $strDireccion = "";
	 $strPiso = "";
	 $strProvincia = "";
	 $strCP = "";
	 $strEmail = "";
	 $strTelefono = "";
	 
 
 
 
$query_DatosComprador = sprintf("SELECT * FROM tblcompra WHERE idUsuario=%s ORDER BY idCompra DESC",
						$usuariotempoactivo);

$DatosComprador = mysqli_query($con,  $query_DatosComprador) or die(mysqli_error($con));
$row_DatosComprador = mysqli_fetch_assoc($DatosComprador);
$totalRows_DatosComprador = mysqli_num_rows($DatosComprador);	
 
 if($totalRows_DatosComprador>0)
	{
		
	 $strNombre = $row_DatosComprador["strNombre"];
	 $strDNI = $row_DatosComprador["strDNI"];
	 $strDireccion = $row_DatosComprador["strDireccion"];
	 $strPiso = $row_DatosComprador["strPiso"];
	 $strProvincia = $row_DatosComprador["strProvincia"];
	 $strCP = $row_DatosComprador["strCP"];
	 $strEmail = $row_DatosComprador["strEmail"];
	 $strTelefono = $row_DatosComprador["strTelefono"];
	 
	}
?>			
					
					
					
						
						<ul class="user_option">
							<li > <br>
							  <input name="strNombre"  type="text" id="strNombre" placeholder="Nombre Completo" class="form-control" value="<?php echo $strNombre;?>"/>
							</li>
							<li> <br>
							  <input name="strDNI"  type="text" id="strDNI" placeholder="DNI" class="form-control" value="<?php echo $strDNI;?>"/>
							</li>
						  <li><br>

								<input name="strDireccion"  type="text" id="strDireccion" placeholder="Direccion" class="form-control" value="<?php echo $strDireccion;?>"/>
							</li>
							<li> <br>
							  <input name="strPiso"  type="text" id="strPiso" placeholder="Piso, Dpto, etc. (opcional)" class="form-control" value="<?php echo $strPiso;?>"/>
							</li>
							<li> <br>
							  <input name="strProvincia"  type="text" id="strProvincia" placeholder="Provincia" class="form-control" value="<?php echo $strProvincia;?>"/>
							</li>
							<li> <br>
							  <input name="strCP"  type="text" id="strCP" placeholder="Codigo Postal" class="form-control" value="<?php echo $strCP;?>" />
							</li>
							<li> <br>
							  <input name="strEmail"  type="email" id="strEmail" placeholder="Email" class="form-control" value="<?php echo $strEmail;?>"/>
							</li>
							<li> <br>
							  <input name="strTelefono"  type="text" id="strTelefono" placeholder="Telefono" class="form-control" value="<?php echo $strTelefono;?>"/>
							</li><br>

							<li> Forma de Pago: <br>
								<?php if (_intAlrecibir=="1"){?>
								<input name="intPago" type="radio" value="1" checked="checked" > Pago al Recibir<br> <?php }?>
								<?php if (_intPaypal=="1"){?>
								<input name="intPago" type="radio" value="2" checked="checked"> Paypal<br><?php }?>
								<?php if (_intTransferencia=="1"){?>
								<input name="intPago" type="radio" value="3" checked="checked"> Transferencia Bancaria<br><?php }?>
								<?php if (_intSantander=="1"){?>
								<input name="intPago" type="radio" value="4" checked="checked"> VISA Santander <br><?php }?>
								<?php if (_intMercadoPago=="1"){?>
								<input name="intPago" type="radio" value="5" checked="checked"> MercadoPago&nbsp;&nbsp;<img src="https://www.ventastecno.com.ar/wp-content/plugins/woocommerce-mercadopago/assets/images/mercadopago.png" alt="Mercado Pago - Tarjeta de Credito o Debito"><br><?php }?>
								
							</li>
							
						 </ul>
						<input name="botonpagar" type="submit" class="btn btn-default update" value="Continuar">
						</form>
					</div>
				</div>
				<div class="col-sm-6">
				  <div class="total_area">
						<ul>
							<li>Sub Total <span><?php echo '$'.number_format($totalsinimpuestos, 2, ",", "" );?></span></li>
							<li>Impuesto <span><?php echo '$'.number_format($totalimpuestos, 2, ",", "" );?></span></li>
							<?php $CostoEnvios=CalcularPortes($totalpeso, $_SESSION["zonaactiva"]);?>
							<li>Costo de envio <span><?php echo '$'.number_format($CostoEnvios, 2, ",", "" );?></span></li>
							<li>Total <span><?php echo '$'.number_format($totalcarrito+$CostoEnvios, 2, ",", "" );
								$_SESSION["Total"]=$totalcarrito+$CostoEnvios;
								$_SESSION["TotalsinImpuestos"]=$totalsinimpuestos;?></span></li>
						</ul>
					</div>
									
<center> 
						<img src="https://imgmp.mlstatic.com/org-img/banners/ar/medios/online/575X40.jpg" title="MercadoPago - Medios de pago" alt="MercadoPago - Medios de pago" width="575" height="40"/><br>

	<br>

					<img class="heartBeat" src="https://www.samic.com.uy/wp-content/uploads/2017/07/version-horizontal-large.png" width="300" height="85"/>

<br>
<br>
<br>

						
</center> 				
				</div>
			</div>
		</div>
	</section>
	<?php }?>
<?php include("includes/pie.php"); ?>
<?php include("includes/piejs.php"); ?>

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
