<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

    //parametros a recibir
	$fecha = $_POST['fecha'];
	$cliente = $_POST['cliente'];
	$merca = $_POST['merca'];
	$estado = $_POST['estado'];
	$index_visita = $_POST['index_visita'];
	$longitud = $_POST['longitud'];
	$latitud = $_POST['latitud'];

	/* comprobar la conexión */
	if (mysqli_connect_errno()) {
		echo "Fallo la conexion a la Base de datos";
		exit();
	}else{
		
		$time = time();
		
		$fecha_sincronizacion = date("Y-m-d H:i:s", $time);
		
		$query ="insert into visita (fecha,cliente,mercaderista,estado,index_visita,longitud,latitud,fecha_sincronizacion) values ('$fecha','$cliente','$merca','$estado','$index_visita','".$longitud."','".$latitud."','$fecha_sincronizacion')";
		
		mysqli_query($enlace,$query);
		
		echo "ingresada";
	}


	mysqli_close($enlace);
?>
