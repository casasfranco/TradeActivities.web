<?php require_once('Connections/conexion.php');

if ($_SESSION['MM2_Temporal']=="ELEVADO")
{
	$usuariotempoactivo=$_SESSION['tradeactivitiesFront_UserId'];
    $insertGoTo = "index.php";
}
	else
	{
	$usuariotempoactivo=$_SESSION['MM2_Temporal'];
    $insertGoTo = "index.php";
}

switch ($_GET["op"]) {
    case 1:
		//ACCEPTADO Y EN CAMINO
		$updateSQL = sprintf("UPDATE tblcompra SET intEstado=0 WHERE intEstado!=0 AND refUsuario=%s",
                       GetSQLValueString($_GET["id"], "int"),
					   $usuariotempoactivo);
		$Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));

	  	$insertGoTo = "carrito.php";
		header(sprintf("Location: %s", $insertGoTo));
		mysqli_free_result($Result1);
        break;
		
		
    case 2:
		//RECHAZADO
		
		$updateSQL = sprintf("UPDATE tblcarrito SET intCantidad=intCantidad-1 WHERE idContador=%s AND refUsuario=%s",
                       GetSQLValueString($_GET["id"], "int"),
					   $usuariotempoactivo);
		$Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));
		}

	  	$insertGoTo = "carrito.php";
		header(sprintf("Location: %s", $insertGoTo));
		mysqli_free_result($Result1);
        break;
 	/*
	case 4:
		//ELIMINAR	TDOO EL CARRITO
       $query_Delete = sprintf("DELETE FROM tblcarrito WHERE refUsuario=%s AND intTransaccionEfectuada=0",
					   $usuariotempoactivo);
	   $Result1 = mysqli_query($con, $query_Delete) or die(mysqli_error($con));

	   $insertGoTo = "carrito.php";
	   header(sprintf("Location: %s", $insertGoTo));
	   mysqli_free_result($Result1);
        break;
	*/
		
	
}
?>
