<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

	//parametros a recibir
	$visita = $_POST['visita'];
	$cliente = $_POST['cliente'];
	$merca = $_POST['merca'];
	$item = $_POST['item'];
	$valor = $_POST['valor'];
	$fecha = $_POST['fecha'];
	$longitud = $_POST['longitud'];
	$latitud = $_POST['latitud'];
	$punteo = $_POST['punteo'];
	$cliente_externo = $_POST['cliente_externo'];
	$longitud = $_POST['longitud'];
	$latitud = $_POST['latitud'];


	/* comprobar la conexi�n */
	if (mysqli_connect_errno()) {
	    echo "Fallo la conexion a la Base de datos";
	    exit();
	}else{
		$query ="insert into respuesta (visita,cliente,mercaderista,item,valor,fecha_hora,longitud,latitud,punteo,cliente_externo) values ('$visita','$cliente','$merca','$item','$valor','$fecha','$longitud','$latitud','$punteo','$cliente_externo')";
	
		mysqli_query($enlace,"SET CHARSET utf8");
		
		mysqli_query($enlace,$query);
		
		mysqli_close($enlace);
	}
	
?>
