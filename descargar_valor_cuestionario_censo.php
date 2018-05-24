<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $conn = $con->conectar_kc();

    /* comprobar la conexión */
    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la Base de datos";
        exit();
    }else{
        $query ="SELECT valor.item,valor.contenido FROM valor,item,bloque_cuestionario,cuestionario WHERE valor.item = item.id_item AND bloque_cuestionario.bloque = item.bloque AND bloque_cuestionario.cuestionario = cuestionario.id_cuestionario AND cuestionario.id_cuestionario IN (14) ORDER BY valor.item,valor.contenido";

        $consulta = mysqli_query($conn,"SET CHARSET utf8");
        $consulta = mysqli_query($conn,$query);

        /*variable de tipo array en donde se guardara toda la consuilta en formato JSON*/
        $json = array();
        $i = 0;

        if (mysqli_num_rows($consulta)) {

            /* obtener el array asociativo */
            while ($row = mysqli_fetch_assoc($consulta)) {
                $json['valor_cuestionario_censo'][$i]=$row;
                $i++;
            }

            /* liberar el conjunto de resultados */
            /*mysqli_free_result($consulta);*/
        }

        /* cerrar la conexión */
        mysqli_close($conn);
        /* salida en formato json */
        echo json_encode($json);
    }
?>
