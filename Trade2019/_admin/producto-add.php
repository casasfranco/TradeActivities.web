<?php require_once('../Connections/conexion.php');
RestringirAcceso("1");?>
<?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "forminsertar")) {
	
$esprincipal=0;
	if ((isset($_POST["intPrincipal"])) && ($_POST["intPrincipal"]=="1"))
		$esprincipal=1;
	
	if (comprobarseonoexiste($_POST["strSEO"]))
	{


  $insertSQL = sprintf("INSERT INTO tblproducto(strNombre, strSEO, refCategoria1,  refCategoria2,  refCategoria3,  refCategoria4,  refCategoria5,  strImagen1, strImagen2, strImagen3, strImagen4, strImagen5, strDescripcion, dblPrecio, dblPrecioAnterior, intEstado, refMarca, intPrincipal, intStock, refImpuesto, dblPeso) VALUES (%s, %s,%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST["strNombre"], "text"),
					   GetSQLValueString($_POST["strSEO"], "text"),
                       GetSQLValueString($_POST["refCategoria1"], "int"),
					   GetSQLValueString($_POST["refCategoria2"], "int"),
					   GetSQLValueString($_POST["refCategoria3"], "int"),
					   GetSQLValueString($_POST["refCategoria4"], "int"),
					   GetSQLValueString($_POST["refCategoria5"], "int"),
                       GetSQLValueString($_POST["strImagen1"], "text"),
					   GetSQLValueString($_POST["strImagen2"], "text"),
					   GetSQLValueString($_POST["strImagen3"], "text"),
					   GetSQLValueString($_POST["strImagen4"], "text"),
					   GetSQLValueString($_POST["strImagen5"], "text"),
                       GetSQLValueString($_POST["strDescripcion"], "text"),
                       GetSQLValueString(ProcesarComaPrecio($_POST["dblPrecio"]), "double"),
					   GetSQLValueString(ProcesarComaPrecio($_POST["dblPrecioAnterior"]), "double"),
					   GetSQLValueString($_POST["intEstado"], "int"),
					   GetSQLValueString($_POST["refMarca"], "int"),
					   GetSQLValueString($esprincipal, "int"),
					   GetSQLValueString($_POST["intStock"], "int"),
					   GetSQLValueString($_POST["refImpuesto"], "int"),					 GetSQLValueString(ProcesarComaPrecio($_POST["dblPeso"]), "int")
					  );

  
  $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));


  $insertGoTo = "producto-lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
		
		}
	else
	{
		//EL SEO NO ES ÚNICO
		 $insertGoTo = "error.php?error=6";
  		 header(sprintf("Location: %s", $insertGoTo));
	}
}

$query_DatosMarcas = sprintf("SELECT * FROM tblmarca WHERE intEstado=1 ORDER BY strMarca");

$DatosMarcas = mysqli_query($con,  $query_DatosMarcas) or die(mysqli_error($con));
$row_DatosMarcas = mysqli_fetch_assoc($DatosMarcas);
$totalRows_DatosMarcas = mysqli_num_rows($DatosMarcas);

$query_DatosImpuestos = sprintf("SELECT * FROM tblimpuesto ORDER BY strNombre");
$DatosImpuestos = mysqli_query($con,  $query_DatosImpuestos) or die(mysqli_error($con));
$row_DatosImpuestos = mysqli_fetch_assoc($DatosImpuestos);
$totalRows_DatosImpuestos = mysqli_num_rows($DatosImpuestos);


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

    <!-- InstanceBeginEditable name="ContenidoAdmin" --><div id="wrapper">

        <!-- Navigation -->
<script src="scriptupload.js"></script>
<script src="../js/scriptadmin.js"></script>
 <script src="../js/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
  selector: '#strDescripcion',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor'
  ],
  toolbar: 'undo redo  | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link'
});
</script>
<div id="wrapper">
  <!-- Navigation -->
  <?php include("../includes/adm-menu.php"); ?>
  <div id="page-wrapper">
     <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gestión de Productos</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <a href="producto-lista.php" class="btn btn-outline btn-info">Volver atrás</a><br>
