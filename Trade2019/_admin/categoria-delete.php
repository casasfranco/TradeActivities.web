<?php require_once('../Connections/conexion.php'); 
RestringirAcceso("1");

//COMPROBAMOS QUE NO HAY SUB-CATEGORIAS DEPENDIENDO DE LO QUE VAMOS A ELIMINAR

$query_DatosConsulta = sprintf("SELECT idCategoria FROM tblcategoria WHERE refPadre = %s ", GetSQLValueString($_GET["id"], "int"));
$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);

if ($totalRows_DatosConsulta>0)
	 header("Location: error.php?error=4");
//FIN DE LA COMPROBACION SUB-CATEGORIAS


else{
	
//COMPROBAMOS QUE NO HAY ARTICULOS DEPENDIENDO DE LO QUE VAMOS A ELIMINAR	
	$query_DatosConsulta = sprintf("SELECT idProducto FROM tblproducto WHERE refCategoria1 = %s OR refCategoria2 = %s OR refCategoria3 = %s OR refCategoria4 = %s OR refCategoria5 = %s   ", 
	   GetSQLValueString($_GET["id"], "int"),
	   GetSQLValueString($_GET["id"], "int"),
	   GetSQLValueString($_GET["id"], "int"),
	   GetSQLValueString($_GET["id"], "int"),
	   GetSQLValueString($_GET["id"], "int"));
	
$DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
$row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
$totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta);
	
	if ($totalRows_DatosConsulta>0)
	 header("Location: error.php?error=5&cat=".$_GET["id"]);
//FIN DE LA COMPROBACION


else{

	//ELIMINACION 

$query_Delete = sprintf("DELETE FROM tblcategoria WHERE idcategoria=%s",
                       GetSQLValueString($_GET["id"], "int"));
$Result1 = mysqli_query($con, $query_Delete) or die(mysqli_error($con));

  $insertGoTo = "categoria-lista.php";
  header(sprintf("Location: %s", $insertGoTo));
  mysqli_free_result($Result1);
}
}
?>








