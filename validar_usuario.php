<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

    //parametros a recibir
    $username = $_POST['username'];

    /* comprobar la conexión */
    if (mysqli_connect_errno()) {
        printf("Falló la conexión: %s\n", mysqli_connect_error());
        exit();
    }else{
        $consulta = "SELECT supervisor.username FROM supervisor WHERE supervisor.username = '".$username."' ";

        if ($sentencia = mysqli_prepare($enlace, $consulta)) {

            /* ejecutar la consulta */
            mysqli_stmt_execute($sentencia);

            /* almacenar el resultado */
            mysqli_stmt_store_result($sentencia);

            $fila = mysqli_stmt_num_rows($sentencia);

            if($fila == 0){
                echo "no es supervisor";
            }else{
                echo "es supervisor";
            }

            /* cerrar la sentencia */
            mysqli_stmt_close($sentencia);
        }

        /* cerrar la conexión */
        mysqli_close($enlace);
    }

?>