<br>

            
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Añadir Producto
                        </div>
                        <div class="panel-body">
                            <form action="producto-add.php" method="post" id="forminsertar" name="forminsertar" role="form"><div class="row">
                                <div class="col-lg-6">
                                  
									<div class="form-group">
                                            <label>Nombre</label>
                                            <input class="form-control" placeholder="Escribir Nombre del Producto" name="strNombre" id="strNombre" onChange="javascript:document.forminsertar.strSEO.value=CodificarSEO(document.forminsertar.strNombre.value);">
                                        </div>
                                         <div class="form-group">
                                            <label>SEO</label>
                                            <input class="form-control" placeholder="Escribir SEO del Producto" name="strSEO" id="strSEO">
                                        </div>
                                          <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea name="strDescripcion" id="strDescripcion"	></textarea>
                                           
                                        </div>
										<div class="form-group">
                                            <label>Precio Antiguo</label>
                                            <input class="form-control" placeholder="Escribir el precio antiguo" name="dblPrecioAnterior" id="dblPrecioAnterior">
                                        </div>
                                          <div class="form-group">
                                            <label>Precio</label>
                                            <input class="form-control" placeholder="Escribir Precio" name="dblPrecio" id="dblPrecio">
                                          </div>
									
										<div class="form-group">
                                            <label>Stock</label>
                                            <input class="form-control" placeholder="Escribir Stock" name="intStock" id="intStock">
                                        </div>
<div class="form-group">
	<label>En página principal</label>
		<div class="checkbox">
			<label>
				<input type="checkbox" value="1" name="intPrincipal" id="intPrincipal">Tildar para mostrar el producto en la página principal de la tienda
			</label>
		</div>
</div>                 
 <div class="form-group">
			<label>Marca</label>
			<select name="refMarca" class="form-control" id="refMarca">
				<option value="0">Sin Marca</option>
				<?php do { ?>
				<option value="<?php echo $row_DatosMarcas["idMarca"]?>" ><?php echo $row_DatosMarcas["strMarca"]?></option>
				<?php
              		 } while ($row_DatosMarcas = mysqli_fetch_assoc($DatosMarcas)); 
	?>
				
			</select>
		</div>
<div class="form-group">
			<label>Impuesto</label>
			<select name="refImpuesto" class="form-control" id="refImpuesto">				
				<?php do { ?>
				<option value="<?php echo $row_DatosImpuestos["idImpuesto"]?>" ><?php echo $row_DatosImpuestos["strNombre"]?></option>
				<?php
              		 } while ($row_DatosImpuestos = mysqli_fetch_assoc($DatosImpuestos)); 
	?>
				
			</select>
</div>
									
<div class="form-group">
		<label>Peso</label>
		<input class="form-control" placeholder="Escribir Peso" name="dblPeso" id="dblPeso value="0" ">
</div>

									
       <div class="form-group">
			<label>Estado</label>
			<select name="intEstado" class="form-control" id="intEstado">
				<option value="0">Inactivo</option>
				<option value="1" selected>Activo</option>
				
			</select>
		</div>




                                        <button type="submit" class="btn btn-success">Añadir</button>
                                      <input name="MM_insert" type="hidden" id="MM_insert" value="forminsertar">
                                       
                                    
                              </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
        <div class="form-group">
			<label>Categoría 1</label>
			<select name="refCategoria1" class="form-control" id="refCategoria1">
				<?php categoriadesplegablenivelProductos(0);?>
			</select>
		</div>
 <div class="form-group">
			<label>Categoría 2</label>
			<select name="refCategoria2" class="form-control" id="refCategoria2">
				<option value="0">Sin Categoría</option>
				<?php categoriadesplegablenivelProductos(0);?>
			</select>
		</div>
 <div class="form-group">
			<label>Categoría 3</label>
			<select name="refCategoria3" class="form-control" id="refCategoria3">
			<option value="0">Sin Categoría</option>
				<?php categoriadesplegablenivelProductos(0);?>
			</select>
		</div>
 <div class="form-group">
			<label>Categoría 4</label>
			<select name="refCategoria4" class="form-control" id="refCategoria4">
			<option value="0">Sin Categoría</option>
				<?php categoriadesplegablenivelProductos(0);?>
			</select>
		</div>
 <div class="form-group">
			<label>Categoría 5</label>
			<select name="refCategoria5" class="form-control" id="refCategoria5">
			<option value="0">Sin Categoría</option>
				<?php categoriadesplegablenivelProductos(0);?>
			</select>
		</div>
                                
