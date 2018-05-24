<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

    //parametros a recibir
    $id_merca = $_POST['id_merca'];
    $semana = $_POST['semana'];
    $dia = $_POST['dia'];


    /* comprobar la conexi�n */
    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la Base de datos";
        exit();
    }else{
        $query ="SELECT item.id_item,valor.contenido,ruta.id_ruta FROM item, cuestionario, bloque_cuestionario, bloque,cuestionario_ruta,ruta,cliente_externo,valor WHERE item.id_item = valor.item AND item.bloque = bloque.id_bloque AND bloque_cuestionario.bloque = bloque.id_bloque AND bloque_cuestionario.cuestionario = cuestionario.id_cuestionario AND cuestionario_ruta.cuestionario = cuestionario.id_cuestionario AND cuestionario_ruta.ruta = ruta.id_ruta AND ruta.mercaderista = '".$id_merca."' AND ruta.semana = '".$semana."' AND ruta.dia = '".$dia."' AND cuestionario_ruta.cliente_externo = cliente_externo.id_cliente_externo ";
    
        //$consulta = mysqli_query($enlace,"SET NAMES utf8");
        $consulta = mysqli_query($enlace,"SET CHARSET utf8");
        $consulta = mysqli_query($enlace,$query);

        /*variable de tipo array en donde se guardara toda la consuilta en formato JSON*/
        $json = array();
        $i = 0;

            if (mysqli_num_rows($consulta)) {

            /* obtener el array asociativo */
            while ($row = mysqli_fetch_assoc($consulta)) {
                $json['valor'][$i]=$row;
                $i++;
            }

            /* liberar el conjunto de resultados */
            /*mysqli_free_result($consulta);*/
        }

        /* cerrar la conexi�n */

        mysqli_close($enlace);
        echo json_encode($json);
        
        }
?>
