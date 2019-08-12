<?php require_once('../Connections/conexion.php'); ?>


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

    <!-- InstanceBeginEditable name="ContenidoAdmin" -->

        <!-- Navigation -->
<script src="scriptupload.js"></script>
<script src="../js/scriptadmin.js"></script>
<div id="wrapper">
  <!-- Navigation -->
  <?php include("../includes/adm-menu.php"); ?>
  <div id="page-wrapper">
     <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Error detectado</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

<br>

            
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Atención
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                <?php if ($_GET["error"]==1){?>
									<div class="alert alert-danger">El e-mail ya se está utilizando. <a href="usuario-add.php">Inténtalo de nuevo</a>.</div>
                             <?php }?>
									<?php if ($_GET["error"]==2){?>
									<div class="alert alert-danger">El e-mail ya se está utilizando. <a href="usuario-edit.php?id=<<?php echo $_GET["id"];?>">Inténtalo de nuevo</a>.</div>
                             <?php }?>
									<?php if ($_GET["error"]==3){?>
									<div class="alert alert-danger">No tienes permiso para acceder a esta sección</div>
                             <?php }?>
									<?php if ($_GET["error"]==4){?>
									<div class="alert alert-danger">No se puede eliminar una categoria que tiene subcategorias dependientes. <a href="categoria-lista.php">Volver a categorias</a></div>
                             <?php }?>
									<?php if ($_GET["error"]==5){?>
									<div class="alert alert-danger">No se puede eliminar una categoria que tiene productos dependientes. <a href="categoria-lista.php">Volver a categorias</a><br>
<br>										
Productos Relacionados: <br><br>

										

									
										<?php productosdependientes($_GET["cat"])?>
									
									</div>
                             <?php }?>
									
								<?php if ($_GET["error"]==6){?>
									<div class="alert alert-danger">Nombre SEO repetido, DEBES INTENTAR CON UNO DIFERENTE. <a href="producto-lista.php">Volver a productos</a></div>
                             <?php }?>	
								<?php if ($_GET["error"]==7){?>
									<div class="alert alert-danger">Nombre SEO repetido, DEBES INTENTAR CON UNO DIFERENTE. <a href="categoria-lista.php">Volver a categorias</a></div>
                             <?php }?>
									
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