<?php 
//BLOQUE INSERCION IMAGEN
//***********************
//***********************
//***********************									  //***********************
//PARÁMETROS DE IMAGEN
$nombrecampoimagen="strImagen1";
$nombrecampoimagenmostrar="strImagenpic1";
$nombrecarpetadestino="../images/productos/"; //carpeta destino con barra al final
$nombrecampofichero="file1";
$nombrecampostatus="status1";
$nombrebarraprogreso="progressBar1";
$maximotamanofichero="500000"; //en Bytes, "0" para ilimitado. 1000000 Bytes = 1000Kb = 1Mb
$tiposficheropermitidos="jpg, png, bmp, PNG, JPG, BMP"; //  Por ejemplo "jpg,doc,png", separados por comas y poner "0" para permitir todos los tipos
$limiteancho="200"; // En píxels, "0" significa cualquier tamaño permitido
$limitealto="200"; // En píxels, "0" significa cualquier tamaño permitido
									  
$cadenadeparametros="'".$nombrecampoimagen."','".$nombrecampoimagenmostrar."','".$nombrecarpetadestino."','".$nombrecampofichero."','".$nombrecampostatus."','".$nombrebarraprogreso."','".$maximotamanofichero."','".$tiposficheropermitidos."','".$limiteancho."','".$limitealto."'";

//$cadenadeparametros="";

									  
									  ?>
<div class="form-group">
	<label>Imagen Principal</label>
	<input class="form-control"  name="<?php echo $nombrecampoimagen;?>" id="<?php echo $nombrecampoimagen;?>">
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
	<img src="" alt="" id="<?php echo $nombrecampoimagenmostrar;?>">
</div>   
<?php /*?>
//***********************
//***********************
//***********************									  //***********************
// FIN BLOQUE INSERCION IMAGEN
<?php */?>    
<?php 
//BLOQUE INSERCION IMAGEN
//***********************
//***********************
//***********************									  //***********************
//PARÁMETROS DE IMAGEN
$nombrecampoimagen="strImagen2";
$nombrecampoimagenmostrar="strImagenpic2";
$nombrecarpetadestino="../images/productos/"; //carpeta destino con barra al final
$nombrecampofichero="file2";
$nombrecampostatus="status2";
$nombrebarraprogreso="progressBar2";
$maximotamanofichero="500000"; //en Bytes, "0" para ilimitado. 1000000 Bytes = 1000Kb = 1Mb
$tiposficheropermitidos="jpg, png, bmp, PNG, JPG, BMP"; //  Por ejemplo "jpg,doc,png", separados por comas y poner "0" para permitir todos los tipos
$limiteancho="200"; // En píxels, "0" significa cualquier tamaño permitido
$limitealto="200"; // En píxels, "0" significa cualquier tamaño permitido
									  
$cadenadeparametros="'".$nombrecampoimagen."','".$nombrecampoimagenmostrar."','".$nombrecarpetadestino."','".$nombrecampofichero."','".$nombrecampostatus."','".$nombrebarraprogreso."','".$maximotamanofichero."','".$tiposficheropermitidos."','".$limiteancho."','".$limitealto."'";

//$cadenadeparametros="";

									  
									  ?>
<div class="form-group">
	<label>Imagen 2</label>
	<input class="form-control"  name="<?php echo $nombrecampoimagen;?>" id="<?php echo $nombrecampoimagen;?>">
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
	<img src="" alt="" id="<?php echo $nombrecampoimagenmostrar;?>">
</div>   
<?php /*?>
//***********************
//***********************
//***********************									  //***********************
// FIN BLOQUE INSERCION IMAGEN
<?php */?> 
<?php 
//BLOQUE INSERCION IMAGEN
//***********************
//***********************
//***********************									  //***********************
//PARÁMETROS DE IMAGEN
$nombrecampoimagen="strImagen3";
$nombrecampoimagenmostrar="strImagenpic3";
$nombrecarpetadestino="../images/productos/"; //carpeta destino con barra al final
$nombrecampofichero="file3";
$nombrecampostatus="status3";
$nombrebarraprogreso="progressBar3";
$maximotamanofichero="500000"; //en Bytes, "0" para ilimitado. 1000000 Bytes = 1000Kb = 1Mb
$tiposficheropermitidos="jpg, png, bmp, PNG, JPG, BMP"; //  Por ejemplo "jpg,doc,png", separados por comas y poner "0" para permitir todos los tipos
$limiteancho="200"; // En píxels, "0" significa cualquier tamaño permitido
$limitealto="200"; // En píxels, "0" significa cualquier tamaño permitido
									  
