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


	/* verificar la conexi�n */
	if (mysqli_connect_errno()) {
	    printf("Conexi�n fallida: %s\n", mysqli_connect_error());
	    exit();
	}else{
		//$consulta = "SELECT id_mercaderista FROM mercaderista WHERE username = '".$nombre."' ";
		$consulta = "SELECT id_visita FROM visita where fecha = '$fecha' AND cliente = '$cliente' AND mercaderista = '$merca'";

		if ($resultado = mysqli_query($enlace, $consulta)) {

		    /* obtener array asociativo */
		    while ($row = mysqli_fetch_assoc($resultado)) {
		        printf ("%s \n", $row["id_visita"]);
		    }

		    /* liberar el conjunto de resultados */
		    mysqli_free_result($resultado);
		}

		/* cerrar la conexi�n */
		mysqli_close($enlace);
	}

?>