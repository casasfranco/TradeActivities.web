<?php
require_once('Connections/conexion.php');

if(isset($_POST["id"]) && !empty($_POST["id"])){
	
	$query_Delete = sprintf("DELETE FROM tblcomparar WHERE refProducto=%s AND refUsuario=%s",
                       GetSQLValueString($_POST["id"], "int"),
					   GetSQLValueString($_SESSION['tradeactivitiesFront_UserId'], "int"));
	$Result1 = mysqli_query($con, $query_Delete) or die(mysqli_error($con));
	echo "1";
}
?>