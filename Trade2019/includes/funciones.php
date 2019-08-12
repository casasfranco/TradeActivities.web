<?php	
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }
  global $con;
  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($con, $theValue) : mysqli_escape_string($con,$theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


function MostrarNivel($nivel)
{
	
	switch ($nivel) {
    case 0:
        return '<button type="button" class="btn btn-primary btn-xs">Usuario público</button>';
        break;
    case 1:
         return '<button type="button" class="btn btn-success btn-xs">SuperAdministrador</button>';
        break;
    case 10:
         return '<button type="button" class="btn btn-info btn-xs">Gestor de Ventas</button>';
        break;
    case 100:
         return '<button type="button" class="btn btn-warning btn-xs">Gestor de Productos</button>';
        break;

	}
}

function MostrarEstado($estado)
{
	
	switch ($estado) {
    case 0:
         return '<button type="button" class="btn btn-error btn-danger"><i class="fa fa-times"></i></button>';
        break;
    case 1:
         return '<button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button>';
        break;
	}
}


function comprobaremailnoexiste($email)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strEmail FROM tblusuario WHERE strEmail = %s ",
		 GetSQLValueString($email, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion==0) 
		return true;
	else return false;
	
	mysqli_free_result($ConsultaFuncion);
}


function comprobaremailunico($idactual, $email)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strEmail FROM tblusuario WHERE strEmail = %s AND idUsuario <> %s ",
		 GetSQLValueString($email, "text"),
		 GetSQLValueString($idactual, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion==0) 
		return true;
	else return false;
	
	mysqli_free_result($ConsultaFuncion);
}

function MostrarOrdenCampo($parametroparaprocesar, $orden, $valor, $currentPage, $consultaextendidaparaordenacion){

	if ((isset($orden)) && ($orden!="0"))	{
		if ((isset($valor)) && ($valor==$parametroparaprocesar))
		{
			//SI HAY VALOR Y ORDEN Y ERA ESTE PARÁMETRO
			//SI VENIA DE orden=1
			if ($orden=="1"){
			?>
			<a href="<?php echo $currentPage;?>?orden=2&valor=<?php echo $parametroparaprocesar;?><?php echo $consultaextendidaparaordenacion;?>"><i class="fa fa-angle-double-down"></i></a>
			<?php
			}
			if ($orden=="2"){
			?>
			<a href="<?php echo $currentPage;?>?orden=1&valor=<?php echo $parametroparaprocesar;?><?php echo $consultaextendidaparaordenacion;?>"><i class="fa fa-angle-double-up"></i></a>
			<?php
			}
		}

		else
		{ //SI HAY VALOR Y ORDEN Y PERO NO DE ESTE PARÁMETRO
			?>
			<a href="<?php echo $currentPage;?>?orden=1&valor=<?php echo $parametroparaprocesar;?><?php echo $consultaextendidaparaordenacion;?>"><i class="fa fa-angle-double-up"></i></a>
			<?php

		}
	}
	else
	{ //NO HAY PARÁMETROS
		?>
			<a href="<?php echo $currentPage;?>?orden=1&valor=<?php echo $parametroparaprocesar;?><?php echo $consultaextendidaparaordenacion;?>"><i class="fa fa-angle-double-down"></i></a>
			<?php
}
}

function categoriadesplegablenivel2($padre, $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s ",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?>
			<option value="<?php echo $row_ConsultaFuncion["idCategoria"];?>"><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"];?></option>
			<?php
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}


function categoriadesplegablenivel($padre, $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s ",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?>
			<option value="<?php echo $row_ConsultaFuncion["idCategoria"];?>"><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"];?></option>
			<?php
			categoriadesplegablenivel2($row_ConsultaFuncion["idCategoria"], " --");
	 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function categoriadesplegablenivelactualizar($padre, $seleccionado, $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s ",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?>
			<option value="<?php echo $row_ConsultaFuncion["idCategoria"];?>" <?php if ($seleccionado==$row_ConsultaFuncion["idCategoria"]) echo "selected"; ?>><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"];?></option>
			<?php
			categoriadesplegablenivelactualizar2($row_ConsultaFuncion["idCategoria"], $seleccionado, " --");
	 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function categoriadesplegablenivelactualizar2($padre, $seleccionado, $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s ",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?>
			<option value="<?php echo $row_ConsultaFuncion["idCategoria"];?>" <?php if ($seleccionado==$row_ConsultaFuncion["idCategoria"]) echo "selected"; ?>><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"];?></option>
			<?php
			
	 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}


function categorianiveladministracion($padre,  $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s ",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?>
						<tr>
						<td><?php echo $row_ConsultaFuncion["idCategoria"];?></td>

							<td><?php echo  $pertenencia.$row_ConsultaFuncion["strNombre"];?></td>
								<td><?php echo MostrarEstado($row_ConsultaFuncion["intEstado"]);?></td>
								<td><?php echo $row_ConsultaFuncion["intOrden"];?></td>
								<td></td>
							<td><a href="categoria-edit.php?id=<?php echo $row_ConsultaFuncion["idCategoria"];?>" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a> <a href="categoria-delete.php?id=<?php echo $row_ConsultaFuncion["idCategoria"];?>" class="btn btn-danger btn-circle"><i class="fa fa-times-circle "></i></a></td>
						</tr>
			<?php
			categorianiveladministracion($row_ConsultaFuncion["idCategoria"], "-------- ");
	 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}



// BLOQUE RESTRICCION ACCESO POR NIVELES
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

function RestringirAcceso($acceden)
{
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = $acceden;
$MM_donotCheckaccess = "false";

$MM_restrictGoTo = "error.php?error=3";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
}

function TieneSubcategorias($padre)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s AND intEstado=1",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	
		return true;
	else
		return false;
	mysqli_free_result($ConsultaFuncion);
}

function MostrarSubcategorias($padre)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s AND intEstado=1",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			 if (TieneSubcategorias($row_ConsultaFuncion["idCategoria"]))
				{
			?>
			<li><a href="<?php echo GenerarRutaCategoria($row_ConsultaFuncion["idCategoria"])?>"><?php echo $row_ConsultaFuncion["strNombre"];?> </a>
			<ul>
				<?php MostrarSubSubcategorias($row_ConsultaFuncion["idCategoria"]);?>
				</ul>
			</li>
			<?php
				
			}
			else 
			{
			?><li><a href="<?php echo GenerarRutaCategoria($row_ConsultaFuncion["idCategoria"])?>"><?php echo $row_ConsultaFuncion["strNombre"];?> </a>
			</li>
			
			<?php
			}
			
	 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function MostrarSubSubcategorias($padre)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s AND intEstado=1",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			
			?>
			<li><a href="<?php echo GenerarRutaCategoria($row_ConsultaFuncion["idCategoria"])?>"><?php echo $row_ConsultaFuncion["strNombre"];?> </a>
			</li>
	<?php
	 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function InicializarConfiguracion()
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblconfiguracion WHERE idConfiguracion = 1");
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		
		define("_logo", $row_ConsultaFuncion["strLogo"]);
		define("_email", $row_ConsultaFuncion["strEmail"]);
		define("_telefono", $row_ConsultaFuncion["strTelefono"]);
		define("_marcas", $row_ConsultaFuncion["intMarcas"]);
		define("_mostrarimpuesto", $row_ConsultaFuncion["intImpuesto"]);
		define("_strPAYPAL_url", $row_ConsultaFuncion["strPAYPAL_url"]);
		define("_strPAYPAL_email", $row_ConsultaFuncion["strPAYPAL_email"]);
		define("_strSANTANDER_url", $row_ConsultaFuncion["strSANTANDER_url"]);
		define("_strSANTANDER_merchantid", $row_ConsultaFuncion["strSANTANDER_merchantid"]);
		define("_strSANTANDER_secret", $row_ConsultaFuncion["strSANTANDER_secret"]);
		define("_strSANTANDER_account", $row_ConsultaFuncion["strSANTANDER_account"]);
		define("_intTransferencia", $row_ConsultaFuncion["intTransferencia"]);
		define("_intPaypal", $row_ConsultaFuncion["intPaypal"]);
		define("_intAlrecibir", $row_ConsultaFuncion["intAlrecibir"]);
		define("_intSantander", $row_ConsultaFuncion["intSantander"]);
		define("_intMercadoPago", $row_ConsultaFuncion["intMercadoPago"]);
		define("_strURL", $row_ConsultaFuncion["strURL"]);
	}
	mysqli_free_result($ConsultaFuncion);
}

