<?php require_once('../Connections/conexion.php');
RestringirAcceso("1, 100");?>
<?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "forminsertar")) {



  $insertSQL = sprintf("INSERT INTO tblopcion(strNombre, intEstado, refPadre, intOrden, dblIncremento) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST["strNombre"], "text"),
                       GetSQLValueString($_POST["intEstado"], "int"),
                       GetSQLValueString($_POST["refPadre"], "int"),
                       GetSQLValueString($_POST["intOrden"], "int"), GetSQLValueString(ProcesarComaPrecio($_POST["dblIncremento"]), "double")
					  );

  
  $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));


  $insertGoTo = "opcion-lista.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
		
}
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
    <title>Administración Tienda 2017</title>
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
                    <h1 class="page-header">Gestión de Opciones</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <a href="opcion-lista.php" class="btn btn-outline btn-info">Volver atrás</a><br>
<br>

            
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Añadir Opción
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                  <form action="opciondetalle-add.php" method="post" id="forminsertar" name="forminsertar" role="form" >
                                        <div class="form-group">
                                            <label>Nombre de la Opción</label>
                                            <input class="form-control" placeholder="Escribir Nombre de la opción" name="strNombre" id="strNombre">
                                        </div>
                                          <div class="alert alert-danger oculto" id="errornombre">Nombre obligatorio</div>
                                          
                                          <div class="form-group">
                                            <label>Orden de Opción</label>
                                            <input class="form-control" placeholder="Escribir Orden de la categoría" name="intOrden" id="intOrden">
                                        </div>
                                          <div class="alert alert-danger oculto" id="errororden">Orden obligatorio</div>
                                          
                                          <div class="form-group">
                                            <label>Incremento</label>
                                            <input class="form-control" value="0" name="dblIncremento" id="dblIncremento">
                                        </div>
                                        
		
       <div class="form-group">
			<label>Estado</label>
			<select name="intEstado" class="form-control" id="intEstado">
				<option value="0">Inactivo</option>
				<option value="1" selected>Activo</option>
				
			</select>
		</div>
                                        <button type="submit" class="btn btn-success">Añadir</button>
                                         <input name="refPadre" type="hidden" id="refPadre" value="<?php echo $_GET["id"]?>">
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
                
                <!-- /.col-lg-6 -->
            </div>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- InstanceEndEditable -->
    <!-- /#wrapper -->
	<?php include("../includes/adm-pie.php"); ?>

    
</body>

<!-- InstanceEnd --></html>