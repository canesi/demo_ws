<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

    //parametros a recibir
    $region = $_POST['region'];


    /* comprobar la conexi�n */
    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la Base de datos";
        exit();
    }else{
        $query ="SELECT id_sku,upc,descripcion,categoria.nombre AS categoria ,subcategoria.nombre AS subcategoria FROM sku,categoria,subcategoria WHERE sku.categoria = categoria.id_categoria AND sku.subcategoria = subcategoria.id_subcategoria AND region = '".$region."' AND activo = 1 ORDER BY categoria.nombre,subcategoria.nombre";

        $consulta = mysqli_query($enlace,"SET CHARSET utf8");
        $consulta = mysqli_query($enlace,$query);


        /*variable de tipo array en donde se guardara toda la consuilta en formato JSON*/
        $json = array();
        $i = 0;

        if (mysqli_num_rows($consulta)) {

            /* obtener el array asociativo */
            while ($row = mysqli_fetch_assoc($consulta)) {
                $json['listadosku'][$i]=$row;
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
