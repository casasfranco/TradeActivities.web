<?php require_once('../Connections/conexion.php'); 
RestringirAcceso(1);?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$mensajeexito=0;
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "forminsertar")) {
	
	$marcas=0;
	if((isset($_POST["intMarcas"])) && ($_POST["intMarcas"]==1))
		$marcas=1;
	$impuesto=0;
	if((isset($_POST["intImpuesto"])) && ($_POST["intImpuesto"]==1))
		$impuesto=1;
	$pago1=0;
	if((isset($_POST["intTransferencia"])) && ($_POST["intTransferencia"]==1))
		$pago1=1;
	$pago2=0;
	if((isset($_POST["intPaypal"])) && ($_POST["intPaypal"]==1))
		$pago2=1;
	$pago3=0;
	if((isset($_POST["intAlrecibir"])) && ($_POST["intAlrecibir"]==1))
		$pago3=1;
	$pago4=0;
	if((isset($_POST["intSantander"])) && ($_POST["intSantander"]==1))
		$pago4=1;
	$pago5=0;
	if((isset($_POST["intMercadoPago"])) && ($_POST["intMercadoPago"]==1))
		$pago5=1;
	
	
  $updateSQL = sprintf("UPDATE tblconfiguracion SET strTelefono=%s, strEmail=%s, strLogo=%s, intMarcas=%s, intImpuesto=%s,
  strPAYPAL_url=%s, strPAYPAL_email=%s, strSANTANDER_url=%s, strSANTANDER_merchantid=%s, strSANTANDER_secret=%s, strSANTANDER_account=%s, intTransferencia=%s, intPaypal=%s, intAlrecibir=%s, intSantander=%s, intMercadoPago=%s, strURL=%s WHERE idConfiguracion=%s",
                       GetSQLValueString($_POST["strTelefono"], "text"),
					   GetSQLValueString($_POST["strEmail"], "text"),
					   GetSQLValueString($_POST["strLogo"], "text"),
					   GetSQLValueString($marcas, "int"),
					   GetSQLValueString($impuesto, "int"),
					   GetSQLValueString($_POST["strPAYPAL_url"], "text"),
					   GetSQLValueString($_POST["strPAYPAL_email"], "text"),
					   GetSQLValueString($_POST["strSANTANDER_url"], "text"),
					   GetSQLValueString($_POST["strSANTANDER_merchantid"], "text"),
					   GetSQLValueString($_POST["strSANTANDER_secret"], "text"),
					   GetSQLValueString($_POST["strSANTANDER_account"], "text"),
					   GetSQLValueString($pago1, "int"),
					   GetSQLValueString($pago2, "int"),
					   GetSQLValueString($pago3, "int"),
					   GetSQLValueString($pago4, "int"),
					   GetSQLValueString($pago5, "int"),
					   GetSQLValueString($_POST["strURL"], "text"),
					   GetSQLValueString($_POST["idConfiguracion"], "int")
					   );
		
//echo $updateSQL;
$Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));
	
	
$mensajeexito=1;

}
?>
<?php

$query_DatosConsulta = sprintf("SELECT * FROM tblconfiguracion WHERE idConfiguracion=1");

$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);
?><!DOCTYPE html>
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
    <title>Administracion TradeActivities</title>
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
<script src="scriptupload.js"></script>
<script src="../js/scriptadmin.js"></script>
<div id="wrapper">
  <!-- Navigation -->
  <?php include("../includes/adm-menu.php"); ?>
  <div id="page-wrapper">
     <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Configuracíon</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <?php /*?><a href="usuario-lista.php" class="btn btn-outline btn-info">Volver atrás</a><br><?php */?>
