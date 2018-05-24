<?php
    /* retorna los clientes externos que tenga segun sus rutas asignandas */

    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

    //parametros a recibir
    $mercaderista = $_POST['mercaderista'];


    /* comprobar la conexión */
    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la Base de datos";
        exit();
    }else{
        $query ="SELECT DISTINCT cliente_externo.id_cliente_externo,cliente_externo.nombre FROM ruta,cliente,cliente_externo WHERE ruta.cliente = cliente.id_cliente AND cliente.cliente_externo = cliente_externo.id_cliente_externo AND ruta.mercaderista = '".$mercaderista."' ORDER BY cliente_externo.nombre";

        $consulta = mysqli_query($enlace,"SET CHARSET utf8");
        $consulta = mysqli_query($enlace,$query);

        /*variable de tipo array en donde se guardara toda la consuilta en formato JSON*/
        $json = array();
        $i = 0;

        if (mysqli_num_rows($consulta)) {

            /* obtener el array asociativo */
            while ($row = mysqli_fetch_assoc($consulta)) {
                $json['cliente_externo'][$i]=$row;
                $i++;
            }

            /* liberar el conjunto de resultados */
            /*mysqli_free_result($consulta);*/
        }

        /* cerrar la conexión */

        mysqli_close($enlace);
        echo json_encode($json);
    }

?>
