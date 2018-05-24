<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Avance en Ruta</title>

<style type="text/css">
  table a:link {
	color: #666;
	font-weight: bold;
	text-decoration:none;
}
table a:visited {
	color: #999999;
	font-weight:bold;
	text-decoration:none;
}
table a:active,
table a:hover {
	color: #bd5a35;
	text-decoration:underline;
}
table {
	font-family:Arial, Helvetica, sans-serif;
	color:#666;
	font-size:12px;
	text-shadow: 1px 1px 0px #fff;
	background:#eaebec;
	margin:20px;
	border:#ccc 1px solid;

	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;

	-moz-box-shadow: 0 1px 2px #d1d1d1;
	-webkit-box-shadow: 0 1px 2px #d1d1d1;
	box-shadow: 0 1px 2px #d1d1d1;
}
table th {
	padding:21px 25px 22px 25px;
	border-top:1px solid #fafafa;
	border-bottom:1px solid #e0e0e0;

	background: #ededed;
	background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb));
	background: -moz-linear-gradient(top,  #ededed,  #ebebeb);
}
table th:first-child {
	text-align: left;
	padding-left:20px;
}
table tr:first-child th:first-child {
	-moz-border-radius-topleft:3px;
	-webkit-border-top-left-radius:3px;
	border-top-left-radius:3px;
}
table tr:first-child th:last-child {
	-moz-border-radius-topright:3px;
	-webkit-border-top-right-radius:3px;
	border-top-right-radius:3px;
}
table tr {
	text-align: center;
	padding-left:20px;
}
table td:first-child {
	text-align: left;
	padding-left:20px;
	border-left: 0;
}
table td {
	padding:18px;
	border-top: 1px solid #ffffff;
	border-bottom:1px solid #e0e0e0;
	border-left: 1px solid #e0e0e0;

	background: #fafafa;
	background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
	background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
}
table tr.even td {
	background: #f6f6f6;
	background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
	background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
}
table tr:last-child td {
	border-bottom:0;
}
table tr:last-child td:first-child {
	-moz-border-radius-bottomleft:3px;
	-webkit-border-bottom-left-radius:3px;
	border-bottom-left-radius:3px;
}
table tr:last-child td:last-child {
	-moz-border-radius-bottomright:3px;
	-webkit-border-bottom-right-radius:3px;
	border-bottom-right-radius:3px;
}
table tr:hover td {
	background: #f2f2f2;
	background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
	background: -moz-linear-gradient(top,  #f2f2f2,  #f0f0f0);
}
  </style>

</head>

<body>



</body>


<?php

/* incluir script de conexion */
include('connect.php');

/* crear objeto de conexion */
$con = new Conexion();

/* obtener la conexion en variable $conn */    
$conn = $con->conectar_comp();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$supervisor = $_POST['supervisor'];

if(empty($supervisor))
{
	$supervisor = 'Incorrecto / No existe';
}
else
{
	$supervisor = $_POST['supervisor'];
}

$fecha = $_POST['fecha'];

if(empty($fecha))
{
	$fecha = date("Y-m-d");
}
else
{
	$fecha = $_POST['fecha'];
}

$mercaderistas = array();
$nombres = array();
$total_visita = array();
$primera_visita = array();
$ultima_visita = array();
$ultimo_sector = array();

$sql = "SELECT mercaderista.id_mercaderista FROM supervisor,mercaderista WHERE supervisor.id_supervisor = mercaderista.supervisor AND supervisor.username = '".$supervisor."' AND mercaderista.username != '".$supervisor."'";

$result = mysqli_query($conn, "SET CHARSET utf8");

$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		$contador = 0;
		while($row = $result->fetch_assoc())
		{
			$arreglo[$contador] = $row["id_mercaderista"];
			$contador = $contador + 1;
		}
	}

	$contador2 = 0;

	for ($i = 0; $i < count($arreglo); $i++)
	{
		$result = $conn->query("SELECT mercaderista, COUNT(id_visita) AS total_visitas FROM visita WHERE mercaderista =".$arreglo[$i]." AND fecha LIKE '".$fecha."%'");
		if ($result->num_rows > 0)
		{

				While($row = $result->fetch_assoc())
				{
					if($row["total_visitas"] <> "0")
					{
						$mercaderistas[$contador2] = $row["mercaderista"];
						$contador2 = $contador2 + 1;
					}


				}
		}
	}

	for ($i = 0; $i < count($mercaderistas); $i++)
	{
		$result = $conn->query("SELECT nombre FROM mercaderista WHERE id_mercaderista = ".$mercaderistas[$i]);
		if ($result->num_rows > 0)
		{
			While($row = $result->fetch_assoc()) {
		   $nombres[$i] = $row["nombre"];

			}
		}

		$result = $conn->query("SELECT COUNT(id_visita) As total_visitas FROM visita WHERE mercaderista = ".$mercaderistas[$i]." AND fecha LIKE '".$fecha."%'");
		if ($result->num_rows > 0)
		{
			While($row = $result->fetch_assoc())
			{
				$total_visitas[$i] = $row["total_visitas"];

			}

		}


		$result = $conn->query("SELECT fecha FROM visita WHERE mercaderista =".$mercaderistas[$i]." AND fecha LIKE '".$fecha."%' ORDER BY id_visita ASC LIMIT 1");
		if ($result->num_rows > 0)
		{
			While($row = $result->fetch_assoc())
			{
				$primera_visita[$i] = $row["fecha"];

			}

		}

		$result = $conn->query("SELECT fecha FROM visita WHERE mercaderista =".$mercaderistas[$i]." AND fecha LIKE '".$fecha."%' ORDER BY id_visita DESC LIMIT 1");
		if ($result->num_rows > 0)
		{
			While($row = $result->fetch_assoc())
			{
				$ultima_visita[$i] = $row["fecha"];

			}

		}

		$result = mysqli_query($conn, "SET CHARSET utf8");

		$result = $conn->query("SELECT CONCAT(municipio.nombre,' - ', territorio.nombre) As ultimo FROM visita, cliente, municipio, territorio, zona WHERE cliente.id_cliente = visita.cliente AND cliente.municipio = municipio.id_municipio AND cliente.territorio = territorio.id_territorio AND cliente.zona = zona.id_zona AND mercaderista = ".$mercaderistas[$i]." ORDER BY id_visita DESC LIMIT 1");
		if ($result->num_rows > 0)
		{
			While($row = $result->fetch_assoc())
			{
				$ultimo_sector[$i] = $row["ultimo"];

			}

		}
	}

	echo "<table cellspacing='0'><caption>Fecha: ".$fecha." Supervisor: ".$supervisor."</caption><tr><th>MERCADERISTA</th><th>TOTAL VISITAS</th><th>PRIMERA VISITA</th><th>ULTIMA VISITA</th><th>ULTIMO SECTOR</th></tr>";

	for ($i = 0; $i < count($mercaderistas); $i++)
	{
		echo "<tr>";
		echo "<td>".$nombres[$i]."</td><td>".$total_visitas[$i]."</td><td>".substr($primera_visita[$i],-9)."</td><td>".substr($ultima_visita[$i],-9)."</td><td>".$ultimo_sector[$i]."</td>";
		echo "</tr>";
	}

	echo "</table>";


$conn->close();
?>

</html>
