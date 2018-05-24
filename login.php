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
        $consulta = "SELECT user.username, user.password,mercaderista.id_mercaderista FROM user,mercaderista WHERE user.active = 1 AND user.username = '".$username."' AND user.password = '".$password. "' AND user.username = mercaderista.username AND mercaderista.region IS NOT NULL and mercaderista.supervisor IS NOT NULL";

        if ($sentencia = mysqli_prepare($enlace, $consulta)) {

            /* ejecutar la consulta */
            mysqli_stmt_execute($sentencia);

            /* almacenar el resultado */
            mysqli_stmt_store_result($sentencia);

            $fila = mysqli_stmt_num_rows($sentencia);

            if($fila == 0){
                echo "usuario no encontrado";

            }else{
                echo "usuario encontrado";
                
                mysqli_query($enlace, "INSERT INTO user_historico (user, accion) VALUES ('".$username."','LI')");
                
                mysqli_close($enlace);
            }

            /* cerrar la sentencia */
            mysqli_stmt_close($sentencia);
        }

        /* cerrar la conexión */
        //mysqli_close($enlace);
    }

?>
