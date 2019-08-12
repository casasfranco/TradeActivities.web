<?php
require_once('Connections/conexion.php');

if(isset($_POST["id"]) && !empty($_POST["id"])){
	
	//COMPROBAR QUE COMO MÁXIMO HAY DOS
	$query_ConsultaFuncion = sprintf("SELECT refUsuario, idComparar FROM tblcomparar WHERE refUsuario = %s ",
		 GetSQLValueString($_SESSION['tradeactivitiesFront_UserId'], "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	
	if ($totalRows_ConsultaFuncion>0){
		$primeracomparacion=$row_ConsultaFuncion["idComparar"];
		}
	if ($totalRows_ConsultaFuncion<3){
	
	
	
	 $insertSQL = sprintf("INSERT INTO tblcomparar(refUsuario, refProducto) VALUES (%s, %s)",
                       GetSQLValueString($_SESSION['tradeactivitiesFront_UserId'], "int"),
                       GetSQLValueString($_POST["id"], "int")
					  );
  $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));
	}
	else
	{
		//TIENE YA 3, ASI QUE LIMINO UNO DE ELLOS
		$query_Delete = sprintf("DELETE FROM tblcomparar WHERE idComparar=%s AND refUsuario=%s",
                       GetSQLValueString($primeracomparacion, "int"),	   GetSQLValueString($_SESSION['tradeactivitiesFront_UserId'], "int"));
	$Result1 = mysqli_query($con, $query_Delete) or die(mysqli_error($con));
		//AHORA AGREGO EL QUE ME QUIERE INTRODUCIR EN EL COMPARADOR
		
		 $insertSQL = sprintf("INSERT INTO tblcomparar(refUsuario, refProducto) VALUES (%s, %s)",
                       GetSQLValueString($_SESSION['tradeactivitiesFront_UserId'], "int"),
                       GetSQLValueString($_POST["id"], "int")
					  );
  
  $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));
		
	}
	?>
<li><a href="usuario-lista-comparar.php" style="color:#1A53A1"><i class="fa fa-bars"></i>En el comparador</a></li>
	<?php
}
?>