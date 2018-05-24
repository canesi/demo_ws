<?php
    	/* incluir script de conexion */
    	include('connect.php');

    	/* crear objeto de conexion */
    	$con = new Conexion();

    	/* obtener la conexion en variable $conn */    
    	$enlace = $con->conectar_comp();

	//parametros a recibir
	$nombre = $_POST['username'];

	/* verificar la conexi�n */
	if (mysqli_connect_errno()) {
	    printf("Conexi�n fallida: %s\n", mysqli_connect_error());
	    exit();
	}else{
		
		//$consulta = "SELECT region FROM mercaderista WHERE username = '".$nombre."' ";
		$consulta = "SELECT supervisor FROM mercaderista WHERE mercaderista.username = '".$nombre."' ";

		if ($resultado = mysqli_query($enlace, $consulta)) {

		    /* obtener array asociativo */
		    while ($row = mysqli_fetch_assoc($resultado)) {
		        printf ("%s \n", $row["supervisor"]);
		    }

		    /* liberar el conjunto de resultados */
		    mysqli_free_result($resultado);
		}

		/* cerrar la conexi�n */
		mysqli_close($enlace);
	}
	
?>
