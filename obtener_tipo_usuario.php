<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* parametros a recibir */
    $username = $_POST['username'];
    
    /* obtener la conexion en variable $conn */    
    $conn = $con->conectar_comp();

    /* comprobar la conexión */
    if (mysqli_connect_errno()) {
        echo "Fallo la conexion a la Base de datos";
        exit();
    }else{
        
        //obtener el id del tipo usuario y su nombre
        $query="SELECT user.user_type,user_type.name_type FROM user,user_type WHERE user.user_type = user_type.id_user_type AND username = '".$username."' ";
        
		$result= mysqli_query($conn,$query);
		
        mysqli_data_seek ($result, 0);
		
        $row= mysqli_fetch_array($result);
		
        $type= ($row['user_type']);
	$name = ($row['name_type']);
        
        echo $type." ".$name;
    }
        
?>
