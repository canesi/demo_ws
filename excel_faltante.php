<?php
include('conexion.php');
//require_once 'Classes/PHPExcel.php';

$conectar = new conexion;

$csv_end = "
";
$conectar = new conexion;
$csv_sep = "|";
$csv_file = "/var/www/html/mycis_kc_ws/plantilla/faltante.xls";
$csv="";

$flag = False;
$id_visitas=array();
$fecha='2017-07-30'; //date('Y-m-j');
//$fechaAnterior = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
$fechaAnterior ='2017-07-29'; //date ( 'Y-m-j' , $fechaAnterior );

$queryVisitas='SELECT visita.fecha as hora, zona.nombre as zona, cliente.nombre as cliente, categoria.nombre as categoria, subcategoria.nombre as subcategoria, sku_formato.descripcion as sku FROM cliente, categoria, subcategoria, sku_formato, visita, faltante, zona WHERE faltante.visita = visita.id_visita AND visita.cliente = cliente.id_cliente AND cliente.zona = zona.id_zona AND faltante.sku = sku_formato.id_sku AND sku_formato.categoria = categoria.id_categoria AND sku_formato.subcategoria = subcategoria.id_subcategoria AND faltante.flag = 1 AND visita.fecha BETWEEN "'.$fechaAnterior.' 18:00:00" and "'.$fecha.' 17:59:59" and visita.mercaderista NOT IN (146, 157) ORDER BY zona.nombre, cliente.nombre, categoria.nombre, subcategoria.nombre, sku_formato.descripcion';

$resultVisitas= mysqli_query($conectar->conectar(),$queryVisitas);

$queryVisitasFormato='SELECT visita.fecha as hora, zona.nombre as zona, cliente.nombre as cliente, categoria.nombre as categoria, subcategoria.nombre as subcategoria, sku.descripcion as sku FROM cliente, categoria, subcategoria, sku, visita, faltante, zona WHERE faltante.visita = visita.id_visita AND visita.cliente = cliente.id_cliente AND cliente.zona = zona.id_zona AND faltante.sku = sku.id_sku AND sku.categoria = categoria.id_categoria AND sku.subcategoria = subcategoria.id_subcategoria AND faltante.flag = 0 AND visita.fecha BETWEEN "'. $fechaAnterior.' 18:00:00 " and " '.$fecha.' 17:59:59" and visita.mercaderista NOT IN (146, 157) ORDER BY zona.nombre, cliente.nombre, categoria.nombre, subcategoria.nombre, sku.descripcion; ';
$resultVisitasFormato= mysqli_query($conectar->conectar(),$queryVisitasFormato);
//echo $queryVisitasFormato;

$validacion2= mysqli_num_rows($resultVisitasFormato);
/*header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Faltante_$fecha.xls");
header("Pragma: no-cache");
header("Expires: 0");
//header("Location: http://localhost/");
*/

$csv.= "<table border=1> ";
$csv.= "<tr> ";
$csv.=    "<th style='color:#00f'>FECHA</th> ";
$csv.=   "<th style='color:#00f'>ZONA</th> ";
$csv.=   "<th style='color:#00f'>CLIENTE</th> ";
$csv.=     "<th style='color:#00f'>CATEGORIA</th> ";
$csv.=    "<th style='color:#00f'>SUBCATEGORIA</th> ";
$csv.=    "<th style='color:#00f'>SKU</th> ";
$csv.= "</tr> ";

while($row = mysqli_fetch_array($resultVisitasFormato))
  {
    $hora = $row['hora'];
    $zona= $row["zona"];
    $cliente=$row["cliente"];
    $categoria= $row["categoria"];
    $subcategoria=$row["subcategoria"];
    $sku= $row["sku"];

    $csv.= "<tr> ";
  	$csv.= 	"<td>".$hora."</td>";
    $csv.= 	"<td>".$zona."</td>";
    $csv.= 	"<td>".$cliente."</td>";
    $csv.= 	"<td>".$categoria."</td>";
    $csv.= 	"<td>".$subcategoria."</td>";
    $csv.=	"<td>".$sku."</td>";
    $csv.= "</tr>";
  }

  while($row = mysqli_fetch_array($resultVisitas))
    {
      $hora = $row['hora'];
      $zona= $row["zona"];
      $cliente=$row["cliente"];
      $categoria= $row["categoria"];
      $subcategoria=$row["subcategoria"];
      $sku= $row["sku"];

      $csv.= "<tr> ";
    	$csv.= 	"<td>".$hora."</td>";
      $csv.= 	"<td>".$zona."</td>";
      $csv.= 	"<td>".$cliente."</td>";
      $csv.= 	"<td>".$categoria."</td>";
      $csv.= 	"<td>".$subcategoria."</td>";
      $csv.=	"<td>".$sku."</td>";
      $csv.= "</tr>";
    }


  $csv.= "</table>";
$conectar->desconectar();
if (!$handle = fopen($csv_file, "w"))
	{
    echo "Cannot open file";
    exit;
	}
if (fwrite($handle,($csv)) === FALSE) {
    echo "Cannot write to file";
    exit;
}
fclose($handle);

?>
