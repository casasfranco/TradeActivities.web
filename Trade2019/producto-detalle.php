<?php require_once('Connections/conexion.php'); ?>
<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');

$variable_Consulta = "0";
if (isset($VARIABLE)) {
  $variable_Consulta = $VARIABLE;
}

$query_DatosConsulta = sprintf("SELECT * FROM tblproducto WHERE intEstado=1 AND strSEO=%s ",
							   GetSQLValueString($_GET["prod"], "text"));


$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);





//INSERTAR VISITA DE PRODUCTO

if (isset($_SESSION['tradeactivitiesFront_UserId']))
	InsertarVisitaProducto($row_DatosConsulta["idProducto"], $_SESSION['tradeactivitiesFront_UserId']);

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
					<div class="product-details" itemscope itemtype="http://schema.org/Product"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								
								
			<?php if ($row_DatosConsulta["strImagen1"]!=""){?>					
<img id="placeholder" src="images/productos/<?php echo $row_DatosConsulta["strImagen1"];?>" alt="" data-big="images/productos/<?php echo $row_DatosConsulta["strImagen1"];?>" itemprop="image"/>
	<?php }
	else
	{?>
<img src="images/usuarios/sinfoto.jpg" alt="">
<?php }?>	
								

								
							</div>
							<div class="row">
							<div class="col-xs-4"><br>

							<!--//IMAGEN 1	-->									
  	<?php if ($row_DatosConsulta["strImagen1"]!=""){?>					
	<a onclick="return showPic(this)" href="images/productos/<?php echo $row_DatosConsulta["strImagen1"];?>" title="">
		<img src="images/productos/<?php echo $row_DatosConsulta["strImagen1"];?>" alt="" id="" width="100%" >
		</a>
	<?php }
	 ?>
	
							</div>
							<div class="col-xs-4">
														<!--//IMAGEN 2	-->									
  <?php if ($row_DatosConsulta["strImagen2"]!=""){?>					
	<a onclick="return showPic(this)" href="images/productos/<?php echo $row_DatosConsulta["strImagen2"];?>" title="">
		<img src="images/productos/<?php echo $row_DatosConsulta["strImagen2"];?>" alt="" id="" width="100%" >
		
	<?php }
	 ?>
	</a>
							</div>
							<div class="col-xs-4">
														<!--//IMAGEN 3	-->									
  	<?php if ($row_DatosConsulta["strImagen3"]!=""){?>					
	<a onclick="return showPic(this)" href="images/productos/<?php echo $row_DatosConsulta["strImagen3"];?>" title="">
		<img src="images/productos/<?php echo $row_DatosConsulta["strImagen3"];?>" alt="" id="" width="100%" >
		</a>
	<?php }
	 ?>
		
							</div>
							<div class="col-xs-4">
														<!--//IMAGEN 4	-->									
  	<?php if ($row_DatosConsulta["strImagen4"]!=""){?>					
	<a onclick="return showPic(this)" href="images/productos/<?php echo $row_DatosConsulta["strImagen4"];?>" title="">
		<img src="images/productos/<?php echo $row_DatosConsulta["strImagen4"];?>" alt="" id="" width="100%" >
		</a>
	<?php }
	 ?>
		
							</div>
							<div class="col-xs-4">
														<!--//IMAGEN 5	-->									
  	<?php if ($row_DatosConsulta["strImagen5"]!=""){?>					
	<a onclick="return showPic(this)" href="images/productos/<?php echo $row_DatosConsulta["strImagen5"];?>" title="">
		<img src="images/productos/<?php echo $row_DatosConsulta["strImagen5"];?>" alt="" id="" width="100%" >
		</a>
	<?php }
	 ?>
		
	</div>
	</div>
							

						</div>
						<div class="col-sm-7">
							<div class="product-information" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2 itemprop="name"><?php echo $row_DatosConsulta["strNombre"];?></h2>
								<?php /*?><p>Web ID: 1089772</p><?php */?>
								<img src="images/product-details/rating.png" alt="" />
								<form name="formcompra" id="formcompra" method="post" action="carrito-add.php">
								<span>
								<?php 
									if ($row_DatosConsulta["dblPrecioAnterior"]!=0){?>	
								<span class="preciotachado"><?php echo '$'.$row_DatosConsulta["dblPrecioAnterior"];?></span><br><br>



								<?php }?>
									
								<span itemprop="price"><?php echo '$'.CalcularPrecioProducto($row_DatosConsulta["idProducto"]);?></span>
								<label>Cantidad:</label>
								<input name="intCantidad" type="number" id="intCantidad" value="1" />
								<input name="refProducto" type="hidden" id="refProducto" value="<?php echo $row_DatosConsulta["idProducto"];?>" />
								<button type="button" class="btn btn-fefault cart" onClick="document.formcompra.submit()">
									<i class="fa fa-shopping-cart"></i>
									Comprar
								</button>
									
						  		</span>
								<?php MostrarOpciones($row_DatosConsulta["idProducto"]);?>
									<img src="https://www.ventastecno.com.ar/wp-content/plugins/woocommerce-mercadopago/assets/images/mercadopago.png" alt="Mercado Pago - Tarjeta de Credito o Debito"><br>

								<span itemprop="description"><?php echo $row_DatosConsulta["strDescripcion"];?></span>
								<?php /*?><p><b>Availability:</b> In Stock</p>
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b> E-SHOPPER</p><?php */?>
								
								</form>
								
                
                
                
            
            
							</div><!--/product-information-->
							<br>

                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                
					<div class="addthis_inline_share_toolbox_s371 "></div>
           		 
            
						</div>
					</div><!--/product-details-->
					
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Detalle</a></li>
								<?php /*?><li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
								<li><a href="#tag" data-toggle="tab">Tag</a></li><?php */?>
								<li><a href="#reviews" data-toggle="tab">Comentarios</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<div class="col-sm-12">
									<?php  MostrarCaracteristicaFrontEnd($row_DatosConsulta["idProducto"]);?>
								</div>
							</div>
							
							<?php /*?><div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div><?php */?>
							
							<?php /*?><div class="tab-pane fade" id="tag" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div><?php */	?>
							
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i><?php echo ObtenerNombreUsuario($_SESSION['tradeactivitiesFront_UserId'])?></a></li>
										<li><a href=""><i class="fa fa-clock-o"></i><?php 
											//Conseguimos la FECHA DE HOY
										@$fecha = date("Y-m-d H:i:s",time());
										$date = new DateTime($fecha, new DateTimeZone('America/Argentina/Buenos_Aires'));
										date_default_timezone_set('America/Argentina/Buenos_Aires');
										$zonahoraria = date_default_timezone_get();
											//LE DAMOS EL FORMATO DESEADO (HORAS)
										@$fecha=date("H:i:s",time());
											echo $fecha?></a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i><?php
												//LE DAMOS EL FORMATO DESEADO (DIA-MES-AÑO)
												@$fecha=date("d-m-Y",time()); echo $fecha?></a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Escribe tu comentario</b></p>
									
									<form action="producto-detalle-opinion.php" method="post">
										<span>
											<input name="strNombreComentador" type="text" required id="strNombreComentador" placeholder="Escribe tu nombre"/>
										</span>
										<textarea name="txtComentario" id="txtComentario" required></textarea>
										<span>
											<input name="intCaptcha" type="number" required id="intCaptcha" placeholder="2+5"/>
										</span>
										<?php /*?><b>Rating: </b> <img src="images/product-details/rating.png" alt="" /><?php */?>
										<button type="button" class="btn btn-default pull-right">
											Enviar
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<?php include("includes/masvendidos.php"); ?>
		  			<!--/recommended_items-->
					
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

<!-- Go to www.addthis.com/dashboard to customize your tools -->

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c94fafb9e062d60"></script>




<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
<?php
//AÑADIR AL FINAL DE LA PÁGINA
mysqli_free_result($DatosConsulta);
?>