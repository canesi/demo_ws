<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

    /* comprobar la conexión */
    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la Base de datos";
        exit();
    }else{
        $query ="SELECT valor.item,valor.contenido FROM item,valor where item.id_item = valor.item AND item.bloque = 1 ORDER BY item,contenido";

        $consulta = mysqli_query($enlace,"SET CHARSET utf8");
        $consulta = mysqli_query($enlace,$query);

        /*variable de tipo array en donde se guardara toda la consuilta en formato JSON*/
        $json = array();
        $i = 0;

            if (mysqli_num_rows($consulta)) {

            /* obtener el array asociativo */
            while ($row = mysqli_fetch_assoc($consulta)) {
                $json['valor_mp'][$i]=$row;
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
