<?php
error_reporting(E_ALL);
ini_set('include_path', ini_get('include_path').';../Classes/');
/*para coneccion a bd y envio de correos*/

include('EnviarMail.php');
include('conexion.php');
/** PHPExcel */

include 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel2007.php';

/****VARIABLES*/
	$conectar = new conexion;
	$bandera_datos=False;
	$flag = False;
	$visitas = array();
	$skus = array();
	$exhibidores = array();
	$implementados = array();
	$razones = array();
	$comentarios = array();
	$clientes = array();
	$mercaderistas = array();
	$horas = array();
	$hoy=date('Y-m-j');

/************************/	
	
		
		if(mysqli_connect_errno())
			{
				echo "Fallo la conexion a la Base de datos";
				exit();
				$flag = False;
			}
		else
			{	
				try
				{
					
					//************chevis
							$sql = "SELECT DISTINCT(respuesta.visita) AS visita FROM respuesta, item, bloque, visita WHERE respuesta.visita = visita.id_visita AND respuesta.item = item.id_item AND item.bloque = bloque.id_bloque AND bloque.nombre = 'Master Plan GT' AND visita.fecha > '".$hoy." 00:00:00'";
							$result =mysqli_query($conectar->conectar(),$sql);
								if ($result->num_rows > 0) {
									$contador = 0;
									while($row = $result->fetch_assoc()) {
										//echo "id: " . $row["visita"]. "<br>";
										$visitas[$contador] = $row["visita"];
										$contador = $contador + 1;
									}
								} else {
									echo "0 results";
								}

								$contador = 0;

								for($i = 0; $i < count($visitas); $i++)
								{	
							
									$result =mysqli_query($conectar->conectar(),"SELECT cliente.nombre AS cliente FROM visita, cliente WHERE visita.cliente = cliente.id_cliente AND visita.id_visita = ".$visitas[$i]);
							
									//$result = $conn->query("SELECT cliente.nombre AS cliente FROM visita, cliente WHERE visita.cliente = cliente.id_cliente AND visita.id_visita = ".$visitas[$i]);
									if ($result->num_rows > 0)
									{
										While($row = $result->fetch_assoc())
										{
											$clientes[$contador] = $row["cliente"];
											$contador = $contador + 1;
										}
									}
									else
									{
										$clientes[$contador] = "";
										$contador = $contador + 1;
									}	
									
								}

								$contador = 0;

								for($i = 0; $i < count($visitas); $i++)
								{	
									$result =mysqli_query($conectar->conectar(),"SELECT mercaderista.nombre AS mercaderista FROM visita, mercaderista WHERE visita.mercaderista = mercaderista.id_mercaderista AND visita.id_visita = ".$visitas[$i]);
									
									/*$result = $conn->query("SELECT mercaderista.nombre AS mercaderista FROM visita, mercaderista WHERE visita.mercaderista = mercaderista.id_mercaderista AND visita.id_visita = ".$visitas[$i]);
									*/
									if ($result->num_rows > 0)
									{
										While($row = $result->fetch_assoc())
										{
											$mercaderistas[$contador] = $row["mercaderista"];
											$contador = $contador + 1;
										}
									}
									else
									{
										$mercaderistas[$contador] = "";
										$contador = $contador + 1;
									}	
									
								}

								$contador = 0;

								for($i = 0; $i < count($visitas); $i++)
								{	
							
									$result =mysqli_query($conectar->conectar(),"SELECT SUBSTRING(visita.fecha,11) AS hora FROM visita WHERE visita.id_visita = ".$visitas[$i]);
									
									
									//$result = $conn->query("SELECT SUBSTRING(visita.fecha,11) AS hora FROM visita WHERE visita.id_visita = ".$visitas[$i]);
									
									if ($result->num_rows > 0)
									{
										While($row = $result->fetch_assoc())
										{
											$horas[$contador] = $row["hora"];
											$contador = $contador + 1;
										}
									}
									else
									{
										$horas[$contador] = "";
										$contador = $contador + 1;
									}	
									
								}

								$contador = 0;

								for($i = 0; $i < count($visitas); $i++)
								{
									//echo $visitas[$i]."<br>";
									
									$result =mysqli_query($conectar->conectar(),"SELECT respuesta.valor AS sku FROM visita, respuesta WHERE respuesta.item = 239 AND respuesta.visita = visita.id_visita AND visita.id_visita = ".$visitas[$i]);
									
									//$result = $conn->query("SELECT respuesta.valor AS sku FROM visita, respuesta WHERE respuesta.item = 239 AND respuesta.visita = visita.id_visita AND visita.id_visita = ".$visitas[$i]);
									if ($result->num_rows > 0)
									{
										While($row = $result->fetch_assoc())
										{
											$skus[$contador] = $row["sku"];
											$contador = $contador + 1;
										}
									}
									else
									{
										$skus[$contador] = "";
										$contador = $contador + 1;
									}	
									
								}

								$contador = 0;

								for($i = 0; $i < count($visitas); $i++)
								{
									//echo $visitas[$i]."<br>";
									
									$result =mysqli_query($conectar->conectar(),"SELECT respuesta.valor AS exhibidor FROM visita, respuesta WHERE respuesta.item = 240 AND respuesta.visita = visita.id_visita AND visita.id_visita = ".$visitas[$i]);
									
									//$result = $conn->query("SELECT respuesta.valor AS exhibidor FROM visita, respuesta WHERE respuesta.item = 240 AND respuesta.visita = visita.id_visita AND visita.id_visita = ".$visitas[$i]);
									if ($result->num_rows > 0)
									{
										While($row = $result->fetch_assoc())
										{
											$exhibidores[$contador] = $row["exhibidor"];
											$contador = $contador + 1;
										}
									}
									else
									{
										$exhibidores[$contador] = "";
										$contador = $contador + 1;
									}	
									
								}


								$contador = 0;

								for($i = 0; $i < count($visitas); $i++)
								{
									//echo $visitas[$i]."<br>";
									
									$result =mysqli_query($conectar->conectar(),"SELECT respuesta.valor AS implementado FROM visita, respuesta WHERE respuesta.item = 2 AND respuesta.visita = visita.id_visita AND visita.id_visita = ".$visitas[$i]);
									
									//$result = $conn->query("SELECT respuesta.valor AS implementado FROM visita, respuesta WHERE respuesta.item = 2 AND respuesta.visita = visita.id_visita AND visita.id_visita = ".$visitas[$i]);
									if ($result->num_rows > 0)
									{
										While($row = $result->fetch_assoc())
										{
											$implementados[$contador] = $row["implementado"];
											$contador = $contador + 1;
										}
									}
									else
									{
										$implementados[$contador] = "";
										$contador = $contador + 1;
									}	
									
								}

								$contador = 0;

								for($i = 0; $i < count($visitas); $i++)
								{
									$result =mysqli_query($conectar->conectar(),"SELECT respuesta.valor AS razon FROM visita, respuesta WHERE respuesta.item = 3 AND respuesta.visita = visita.id_visita AND visita.id_visita = ".$visitas[$i]);
									
									//$result = $conn->query("SELECT respuesta.valor AS razon FROM visita, respuesta WHERE respuesta.item = 3 AND respuesta.visita = visita.id_visita AND visita.id_visita = ".$visitas[$i]);
									if ($result->num_rows > 0)
									{
										While($row = $result->fetch_assoc())
										{
											if($row["razon"] == "OTRO")
											{
												$result1=mysqli_query($conectar->conectar(),"SELECT respuesta.valor AS otra FROM visita, respuesta WHERE respuesta.item = 4 AND respuesta.visita = visita.id_visita AND visita.id_visita = ".$visitas[$i]);
												
												//$result1 = $conn->query("SELECT respuesta.valor AS otra FROM visita, respuesta WHERE respuesta.item = 4 AND respuesta.visita = visita.id_visita AND visita.id_visita = ".$visitas[$i]);
												While($row = $result1->fetch_assoc())
												{
													$razones[$contador] = "OTRO: ".strtoupper($row["otra"]);
													$contador = $contador + 1;
												}
												
											}
											else
											{
												$razones[$contador] = $row["razon"];
												$contador = $contador + 1;
											}
											
										}
									}
									else
									{
										$razones[$contador] = "";
										$contador = $contador + 1;
									}	
									
								}

								$contador = 0;

								for($i = 0; $i < count($visitas); $i++)
								{
									$result =	mysqli_query($conectar->conectar(),"SELECT respuesta.valor AS comentario FROM visita, respuesta WHERE respuesta.item = 242 AND respuesta.visita = visita.id_visita AND visita.id_visita = ".$visitas[$i]);
									
									//$result = $conn->query("SELECT respuesta.valor AS comentario FROM visita, respuesta WHERE respuesta.item = 242 AND respuesta.visita = visita.id_visita AND visita.id_visita = ".$visitas[$i]);
									if ($result->num_rows > 0)
									{
										While($row = $result->fetch_assoc())
										{
											$comentarios[$contador] = strtoupper($row["comentario"]);
											$contador = $contador + 1;
										}
									}
									else
									{
										$comentarios[$contador] = "";
										$contador = $contador + 1;
									}	
									
								}
								
									
								$datos.= "<table border ='1;'><tr><th>PDV</th><th>Mercaderista</th><th>Hora</th><th>Sku</th><th>Tipo de Espacio</th><th>Status</th><th>Razon</th><th>Comentarios</th></tr>";
								for($i = 0; $i < count($visitas); $i++)
								{
									$datos .="<tr>";
									$datos .="<td>".$clientes[$i]."</td><td>".$mercaderistas[$i]."</td><td>".$horas[$i]."</td><td>".$skus[$i]."</td><td>".$exhibidores[$i]."</td><td>".$implementados[$i]."</td><td>".$razones[$i]."</td><td>".$comentarios[$i]."</td>";    
									$datos.= "</tr>";
								}
						//echo $body;
					
					//*****fin chevis
					
					//******generacion de excel****///
					
					$objPHPExcel = new PHPExcel();

											// Propiedades del archivo
											$objPHPExcel->getProperties()->setCreator("Team Mycis");
											$objPHPExcel->getProperties()->setLastModifiedBy("Team Mycis");
											$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
											$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
											$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
											//Estilo 
											$styleArray = array(
												'font'  => array(
													'bold'  => true,
													'color' => array('rgb' => '(114,160,229)'),
													'size'  => 11,
													'name'  => 'Calibri'
												));
											// Encabezados de columnas
											$objPHPExcel->setActiveSheetIndex(0);
											$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'PDV');
											$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'MERCADERISTA');
											$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'HORA');
											$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'SKU');
											$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'TIPO DE ESPACIO');
											$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'STATUS');
											$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'RAZON');
											$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'COMENTARIOS');
											//Estilo para los encabezados
											$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->setAutoFilter("A1:H1");

											//Numero de fila donde se va a comenzar a rellenar
											$i = 2; 
											//
											//llena el excel con los datos que se estan asignando
											/*
											while ($fila = $resultVisitas->fetch_array()) 
											{
												$objPHPExcel->setActiveSheetIndex(0)
													->setCellValue('A'.$i, $fila['hora'])
													->setCellValue('B'.$i, $fila['zona'])
													->setCellValue('C'.$i, $fila['cliente'])
													->setCellValue('D'.$i, $fila['categoria'])
													->setCellValue('E'.$i, $fila['subcategoria'])
													->setCellValue('F'.$i, $fila['upc'])
													->setCellValue('G'.$i, $fila['sku']);
												$i++;
											}

											
											*/ 
											
											for($i; $i < count($visitas); $i++)
											{
												$objPHPExcel->setActiveSheetIndex(0)
													->setCellValue('A'.$i,$clientes[$i]);
												}
											
											
											
											//ajusta el tamaÃ±o de las celdas
											foreach(range('A','H') as $columnID) {
												$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
													->setAutoSize(true);
												
											}

											//nombre de la hoja activa
											$nombre_hoja="Master_plan".$fecha;
											$objPHPExcel->getActiveSheet()->setTitle($nombre_hoja);


											// para guardar el archivo en Excel 2007 y la ubicacion
											$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
											$objWriter->save('/var/www/html/mycis_kc_ws/plantilla/Master_plan.xlsx','Excel2007');
					//*****generacion de excel****///
					
					//********envio de correo**********//
						
					$enviar = new EnviarMail;	
					$body = file_get_contents("plantilla/master_plan_KCmail.html");
					$sustituir_datos="%datos%";
					$body= str_replace($sustituir_datos,$datos,$body);
					$codigoN= "&Ntilde;";
					$sustituirN="Ã‘";
					$body= str_replace($sustituirN,$codigoN,$body);		
					$enviar-> enviarCorreo2("kevin.barrios@novaservicios.com.gt",null,"Master Plan ".$fecha,$body,null,null);
				
					//******envio de correo**********//
				
				}
				catch(Exception $e)
					{
					echo $e;
					}
					$flag = True;
					$conectar->desconectar();
						
			}
				
			
			

?>