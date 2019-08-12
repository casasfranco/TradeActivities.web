<?php require_once('../Connections/conexion.php'); 
RestringirAcceso("1");

$query_Delete = sprintf("DELETE FROM tblproductoopcion WHERE refProducto=%s AND refOpcion=%s",
                       GetSQLValueString($_GET["id"], "int"),
                       GetSQLValueString($_GET["opcion"], "int"));
$Result1 = mysqli_query($con, $query_Delete) or die(mysqli_error());

  $insertGoTo = "productoopcion-edit.php?id=".$_GET["id"];
  header(sprintf("Location: %s", $insertGoTo));
  mysqli_free_result($Result1);

?>