<br>
	  
	  <?php if ($mensajeexito==1){?>
<div class="row">
	<div class="col-lg-12">
		<div class="alert alert-success">La configuracion se guardó correctamente.</div>	              
	</div>
</div>
	  <?php }?>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Editar Configuracíon
                        </div>
                        <div class="panel-body">
							<form action="configuracion.php" method="post" id="forminsertar" role="form" name="forminsertar">
                            <div class="row">
                                <div class="col-lg-6">
									<div class="form-group">
                                            <label>URL Página</label>
                                            <input class="form-control" placeholder="Escribir URL de la página" name="strURL" id="strURL" value="<?php echo $row_DatosConsulta["strURL"];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" placeholder="email" name="strEmail" id="strEmail" value="<?php echo $row_DatosConsulta["strEmail"];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Teléfono</label>
                                            <input class="form-control" placeholder="Teléfono que saldra en la parte superior" name="strTelefono" id="strTelefono" value="<?php echo $row_DatosConsulta["strTelefono"];?>">
                                        </div>
									  <div class="form-group">
                                            <label>Mostrar Marcas</label>
												<div class="checkbox">
													<label>
														<input type="checkbox" value="1" name="intMarcas" id="intMarcas" <?php if($row_DatosConsulta["intMarcas"]==1){?> checked="checked" <?php }?>>Tildar para mostrar el apartado de marcas en el menú de la izquierda
													</label>
												</div>
                                        </div>
									  
									  <div class="form-group">
                                            <label>Precios con Impuestos</label>
												<div class="checkbox">
													<label>
														<input type="checkbox" value="1" name="intImpuesto" id="intImpuesto" <?php if($row_DatosConsulta["intImpuesto"]==1){?> checked="checked" <?php }?>>Tildar para mostrar los precios con impuesto incluido
													</label>
												</div>
                                        </div>

<?php 
//BLOQUE INSERCION IMAGEN
//***********************
//***********************
//***********************									  //***********************
//PARÁMETROS DE IMAGEN
$nombrecampoimagen="strLogo";
$nombrecampoimagenmostrar="strLogopic";
$nombrecarpetadestino="../images/"; //carpeta destino con barra al final
$nombrecampofichero="file1";
$nombrecampostatus="status1";
$nombrebarraprogreso="progressBar1";
$maximotamanofichero="500000"; //en Bytes, "0" para ilimitado. 1000000 Bytes = 1000Kb = 1Mb
$tiposficheropermitidos="jpg, png, bmp, PNG, JPG, BMP, jpeg, JPEG"; //  Por ejemplo "jpg,doc,png", separados por comas y poner "0" para permitir todos los tipos
$limiteancho="0"; // En píxels, "0" significa cualquier tamaño permitido
$limitealto="0"; // En píxels, "0" significa cualquier tamaño permitido
									  
$cadenadeparametros="'".$nombrecampoimagen."','".$nombrecampoimagenmostrar."','".$nombrecarpetadestino."','".$nombrecampofichero."','".$nombrecampostatus."','".$nombrebarraprogreso."','".$maximotamanofichero."','".$tiposficheropermitidos."','".$limiteancho."','".$limitealto."'";
//$cadenadeparametros="";

									  
									  ?>
<div class="form-group">
	<label>Imagen de logo</label>
	<input class="form-control"  name="<?php echo $nombrecampoimagen;?>" id="<?php echo $nombrecampoimagen;?>" value="<?php echo $row_DatosConsulta["strLogo"];?>">
</div> 
<div class="form-group">
	<div class="row">
		<div class="col-lg-6">
			<input type="file" name="<?php echo $nombrecampofichero;?>" id="<?php echo $nombrecampofichero;?>"><br>
		</div>
		<div class="col-lg-6">
			<input class="form-control" type="button" value="Subir Fichero" onclick="uploadFile(<?php echo $cadenadeparametros;?>)">
		</div>
	</div>
	<progress id="<?php echo $nombrebarraprogreso;?>" value="0" max="100" style="width:100%;"></progress>
	<h5 id="<?php echo $nombrecampostatus;?>"></h5>
	<?php if ($row_DatosConsulta["strLogo"]!=""){?>
	<img src="<?php echo $nombrecarpetadestino.$row_DatosConsulta["strLogo"];?>" alt=""  width="200" height="200" id="<?php echo $nombrecampoimagenmostrar;?>">
	<?php }
	else
	{?>
	<img src="../images/usuarios/sinfoto.jpg" alt="" width="400"  id="<?php echo $nombrecampoimagenmostrar;?>">
	<?php }?>
