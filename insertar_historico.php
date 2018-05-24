<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

	//parametros a recibir
	$fecha_hora = $_POST['fecha_hora'];
	$mercaderista = $_POST['mercaderista'];
	$accion = $_POST['accion'];
	$version_aplicacion = $_POST['version_aplicacion'];

	/* comprobar la conexión */
	if (mysqli_connect_errno()) {
	    echo "Fallo la conexion a la Base de datos";
	    exit();
	}else{
		$query ="insert into historico_offline (fecha_hora,mercaderista,accion,version_aplicacion) values ('$fecha_hora','$mercaderista','$accion','$version_aplicacion')";
		mysqli_query($enlace,$query);
		mysqli_close($enlace);
	}
	
?>
