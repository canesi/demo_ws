<?php
    /* incluir script de conexion */
    include('connect.php');

    /* parametros a recibir */
    $region = $_POST['region'];

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $conn = $con->conectar_kc();

    /* comprobar la conexi�n */
    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la Base de datos";
        exit();
    }else{
        $query = "SELECT region.id_region, region.nombre AS nombre_region, departamento.id_departamento, departamento.nombre AS nombre_departamento, municipio.id_municipio, municipio.nombre AS nombre_municipio, zona.id_zona, zona.nombre AS nombre_zona, territorio.id_territorio, territorio.nombre AS nombre_territorio FROM region, departamento, municipio, zona, territorio WHERE territorio.zona = zona.id_zona AND zona.municipio = municipio.id_municipio AND municipio.departamento = departamento.id_departamento AND departamento.region = region.id_region AND region.id_region = '".$region."' AND territorio.nombre NOT IN ('WALMART','SUPER PAIZ','MAXI','DESPENSA FAMILIAR','LA TORRE','ECONOSUPER','PRICEMART','INDEPENDIENTE','MEGARED DE SUPERMERCADOS S.A','NULL') ORDER BY departamento.nombre,municipio.nombre";
        
        $consulta = mysqli_query($conn,"SET CHARSET utf8");
        $consulta = mysqli_query($conn,$query);

        /*variable de tipo array en donde se guardara toda la consuilta en formato JSON*/
        $json = array();
        $i = 0;

        if (mysqli_num_rows($consulta)) {

            /* obtener el array asociativo */
            while ($row = mysqli_fetch_assoc($consulta)) {
                $json['info'][$i]=$row;
                $i++;
            }

        /* liberar el conjunto de resultados */
        /*mysqli_free_result($consulta);*/
        }

        /* cerrar la conexi�n */
        mysqli_close($conn);

        /* mostrar salida de datos en */
        echo json_encode($json);    
    }
?>