$cadenadeparametros="'".$nombrecampoimagen."','".$nombrecampoimagenmostrar."','".$nombrecarpetadestino."','".$nombrecampofichero."','".$nombrecampostatus."','".$nombrebarraprogreso."','".$maximotamanofichero."','".$tiposficheropermitidos."','".$limiteancho."','".$limitealto."'";

//$cadenadeparametros="";

									  
									  ?>
<div class="form-group">
	<label>Imagen 3</label>
	<input class="form-control"  name="<?php echo $nombrecampoimagen;?>" id="<?php echo $nombrecampoimagen;?>">
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
	<img src="" alt="" id="<?php echo $nombrecampoimagenmostrar;?>">
</div>   
<?php /*?>
//***********************
//***********************
//***********************									  //***********************
// FIN BLOQUE INSERCION IMAGEN
<?php */?> 
<?php 
//BLOQUE INSERCION IMAGEN
//***********************
//***********************
//***********************									  //***********************
//PARÁMETROS DE IMAGEN
$nombrecampoimagen="strImagen4";
$nombrecampoimagenmostrar="strImagenpic4";
$nombrecarpetadestino="../images/productos/"; //carpeta destino con barra al final
$nombrecampofichero="file4";
$nombrecampostatus="status4";
$nombrebarraprogreso="progressBar4";
$maximotamanofichero="500000"; //en Bytes, "0" para ilimitado. 1000000 Bytes = 1000Kb = 1Mb
$tiposficheropermitidos="jpg, png, bmp, PNG, JPG, BMP"; //  Por ejemplo "jpg,doc,png", separados por comas y poner "0" para permitir todos los tipos
$limiteancho="200"; // En píxels, "0" significa cualquier tamaño permitido
$limitealto="200"; // En píxels, "0" significa cualquier tamaño permitido
									  
$cadenadeparametros="'".$nombrecampoimagen."','".$nombrecampoimagenmostrar."','".$nombrecarpetadestino."','".$nombrecampofichero."','".$nombrecampostatus."','".$nombrebarraprogreso."','".$maximotamanofichero."','".$tiposficheropermitidos."','".$limiteancho."','".$limitealto."'";

//$cadenadeparametros="";

									  
									  ?>
<div class="form-group">
	<label>Imagen 4</label>
	<input class="form-control"  name="<?php echo $nombrecampoimagen;?>" id="<?php echo $nombrecampoimagen;?>">
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
	<img src="" alt="" id="<?php echo $nombrecampoimagenmostrar;?>">
</div>   
<?php /*?>
//***********************
//***********************
//***********************									  //***********************
// FIN BLOQUE INSERCION IMAGEN
<?php */?> 
<?php 
//BLOQUE INSERCION IMAGEN
//***********************
//***********************
//***********************									  //***********************
//PARÁMETROS DE IMAGEN
$nombrecampoimagen="strImagen5";
$nombrecampoimagenmostrar="strImagenpic5";
$nombrecarpetadestino="../images/productos/"; //carpeta destino con barra al final
$nombrecampofichero="file5";
$nombrecampostatus="status5";
$nombrebarraprogreso="progressBar5";
$maximotamanofichero="500000"; //en Bytes, "0" para ilimitado. 1000000 Bytes = 1000Kb = 1Mb
$tiposficheropermitidos="jpg, png, bmp, PNG, JPG, BMP"; //  Por ejemplo "jpg,doc,png", separados por comas y poner "0" para permitir todos los tipos
$limiteancho="200"; // En píxels, "0" significa cualquier tamaño permitido
$limitealto="200"; // En píxels, "0" significa cualquier tamaño permitido
									  
$cadenadeparametros="'".$nombrecampoimagen."','".$nombrecampoimagenmostrar."','".$nombrecarpetadestino."','".$nombrecampofichero."','".$nombrecampostatus."','".$nombrebarraprogreso."','".$maximotamanofichero."','".$tiposficheropermitidos."','".$limiteancho."','".$limitealto."'";

//$cadenadeparametros="";

									  
									  ?>
<div class="form-group">
	<label>Imagen 5</label>
	<input class="form-control"  name="<?php echo $nombrecampoimagen;?>" id="<?php echo $nombrecampoimagen;?>">
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
	<img src="" alt="" id="<?php echo $nombrecampoimagenmostrar;?>">
</div>   
<?php /*?>
//***********************
//***********************
//***********************									  //***********************
// FIN BLOQUE INSERCION IMAGEN
<?php */?>  
									

									
								</div>
                                <!-- /.col-lg-6 (nested) -->
                            </div></form>
                            <!-- /.row (nested) -->
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

