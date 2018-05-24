<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

    //parametros a recibir
    $username = $_POST['username'];
    $password = $_POST['password'];


    /* comprobar la conexión */
    if (mysqli_connect_errno()) {
        printf("Falló la conexión: %s\n", mysqli_connect_error());
        exit();
    }else{
        $consulta = "SELECT user.username, user.password,mercaderista.id_mercaderista FROM user,mercaderista WHERE user.active = 1 AND user.username = '".$username."' AND user.password = '".$password. "' AND user.username = mercaderista.username";

        if ($sentencia = mysqli_prepare($enlace, $consulta)) {

            /* ejecutar la consulta */
            mysqli_stmt_execute($sentencia);

            /* almacenar el resultado */
            mysqli_stmt_store_result($sentencia);

            $fila = mysqli_stmt_num_rows($sentencia);

            if($fila == 0){
                echo "token cambio";
            
            }else{
                echo "token correcto";
            }
            

            /* cerrar la sentencia */
            mysqli_stmt_close($sentencia);
        }

        /* cerrar la conexión */
        mysqli_close($enlace);
    }

?>

