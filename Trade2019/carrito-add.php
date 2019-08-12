<?php require_once('Connections/conexion.php');

if ((isset($_SESSION['MM2_Temporal'])) && ($_SESSION['MM2_Temporal'] != ""))
	{
	//La variable temporal ya está asignada, puedo agregar el producto
	}
else
{
	$_SESSION['MM2_Temporal'] = InsertarUsuarioTemporal();
	}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

//GENERAR SESION PARA EL USUARIO, SE HAYA REGISTRADO O NO
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

$valorrespuesta = comprobarexistencia($_POST['refProducto'],$usuariotempoactivo );

//$valorrespuesta = 0;
if ($valorrespuesta!=0){
	
	//UPDATE
  $insertSQL = sprintf("UPDATE tblcarrito SET intCantidad = intCantidad + %s WHERE idContador = %s",$_POST['intCantidad'],
					   $valorrespuesta);
	
	 $Result1 = mysqli_query($con, $insertSQL) or die(mysqli_error($con));
  $ultimoidinsertadodecarrito = mysqli_insert_id($con);
}
else
{
  $insertSQL = sprintf("INSERT INTO tblcarrito (refUsuario, refProducto, intCantidad) VALUES (%s, %s, %s)",
                       GetSQLValueString($usuariotempoactivo, "int"),
                       GetSQLValueString($_POST['refProducto'], "int"),
					   GetSQLValueString($_POST['intCantidad'], "int"));
	
	 $Result1 = mysqli_query($con, $insertSQL) or die(mysqli_error($con));
  $ultimoidinsertadodecarrito = mysqli_insert_id($con);

  AgregarOpcionesaCarrito($ultimoidinsertadodecarrito, $_POST['refProducto']);
}
  
 


  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
?>