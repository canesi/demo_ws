<?php

/* incluir script de conexion */
include('connect.php');

/* parametros a recibir */
$visita = $_POST['visita'];
$sku = $_POST['sku'];
$valor = $_POST['valor'];
$flag = $_POST['flag'];

/* crear objeto de conexion */
$con = new Conexion();

/* obtener la conexion en variable $conn */    
$conn = $con->conectar_kc();

/* comprobar la conexión */
if (mysqli_connect_errno()) {
    echo "Fallo la conexion a la Base de datos";
    exit();
}else{
	$query ="insert into inventario (visita,sku,valor,flag) values ('$visita','$sku','$valor','$flag')";
	mysqli_query($conn,$query);
	mysqli_close($conn);
}
?>
