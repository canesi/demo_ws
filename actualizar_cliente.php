<?php

	/* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $conn = $con->conectar_comp();

	//parametros a recibir
	$codigo = $_POST['codigo'];
	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];


	/* comprobar la conexión */
	if (mysqli_connect_errno()) {
    	echo "Fallo la conexion a la Base de datos";
    	exit();
	}else{
		/* evaluar los parametros recibidos */
		if(!empty($nombre) && !empty($direccion)){
			actualizar($codigo,$nombre,$direccion,$conn);
		}else if(!empty($nombre) && empty($direccion)){
			//actualizar solo el nombre
			actualizarnombre($codigo,$nombre,$conn);
		}else if(empty($nombre) && !empty($direccion)){
			actualizardireccion($codigo,$direccion,$conn);
		}else if(empty($nombre) && empty($direccion)){
			//los parametros estan vacios
			exit();
		}
		mysqli_close($conn);
	}	
	
	function actualizar($cod,$nom,$dir,$enlacex){
		if (mysqli_connect_errno()) {
			echo "Fallo la conexion a la Base de datos";
			exit();
		}else{
			$query ="UPDATE cliente SET nombre = '".$nom."', direccion = '".$dir."' WHERE id_cliente = ".$cod." ";
			mysqli_query($enlacex,"SET CHARSET utf8");
			mysqli_query($enlacex,$query);
			echo $query;
		}
	}

	function actualizarnombre($cod,$nom,$enlacex){
		if (mysqli_connect_errno()) {
			echo "Fallo la conexion a la Base de datos";
			exit();
		}else{
			$query ="UPDATE cliente SET nombre = '".$nom."' WHERE id_cliente = ".$cod." ";
			mysqli_query($enlacex,"SET CHARSET utf8");
			mysqli_query($enlacex,$query);
			echo $query;
		}
	}
	
	function actualizardireccion($cod,$dir,$enlacex){
		if (mysqli_connect_errno()) {
			echo "Fallo la conexion a la Base de datos";
			exit();
		}else{
			$query ="UPDATE cliente SET direccion = '".$dir."' WHERE id_cliente = ".$cod." ";
			mysqli_query($enlacex,"SET CHARSET utf8");
			mysqli_query($enlacex,$query);
			echo $query;
		}
	}
		
?>
