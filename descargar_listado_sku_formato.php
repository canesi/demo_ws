<?php
$region = $_POST['region'];

/* incluir script de conexion */
include('connect.php');

/* crear objeto de conexion */
$con = new Conexion();

/* obtener la conexion en variable $conn */    
$conn = $con->conectar_comp();

/* comprobar la conexi�n */
if (mysqli_connect_errno()) {
    echo "Fallo la conexion a la Base de datos";
    exit();
}else{

    $query ="SELECT id_sku,upc,descripcion,categoria.nombre AS categoria ,subcategoria.nombre AS subcategoria,item AS item,precio_ref AS precio_ref,tipo_cliente.nombre AS formato,cliente_externo.id_cliente_externo AS cliente_externo FROM sku_formato,categoria,subcategoria,tipo_cliente,cliente_externo WHERE sku_formato.categoria = categoria.id_categoria AND sku_formato.subcategoria = subcategoria.id_subcategoria AND sku_formato.tipo_cliente = tipo_cliente.id_tipo_cliente AND sku_formato.cliente_externo = cliente_externo.id_cliente_externo AND sku_formato.region = 1 AND activo = 1 ORDER BY tipo_cliente.id_tipo_cliente,categoria.nombre,subcategoria.nombre";

    $consulta = mysqli_query($conn,"SET CHARSET utf8");
    $consulta = mysqli_query($conn,$query);
    
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
        }else{ 
            //echo "region: ".$region;
        }
    
    /* cerrar la conexi�n */
    mysqli_close($conn);
    echo json_encode($json);
}

?>
