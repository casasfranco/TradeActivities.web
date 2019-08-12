<?php require_once('../Connections/conexion.php'); 
RestringirAcceso(1);?>
<?php


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "forminsertar")) {
	



  $insertSQL = sprintf("INSERT INTO tblimpuesto(strNombre, dblImpuesto) VALUES (%s, %s)",
                       GetSQLValueString($_POST["strNombre"], "text"),
                       GetSQLValueString(ProcesarComaPrecio($_POST["dblImpuesto"]), "double"));

  
  $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));


  $insertGoTo = "impuesto-lista.php";
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
                    <h1 class="page-header">Gestión de Impuestos</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <a href="impuesto-lista.php" class="btn btn-outline btn-info">Volver atrás</a><br>
<br>

            
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Añadir Impuesto
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                  <form action="impuesto-add.php" method="post" id="forminsertar" name="forminsertar" role="form"> 
                                        <div class="form-group">
                                            <label>Nombre del impuesto</label>
                                            <input class="form-control" placeholder="Escribir Nombre del impuesto" name="strNombre" id="strNombre">
                                        </div>
									  <div class="form-group">
                                            <label>Valor (indicado en porcentajes, por ejemplo 21% habria que poner 21)</label>
                                            <input class="form-control" placeholder="Escribir valor del impuesto" name="dblImpuesto" id="dblImpuesto">
                                        </div>
                   
                                        <button type="submit" class="btn btn-success">Añadir</button>
									  <input name="MM_insert" type="hidden" id="MM_insert" value="forminsertar" >
										
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