InicializarConfiguracion();

function MostrarMarca($idmarca)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblmarca WHERE idMarca = %s",
		 GetSQLValueString($idmarca, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	
		return $row_ConsultaFuncion["strMarca"];
	else
		return "No usado";
	mysqli_free_result($ConsultaFuncion);
}

function categoriadesplegablenivelProductos($padre, $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s ",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?>
			<option value="<?php echo $row_ConsultaFuncion["idCategoria"];?>"><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"];?></option>
			<?php
			categoriadesplegablenivel2Productos($row_ConsultaFuncion["idCategoria"], " --");
	 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function categoriadesplegablenivel2Productos($padre, $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s ",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?>
			<option value="<?php echo $row_ConsultaFuncion["idCategoria"];?>"><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"];?></option>
			<?php
			categoriadesplegablenivel3Productos($row_ConsultaFuncion["idCategoria"], " ----");
			
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function categoriadesplegablenivel3Productos($padre, $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s ",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?>
			<option value="<?php echo $row_ConsultaFuncion["idCategoria"];?>"><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"];?></option>
			<?php
		
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function ProcesarComaPrecio($precio)
{
	return str_replace(',','.',$precio);
}

function categoriadesplegablenivelProductosEdit($padre, $seleccionado, $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s ",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?>
			<option value="<?php echo $row_ConsultaFuncion["idCategoria"];?>" <?php if ($seleccionado==$row_ConsultaFuncion["idCategoria"]) echo "selected"; ?>><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"];?></option>
			<?php
			categoriadesplegablenivel2ProductosEdit($row_ConsultaFuncion["idCategoria"], $seleccionado, " --");
	 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function categoriadesplegablenivel2ProductosEdit($padre, $seleccionado, $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s ",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?>
			<option value="<?php echo $row_ConsultaFuncion["idCategoria"];?>" <?php if ($seleccionado==$row_ConsultaFuncion["idCategoria"]) echo "selected"; ?>><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"];?></option>
			<?php
			categoriadesplegablenivel3ProductosEdit($row_ConsultaFuncion["idCategoria"], $seleccionado, " ----");
			
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function categoriadesplegablenivel3ProductosEdit($padre, $seleccionado, $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE refPadre = %s ",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?>
			<option value="<?php echo $row_ConsultaFuncion["idCategoria"];?>" <?php if ($seleccionado==$row_ConsultaFuncion["idCategoria"]) echo "selected"; ?>><?php echo $pertenencia.$row_ConsultaFuncion["strNombre"];?></option>
			<?php
		
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function MostrarProducto($id, $tipomuestra=0)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblproducto WHERE idProducto = %s ",
		 GetSQLValueString($id, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	//$linkProducto="producto-detalle.php?id=".$row_ConsultaFuncion["idProducto"];
	$linkProducto=GenerarRutaCategoria($row_ConsultaFuncion["refCategoria1"]).$row_ConsultaFuncion["strSEO"].".html";
	
	?>
	
	<div class="product-image-wrapper">
	<div class="single-products">
			<div class="productinfo text-center">
			
			<?php if ($row_ConsultaFuncion["strImagen1"]!=""){?>
			<a href="<?php echo $linkProducto;?>">
	<img src="images/productos/<?php echo $row_ConsultaFuncion["strImagen1"];?>" alt="" id="imagenproducto<?php echo $row_ConsultaFuncion["idProducto"];?>"></a>
	<?php }
	else
	{?>
		<a href="<?php echo $linkProducto;?>"><img src="images/productos/nodisponible.jpg" alt="" id="imagenproducto<?php echo $row_ConsultaFuncion["idProducto"];?>"></a>
	<?php }?>
			
				
				<h2><?php echo '$'.CalcularPrecioProducto($row_ConsultaFuncion["idProducto"]); ?></h2>
				<p><?php echo $row_ConsultaFuncion["strNombre"]; ?></p>
				<a href="<?php echo $linkProducto;?>" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Ver</a>
				<?php if ($tipomuestra==2){?>
				<br>
				
				<?php 
				MostrarCaracteristicasComparador($row_ConsultaFuncion["idProducto"]);						   
				}?>
			</div>

	</div>
	<div class="choose">
		<ul class="nav nav-pills nav-justified" id="deseolista<?php echo $row_ConsultaFuncion["idProducto"];?>">
		<?php if (isset($_SESSION['tradeactivitiesFront_UserId'])){
			if (!EsYaUnDeseo($row_ConsultaFuncion["idProducto"])){?>
			<li id="deseoli<?php echo $row_ConsultaFuncion["idProducto"];?>"><a href="javascript:void(0);" class="Adeseos" id="deseo<?php echo $row_ConsultaFuncion["idProducto"];?>"><i class="fa fa-plus-square"></i>A mis deseos</a></li>
			<?php
			}
			else
			{
				?>
				<li><a href="usuario-lista-deseos.php" style="color:#FF0004"><i class="fa fa-heart"></i>En mis deseos</a></li>
				
				<?php
			
				}
			 }
			else
			
			{?>
				<li id="deseoli<?php echo $row_ConsultaFuncion["idProducto"];?>"><a title="Debes registrarte para poder guardar tus deseos" href="javascript:void(0);" id="deseo<?php echo $row_ConsultaFuncion["idProducto"];?>"><i class="fa fa-plus-square"></i>A mis deseos</a></li>
				
				<?php
			}?>
			
			<?php
	//BLOQUE COMPARADOR
	
	if (isset($_SESSION['tradeactivitiesFront_UserId'])){
			if (!EsYaUnComparar($row_ConsultaFuncion["idProducto"])){?>
			<li id="compararli<?php echo $row_ConsultaFuncion["idProducto"];?>"><a href="javascript:void(0);" class="AComparar" id="comparar<?php echo $row_ConsultaFuncion["idProducto"];?>"><i class="fa fa-bars"></i>Al comparador</a></li>
			<?php
			}
			else
			{
				?>
				<li><a href="usuario-lista-comparar.php" style="color:#1A53A1"><i class="fa fa-bars "></i>En el comparador</a></li>
				
				<?php
			
				}
			 }
			else
			
			{?>
				<li id="compararli<?php echo $row_ConsultaFuncion["idProducto"];?>"><a title="Debes registrarte para poder usar el comparador" href="javascript:void(0);" id="comparar<?php echo $row_ConsultaFuncion["idProducto"];?>"><i class="fa fa-bars"></i>Al comparador</a></li>
				
				<?php
			}?>
			
		</ul>
	</div>
	<?php if ($tipomuestra==1){?>
	<div class="choose">
		<ul class="nav nav-pills nav-justified">
		<li><a href="javascript:void(0);" onClick="javascript:js_EliminaDeseo(<?php echo $row_ConsultaFuncion["idProducto"];?>)"><i class="fa fa-times-circle"></i>Quitar de mis deseos</a></li>
		</ul>
	</div>
	<?php }?>
		
	<?php if ($tipomuestra==2){?>
	<div class="choose">
		<ul class="nav nav-pills nav-justified">
		<li><a href="javascript:void(0);" onClick="javascript:js_EliminaComparar(<?php echo $row_ConsultaFuncion["idProducto"];?>)"><i class="fa fa-times-circle"></i>Quitar de mi comparador</a></li>
		</ul>
	</div>
	<?php }?>
</div>
	
	<?php
	
	mysqli_free_result($ConsultaFuncion);
}



function MostrarProductoExtra($id, $tipomuestra=0)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblproducto WHERE idProducto = %s ",
		 GetSQLValueString($id, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	//$linkProducto="producto-detalle.php?id=".$row_ConsultaFuncion["idProducto"];
	$linkProducto=GenerarRutaCategoria($row_ConsultaFuncion["refCategoria1"]).$row_ConsultaFuncion["strSEO"].".html";
	
	?>
	
	<div class="product-image-wrapper">
	<div class="single-products">
			<div class="productinfo text-center">
			
			<?php if ($row_ConsultaFuncion["strImagen1"]!=""){?>
			<a href="<?php echo $linkProducto;?>">
	<img src="images/productos/<?php echo $row_ConsultaFuncion["strImagen1"];?>" alt="" id="imagenproducto<?php echo $row_ConsultaFuncion["idProducto"];?>"></a>
	<?php }
	else
	{?>
		<a href="<?php echo $linkProducto;?>"><img src="images/productos/nodisponible.jpg" alt="" id="imagenproducto<?php echo $row_ConsultaFuncion["idProducto"];?>"></a>
	<?php }?>
			
				
				<h2><?php echo '$'.CalcularPrecioProducto($row_ConsultaFuncion["idProducto"]); ?></h2>
				<p><?php echo $row_ConsultaFuncion["strNombre"]; ?></p>
				<a href="<?php echo $linkProducto;?>" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Ver</a>

			</div>

	</div>
	
	
</div>
	
	<?php
	
	mysqli_free_result($ConsultaFuncion);
}




function Productosdependientes($cat)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT idProducto, strNombre FROM tblproducto WHERE refCategoria1 = %s OR refCategoria2 = %s OR refCategoria3 = %s OR refCategoria4 = %s OR refCategoria5 = %s   ", 
	   GetSQLValueString($cat, "int"),
	   GetSQLValueString($cat, "int"),
	   GetSQLValueString($cat, "int"),
	   GetSQLValueString($cat, "int"),
	   GetSQLValueString($cat, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?><a href="producto-edit.php?id=<?php echo $row_ConsultaFuncion["idProducto"]?>"><?php echo $row_ConsultaFuncion["strNombre"];?></a><br>

			
			<?php
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function ProductosporMarca($marca)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT COUNT(idProducto) AS Total FROM tblproducto WHERE refMarca = %s ", 
	   GetSQLValueString($marca, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion["Total"];	
	
	mysqli_free_result($ConsultaFuncion);
}

function CalcularPrecioProducto($producto, $opcion=0)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT dblPrecio, refImpuesto FROM tblproducto WHERE idProducto = %s ", 
	   GetSQLValueString($producto, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if($opcion==0)
	{
	
	$impuesto=0;
	if(_mostrarimpuesto==1)
	{
		$datoimpuesto = ObtenerImpuesto($row_ConsultaFuncion["refImpuesto"]);
		$impuesto=$row_ConsultaFuncion["dblPrecio"] * ($datoimpuesto/100);
		
	}
	
	return number_format($row_ConsultaFuncion["dblPrecio"]+$impuesto, 2, ".", "");	
	}
	
	if($opcion==1)
	{
	return ($row_ConsultaFuncion["dblPrecio"]);	
	}
	mysqli_free_result($ConsultaFuncion);
}


function ObtenerImpuesto($idimpuesto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT dblImpuesto FROM tblimpuesto WHERE idImpuesto = %s ", 
	   GetSQLValueString($idimpuesto, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion["dblImpuesto"];	
	
	mysqli_free_result($ConsultaFuncion);
}


function CalcularImpuestoProducto($producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT dblPrecio, refImpuesto FROM tblproducto WHERE idProducto = %s ", 
	   GetSQLValueString($producto, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	$impuesto = ObtenerImpuesto($row_ConsultaFuncion["refImpuesto"]);
	
	return number_format($row_ConsultaFuncion["dblPrecio"]*($impuesto/100), 2, ".", "");	
	
	mysqli_free_result($ConsultaFuncion);
}


function opcionniveladministracion($padre,  $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblopcion WHERE refPadre = %s ",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?>
						<tr>
						<td><?php echo $row_ConsultaFuncion["idOpcion"];?></td>

							<td><?php echo  $pertenencia.$row_ConsultaFuncion["strNombre"];?></td>
								<td><?php echo MostrarEstado($row_ConsultaFuncion["intEstado"]);?></td>
								<td><?php echo $row_ConsultaFuncion["intOrden"];?></td>
								<td><?php echo $row_ConsultaFuncion["dblIncremento"];?></td>
							<td><a href="opciondetalle-edit.php?id=<?php echo $row_ConsultaFuncion["idOpcion"];?>" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a> </td>
						</tr>
			<?php
			
	 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function MostrarOpcionProductoEdit($opcion, $producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblproductoopcion WHERE refProducto = %s AND refOpcion=%s ",
		 GetSQLValueString($producto, "int"),
		 GetSQLValueString($opcion, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion==0) 
		return '<a type="button" class="btn btn-error btn-danger" href="productoopcion-add.php?opcion='.$opcion.'&id='.$producto.'"><i class="fa fa-times"></i></a>';
	else return '<a type="button" class="btn btn-success btn-circle" href="productoopcion-delete.php?opcion='.$opcion.'&id='.$producto.'"><i class="fa fa-check"></i></a>';
	
	mysqli_free_result($ConsultaFuncion);
}

function MostrarOpciones($producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblproductoopcion WHERE refProducto=%s ", 
	   GetSQLValueString($producto, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			MostrarOpcionesProductoSubopcion($row_ConsultaFuncion["refOpcion"])
			?>
			
		<br>

			
			<?php
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function MostrarOpcionesProductoSubopcion($opcion)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblopcion WHERE refPadre=%s AND intEstado=1 ORDER BY intOrden ASC ", 
	   GetSQLValueString($opcion, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		echo ObtenerNombreOpcion($opcion);
		?>
		<select name="intOpcion-<?php echo $opcion;?>" class="form-control" id="intOpcion-<?php echo $opcion;?>">
				
		<?php
		do { 
			?>
			<option value="<?php echo $row_ConsultaFuncion["idOpcion"]?>"><?php echo $row_ConsultaFuncion["strNombre"]?></option>
		
			<?php
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		?>
		</select>
		<?php
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function ObtenerNombreOpcion($opcion)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblopcion WHERE idOpcion = %s",
		 GetSQLValueString($opcion, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	
		return $row_ConsultaFuncion["strNombre"];
	else
		return "----";
	mysqli_free_result($ConsultaFuncion);
}

function ObtenerNombreCaracteristica($caracteristica)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblcaracteristica WHERE idCaracteristica = %s",
		 GetSQLValueString($caracteristica, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	
		return $row_ConsultaFuncion["strNombre"];
	else
		return "----";
	mysqli_free_result($ConsultaFuncion);
}

function caracteristicaniveladministracion($padre,  $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcaracteristica WHERE refPadre = %s ",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?>
						<tr>
						<td><?php echo $row_ConsultaFuncion["idCaracteristica"];?></td>

							<td><?php echo  $pertenencia.$row_ConsultaFuncion["strNombre"];?></td>
								<td><?php echo MostrarEstado($row_ConsultaFuncion["intEstado"]);?></td>
								<td><?php echo $row_ConsultaFuncion["intOrden"];?></td>
								
							<td><a href="caracteristicadetalle-edit.php?id=<?php echo $row_ConsultaFuncion["idCaracteristica"];?>" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a> </td>
						</tr>
			<?php
			
	 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function MostrarCaracteristicaProductoEdit($caracteristica, $producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcaracteristica WHERE refPadre=%s AND intEstado=1 ORDER BY intOrden ASC ", 
	   GetSQLValueString($caracteristica, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		//echo ObtenerNombreCaracteristica($caracteristica);
		$actual=ObtenerCaracteristicaSeleccionadaProducto($caracteristica, $producto);
		?>
		<select name="intCaracteristica-<?php echo $caracteristica;?>" class="form-control" id="intCaracteristica-<?php echo $caracteristica;?>">
			<option value="0" <?php if ($actual=="0") echo "selected"; ?>>No utilizado</option>
				
		<?php
		do { 
			?>
			<option value="<?php echo $row_ConsultaFuncion["idCaracteristica"]?>" <?php if ($actual==$row_ConsultaFuncion["idCaracteristica"]) echo "selected"; ?>><?php echo $row_ConsultaFuncion["strNombre"]?></option>
		
			<?php
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		?>
		</select>
		<?php
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function ObtenerCaracteristicaSeleccionadaProducto($caracteristica, $producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT refSeleccionada FROM tblproductocaracteristica WHERE refProducto = %s AND refCaracteristica= %s",
		 GetSQLValueString($producto, "int"),
		 GetSQLValueString($caracteristica, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	
		return $row_ConsultaFuncion["refSeleccionada"];
	else
		return "0";
	mysqli_free_result($ConsultaFuncion);
}

function MostrarCaracteristicaFrontEnd($producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblproductocaracteristica WHERE refProducto=%s ", 
	   GetSQLValueString($producto, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
		
		echo "<strong>".ObtenerNombreCaracteristica($row_ConsultaFuncion["refCaracteristica"]).": </strong>";
		echo ObtenerNombreCaracteristica($row_ConsultaFuncion["refSeleccionada"]);
			//$actual=ObtenerCaracteristicaSeleccionadaProducto($caracteristica, $producto);
			echo "<br>";
			} while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}


function MostrarBreadcrumbs($categoria)
{
	global $con;
	
	$nivel1="";
	$nivel2="";
	$nivel3="";
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE idCategoria = %s",
		 GetSQLValueString($categoria, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($row_ConsultaFuncion["refPadre"]!="0")
	{
		//ES DE SEGUNDO O TERCER NIVEL
		$query_ConsultaFuncion2 = sprintf("SELECT * FROM tblcategoria WHERE idCategoria = %s",
		 GetSQLValueString($row_ConsultaFuncion["refPadre"], "int"));
		//echo $query_ConsultaFuncion;
		$ConsultaFuncion2 = mysqli_query($con,  $query_ConsultaFuncion2) or die(mysqli_error($con));
		$row_ConsultaFuncion2 = mysqli_fetch_assoc($ConsultaFuncion2);
		$totalRows_ConsultaFuncion2 = mysqli_num_rows($ConsultaFuncion2);
		
		if ($row_ConsultaFuncion2["refPadre"]!="0")
		{
			//CONSIDERAMOS NIVEL 3
			$nivel2=$row_ConsultaFuncion2["strNombre"];
			$nivel3=$row_ConsultaFuncion["strNombre"];
			
			$query_ConsultaFuncion3 = sprintf("SELECT * FROM tblcategoria WHERE idCategoria = %s",
		 GetSQLValueString($row_ConsultaFuncion2["refPadre"], "int"));
		//echo $query_ConsultaFuncion;
		$ConsultaFuncion3 = mysqli_query($con,  $query_ConsultaFuncion3) or die(mysqli_error($con));
		$row_ConsultaFuncion3 = mysqli_fetch_assoc($ConsultaFuncion3);
		$totalRows_ConsultaFuncion3 = mysqli_num_rows($ConsultaFuncion3);
			
			$nivel1=$row_ConsultaFuncion3["strNombre"];
			
			
		}
		else
		{
			//CONSIDERAMOS NIVEL 2
			$nivel1=$row_ConsultaFuncion2["strNombre"];
			$nivel2=$row_ConsultaFuncion["strNombre"];
		}
		
		
		
	}
	else
	{
		//ES DE PRIMER NIVEL
		$nivel1=$row_ConsultaFuncion["strNombre"];
	}
	
	?>
	 <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Inicio</a></li>
				  <?php if ($nivel1!="") 
					echo '<li >'.$nivel1.'</li>'
					?>
					 <?php if ($nivel2!="") 
					echo '<li >'.$nivel2.'</li>'
					?>
					 <?php if ($nivel3!="") 
					echo '<li >'.$nivel3.'</li>'
					?>
				  
				</ol>
			</div>
	<?php
	
	mysqli_free_result($ConsultaFuncion);
}

function ObtenerNombreUsuario($usuario)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblusuario WHERE idUsuario = %s ",
		 GetSQLValueString($usuario, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion["strNombre"];
	
	mysqli_free_result($ConsultaFuncion);
}

function ObtenerNombreUsuarioCarro($usuariotempoactivo)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblusuario WHERE idUsuario = %s ",
		 GetSQLValueString($_SESSION["usuariotempoactivo"], "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion["strNombre"];
	
	mysqli_free_result($ConsultaFuncion);
}



function ObtenerMailUsuarioCarro($usuariotempoactivo)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strEmail FROM tblusuario WHERE idUsuario = %s ",
		 GetSQLValueString($usuariotempoactivo, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion["strEmail"];
	
	mysqli_free_result($ConsultaFuncion);
}




function ObtenerDNIUsuarioCarrito($usuariotempoactivo)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strDNI FROM tblcompra WHERE idUsuario = %s ",
		 GetSQLValueString($usuariotempoactivo, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion["strDNI"];
	
	mysqli_free_result($ConsultaFuncion);
}


function ObtenerZonaPedidoCarrito($zona)
{
	
	switch ($zona) {
    case 1:
         return '<button type="button" class="btn btn-success btn-xs">Barrio Norte</button>';
        break;
    case 8:
         return '<button type="button" class="btn btn-info btn-xs">Barrio Sur</button>';
        break;
    case 12:
         return '<button type="button" class="btn btn-warning btn-xs">Otra Zona</button>';
        break;

	}
}

function ObtenerDireccionUsuarioCarrito($usuariotempoactivo)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strDireccion FROM tblcompra WHERE idUsuario = %s ",
		 GetSQLValueString($usuariotempoactivo, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion["strDireccion"];
	
	mysqli_free_result($ConsultaFuncion);
}

function ObtenerZipCodeUsuarioCarrito($usuariotempoactivo)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strCP FROM tblcompra WHERE idUsuario = %s ",
		 GetSQLValueString($usuariotempoactivo, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion["strCP"];
	
	mysqli_free_result($ConsultaFuncion);
}

function ObtenerTelefonoCarrito($usuariotempoactivo)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strTelefono FROM tblcompra WHERE idUsuario = %s ",
		 GetSQLValueString($usuariotempoactivo, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion["strTelefono"];
	
	mysqli_free_result($ConsultaFuncion);
}

function EsYaUnDeseo($producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT idDeseo FROM tbldeseo WHERE refUsuario = %s AND refProducto=%s ",
		 GetSQLValueString($_SESSION['tradeactivitiesFront_UserId'], "int"),
		 GetSQLValueString($producto, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>=1) 
		return true;
	else return false;
	
	mysqli_free_result($ConsultaFuncion);
}



function EsYaUnComparar($producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT idComparar FROM tblcomparar WHERE refUsuario = %s AND refProducto=%s ",
		 GetSQLValueString($_SESSION['tradeactivitiesFront_UserId'], "int"),
		 GetSQLValueString($producto, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>=1) 
		return true;
	else return false;
	
	mysqli_free_result($ConsultaFuncion);
}



function MostrarCaracteristicasComparador($producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcaracteristica WHERE intEstado=1 AND refPadre=0 ORDER BY intOrden ASC");
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			echo "<b>".ObtenerNombreCaracteristica($row_ConsultaFuncion["idCaracteristica"])."</b><br>";
			echo ObtenerCaracteristicaSeleccionadaProductoComparador($row_ConsultaFuncion["idCaracteristica"], $producto);
			
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}


function ObtenerCaracteristicaSeleccionadaProductoComparador($caracteristica, $producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT refSeleccionada FROM tblproductocaracteristica WHERE refProducto = %s AND refCaracteristica= %s",
		 GetSQLValueString($producto, "int"),
		 GetSQLValueString($caracteristica, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	
		return ObtenerNombreCaracteristica($row_ConsultaFuncion["refSeleccionada"])."<br>";
	else
		return "--<br>";
	mysqli_free_result($ConsultaFuncion);
}


function InsertarUsuarioTemporal(){
	global $con;
	
	$insertSQL = sprintf("INSERT INTO tblusuario (strNombre, strEmail, intEstado, strPassword, fchAlta) VALUES (%s, %s, %s, %s, NOW())",
                       GetSQLValueString("", "text"),
                       GetSQLValueString("", "text"),
                       GetSQLValueString(1, "int"),
                       GetSQLValueString("", "text"));
  $Result1 = mysqli_query($con, $insertSQL) or die(mysqli_error($con));
  return mysqli_insert_id($con);
}

function ImportarCarritoTemporal($valortemporal)
{
	
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT idContador FROM tblcarrito WHERE tblcarrito.refUsuario = %s AND tblcarrito.intTransaccionEfectuada = 0", GetSQLValueString($_SESSION['MM2_Temporal'], "int"));
	$ConsultaFuncion = mysqli_query($con, $query_ConsultaFuncion) or die(mysqli_error());
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	if ($totalRows_ConsultaFuncion>0){
		do{
		
		$updateSQL = sprintf("UPDATE tblcarrito SET refUsuario=%s WHERE idContador=%s AND intTransaccionEfectuada = 0",         $valortemporal, $row_ConsultaFuncion["idContador"]);
  
  $Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));
		
		} while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion));
	}
	}


function AgregarOpcionesaCarrito($idcarrito, $producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblopcion WHERE intEstado=1 AND refPadre=0 ");
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			//BUSCO SOBRE tblproductoopcion para ver si tiene esa opcion activada
			
			$query_ConsultaOpcion = sprintf("SELECT * FROM tblproductoopcion WHERE refProducto=%s AND refOpcion=%s", 
					$producto,
					$row_ConsultaFuncion["idOpcion"]);
			//echo $query_ConsultaOpcion;
			$ConsultaOpcion = mysqli_query($con,  $query_ConsultaOpcion) or die(mysqli_error($con));
			$row_ConsultaOpcion = mysqli_fetch_assoc($ConsultaOpcion);
			$totalRows_ConsultaOpcion = mysqli_num_rows($ConsultaOpcion);
			
			//SI EXISTE COMO OPCION, HAY QUE AGREGARLA A LA TABLA RELACIONADA
			if ($totalRows_ConsultaOpcion==1)
				AgregarOpcionAProducto($idcarrito, $row_ConsultaFuncion["idOpcion"]);
			
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function AgregarOpcionAProducto($idcarrito, $opcion){
	global $con;
	
	$insertSQL = sprintf("INSERT INTO tblcarritodetalle (refCarrito, refOpcion, refOpcionseleccionada) VALUES (%s, %s, %s)",
                       GetSQLValueString($idcarrito, "int"),
                       GetSQLValueString($opcion, "int"),
                       GetSQLValueString($_POST["intOpcion-".$opcion], "int"));
  $Result1 = mysqli_query($con, $insertSQL) or die(mysqli_error($con));
}

function comprobarexistencia($idproducto, $idusuario)
{

	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcarrito WHERE refUsuario = %s AND refProducto=%s AND intTransaccionEfectuada = 0", $idusuario,$idproducto );
	$ConsultaFuncion = mysqli_query($con, $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion >0) 
	{
		//Do While para recorrer toda la tabla 
		do{
		$valor=ComprobarOpcionesdeCarrito($idproducto, $row_ConsultaFuncion["idContador"]);
		//EL PRODUCTO YA EXISTE EN EL CARRITO PENDIENTE, HAY QUE COMPROBAR QUE LAS OPCIONES SON LAS MISMAS
		if ($valor==1){
			return $row_ConsultaFuncion["idContador"];
			exit;
		}
		 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
	}
	else
	return 0;
	mysqli_free_result($ConsultaFuncion);
}

function ComprobarOpcionesdeCarrito($producto, $idcompra)
{
	global $con;
	
	$coincide=1;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblopcion WHERE intEstado=1 AND refPadre=0 ");
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			//BUSCO SOBRE tblproductoopcion para ver si tiene esa opcion activada
			
			$query_ConsultaOpcion = sprintf("SELECT * FROM tblproductoopcion WHERE refProducto=%s AND refOpcion=%s", 
					$producto,
					$row_ConsultaFuncion["idOpcion"]);
			//echo $query_ConsultaOpcion;
			$ConsultaOpcion = mysqli_query($con,  $query_ConsultaOpcion) or die(mysqli_error($con));
			$row_ConsultaOpcion = mysqli_fetch_assoc($ConsultaOpcion);
			$totalRows_ConsultaOpcion = mysqli_num_rows($ConsultaOpcion);
			
			//SI EXISTE COMO OPCION, HAY QUE COMPROBAR SI TIENE EL MISMO VALOR QUE LA QUE ESTAMOS INTENTANDO INSERTAR
			if ($totalRows_ConsultaOpcion==1)
			{
				
				$query_ConsultaOpcion2 = sprintf("SELECT * FROM tblcarritodetalle WHERE refCarrito=%s AND refOpcion=%s", 
					$idcompra,
					$row_ConsultaFuncion["idOpcion"]);
			//echo $query_ConsultaOpcion;
			$ConsultaOpcion2 = mysqli_query($con,  $query_ConsultaOpcion2) or die(mysqli_error($con));
			$row_ConsultaOpcion2 = mysqli_fetch_assoc($ConsultaOpcion2);
			$totalRows_ConsultaOpcion2 = mysqli_num_rows($ConsultaOpcion2);
				
			$seleccionada=$row_ConsultaOpcion2["refOpcionSeleccionada"];
				if ($seleccionada!=$_POST["intOpcion-".$row_ConsultaFuncion["idOpcion"]])
				 {
					$coincide=0;
				 }

			}
	
				//AgregarOpcionAProducto($idcarrito, $row_ConsultaFuncion["idOpcion"]);
			
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	
	mysqli_free_result($ConsultaFuncion);
	return $coincide;
}


function MostrarOpcionesProductoCarrrito($LineaCarrito)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcarritodetalle WHERE refCarrito=%s ", 
	   GetSQLValueString($LineaCarrito, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			
			echo ObtenerNombreOpcion($row_ConsultaFuncion["refOpcion"]).": ";
			

			echo ObtenerNombreOpcion($row_ConsultaFuncion["refOpcionSeleccionada"]);
			
			
			
			?>
			
		<br>

			
			<?php
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function MostrarCantidadCarrito()
{
	global $con;
	
	if ((isset($_SESSION['tradeactivitiesFront_UserId'])) || (isset($_SESSION['MM2_Temporal'])))
	{
		if ($_SESSION['MM2_Temporal']=="ELEVADO")
		$usuariotempoactivo=$_SESSION['tradeactivitiesFront_UserId'];
		else
		$usuariotempoactivo=$_SESSION['MM2_Temporal'];
	}
	//Con SUM(intCantidad) lo que hago es sumar la cantidad de productos que tengo en el carrito
	//con COUNT(idContador) lo que hago es contar la cantidad de productos diferentes tengo en el carrito
	$query_ConsultaFuncion = sprintf("SELECT SUM(intCantidad) AS Total FROM tblcarrito WHERE refUsuario = %s AND intTransaccionEfectuada=0 ", 
	   GetSQLValueString($usuariotempoactivo, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	if(($row_ConsultaFuncion["Total"])!=NULL){
	echo "(".$row_ConsultaFuncion["Total"].")";		
	}
	else
		echo "(0)";
	
	
	mysqli_free_result($ConsultaFuncion);
}


function MostrarDatosUsuarioCarritoActivo()
{
	global $con;
	
	if ((isset($_SESSION['tradeactivitiesFront_UserId'])) || (isset($_SESSION['MM2_Temporal'])))
	{
		if ($_SESSION['MM2_Temporal']=="ELEVADO")
		$usuariotempoactivo=$_SESSION['tradeactivitiesFront_UserId'];
		else
		$usuariotempoactivo=$_SESSION['MM2_Temporal'];
	}
	//Con SUM(intCantidad) lo que hago es sumar la cantidad de productos que tengo en el carrito
	//con COUNT(idContador) lo que hago es contar la cantidad de productos diferentes tengo en el carrito
	$query_ConsultaFuncion = sprintf("SELECT strNombre, strEmail FROM tblcarrito WHERE refUsuario = %s AND intTransaccionEfectuada=0 ", 
	   GetSQLValueString($usuariotempoactivo, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	
	mysqli_free_result($ConsultaFuncion);
}


function MostrarPedidosActivos()
{
	global $con;
	
	//Con SUM(intCantidad) lo que hago es sumar la cantidad de productos/pedidos
	//con COUNT(idContador) lo que hago es contar la cantidad de productos/pedidos diferentes tengo en el carrito
	$query_ConsultaFuncion = sprintf("SELECT COUNT(idCompra) AS Total FROM tblcompra WHERE intEstado!=0 ");
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	
	mysqli_free_result($ConsultaFuncion);
}


function zonaniveladministracion($padre,  $pertenencia = "")
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblzona WHERE refPadre = %s ",
		 GetSQLValueString($padre, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			?>
						<tr>
						<td><?php echo $row_ConsultaFuncion["idZona"];?></td>

							<td><?php echo  $pertenencia.$row_ConsultaFuncion["strNombre"];?></td>
								<td><?php echo MostrarEstado($row_ConsultaFuncion["intEstado"]);?></td>
								<td><?php echo $row_ConsultaFuncion["dblInferior"].' (Kg)';?></td>
								<td><?php echo $row_ConsultaFuncion["dblSuperior"].' (Kg)';?></td>
								<td><?php echo '$'.$row_ConsultaFuncion["dblCoste"];?></td>
							<td><a href="zonadetalle-edit.php?id=<?php echo $row_ConsultaFuncion["idZona"];?>" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a> </td>
						</tr>
			<?php
			
	 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
}

function CalcularPortes($peso, $zona)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblzona WHERE refPadre = %s ",
		 GetSQLValueString($zona, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	$coste=0;
	
	
	if ($totalRows_ConsultaFuncion>0)	{
		do { 
			if (($peso>$row_ConsultaFuncion["dblInferior"]) && ($peso<=$row_ConsultaFuncion["dblSuperior"]))
			
				$coste=$row_ConsultaFuncion["dblCoste"];
			
			 } while ($row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion)); 
		
	}
	mysqli_free_result($ConsultaFuncion);
	return $coste;
}


function ConfirmacionPago($tipopago, $estado)
{

	global $con;

	//$_SESSION["usuariotempoactivo"]
		
	//$_SESSION["Total"]=$_SESSION["PrecioFinal"]+$_SESSION["PrecioFinal"]*$iva;

	$insertSQL = sprintf("INSERT INTO tblcompra (idUsuario, fchCompra, intTipoPago, dblTotalIVA, dblTotalsinIVA, intFacturacion, intEnvio, intEstado, intZona, strNombre, strDNI, strDireccion, strPiso, strProvincia, strCP, strEmail, strTelefono ) VALUES (%s, NOW(), %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_SESSION["usuariotempoactivo"], "int"),
					   $tipopago,
					   GetSQLValueString($_SESSION["Total"],"double"),
					   GetSQLValueString($_SESSION["TotalsinImpuestos"],"double"),
					   0,
					   0,
					   $estado,
						$_SESSION["COMPRA_intZona"],
						GetSQLValueString($_SESSION["COMPRA_strNombre"],"text"),
						GetSQLValueString($_SESSION["COMPRA_strDNI"],"text"),
						GetSQLValueString($_SESSION["COMPRA_strDireccion"],"text"),
						GetSQLValueString($_SESSION["COMPRA_strPiso"],"text"),
						GetSQLValueString($_SESSION["COMPRA_strProvincia"],"text"),
						GetSQLValueString($_SESSION["COMPRA_strCP"],"text"),
						GetSQLValueString($_SESSION["COMPRA_strEmail"],"text"),
						GetSQLValueString($_SESSION["COMPRA_strTelefono"],""));
  $Result1 = mysqli_query($con, $insertSQL) or die(mysqli_error($con));
  $ultimacompra = mysqli_insert_id($con);
  $_SESSION["compraactivavisa"] = $ultimacompra;
  ActualizacionCarrito($ultimacompra);
  //ActualizacionStock($ultimacompra);
  
}

function ActualizacionCarrito($idCompra)
{
	
	global $con;
		
		$updateSQL = sprintf("UPDATE tblcarrito SET intTransaccionEfectuada=%s WHERE refUsuario=%s AND intTransaccionEfectuada = 0",
					$idCompra,
					$_SESSION["usuariotempoactivo"]);
  
  $Result1 = mysqli_query($con, $updateSQL) or die(mysqli_error($con));

}

function comprobarseonoexiste($strSEO)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strSEO FROM tblproducto WHERE strSEO = %s ",
		 GetSQLValueString($strSEO, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion==0) 
		return true;
	else return false;
	
	mysqli_free_result($ConsultaFuncion);
}

function comprobarseounico($idactual, $strSEO)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strSEO FROM tblproducto WHERE strSEO = %s AND idProducto <> %s ",
		 GetSQLValueString($strSEO, "text"),
		 GetSQLValueString($idactual, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion==0) 
		return true;
	else return false;
	
	mysqli_free_result($ConsultaFuncion);
}

function comprobarseocategorianoexiste($strSEO)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strSEO FROM tblcategoria WHERE strSEO = %s ",
		 GetSQLValueString($strSEO, "text"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion==0) 
		return true;
	else return false;
	
	mysqli_free_result($ConsultaFuncion);
}


function comprobarseocategoriaunico($idactual, $strSEO)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT strSEO FROM tblcategoria WHERE strSEO = %s AND idCategoria <> %s ",
		 GetSQLValueString($strSEO, "text"),
		 GetSQLValueString($idactual, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($totalRows_ConsultaFuncion==0) 
		return true;
	else return false;
	
	mysqli_free_result($ConsultaFuncion);
}


function GenerarRutaCategoria($categoria)
{
	global $con;
	
	$nivel1="";
	$nivel2="";
	$nivel3="";
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblcategoria WHERE idCategoria = %s",
		 GetSQLValueString($categoria, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	if ($row_ConsultaFuncion["refPadre"]!="0")
	{
		//ES DE SEGUNDO O TERCER NIVEL
		$query_ConsultaFuncion2 = sprintf("SELECT * FROM tblcategoria WHERE idCategoria = %s",
		 GetSQLValueString($row_ConsultaFuncion["refPadre"], "int"));
		//echo $query_ConsultaFuncion;
		$ConsultaFuncion2 = mysqli_query($con,  $query_ConsultaFuncion2) or die(mysqli_error($con));
		$row_ConsultaFuncion2 = mysqli_fetch_assoc($ConsultaFuncion2);
		$totalRows_ConsultaFuncion2 = mysqli_num_rows($ConsultaFuncion2);
		
		if ($row_ConsultaFuncion2["refPadre"]!="0")
		{
			//CONSIDERAMOS NIVEL 3
			$nivel2=$row_ConsultaFuncion2["strSEO"];
			$nivel3=$row_ConsultaFuncion["strSEO"];
			
			$query_ConsultaFuncion3 = sprintf("SELECT * FROM tblcategoria WHERE idCategoria = %s",
		 GetSQLValueString($row_ConsultaFuncion2["refPadre"], "int"));
		//echo $query_ConsultaFuncion;
		$ConsultaFuncion3 = mysqli_query($con,  $query_ConsultaFuncion3) or die(mysqli_error($con));
		$row_ConsultaFuncion3 = mysqli_fetch_assoc($ConsultaFuncion3);
		$totalRows_ConsultaFuncion3 = mysqli_num_rows($ConsultaFuncion3);
			
			$nivel1=$row_ConsultaFuncion3["strSEO"];
			
			
		}
		else
		{
			//CONSIDERAMOS NIVEL 2
			$nivel1=$row_ConsultaFuncion2["strSEO"];
			$nivel2=$row_ConsultaFuncion["strSEO"];
		}
		
		
		
	}
	else
	{
		//ES DE PRIMER NIVEL
		$nivel1=$row_ConsultaFuncion["strSEO"];
	}
	
	$rutacompleta = "";
	  if ($nivel1!="") 
	$rutacompleta=$nivel1.'/';
	 if ($nivel2!="") 
	$rutacompleta=$rutacompleta.$nivel2.'/';
	 if ($nivel3!="")
	$rutacompleta=$rutacompleta.$nivel3.'/';
	
	return $rutacompleta; 
	
	mysqli_free_result($ConsultaFuncion);
}

function InsertarVisitaProducto($producto, $usuario){
	global $con;
	
	$insertSQL = sprintf("INSERT INTO tblproductovisita (refUsuario, refProducto) VALUES (%s, %s)",
                       GetSQLValueString($usuario, "int"),
                       GetSQLValueString($producto, "int"));
  $Result1 = mysqli_query($con, $insertSQL) or die(mysqli_error($con));
  return mysqli_insert_id($con);
}

	

	
?>