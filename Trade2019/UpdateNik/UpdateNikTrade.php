<html><head><meta charset="utf-8"></head>

<body>

<?php
     $local_file = "Novedades.sql";
     $wHayErrores = "NO";
     $link = mysqli_connect('localhost', 'tradeact_casasf', 'FORMULA2011formula2011');
     mysqli_select_db($link, "tradeact_trade2019");
     $tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes
	 
     if (file_exists($local_file)) {
      $file = fopen("$local_file", "r") or die("Unable to open file!");
      //Output a line of the file until the end is reached      
      while(!feof($file)) {
       $wSentencia = fgets($file);	   
	   if ($wSentencia!="") {
		$result = mysqli_query($link, $wSentencia);
		   
		if (!$result) {
			echo "Error al procesar la $wSentencia<br>";
			$wHayErrores = "SI";
		}
	   }	   
      }
      
	  if ($wHayErrores!="SI") echo "Lista de Precios Actualizada Correctamente...<br>";
      fclose($file);
	 }
	 else echo "No se ha encontrado el archivo $local_file<br>";
     
     mysqli_free_result($result);
     mysqli_close($link);	 
?>

<?php


/*
mysqli_data_seek ($result, 0);

$extraido= mysqli_fetch_array($result);

echo "- Nombre: ".$extraido['strNombre']."<br/>";
*/


?>

</body>

</html>
