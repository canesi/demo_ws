<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

	//parametros a recibir
	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$region = $_POST['region'];
	$departamento = $_POST['departamento'];
	$municipio = $_POST['municipio'];
	$zona = $_POST['zona'];
	$territorio = $_POST['territorio'];
	$tipo_cliente = $_POST['tipo_cliente'];
	$mercaderista = $_POST['mercaderista'];
	$supervisor = $_POST['supervisor'];
	$dia = $_POST['dia'];
	$semana = $_POST['semana'];
	$index_ruta = $_POST['index_ruta'];
	$procesado = $_POST['procesado'];
	$longitud = $_POST['longitud'];
	$latitud = $_POST['latitud'];
	$fechaHora = $_POST['fechaHora'];


	/* comprobar la conexión */
	if (mysqli_connect_errno()) {
	    echo "Fallo la conexion a la Base de datos";
	    exit();
	}else{
		
		$query ="insert into cliente_alta (nombre,direccion,region,departamento,municipio,zona,territorio,tipo_cliente,mercaderista,supervisor,dia,semana,index_ruta,procesado,longitud,latitud,fechaHora) values ('$nombre','$direccion','$region','$departamento','$municipio','$zona','$territorio','$tipo_cliente','$mercaderista','$supervisor','$dia','$semana','$index_ruta','$procesado','$longitud','$latitud','$fechaHora')";
		
		mysqli_query($enlace,"SET CHARSET utf8");

		mysqli_query($enlace,$query);
		
		mysqli_close($enlace);
	}

?>