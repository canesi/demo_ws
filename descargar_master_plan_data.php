<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* parametros a recibir */
    $region = $_POST['region'];
    $merca = $_POST['merca'];

    /* obtener la conexion en variable $conn */    
    $conn = $con->conectar_kc();

    /* comprobar la conexi�n */
    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la Base de datos";
        exit();
    }else{
        $query ="SELECT DISTINCT mpd.id_master_plan,mpd.cliente,c.nombre as nombre_cliente,s.descripcion as descripcion,cat.nombre as categoria,sub.nombre as subcategoria,mpd.fecha_inicio,mpd.fecha_final,mpd.tipo_espacio,mpd.capacidad_exhibicion FROM master_plan_data as mpd,cliente as c,ruta as r,sku_formato as s,categoria as cat,subcategoria as sub WHERE mpd.cliente = c.id_cliente AND mpd.sku = s.id_sku AND s.categoria = cat.id_categoria AND s.subcategoria = sub.id_subcategoria AND mpd.activo = 1 AND mpd.cliente IN (SELECT cliente FROM ruta WHERE semana = 1 AND dia = 'Lunes' AND mercaderista = '".$merca."') ORDER BY mpd.cliente,id_master_plan";

        $consulta = mysqli_query($conn,"SET CHARSET utf8");
        $consulta = mysqli_query($conn,$query);


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
        mysqli_close($conn);
        /* salida codificada */
        echo json_encode($json);
    }
?>
