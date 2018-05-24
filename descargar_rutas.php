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
    $externo = $_POST['externo'];


    /* comprobar la conexi�n */
    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la Base de datos";
        exit();
    }else{
        $query ="SELECT ruta.index_ruta,ruta.id_ruta, ruta.cliente, cliente.nombre, cliente.codigo, cliente.direccion, cliente.longitud, cliente.latitud,region.nombre AS region, departamento.nombre AS departamento, municipio.nombre AS municipio,zona.nombre AS zona,tipo_cliente.id_tipo_cliente AS id_tipo_cliente,tipo_cliente.nombre AS tipoCliente,territorio.nombre AS territorio FROM ruta, cliente, region, departamento, municipio,zona,tipo_cliente,territorio WHERE mercaderista = '".$id_merca."' AND semana = '".$semana."' AND dia = '".$dia."' AND cliente.cliente_externo = '".$externo."'  AND ruta.cliente = cliente.id_cliente AND cliente.region = region.id_region AND cliente.departamento = departamento.id_departamento AND cliente.municipio = municipio.id_municipio AND cliente.zona = zona.id_zona AND cliente.tipo_cliente = tipo_cliente.id_tipo_cliente AND cliente.territorio = territorio.id_territorio AND cliente.territorio = territorio.id_territorio ORDER BY index_ruta,id_ruta,codigo";

        $consulta = mysqli_query($enlace,"SET CHARSET utf8");
        $consulta = mysqli_query($enlace,$query);


        /*variable de tipo array en donde se guardara toda la consuilta en formato JSON*/
        $json = array();
        $i = 0;

        if (mysqli_num_rows($consulta)) {

            /* obtener el array asociativo */
            while ($row = mysqli_fetch_assoc($consulta)) {
                $json['Clientes'][$i]=$row;
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
