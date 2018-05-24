<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

    //parametros a recibir
	$cliente = $_POST['cliente'];
	$merca = $_POST['merca'];
	$procesado = $_POST['procesado'];
	$fechaHora = $_POST['fecha'];
	$item = $_POST['item'];
	$valor = $_POST['valor'];


	/* comprobar la conexi�n */
	if (mysqli_connect_errno()) {
	    echo "Fallo la conexion a la Base de datos";
	    exit();
	}else{
		$query ="INSERT INTO cliente_baja (cliente,mercaderista,procesado,fechaHora,item,valor) values ('$cliente','$merca','$procesado','$fechaHora','$item','$valor')";
		mysqli_query($enlace,"SET CHARSET utf8");
		mysqli_query($enlace,$query);
		mysqli_close($enlace);
	}

?>
