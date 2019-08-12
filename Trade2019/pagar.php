<?php require_once('Connections/conexion.php');

//GUARDAR DATOS DE ENVIO

$_SESSION["COMPRA_intZona"] = $_POST["intZona"];
$_SESSION["COMPRA_strNombre"] = $_POST["strNombre"];
$_SESSION["COMPRA_strDNI"] = $_POST["strDNI"];
$_SESSION["COMPRA_strDireccion"] = $_POST["strDireccion"];
$_SESSION["COMPRA_strPiso"] = $_POST["strPiso"];
$_SESSION["COMPRA_strProvincia"] = $_POST["strProvincia"];
$_SESSION["COMPRA_strCP"] = $_POST["strCP"];
$_SESSION["COMPRA_strEmail"] = $_POST["strEmail"];
$_SESSION["COMPRA_strTelefono"] = $_POST["strTelefono"];

//ActualizarPreciosEnTablaCarrito();

if (!isset($_POST["intPago"])){
	header("Location:error.php?error=1");
	exit;
}
	else
	{
		if ($_POST["intPago"]==1)	
		{
			//AL RECIBIR 
			ConfirmacionPago(1, -1);
			
			
			//$contenido = GenerarEmailCliente(3);
			//$asunto="Gracias por su pedido";
			//GuardarEmailEnviado($_SESSION["compraactivavisa"], $contenido);
			//EnvioCorreoHTML(ObtenerCorreo($_SESSION['WEBWEBWEB_IdUsuario']), $contenido, $asunto);
			//
			//GeneracionFacturaInline($_SESSION["compraactivavisa"]);
			//
			header("Location:gracias.php?tipo=1");
			exit;
			
		}
		
		
			if ($_POST["intPago"]==5)	
				{
					//MERCADO PAGO
					ConfirmacionPago(5, 0);

					//header("Location:buttomMP.php");
					
					//Este es el que hay que descomentar
					header("Location:pagar-MP.php");
					exit;

				}
		
		
		
		
		
		if ($_POST["intPago"]==3)	
		{
			//TRANSFERENCIA
			ConfirmacionPago(3, 0);
			
			
			//$contenido = GenerarEmailCliente(3);
			//$asunto="Gracias por su pedido";
			//GuardarEmailEnviado($_SESSION["compraactivavisa"], $contenido);
			//EnvioCorreoHTML(ObtenerCorreo($_SESSION['WEBWEBWEB_IdUsuario']), $contenido, $asunto);
			//
			//GeneracionFacturaInline($_SESSION["compraactivavisa"]);
			//
			
	header("Location:gracias.php?tipo=3");
			exit;
			
		}
		
		
	}
?>