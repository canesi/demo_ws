<?php
	/* incluir script de conexion */
    include('connect.php');

    /* parametros a recibir */
    $nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$tipo_cliente = $_POST['tipo_cliente'];
	$region = $_POST['region'];
	$departamento = $_POST['departamento'];
	$municipio = $_POST['municipio'];
	$zona = $_POST['zona'];
	$territorio = $_POST['territorio'];
	$fechaHora = $_POST['fechaHora'];
	$supervisor = $_POST['supervisor'];
	$activo = $_POST['activo'];
	$longitud = $_POST['longitud'];
	$latitud = $_POST['latitud'];
	
    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $conn = $con->conectar_kc();


	/* comprobar la conexión */
	if (mysqli_connect_errno()) {
    	echo "Fallo la conexion a la Base de datos";
    	exit();
	}else{

			/* antes de insertar cliente consultar cliente_externo por medio del id supervisor */
			$queryce="SELECT cliente_externo FROM supervisor_cliente_externo WHERE supervisor = '".$supervisor."' ";

			mysqli_report(MYSQLI_REPORT_STRICT);
			mysqli_query($conn,"SET CHARSET utf8");
			
			if(mysqli_query($conn,$queryce)){
				//ejecutar consulta
    			$result1= mysqli_query($conn,$queryce);

    			//buscar el id del cliente
    			mysqli_data_seek ($result1, 0);
    		
    			//obtener dato de registro
    			$resultce= mysqli_fetch_array($result1);
    		
    			//obtener resultado de la consulta */
    			$cliente_externo = $resultce['cliente_externo'];
    			
    			//evaluar cliente externo que no sea nulo
    			if(empty($cliente_externo)){
    				echo "error al obtener id cliente externo";
    				exit();
    			}else{
    				/* query para insertar el cliente */
					$query ="insert into cliente (nombre,direccion,tipo_cliente,region,departamento,municipio,zona,territorio,fecha_autorizacion,supervisor,activo,longitud,latitud,cliente_externo) values ('$nombre','$direccion','$tipo_cliente','$region','$departamento','$municipio','$zona','$territorio','$fechaHora','$supervisor','$activo','$longitud','$latitud','$cliente_externo')";

					mysqli_report(MYSQLI_REPORT_STRICT);
					mysqli_query($conn,"SET CHARSET utf8");
		
					/* evaluar si se produjo error en la insercion */
					if(mysqli_query($conn,$query)){
					/* recuperar id del cliente insertado */
			
					//construir el query para obtener el id 
					$queryid="SELECT id_cliente FROM cliente WHERE region = '".$region."' AND fecha_autorizacion = '".$fechaHora."' AND departamento = '".$departamento."' AND municipio = '".$municipio."' AND zona = '".$zona."' AND territorio = '".$territorio."'";

					//ejecutar consulta
    				$result= mysqli_query($conn,$queryid);

    				//buscar el id del cliente
    				mysqli_data_seek ($result, 0);
    		
    				//obtener dato de registro
    				$resultid= mysqli_fetch_array($result);
    		
    				//obtener resultado de la consulta */
    				$id_cliente= $resultid['id_cliente'];
    		
    				//imprimir el id del cliente
    				echo $id_cliente;
					}else{echo "error_insercion";}
    			}
			}else{echo "error en conexion";}
		/* cerrar conexion a db */
		mysqli_close($conn);
	}
?>