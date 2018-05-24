<?php
    /* incluir script de conexion */
    include('connect.php');

    /* crear objeto de conexion */
    $con = new Conexion();

    /* obtener la conexion en variable $conn */    
    $enlace = $con->conectar_comp();

	class conexion
		{
	public function  conectar()
		{
			mysqli_set_charset($enlace,"utf8");
				return $enlace;
			}

			public function desconectar()
			{
				mysqli_close($enlace);
			}
		}
?>