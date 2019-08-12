<?php require_once('../Connections/conexion.php');
RestringirAcceso("1,100");?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "forminsertar")) {
	
	if (comprobarseocategoriaunico($_POST["idCategoria"], $_POST["strSEO"]))
	{	
		
		$esprincipal=0;
	if ((isset($_POST["intPrincipal"])) && ($_POST["intPrincipal"]=="1"))
		$esprincipal=1;

  $updateSQL = sprintf("UPDATE tblcategoria SET strNombre=%s, strSEO=%s, intEstado=%s, refPadre=%s, intOrden=%s, intPrincipal=%s WHERE idCategoria=%s",
                       GetSQLValueString($_POST["strNombre"], "text"),
					   GetSQLValueString($_POST["strSEO"], "text"),
					   GetSQLValueString($_POST["intEstado"], "int"),
					   GetSQLValueString($_POST["refPadre"], "int"),
					   GetSQLValueString($_POST["intOrden"], "int"),
					   GetSQLValueString($esprincipal, "int"),
					   GetSQLValueString($_POST["idCategoria"], "int"));

//echo $updateSQL;
$Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));

  $updateGoTo = "categoria-lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}		
else
	{
		//EL SEO ESTÁREPETIDO
		 $insertGoTo = "error.php?error=6";
  		 header(sprintf("Location: %s", $insertGoTo));
	}		
	}

$query_DatosConsulta = sprintf("SELECT * FROM tblcategoria WHERE idCategoria=%s", GetSQLValueString($_GET["id"], "int"));

$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);

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
<div id="wrapper">
  <!-- Navigation -->
  <?php include("../includes/adm-menu.php"); ?>
  <div id="page-wrapper">
     <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gestión de Categorías</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <a href="categoria-lista.php" class="btn btn-outline btn-info">Volver atrás</a><br>
<br>

            
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Añadir Categoría
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                  <form action="categoria-edit.php" method="post" id="forminsertar" name="forminsertar" role="form" onSubmit="javascript:return validarcategoriaalta();">
                                       
                                       
                                        <div class="form-group">
                                            <label>Nombre de categoría</label>
                                            <input class="form-control" placeholder="Escribir Nombre del categoría" name="strNombre" id="strNombre" value="<?php echo $row_DatosConsulta["strNombre"];?>" onChange="javascript:document.forminsertar.strSEO.value=CodificarSEO(document.forminsertar.strNombre.value);">
                                        </div>
									 	<div class="form-group">
                                            <label>SEO de categoría</label>
                                            <input class="form-control" placeholder="Escribir SEO de la categoría" name="strSEO" id="strSEO" value="<?php echo $row_DatosConsulta["strSEO"];?>">
                                        </div>
                                          <div class="alert alert-danger oculto" id="errornombre">Nombre obligatorio</div>
                                          
                                          <div class="form-group">
                                            <label>Orden de categoría</label>
                                            <input class="form-control" placeholder="Escribir Orden de la categoría" name="intOrden" id="intOrden" value="<?php echo $row_DatosConsulta["intOrden"];?>">
                                        </div>
                                          <div class="alert alert-danger oculto" id="errororden">Orden obligatorio</div>
                                          
		<div class="form-group">
			<label>Categoría de la que depende</label>
			<select name="refPadre" class="form-control" id="refPadre">
				<option value="0" <?php if ($row_DatosConsulta["refPadre"]=="0") echo "selected"; ?>>Categoría Principal</option>
				<?php categoriadesplegablenivelactualizar(0, $row_DatosConsulta["refPadre"]);?>
				

			</select>
		</div>
       <div class="form-group">
			<label>Estado</label>
			<select name="intEstado" class="form-control" id="intEstado">
				<option value="0" <?php if ($row_DatosConsulta["intEstado"]=="0") echo "selected"; ?>>Inactivo</option>
				<option value="1" <?php if ($row_DatosConsulta["intEstado"]=="1") echo "selected"; ?>>Activo</option>
				
			</select>
		</div>
									  
<div class="form-group">
<label>En página principal</label>
<div class="checkbox">
<label>
<input type="checkbox" value="1" name="intPrincipal" id="intPrincipal" <?php if ($row_DatosConsulta["intPrincipal"]==1){ ?>checked="checked" <?php }?>>
Marcar para mostrar la categoria en la página principal de la tienda
</label>
</div>
</div>
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                        <input name="idCategoria" type="hidden" id="idCategoria" value="<?php echo $row_DatosConsulta["idCategoria"];?>">
                                      <input name="MM_insert" type="hidden" id="MM_insert" value="forminsertar">
                                       
                                  </form>
                              </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                                <!-- /.col-lg-6 (nested) -->
                            </div>
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