</div>   
<?php /*?>
//***********************
//***********************
//***********************									  //***********************
// FIN BLOQUE INSERCION IMAGEN
<?php */?>     
                                                                
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                      <input name="idConfiguracion" type="hidden" id="idConfiguracion" value="<?php echo $row_DatosConsulta["idConfiguracion"];?>">
                                      <input name="MM_insert" type="hidden" id="MM_insert" value="forminsertar">

                              </div>
                                <!-- /.col-lg-6 (nested) -->
 <div class="col-lg-6">
 <div class="checkbox">
<label>
<input type="checkbox" value="1" name="intAlrecibir" id="intAlrecibir" <?php if ($row_DatosConsulta["intAlrecibir"]==1){ ?>checked="checked" <?php }?>>

Marcar para activar el pago al recibir
</label>
</div>
	 
 <div class="checkbox">
<label>
<input type="checkbox" value="1" name="intPaypal" id="intPaypal" <?php if ($row_DatosConsulta["intPaypal"]==1){ ?>checked="checked" <?php }?>>
Marcar para activar el pago por Paypal
</label>
</div>
	 
<div class="checkbox">
<label>
<input type="checkbox" value="1" name="intTransferencia" id="intTransferencia" <?php if ($row_DatosConsulta["intTransferencia"]==1){ ?>checked="checked" <?php }?>>
Marcar para activar el pago por Transferencia
</label>
</div>
	 
 <div class="checkbox">
<label>
<input type="checkbox" value="1" name="intMercadoPago" id="intMercadoPago" <?php if ($row_DatosConsulta["intMercadoPago"]==1){ ?>checked="checked" <?php }?>>
Marcar para activar el pago por MercadoPago
</label>
</div>
	 
 <div class="checkbox">
<label>
<input type="checkbox" value="1" name="intSantander" id="intSantander" <?php if ($row_DatosConsulta["intSantander"]==1){ ?>checked="checked" <?php }?>>
Marcar para activar el pago por Santander
</label>
</div>

	 <div class="form-group">
			<label>Paypal URL</label>
			<input class="form-control" placeholder="Direccion de Paypal" name="strPAYPAL_url" id="strPAYPAL_url" value="<?php echo $row_DatosConsulta["strPAYPAL_url"];?>">
	  </div>
	 <div class="form-group">
			<label>Paypal Email</label>
			<input class="form-control" placeholder="Email de Paypal" name="strPAYPAL_email" id="strPAYPAL_email" value="<?php echo $row_DatosConsulta["strPAYPAL_email"];?>">
	  </div>
	 <div class="form-group">
			<label>Santander URL</label>
			<input class="form-control" placeholder="Direccion de Santander" name="strSANTANDER_url" id="strSANTANDER_url" value="<?php echo $row_DatosConsulta["strSANTANDER_url"];?>">
	  </div>
	 <div class="form-group">
			<label>Santander MerchantId</label>
			<input class="form-control" placeholder="Direccion de Paypal" name="strSANTANDER_merchantid" id="strSANTANDER_merchantid" value="<?php echo $row_DatosConsulta["strSANTANDER_merchantid"];?>">
	  </div>
	 <div class="form-group">
			<label>SANTANDER Secret</label>
			<input class="form-control" placeholder="Direccion de Paypal" name="strSANTANDER_secret" id="strSANTANDER_secret" value="<?php echo $row_DatosConsulta["strSANTANDER_secret"];?>">
	  </div>
	 <div class="form-group">
			<label>Santander Account</label>
			<input class="form-control" placeholder="Direccion de Paypal" name="strSANTANDER_account" id="strSANTANDER_account" value="<?php echo $row_DatosConsulta["strSANTANDER_account"];?>">
	  </div>
	 
									 
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
							</form>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
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

