<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

	//parametros a recibir
	$visita = $_POST['visita'];
	$sku = $_POST['sku'];
	$flag = $_POST['flag'];


	/* comprobar la conexión */
	if (mysqli_connect_errno()) {
	    echo "Fallo la conexion a la Base de datos";
	    exit();
	}else{
		$query ="insert into faltante (visita,sku,flag) values ('$visita','$sku','$flag')";
		
		mysqli_query($enlace,$query);
		
		mysqli_close($enlace);
	}

?>
