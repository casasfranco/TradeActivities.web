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
			<li><a href="categoria.php?id=<?php echo $row_ConsultaFuncion["idCategoria"];?>"><?php echo $row_ConsultaFuncion["strNombre"];?> </a>
			<ul>
				<?php MostrarSubSubcategorias($row_ConsultaFuncion["idCategoria"]);?>
				</ul>
			</li>
			<?php
				
			}
			else 
			{
			?><li><a href="categoria.php?id=<?php echo $row_ConsultaFuncion["idCategoria"];?>"><?php echo $row_ConsultaFuncion["strNombre"];?> </a>
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
			<li><a href="categoria.php?id=<?php echo $row_ConsultaFuncion["idCategoria"];?>"><?php echo $row_ConsultaFuncion["strNombre"];?> </a>
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

function MostrarProducto($id)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT * FROM tblproducto WHERE idProducto = %s ",
		 GetSQLValueString($id, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	$linkProducto="producto-detalle.php?id=".$row_ConsultaFuncion["idProducto"];
	
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
			
				
				<h2><?php echo CalcularPrecioProducto($row_ConsultaFuncion["idProducto"]); ?></h2>
				<p><?php echo $row_ConsultaFuncion["strNombre"]; ?></p>
				<a href="<?php echo $linkProducto;?>" class="btn btn-default add-to-cart"><i class="fa fa-cog"></i>Ver</a>
				<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Comprar</a>
			</div>

	</div>
	<div class="choose">
		<ul class="nav nav-pills nav-justified" id="deseolista<?php echo $row_ConsultaFuncion["idProducto"];?>">
			<li id="deseoli<?php echo $row_ConsultaFuncion["idProducto"];?>"><a href="javascript:void(0);" class="Adeseos" id="deseo<?php echo $row_ConsultaFuncion["idProducto"];?>"><i class="fa fa-plus-square"></i>A mis deseos</a></li>
			<li><a href="#"><i class="fa fa-plus-square"></i>Al comparador</a></li>
		</ul>
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

function CochesporMarca($marca)
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

function CalcularPrecioProducto($producto)
{
	global $con;
	
	$query_ConsultaFuncion = sprintf("SELECT dblPrecio FROM tblproducto WHERE idProducto = %s ", 
	   GetSQLValueString($producto, "int"));
	//echo $query_ConsultaFuncion;
	$ConsultaFuncion = mysqli_query($con,  $query_ConsultaFuncion) or die(mysqli_error($con));
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return number_format($row_ConsultaFuncion["dblPrecio"], 2, ",", "")."€";	
	
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
		return $row_ConsultaFuncion["strNombre"].":";
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

function MostrarCaracteristicasFrontEnd($producto)
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


?>