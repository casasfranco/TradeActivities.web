<?php require_once('Connections/conexion.php');

$_SESSION['MM2_Username']="";
$_SESSION['MM2_UserGroup']="";	 
$_SESSION['MM2_IdUsuario']="";
$_SESSION['tradeactivitiesFront_UserId']="";
$_SESSION['tradeactivitiesFront_Mail']="";
$_SESSION['tradeactivitiesFront_Nivel']="";
$_SESSION['MM2_Temporal']="";
$_SESSION['tradeactivitiesFront_Temporal']="";
unset($_SESSION['MM2_Username']);
unset($_SESSION['MM2_UserGroup']);
unset($_SESSION['MM2_IdUsuario']);
unset($_SESSION['tradeactivitiesFront_UserId']);
unset($_SESSION['tradeactivitiesFront_Mail']);
unset($_SESSION['tradeactivitiesFront_Nivel']);
unset($_SESSION['MM2_Temporal']);
unset($_SESSION['tradeactivitiesFront_Temporal']);

header("Location: index.php");
?>