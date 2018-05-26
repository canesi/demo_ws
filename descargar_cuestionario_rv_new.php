<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* parametros a recibir */
    $region = $_POST['region'];
    $user_type = $_POST['user_type'];

    /* obtener la conexion en variable $conn */    
    $conn = $con->conectar_comp();

    /* comprobar la conexión */
    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la Base de datos";
        exit();
    }else{
        $query ="SELECT DISTINCT item.id_item, item.contenido, item.index_item,item.condicion_item, item.condicion_valor, item.tipo_item, bloque.nombre AS Bloque, cuestionario.id_cuestionario AS id_cuestionario,cuestionario.nombre AS Cuestionario, region.id_region, region.nombre AS Pais, cuestionario_cliente_externo.cliente_externo AS Externo FROM item, bloque, cuestionario, region, cliente_externo, bloque_cuestionario, cuestionario_cliente_externo,asignar_cuestionario WHERE item.bloque = bloque.id_bloque AND bloque.id_bloque = bloque_cuestionario.bloque AND cuestionario.id_cuestionario = bloque_cuestionario.cuestionario AND asignar_cuestionario.cuestionario = cuestionario.id_cuestionario AND bloque.region = region.id_region AND cuestionario_cliente_externo.cuestionario = cuestionario.id_cuestionario AND cuestionario.region = '".$region."' AND asignar_cuestionario.user_type = '".$user_type."' "; 

        $consulta = mysqli_query($conn,"SET CHARSET utf8");
        $consulta = mysqli_query($conn,$query);

        /*variable de tipo array en donde se guardara toda la consuilta en formato JSON*/
        $json = array();
        $i = 0;

        if (mysqli_num_rows($consulta)) {

            /* obtener el array asociativo */
            while ($row = mysqli_fetch_assoc($consulta)) {
                $json['cuestionario_rv'][$i]=$row;
                $i++;
            }

            /* liberar el conjunto de resultados */
            /*mysqli_free_result($consulta);*/
        }

        /* cerrar la conexión */
        mysqli_close($conn);
        echo json_encode($json);
    }//fin del else
?>
