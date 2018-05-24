<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>

<style type="text/css">

th { background: #910d86; color: #fff; font-size: 14px; font-weight: bold;}
table {
		border-collapse: collapse;
		border: 1px solid #cdcdcd;
		font: normal 12px arial;
		width: 100%;
	}
td, th { border: 1px solid #cdcdcd; padding: 8px;}


@media only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

		table, thead, tbody, th, td, tr {
			display: block;
		}

		thead tr {
			position: absolute;
			top: -9999px;
			left: -9999px;
		}

		tr { border-bottom: 2px solid #690461; }

		td {

			border: none;
			border-bottom: 1px solid #eee;
			position: relative;
			padding-left: 50% !important;
  			text-align: left !important;
		}

		td:before {
			position: absolute;
			top: 6px;
			left: 6px;
			width: 45%;
			padding-right: 10px;
			white-space: nowrap;
            font-weight: bold;
		}

		td:nth-of-type(1):before { content: "Mercaderista"; color: #0e9893;}
		td:nth-of-type(2):before { content: "Total Visitas"; color: #0e9893;}
		td:nth-of-type(3):before { content: "Primer Visita"; color: #0e9893;}
		td:nth-of-type(4):before { content: "Ultima Visita"; color: #0e9893;}
		td:nth-of-type(5):before { content: "Ultimo Sector"; color: #0e9893;}

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

$fecha = date("Y-m-d");

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

		$result = $conn->query("SELECT CONCAT(municipio.nombre,' - ', territorio.nombre) As ultimo FROM visita, cliente, municipio, territorio, zona WHERE cliente.id_cliente = visita.cliente AND cliente.municipio = municipio.id_municipio AND cliente.territorio = territorio.id_territorio AND cliente.zona = zona.id_zona AND mercaderista = ".$mercaderistas[$i]." ORDER BY id_visita DESC LIMIT 1");
		if ($result->num_rows > 0)
		{
			While($row = $result->fetch_assoc())
			{
				$ultimo_sector[$i] = $row["ultimo"];

			}

		}
	}

	echo "<section><div  class='tbl-header'><table cellpadding='0' cellspacing='0' border='0'><thead><tr><th>MERCADERISTA</th><th>TOTAL VISITAS</th><th>PRIMERA VISITA</th><th>ULTIMA VISITA</th><th>ULTIMO SECTOR</th></tr></thead></table></div><div  class='tbl-content'><table cellpadding='0' cellspacing='0' border='0'><tbody>";

	for ($i = 0; $i < count($mercaderistas); $i++)
	{
		echo "<tr>";
		echo "<td>".$nombres[$i]."</td><td>".$total_visitas[$i]."</td><td>".substr($primera_visita[$i],-9)."</td><td>".substr($ultima_visita[$i],-9)."</td><td>".$ultimo_sector[$i]."</td>";
		echo "</tr>";
	}

	echo "</tbody></table></div></section>";


$conn->close();

?>

</html>
