<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* parametros a recibir */
    $region = $_POST['region'];
    $user_type = $_POST['user_type'];

    /* obtener la conexion en variable $conn */    
    $conn = $con->conectar_kc();

    /* comprobar la conexión */
    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la Base de datos";
        exit();
    }else{
        $query ="SELECT item.id_item AS item,valor.contenido AS contenido FROM item,cuestionario,bloque_cuestionario,bloque,valor,asignar_cuestionario,user_type WHERE item.id_item = valor.item AND item.bloque = bloque.id_bloque AND bloque_cuestionario.bloque = bloque.id_bloque AND bloque_cuestionario.cuestionario = cuestionario.id_cuestionario AND asignar_cuestionario.cuestionario = cuestionario.id_cuestionario AND asignar_cuestionario.user_type = user_type.id_user_type AND cuestionario.region = '".$region."' AND user_type.id_user_type = '".$user_type."' ORDER BY item.id_item,valor.contenido";

        $consulta = mysqli_query($conn,"SET CHARSET utf8");
        $consulta = mysqli_query($conn,$query);

        /*variable de tipo array en donde se guardara toda la consuilta en formato JSON*/
        $json = array();
        $i = 0;

        if (mysqli_num_rows($consulta)) {
        
            /* obtener el array asociativo */
            while ($row = mysqli_fetch_assoc($consulta)) {
                $json['valor_rv'][$i]=$row;
                $i++;
            }

            /* liberar el conjunto de resultados */
            /*mysqli_free_result($consulta);*/
        }

        /* cerrar la conexión */
        mysqli_close($conn);
        echo json_encode($json);
}

?>
