<?php require_once('../Connections/conexion.php'); 
RestringirAcceso("1");

$insertSQL = sprintf("INSERT INTO tblproductoopcion(refProducto, refOpcion) VALUES (%s, %s)",
                       GetSQLValueString($_GET["id"], "int"),
                       GetSQLValueString($_GET["opcion"], "int"));

  
  $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));

  $insertGoTo = "productoopcion-edit.php?id=".$_GET["id"];
  header(sprintf("Location: %s", $insertGoTo));
  mysqli_free_result($Result1);

?>








