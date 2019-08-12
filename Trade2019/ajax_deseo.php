<?php
require_once('Connections/conexion.php');

if(isset($_POST["id"]) && !empty($_POST["id"])){
	
	 $insertSQL = sprintf("INSERT INTO tbldeseo(refUsuario, refProducto) VALUES (%s, %s)",
                       GetSQLValueString($_SESSION['tradeactivitiesFront_UserId'], "int"),
                       GetSQLValueString($_POST["id"], "int")
					  );
  
  $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));
	?>
<li><a href="usuario-lista-deseos.php" style="color:#FF0004"><i class="fa fa-heart"></i>En mis deseos</a></li>
	<?php
}
?>