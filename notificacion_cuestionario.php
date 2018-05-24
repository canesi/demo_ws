<?php
    /* incluir script de conexion */
    include('EnviarMail.php');
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* parametros a recibir */
    $user_type = $_POST['user_type'];
    $id_cuestionario = $_POST['id_cuestionario'];
    $id_visita = $_POST['id_visita'];
    //para correo
    $nombre_tienda = $_POST['nombre_tienda'];
    $direccion = $_POST['direccion'];
    $departamento = $_POST['departamento'];
    $municipio = $_POST['municipio'];
    $zona = $_POST['zona'];
    $territorio = $_POST['territorio'];
    $id_supervisor= $_POST['id_supervisor'];//codigo del supervisor
    $merca = $_POST['merca'];//coigo del mercaderista
    $ubicacion=$direccion." ".$departamento." ".$municipio." ".$zona." ".$territorio;

    /* obtener la conexion en variable $conn */
    $conn = $con->conectar_kc();

    /* comprobar la conexión */
    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la Base de datos";
        exit();
    }else
    {
        //si la conexion es exitosa a la base de datos
        //primera consultar tabla de asignar_cuestionario
        //para saber si dicho cuestionario tiene flag 1 para enviar por correo
        $queryflag="SELECT enviar_correo FROM asignar_cuestionario WHERE user_type = '".$user_type."' AND cuestionario = '".$id_cuestionario."' ";
    		$result= mysqli_query($conn,$queryflag);
    		mysqli_data_seek ($result, 0);
    		$resultflag= mysqli_fetch_array($result);
    		$flag= $resultflag['enviar_correo'];
        echo $flag;
        echo "Flag para enviar por correo: ".$flag;



        if(strcmp($flag,"0")==0)
        {
            //no enviar correo
            echo "no se envia correo";
        }
        else if($flag==1)
        {
          try
          {
            //enviar correo
            //nombre del mercaderista
            if ($merca==null)
            {
              $noms="Mercaderista Nulo";
            }
            else
            {
              $queryNombreMerca="SELECT nombre FROM mercaderista WHERE id_mercaderista = '".(int)$merca."' 'utf8'";
              $result= mysqli_query($conn,$queryNombreMerca);
              mysqli_data_seek ($result, 0);
              $nombreMerca= mysqli_fetch_array($result);
              $noms=$nombreMerca['nombre'];
            }

            $validacionMerca=mysqli_num_rows($result);
    				//$noms=$nombreMerca['nombre'];
            //fin nombre mercaderista
            //  para vista de los datos del reporte
            $datos="";
            $contador=0;
            $queryReporte="SELECT item.contenido,respuesta.valor FROM item,respuesta WHERE item.id_item = respuesta.item and respuesta.visita =".$id_visita;
            $resultReporte=mysqli_query($conn,$queryReporte);
            $validacion=mysqli_num_rows($resultReporte);

		        if($validacion!=0)
		        {
          			$datos.="<table border ='3;'>
          			<th BGCOLOR='#0174DF', sytle='color:white'>PREGUNTA</th>
          			<th BGCOLOR='#0174DF', sytle='color:white'>RESPUESTA</th>";
          		   while($row = $resultReporte->fetch_assoc())
          		     {
                     $pregunta[$contador] = $row["contenido"]."\t";
                     $respuesta[$contador] = $row["valor"]."\t";
                     $datos.= "<tr>";
                		 $datos.= "<td>".$pregunta[$contador]."</td>";
                		 $datos.= "<td>".$respuesta[$contador]."</td>";
                     $datos.="</tr>";
			               $contador = $contador + 1;
                   }
                $datos.= "</table>";

            }

            // fin datos del reporte
            echo $datos;
            function mensaje($tipo_usuario,$nombre_tienda,$ubicacion,$noms,$datos)
            {
                if($tipo_usuario=="1")
                {
                  $body = file_get_contents("plantilla/reportesVarios.html");
                  $sustituir_destinatario="%destinatario%";
                  $body = str_replace($sustituir_destinatario,"Supervisor", $body);

                  $sustituir_nombre_tienda= "%punto_de_venta%";
                  $body = str_replace($sustituir_nombre_tienda,$nombre_tienda, $body);
                  $sustituir_ubicacion="%ubicacion%";
                  $body = str_replace($sustituir_ubicacion,$ubicacion, $body);

                  $sustituir_usuario="%usuario%";
                  $body = str_replace($sustituir_usuario,$noms, $body);
                  $sustituir_datos="%datos%";
                  $body = str_replace($sustituir_datos,$datos, $body);
                  return $body;
                }
                else if($tipo_usuario=="2")
                {
                  $body = file_get_contents("plantilla/reportesVarios.html");
                  $sustituir_destinatario="%destinatario%";
                  $body = str_replace($sustituir_destinatario,"Coordinador", $body);

                  $sustituir_nombre_tienda= "%punto_de_venta%";
                  $body = str_replace($sustituir_nombre_tienda,$nombre_tienda, $body);
                  $sustituir_ubicacion="%ubicacion%";
                  $body = str_replace($sustituir_ubicacion,$ubicacion, $body);

                  $sustituir_usuario="%usuario%";
                  $body = str_replace($sustituir_usuario,$noms, $body);
                  $sustituir_datos="%datos%";
                  $body = str_replace($sustituir_datos,$datos, $body);
                  return $body;
                }
            }


                if($user_type=="1")
                {
                  //******************************************************OBTIENE EL MAIL DEL Destinatario
                  $querySupervisor="select email from supervisor where id_supervisor = '".(int)$id_supervisor."'";
                  $resultSupervisor= mysqli_query($GLOBALS['conn'],$querySupervisor);
                  mysqli_data_seek ($resultSupervisor,0);
                  $mailRecuperado= mysqli_fetch_array($resultSupervisor);
                  $mailSupervisor=$mailRecuperado['email'];
                  $enviar = new EnviarMail;
                  $enviar->enviarCorreo("Kevin.barrios@novaservicios.com.gt"/*$mailSupervisor*/,null,"Reporte Varios",mensaje($user_type,$nombre_tienda,$ubicacion,$noms,$datos));

                }
                else if($user_type=="2")
                {
                  //**********************Recuperar la region
                  /*
                  $query_region= "select region from mercaderista where id_mercaderista ='".(int)$id_supervisor."'";
                  $result_region=mysqli_query($GLOBALS['conn'],$query_region);
                  mysqli_data_seek ($result_region,0);
                  $region_recuperada= mysqli_fetch_array($result_region);
                  $region=$region_recuperada['region'];
                  */
                  //**********************Recuperar correos de los coordinares
                  $queryDestinatarios="select correo_para,correo_cc from alerta_destinatario where reporte like '%reportes_varios%'";
              		$resultDestinatario=mysqli_query($conn,$queryDestinatarios);
              		mysqli_data_seek ($resultDestinatario,0);
              		$recuperadoP = mysqli_fetch_array($resultDestinatario);
              		$para= $recuperadoP['correo_para'];
              		$copia= $recuperadoP['correo_cc'];
                  $enviar = new EnviarMail;
                  $enviar->enviarCorreo("Kevin.barrios@novaservicios.com.gt"/*$para*/,null/*$copia*/,"Reporte Varios",mensaje($user_type,$nombre_tienda,$ubicacion,$noms,$datos));

                }
              }
              catch (Exception $e)
              {
                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
              }
        }
    }
?>
