<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

    //parametros a recibir
    $id_merca = $_POST['id_merca'];
    $mes = $_POST['mes'];
    $anio = $_POST['anio'];


    /* comprobar la conexi�n */
    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la Base de datos";
        exit();
    }else{
        $query ="SELECT id_master_plan,cliente,fecha_registro,fecha_inicio,fecha_final,sku_formato.id_sku,sku_formato.descripcion,categoria.nombre AS categoria,subcategoria.nombre AS subcategoria,dinamica,detalle_dinamica,rotulacion,observaciones,descuento,precio_oferta,usuario,conteo,modificaciones,mercaderista,trade_executive,supervisor,kam FROM master_plan,sku_formato,categoria,subcategoria WHERE master_plan.sku = sku_formato.id_sku AND sku_formato.categoria = categoria.id_categoria AND sku_formato.subcategoria = subcategoria.id_subcategoria AND mes = '".$mes."' AND anio = '".$anio."' AND mercaderista = '".$id_merca."' ORDER BY id_master_plan";

        $consulta = mysqli_query($enlace,"SET CHARSET utf8");
        $consulta = mysqli_query($enlace,$query);


        /*variable de tipo array en donde se guardara toda la consuilta en formato JSON*/
        $json = array();
        $i = 0;

        if (mysqli_num_rows($consulta)) {

            /* obtener el array asociativo */
            while ($row = mysqli_fetch_assoc($consulta)) {
                $json['masterplan'][$i]=$row;
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
