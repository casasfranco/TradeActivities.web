<?php    

$_SESSION['MM_Username']="";
$_SESSION['MM_UserGroup']="";	 
$_SESSION['tradeactivities_UserId']="";
$_SESSION['tradeactivities_Mail']="";
$_SESSION['tradeactivities_Nivel']="";

unset($_SESSION['MM_Username']);
unset($_SESSION['MM_UserGroup']);	 
unset($_SESSION['tradeactivities_UserId']);
unset($_SESSION['tradeactivities_Mail']);
unset($_SESSION['tradeactivities_Nivel']);

header("Location: index.php");

?>