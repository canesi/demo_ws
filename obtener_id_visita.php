<?php

    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

    $fecha = $_POST['fecha'];
    $cliente = $_POST['cliente'];
    $merca = $_POST['merca'];
    $master = $_POST['idmp'];
    $frecuencia = $_POST['frecuencia'];

    //
    $frecuencia1 = "Master Plan: Dia 3";
    $frecuencia2 = "Master Plan: Dia 7";
    $frecuencia3 = "Master Plan: Semana 2";
    $frecuencia4 = "Master Plan: Semana 3";
    $frecuencia5 = "Master Plan: Semana 4";


    /* verificar la conexi�n */
    if (mysqli_connect_errno()) {
        printf("Conexi�n fallida: %s\n", mysqli_connect_error());
        exit();
    }else{
      //$consulta = "SELECT id_mercaderista FROM mercaderista WHERE username = '".$nombre."' ";
      $consulta = "SELECT id_visita FROM visita where fecha = '$fecha' AND cliente = '$cliente' AND mercaderista = '$merca'";

      if ($resultado = mysqli_query($enlace, $consulta)) {

          /* obtener array asociativo */
          while ($row = mysqli_fetch_assoc($resultado)) {
              $respuesta = $row["id_visita"];
              if(strcmp($frecuencia,$frecuencia1)==0){//Dia 3
                $campo = "visita_dia_3";
                    query($respuesta,$campo,$master,$enlace);
              }else if(strcmp($frecuencia,$frecuencia2)==0){//Dia 7
                $campo = "visita_dia_7";
                    query($respuesta,$campo,$master,$enlace);
              }else if(strcmp($frecuencia,$frecuencia3)==0){//Semana 2
                $campo = "visita_semana_2";
                    query($respuesta,$campo,$master,$enlace);
              }else if(strcmp($frecuencia,$frecuencia4)==0){//Semana 3
                $campo = "visita_semana_3";
                    query($respuesta,$campo,$master,$enlace);
              }else if(strcmp($frecuencia,$frecuencia5)==0){//Semana 4
                $campo = "visita_semana_4";
              query($respuesta,$campo,$master,$enlace);
              }
              //printf ("%s \n", $row["id_visita"]);
          }

          /* liberar el conjunto de resultados */
          mysqli_free_result($resultado);
      }
      /* cerrar la conexi�n */
      mysqli_close($enlace);


          function query($resp,$camp,$mp,$enl){
                if (mysqli_connect_errno()) {
                    echo "Fallo la conexion a la Base de datos";
                    exit();
                }else{
                  $query1 ="UPDATE master_plan SET ".$camp." = '".$resp."' WHERE id_master_plan = ".$mp." ";
                  mysqli_query($enl,$query1);
                  echo $resp;
                }
      }
    }//end else

?>
