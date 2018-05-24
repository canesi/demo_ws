<?php
/** Error reporting */
error_reporting(E_ALL);

/** Include path **/
ini_set('include_path', ini_get('include_path').';../Classes/');

/** PHPExcel */
include 'Classes/PHPExcel.php';


/** PHPExcel_Writer_Excel2007 */
include 'Classes/PHPExcel/Writer/Excel2007.php';
include('conexion.php');

$conectar = new conexion;
$fecha=date('Y-m-j');
$fechaAnterior = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
$fechaAnterior =date ( 'Y-m-j' , $fechaAnterior );

$queryVisitas='SELECT visita.fecha as hora, zona.nombre as zona, cliente.nombre as cliente, categoria.nombre as categoria, subcategoria.nombre as subcategoria, sku_formato.descripcion as sku FROM cliente, categoria, subcategoria, sku_formato, visita, faltante, zona WHERE faltante.visita = visita.id_visita AND visita.cliente = cliente.id_cliente AND cliente.zona = zona.id_zona AND faltante.sku = sku_formato.id_sku AND sku_formato.categoria = categoria.id_categoria AND sku_formato.subcategoria = subcategoria.id_subcategoria AND faltante.flag = 1 AND visita.fecha BETWEEN "'.$fechaAnterior.' 18:00:00" and "'.$fecha.' 17:59:59" and visita.mercaderista NOT IN (146, 157) ORDER BY zona.nombre, cliente.nombre, categoria.nombre, subcategoria.nombre, sku_formato.descripcion';

$resultVisitas= mysqli_query($conectar->conectar(),$queryVisitas);

$queryVisitasFormato='SELECT visita.fecha as hora, zona.nombre as zona, cliente.nombre as cliente, categoria.nombre as categoria, subcategoria.nombre as subcategoria, sku.descripcion as sku FROM cliente, categoria, subcategoria, sku, visita, faltante, zona WHERE faltante.visita = visita.id_visita AND visita.cliente = cliente.id_cliente AND cliente.zona = zona.id_zona AND faltante.sku = sku.id_sku AND sku.categoria = categoria.id_categoria AND sku.subcategoria = subcategoria.id_subcategoria AND faltante.flag = 0 AND visita.fecha BETWEEN "'. $fechaAnterior.' 18:00:00 " and " '.$fecha.' 17:59:59" and visita.mercaderista NOT IN (146, 157) ORDER BY zona.nombre, cliente.nombre, categoria.nombre, subcategoria.nombre, sku.descripcion; ';
$resultVisitasFormato= mysqli_query($conectar->conectar(),$queryVisitasFormato);

// Create new PHPExcel object
echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

// Set properties
echo date('H:i:s') . " Set properties\n";
$objPHPExcel->getProperties()->setCreator("Team Mycis");
$objPHPExcel->getProperties()->setLastModifiedBy("Team Mycis");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");

$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '(114,160,229)'),
        'size'  => 11,
        'name'  => 'Calibri'
    ));
// Add some data
echo date('H:i:s') . " Add some data\n";
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'HORA');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'ZONA');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'CLIENTE');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'CATEGORIA');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'SUBCATEGORIA');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->setAutoFilter("A1:F1");


$i = 2; //Numero de fila donde se va a comenzar a rellenar
while ($fila = $resultVisitas->fetch_array()) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$i, $fila['hora'])
        ->setCellValue('B'.$i, $fila['zona'])
        ->setCellValue('C'.$i, $fila['cliente'])
        ->setCellValue('D'.$i, $fila['categoria'])
        ->setCellValue('E'.$i, $fila['subcategoria'])
        ->setCellValue('F'.$i, $fila['sku']);
    $i++;
}
foreach(range('A','F') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
	
}

$nombre_hoja="Faltantes".$fecha;
$objPHPExcel->getActiveSheet()->setTitle($nombre_hoja);


// Save Excel 2007 file
echo date('H:i:s') . " Write to Excel2007 format\n";
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('/var/www/html/mycis_kc_ws/plantilla/faltante.xlsx','Excel2007');

// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";


?>
