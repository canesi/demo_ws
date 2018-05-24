<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

  //parametros a recibir
  $visita = $_POST['visita'];
  $cliente = $_POST['cliente'];
  $merca = $_POST['merca'];
  $item = $_POST['item'];
  $valor = $_POST['valor'];
  $fecha = $_POST['fecha'];
  $longitud = $_POST['longitud'];
  $latitud = $_POST['latitud'];
  $punteo = $_POST['punteo'];
  $cliente_externo = $_POST['cliente_externo'];
  $longitud = $_POST['longitud'];
  $latitud = $_POST['latitud'];
  $master_plan = $_POST['idmp'];
  $frecuencia = $_POST['frecuencia'];

  //variables estaticas
  $item2 = "2"; //para status del master plan
  $item3 = "3";//para justificacion
  $item4 = "4";//para justificacion
  $item5 = "5";
  $item8 = "8";//para justificacion
  $item9 = "9";//para justificacion

  //
  $frecuencia1 = "Dia 3";
  $frecuencia2 = "Dia 7";
  $frecuencia3 = "Semana 2";
  $frecuencia4 = "Semana 3";
  $frecuencia5 = "Semana 4";


  /* comprobar la conexi�n */
  if (mysqli_connect_errno()) {
      echo "Fallo la conexion a la Base de datos";
      exit();
  }
    $query ="insert into respuesta (visita,cliente,mercaderista,item,valor,fecha_hora,longitud,latitud,punteo,cliente_externo) values ('$visita','$cliente','$merca','$item','$valor','$fecha','$longitud','$latitud','$punteo','$cliente_externo')";
    mysqli_query($enlace,"SET CHARSET utf8");
    mysqli_query($enlace,$query);

    if(strcmp($item,$item2)==0){//para status
  	     if(strcmp($frecuencia,$frecuencia1)==0){//Dia 3
  		          $campo = "status_dia_3";
  		          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
  	      }else if(strcmp($frecuencia,$frecuencia2)==0){//Dia 7
  		          $campo = "status_dia_7";
  		            query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
  	      }else if(strcmp($frecuencia,$frecuencia3)==0){//Semana 2
  		            $campo = "status_semana_2";
  		            query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
  	      }else if(strcmp($frecuencia,$frecuencia4)==0){//Semana 3
  		            $campo = "status_semana_3";
  		            query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
  	      }else if(strcmp($frecuencia,$frecuencia5)==0){//Semana 4
  		            $campo = "status_semana_4";
  		            query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
  	      }
    }else if(strcmp($item,$item3)==0){//para justificacion
      if(strcmp($frecuencia,$frecuencia1)==0){//Dia 3
            $campo = "justificacion_dia_3";
            query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
     }else if(strcmp($frecuencia,$frecuencia2)==0){//Dia 7
            $campo = "justificacion_dia_7";
            query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
     }else if(strcmp($frecuencia,$frecuencia3)==0){//Semana 2
            $campo = "justificacion_semana_2";
            query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
     }else if(strcmp($frecuencia,$frecuencia4)==0){//Semana 3
            $campo = "justificacion_semana_3";
            query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
     }else if(strcmp($frecuencia,$frecuencia5)==0){//Semana 4
            $campo = "justificacion_semana_4";
            query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
     }
    }else if(strcmp($item,$item4)==0){//para justificacion
          if(strcmp($frecuencia,$frecuencia1)==0){//Dia 3
              $campo = "justificacion_dia_3";
              query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
          }else if(strcmp($frecuencia,$frecuencia2)==0){//Dia 7
              $campo = "justificacion_dia_7";
              query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
          }else if(strcmp($frecuencia,$frecuencia3)==0){//Semana 2
              $campo = "justificacion_semana_2";
              query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
          }else if(strcmp($frecuencia,$frecuencia4)==0){//Semana 3
              $campo = "justificacion_semana_3";
              query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
          }else if(strcmp($frecuencia,$frecuencia5)==0){//Semana 4
              $campo = "justificacion_semana_4";
              query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
          }
    }else if(strcmp($item,$item8)==0){//para justificacion
      if(strcmp($frecuencia,$frecuencia1)==0){//Dia 3
          $campo = "justificacion_dia_3";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }else if(strcmp($frecuencia,$frecuencia2)==0){//Dia 7
          $campo = "justificacion_dia_7";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }else if(strcmp($frecuencia,$frecuencia3)==0){//Semana 2
          $campo = "justificacion_semana_2";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }else if(strcmp($frecuencia,$frecuencia4)==0){//Semana 3
          $campo = "justificacion_semana_3";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }else if(strcmp($frecuencia,$frecuencia5)==0){//Semana 4
          $campo = "justificacion_semana_4";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }
    }else if(strcmp($item,$item9)==0){//para justificacion
      if(strcmp($frecuencia,$frecuencia1)==0){//Dia 3
          $campo = "justificacion_dia_3";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }else if(strcmp($frecuencia,$frecuencia2)==0){//Dia 7
          $campo = "justificacion_dia_7";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }else if(strcmp($frecuencia,$frecuencia3)==0){//Semana 2
          $campo = "justificacion_semana_2";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }else if(strcmp($frecuencia,$frecuencia4)==0){//Semana 3
          $campo = "justificacion_semana_3";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }else if(strcmp($frecuencia,$frecuencia5)==0){//Semana 4
          $campo = "justificacion_semana_4";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }
    }else if(strcmp($item,$item5)==0){//para comentarios
      if(strcmp($frecuencia,$frecuencia1)==0){//Dia 3
          $campo = "comentarios_dia_3";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }else if(strcmp($frecuencia,$frecuencia2)==0){//Dia 7
          $campo = "comentarios_dia_7";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }else if(strcmp($frecuencia,$frecuencia3)==0){//Semana 2
          $campo = "comentarios_semana_2";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }else if(strcmp($frecuencia,$frecuencia4)==0){//Semana 3
          $campo = "comentarios_semana_3";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }else if(strcmp($frecuencia,$frecuencia5)==0){//Semana 4
          $campo = "comentarios_semana_4";
          query($item,$frecuencia,$valor,$master_plan,$campo,$enlace);
      }
    }//fin de todos los if else
    
    mysqli_close($enlace);

      function query($itemx,$frex,$val,$mp,$camp,$enlacex){
    	  if (mysqli_connect_errno()) {
    			echo "Fallo la conexion a la Base de datos";
    			exit();
    	}else{
    		$query1 ="UPDATE master_plan SET ".$camp." = '".$val."' WHERE id_master_plan = ".$mp."";
    		mysqli_query($enlacex,$query1);
    		//echo $itemx."".$frex." frecuencia aux"." valor: ".$val." master: ".$mp." Campo: ".$camp;
    		echo $query1;
    	}

    }
?>
