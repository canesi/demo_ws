<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

	//se reciben los parametros via POST
	$visita = $_POST['visita'];
	$cliente = $_POST['cliente'];
	$merca = $_POST['merca'];
	$item = $_POST['item'];
	$imagen = $_POST['valor'];
	$fecha = $_POST['fecha'];
	$punteo = $_POST['punteo'];
	$cliente_externo = $_POST['cliente_externo'];
	$longitud = $_POST['longitud'];
	$latitud = $_POST['latitud'];
	$numero_imagen = $_POST['numero_imagen'];
	$master_plan = $_POST['idmp'];

	$nombre_imagen = $visita."_".$cliente."_".$fecha."_".$merca."_".$numero_imagen.".jpeg";
	$nombre_imagen_webview = "https://ourmycis.com/images_kc/master_plan/".$nombre_imagen;

	//en esta variable se guarda el nombre de la imagen con la ruta
	$ruta_imagen = "/upload/scm-mercadeo/imagenes/".$nombre_imagen;
	$ruta_imagen_webview = "/var/www/html/images_kc/master_plan/".$nombre_imagen;

	$Base64Img = "data:image/jpeg;base64,'".$imagen."' ";

	list(, $Base64Img) = explode(';', $Base64Img);
	list(, $Base64Img) = explode(',', $Base64Img);

	$Base64Img = base64_decode($Base64Img);
	//escribimos la información obtenida en un archivo llamado

	file_put_contents($ruta_imagen, $Base64Img) or die ("Error al escribir");
	file_put_contents($ruta_imagen_webview, $Base64Img) or die ("Error al escribir");

	//echo "<img src='unodepiera.png' alt='unodepiera' />";
	//trabajar con la base de datos

	/* comprobar la conexión */
	if (mysqli_connect_errno()) {
	    echo "Fallo la conexion a la Base de datos";
	    exit();
	}else{

		$query ="insert into respuesta(visita,cliente,mercaderista,item,valor,fecha_hora,longitud,latitud,punteo,cliente_externo)
		values ('$visita','$cliente','$merca','$item','$nombre_imagen','$fecha','$longitud','$latitud','$punteo','$cliente_externo')";
	  	//actualizar campo fotografia en la tabla master plan
	  	
	  	$querymp = "UPDATE master_plan SET fotografia = '$nombre_imagen_webview' WHERE id_master_plan = '$master_plan' ";
		
		mysqli_query($enlace,$query);
	  	
	  	mysqli_query($enlace,$querymp);
		
		mysqli_close($enlace);
	}

?>
