<?php 

//CON " DISTINCT " OBLIGO QUE SOLO SEAN DIFERENTES ASI NO ENCUENTRE EL MISMO PRODUCTO REPETIDO
$query_DatosVisitados = sprintf("SELECT DISTINCT (refProducto) FROM tblproductovisita WHERE refUsuario=%s ORDER BY fchFecha DESC LIMIT 6",
							GetSQLValueString($_SESSION['tradeactivitiesFront_UserId'], "int"));
$DatosVisitados = mysqli_query($con,  $query_DatosVisitados) or die(mysqli_error($con));
$row_DatosVisitados = mysqli_fetch_assoc($DatosVisitados);
$totalRows_DatosVisitados = mysqli_num_rows($DatosVisitados);


$contadorproductos=1;


	
	 
	
if ($totalRows_DatosVisitados>0){
?>
<div class="recommended_items"><!--recommended_items-->
	<h2 class="title text-center">Tus últimas visitas</h2>

	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
		<?php
	do {
			if 	($contadorproductos==1)	{ ?>			 
			<div class="item active">	
			<?php }
				if 	($contadorproductos==4)	{ ?>			 
			<div class="item">	
			<?php }?>
			<?php //echo $contadorproductos;?>
				<div class="col-sm-4">
					<?php '$'.MostrarProductoExtra($row_DatosVisitados["refProducto"]);?>
				</div>
			<?php 
		if ($contadorproductos==3)	{ ?>			 
			</div>	
			<?php }
		if ($contadorproductos==6)	{ ?>			 
			</div>	
			<?php }
		$contadorproductos++;
			 } while ($row_DatosVisitados = mysqli_fetch_assoc($DatosVisitados)); 
			
			//NO SE LLEGA A 3 o a 6
	//if ($contadorproductos<3) echo "</div>";
	//if (($contadorproductos>3) && ($contadorproductos<6)) echo "</div>";
	if (($contadorproductos==2) ||($contadorproductos==3) || ($contadorproductos==6)|| ($contadorproductos==5)) echo "</div>";
			?>

		</div>
		 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
			<i class="fa fa-angle-left"></i>
		  </a>
		  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
			<i class="fa fa-angle-right"></i>
		  </a>			
	</div>
</div>
<?php }