<?php
error_reporting(E_ALL);
ini_set('include_path', ini_get('include_path').';../Classes/');
/*para coneccion a bd y envio de correos*/
include('EnviarMail.php');
include('conexion.php');
/** PHPExcel */
include 'Classes/PHPExcel.php';
include 'Classes/PHPExcel/Writer/Excel2007.php';

class Faltantes {
			function EnviarUtt()
			{
						
					$conectar = new conexion;
					$bandera_datos=False;
					$flag = False;
					$id_visitas=array();
					$fecha= date('Y-m-j');
					$fechaAnterior = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
					$fechaAnterior = date ( 'Y-m-j' , $fechaAnterior );

					//$fecha="2016-01-21";
					//$fechaAnterior = "2016-01-20";



					$conectar->conectar();
						if (mysqli_connect_errno())
						{
							echo "Fallo la conexion a la Base de datos";
							exit();
							$flag = False;
						}
						else
						{
							try{
								$contador=0;
								$queryDestinatarios="select correo_para,correo_cc from alerta_destinatario where reporte like '%faltante_utt%'";
								$resultDestinatario=mysqli_query($conectar->conectar(),$queryDestinatarios);
								mysqli_data_seek ($resultDestinatario,0);
								$recuperadoP = mysqli_fetch_array($resultDestinatario);
								$para= $recuperadoP['correo_para'];
								$copia= $recuperadoP['correo_cc'];


								$queryVisitas='SELECT visita.fecha as hora, zona.nombre as zona, cliente.nombre as cliente, categoria.nombre as categoria, subcategoria.nombre as subcategoria, sku.descripcion as sku FROM cliente, categoria, subcategoria, sku, visita, faltante, zona WHERE faltante.visita = visita.id_visita AND visita.cliente = cliente.id_cliente AND cliente.zona = zona.id_zona AND faltante.sku = sku.id_sku AND sku.categoria = categoria.id_categoria AND sku.subcategoria = subcategoria.id_subcategoria AND faltante.flag = 0 AND visita.fecha BETWEEN "'.$fechaAnterior.' 18:00:00" and "'.$fecha.' 17:59:59" and visita.mercaderista NOT IN (146, 157) ORDER BY zona.nombre, cliente.nombre, categoria.nombre, subcategoria.nombre, sku.descripcion';
								$resultVisitas= mysqli_query($conectar->conectar(),$queryVisitas);
								$validacion=mysqli_num_rows($resultVisitas);
								//echo $queryVisitas;
								
								$queryVisitas1='SELECT visita.fecha as hora, zona.nombre as zona, cliente.nombre as cliente, categoria.nombre as categoria, subcategoria.nombre as subcategoria,sku_formato.upc as upc, sku_formato.descripcion as sku FROM cliente, categoria, subcategoria, sku_formato, visita, faltante, zona WHERE faltante.visita = visita.id_visita AND visita.cliente = cliente.id_cliente AND cliente.zona = zona.id_zona AND faltante.sku = sku_formato.id_sku AND sku_formato.categoria = categoria.id_categoria AND cliente.tipo_cliente in (1,2,3,7,8,9)  AND sku_formato.subcategoria = subcategoria.id_subcategoria AND faltante.flag = 1 AND visita.fecha BETWEEN "'.$fechaAnterior.' 18:00:00" and "'.$fecha.' 17:59:59" and visita.mercaderista NOT IN (146, 157) ORDER BY zona.nombre, cliente.nombre, categoria.nombre, subcategoria.nombre, sku_formato.descripcion';
								$resultVisitas1= mysqli_query($conectar->conectar(),$queryVisitas1);
								$validacion1=mysqli_num_rows($resultVisitas1);
								$datosExcel=$resultVisitas1;
								//echo "<br>".$queryVisitas1;	
								if($validacion!=0 OR $validacion1 != 0)
								{
									$datos.="<table border ='3;'>
									<th BGCOLOR='#6D8FFF'>HORA</th>
									<th BGCOLOR='#6D8FFF'>CADENA</th>
									<th BGCOLOR='#6D8FFF'>CLIENTE</th>
									<th BGCOLOR='#6D8FFF'>CATEGORIA</th>
									<th BGCOLOR='#6D8FFF'>SUBCATEGORIA</th>
									<th BGCOLOR='#6D8FFF'>UPC</th>
									<th BGCOLOR='#6D8FFF'>DESCRIPCION</th>";
									while($row = $resultVisitas->fetch_assoc())
									{	
										$hora[$contador] = $row["hora"]."\t";
										$zona[$contador] = $row["zona"]."\t";
										$cliente[$contador]=$row["cliente"]."\t";
										$categoria[$contador] = $row["categoria"]."\t";
										$subcategoria[$contador]=$row["subcategoria"]."\t";
										$upc[$contador]=$row["upc"]."\t";
										$sku[$contador] = $row["sku"]."<br>";

										$datos.= "<tr>";
										$datos.="<td>".substr($hora[$contador],-10)."</td>";
										$datos.= "<td>".$zona[$contador]."</td>";
										$datos.= "<td>".$cliente[$contador]."</td>";
										$datos.="<td>".$categoria[$contador]."</td>";
										$datos.="<td>".$subcategoria[$contador]."</td>";
										$datos.="<td>".$upc[$contador]."</td>";
										$datos.= "<td>".$sku[$contador]."</td>";
										$contador = $contador + 1;
										$datos.="</tr>";
									}

									while($row = $resultVisitas1->fetch_assoc())
									{
										$hora[$contador] = $row["hora"]."\t";
										$zona[$contador] = $row["zona"]."\t";
										$cliente[$contador]=$row["cliente"]."\t";
										$categoria[$contador] = $row["categoria"]."\t";
										$subcategoria[$contador]=$row["subcategoria"]."\t";
										$upc[$contador]=$row["upc"]."\t";
										$sku[$contador] = $row["sku"]."<br>";

										$datos.= "<tr>";
										$datos.="<td>".substr($hora[$contador],-10)."</td>";
										$datos.= "<td>".$zona[$contador]."</td>";
										$datos.= "<td>".$cliente[$contador]."</td>";
										$datos.="<td>".$categoria[$contador]."</td>";
										$datos.="<td>".$subcategoria[$contador]."</td>";
										$datos.="<td>".$upc[$contador]."</td>";
										$datos.= "<td>".$sku[$contador]."</td>";
										$contador = $contador + 1;
										$datos.="</tr>";
									}
										$queryVisitas='SELECT visita.fecha as hora, zona.nombre as zona, cliente.nombre as cliente, categoria.nombre as categoria, subcategoria.nombre as subcategoria,sku_formato.upc as upc, sku_formato.descripcion as sku FROM cliente, categoria, subcategoria, sku_formato, visita, faltante, zona WHERE faltante.visita = visita.id_visita AND visita.cliente = cliente.id_cliente AND cliente.zona = zona.id_zona AND faltante.sku = sku_formato.id_sku AND sku_formato.categoria = categoria.id_categoria AND cliente.tipo_cliente in (1,2,3,7,8,9)  AND sku_formato.subcategoria = subcategoria.id_subcategoria AND faltante.flag = 1 AND visita.fecha BETWEEN "'.$fechaAnterior.' 18:00:00" and "'.$fecha.' 17:59:59" and visita.mercaderista NOT IN (146, 157) ORDER BY zona.nombre, cliente.nombre, categoria.nombre, subcategoria.nombre, sku_formato.descripcion';

										$resultVisitas= mysqli_query($conectar->conectar(),$queryVisitas);
									
										$datos.= "</table>";
										//Crear el archivo excel adjunto
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
											$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'HORA');
											$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'ZONA');
											$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'CLIENTE');
											$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'CATEGORIA');
											$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'SUBCATEGORIA');
											$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'UPC');
											$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'DESCRIPCION');
											//Estilo para los encabezados
											$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->setAutoFilter("A1:G1");

											//Numero de fila donde se va a comenzar a rellenar
											$i = 2; 
											//
											//llena el excel con los datos que se estan asignando
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

											//ajusta el tamaño de las celdas
											foreach(range('A','G') as $columnID) {
												$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
													->setAutoSize(true);
												
											}

											//nombre de la hoja activa
											$nombre_hoja="FaltantesUtt".$fecha;
											$objPHPExcel->getActiveSheet()->setTitle($nombre_hoja);


											// para guardar el archivo en Excel 2007 y la ubicacion
											$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
											$objWriter->save('/var/www/html/mycis_kc_ws/plantilla/faltanteUtt.xlsx','Excel2007');

									$bandera_datos=True;
									
								}
								else
								{
									$bandera_datos=False;
									$datos =	'<div class="alert alert-success"><strong>NO SE GENERARON REGISTROS DE FALTANTE </strong></div>';
									

								}

							}
								catch(Exception $e)
								{
									echo $e;
								}
							$flag = True;
							$conectar->desconectar();
						
						}

						try
						{
							if($flag == True)
							{
								if($bandera_datos==true)
								{
									$enviar = new EnviarMail;
									$body = file_get_contents("plantilla/FaltanteKCmail.html");
									$sustituirCliente="%datos%";
									$body= str_replace($sustituirCliente,$datos,$body);
									$codigoN= "&Ntilde;";
									$sustituirN="Ñ";
									$body= str_replace($sustituirN,$codigoN,$body);
									$adjunto1="http://ourmycis.com/mycis_kc_ws/plantilla/faltanteUtt.xlsx";
									$no="faltanteUtt.xlsx";
									//ENVIO DE CORREO CON ADJUNTO
									/*$para == destino|| $copia == direccion copia ||asunto concatenada con fecha || $direccion del archivo adjunto || $nombre del archivo*/
									
									$enviar-> enviarCorreo2($para,$copia," UTT-REPORTE FALTANTE  ".$fecha,$body,$adjunto1,$no);
								//	$enviar-> enviarCorreo2("kevin.barrios@novaservicios.com.gt",null," UTT-REPORTE FALTANTE ".$fecha,$body,$adjunto1,$no);
									//$enviar-> enviarCorreo2("kevin.barrios@novaservicios.com.gt",null," REPORTE FALTANTE ".$fecha,$body,$adjunto1,$no);
								}
								elseif ($bandera_datos==false)
								{
									$enviar = new EnviarMail;
									$body = file_get_contents("plantilla/FaltanteKCmail.html");
									$sustituirCliente="%datos%";
									$body= str_replace($sustituirCliente,$datos,$body);
									//ENVIO DE CORREO SIN ADJUNTO
									
									$enviar-> enviarCorreo($para,$copia," UTT-REPORTE FALTANTE ".$fecha,$body);
									
									//$enviar-> enviarCorreo("kevin.barrios@novaservicios.com.gt",null," UTT-REPORTE FALTANTE ".$fecha,$body);
									
									//$enviar-> enviarCorreo("kevin.barrios@novaservicios.com.gt",null," REPORTE FALTANTE ".$fecha,$body);
								
								}
										


							}
						}
						catch(Exception $e)
							{
								echo "captura del error";
								echo $e;
							}

			}	

			function EnviarFarmacias()
			{
						
					$conectar = new conexion;
					$bandera_datos=False;
					$flag = False;
					$id_visitas=array();
					$fecha= date('Y-m-j');
					$fechaAnterior = strtotime ( '-1 day' , strtotime ( $fecha ) ) ;
					$fechaAnterior = date ( 'Y-m-j' , $fechaAnterior );

					//$fecha="2016-01-21";
					//$fechaAnterior = "2016-01-20";



					$conectar->conectar();
						if (mysqli_connect_errno())
						{
							echo "Fallo la conexion a la Base de datos";
							exit();
							$flag = False;
						}
						else
						{
							try{
								$contador=0;
								$queryDestinatarios="select correo_para,correo_cc from alerta_destinatario where reporte like '%faltante_farmacias%'";
								$resultDestinatario=mysqli_query($conectar->conectar(),$queryDestinatarios);
								mysqli_data_seek ($resultDestinatario,0);
								$recuperadoP = mysqli_fetch_array($resultDestinatario);
								$para= $recuperadoP['correo_para'];
								$copia= $recuperadoP['correo_cc'];


								$queryVisitas='SELECT visita.fecha as hora, zona.nombre as zona, cliente.nombre as cliente, categoria.nombre as categoria, subcategoria.nombre as subcategoria, sku.descripcion as sku FROM cliente, categoria, subcategoria, sku, visita, faltante, zona WHERE faltante.visita = visita.id_visita AND visita.cliente = cliente.id_cliente AND cliente.zona = zona.id_zona AND faltante.sku = sku.id_sku AND sku.categoria = categoria.id_categoria AND sku.subcategoria = subcategoria.id_subcategoria AND faltante.flag = 0 AND visita.fecha BETWEEN "'.$fechaAnterior.' 18:00:00" and "'.$fecha.' 17:59:59" and visita.mercaderista NOT IN (146, 157) ORDER BY zona.nombre, cliente.nombre, categoria.nombre, subcategoria.nombre, sku.descripcion';
								$resultVisitas= mysqli_query($conectar->conectar(),$queryVisitas);
								$validacion=mysqli_num_rows($resultVisitas);
								//echo $queryVisitas;
								
								$queryVisitas1='SELECT visita.fecha as hora, zona.nombre as zona, cliente.nombre as cliente, categoria.nombre as categoria, subcategoria.nombre as subcategoria,sku_formato.upc as upc, sku_formato.descripcion as sku FROM cliente, categoria, subcategoria, sku_formato, visita, faltante, zona WHERE faltante.visita = visita.id_visita AND visita.cliente = cliente.id_cliente AND cliente.zona = zona.id_zona AND faltante.sku = sku_formato.id_sku AND sku_formato.categoria = categoria.id_categoria AND cliente.tipo_cliente in (55,56)  AND sku_formato.subcategoria = subcategoria.id_subcategoria AND faltante.flag = 1 AND visita.fecha BETWEEN "'.$fechaAnterior.' 18:00:00" and "'.$fecha.' 17:59:59" and visita.mercaderista NOT IN (146, 157) ORDER BY zona.nombre, cliente.nombre, categoria.nombre, subcategoria.nombre, sku_formato.descripcion';
								$resultVisitas1= mysqli_query($conectar->conectar(),$queryVisitas1);
								$validacion1=mysqli_num_rows($resultVisitas1);
								$datosExcel=$resultVisitas1;
								//echo "<br>".$queryVisitas1;	
								if($validacion!=0 OR $validacion1 != 0)
								{
									$datos.="<table border ='3;'>
									<th BGCOLOR='#6D8FFF'>HORA</th>
									<th BGCOLOR='#6D8FFF'>CADENA</th>
									<th BGCOLOR='#6D8FFF'>CLIENTE</th>
									<th BGCOLOR='#6D8FFF'>CATEGORIA</th>
									<th BGCOLOR='#6D8FFF'>SUBCATEGORIA</th>
									<th BGCOLOR='#6D8FFF'>UPC</th>
									<th BGCOLOR='#6D8FFF'>DESCRIPCION</th>";
									while($row = $resultVisitas->fetch_assoc())
									{	
										$hora[$contador] = $row["hora"]."\t";
										$zona[$contador] = $row["zona"]."\t";
										$cliente[$contador]=$row["cliente"]."\t";
										$categoria[$contador] = $row["categoria"]."\t";
										$subcategoria[$contador]=$row["subcategoria"]."\t";
										$upc[$contador]=$row["upc"]."\t";
										$sku[$contador] = $row["sku"]."<br>";

										$datos.= "<tr>";
										$datos.="<td>".substr($hora[$contador],-10)."</td>";
										$datos.= "<td>".$zona[$contador]."</td>";
										$datos.= "<td>".$cliente[$contador]."</td>";
										$datos.="<td>".$categoria[$contador]."</td>";
										$datos.="<td>".$subcategoria[$contador]."</td>";
										$datos.="<td>".$upc[$contador]."</td>";
										$datos.= "<td>".$sku[$contador]."</td>";
										$contador = $contador + 1;
										$datos.="</tr>";
									}

									while($row = $resultVisitas1->fetch_assoc())
									{
										$hora[$contador] = $row["hora"]."\t";
										$zona[$contador] = $row["zona"]."\t";
										$cliente[$contador]=$row["cliente"]."\t";
										$categoria[$contador] = $row["categoria"]."\t";
										$subcategoria[$contador]=$row["subcategoria"]."\t";
										$upc[$contador]=$row["upc"]."\t";
										$sku[$contador] = $row["sku"]."<br>";

										$datos.= "<tr>";
										$datos.="<td>".substr($hora[$contador],-10)."</td>";
										$datos.= "<td>".$zona[$contador]."</td>";
										$datos.= "<td>".$cliente[$contador]."</td>";
										$datos.="<td>".$categoria[$contador]."</td>";
										$datos.="<td>".$subcategoria[$contador]."</td>";
										$datos.="<td>".$upc[$contador]."</td>";
										$datos.= "<td>".$sku[$contador]."</td>";
										$contador = $contador + 1;
										$datos.="</tr>";
									}
										$queryVisitas='SELECT visita.fecha as hora, zona.nombre as zona, cliente.nombre as cliente, categoria.nombre as categoria, subcategoria.nombre as subcategoria,sku_formato.upc as upc, sku_formato.descripcion as sku FROM cliente, categoria, subcategoria, sku_formato, visita, faltante, zona WHERE faltante.visita = visita.id_visita AND visita.cliente = cliente.id_cliente AND cliente.zona = zona.id_zona AND faltante.sku = sku_formato.id_sku AND sku_formato.categoria = categoria.id_categoria AND cliente.tipo_cliente in (55,56)  AND sku_formato.subcategoria = subcategoria.id_subcategoria AND faltante.flag = 1 AND visita.fecha BETWEEN "'.$fechaAnterior.' 18:00:00" and "'.$fecha.' 17:59:59" and visita.mercaderista NOT IN (146, 157) ORDER BY zona.nombre, cliente.nombre, categoria.nombre, subcategoria.nombre, sku_formato.descripcion';

										$resultVisitas= mysqli_query($conectar->conectar(),$queryVisitas);
									
										$datos.= "</table>";
										//Crear el archivo excel adjunto
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
											$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'HORA');
											$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'ZONA');
											$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'CLIENTE');
											$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'CATEGORIA');
											$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'SUBCATEGORIA');
											$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'UPC');
											$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'DESCRIPCION');
											//Estilo para los encabezados
											$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleArray);
											$objPHPExcel->getActiveSheet()->setAutoFilter("A1:G1");

											//Numero de fila donde se va a comenzar a rellenar
											$i = 2; 
											//
											//llena el excel con los datos que se estan asignando
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

											//ajusta el tamaño de las celdas
											foreach(range('A','G') as $columnID) {
												$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
													->setAutoSize(true);
												
											}

											//nombre de la hoja activa
											$nombre_hoja="FaltantesFarmacias".$fecha;
											$objPHPExcel->getActiveSheet()->setTitle($nombre_hoja);


											// para guardar el archivo en Excel 2007 y la ubicacion
											$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
											$objWriter->save('/var/www/html/mycis_kc_ws/plantilla/faltanteFarmacias.xlsx','Excel2007');

									$bandera_datos=True;
									
								}
								else
								{
									$bandera_datos=False;
									$datos =	'<div class="alert alert-success"><strong>NO SE GENERARON REGISTROS DE FALTANTE </strong></div>';
									

								}

							}
								catch(Exception $e)
								{
									echo $e;
								}
							$flag = True;
							$conectar->desconectar();
						
						}

						try
						{
							if($flag == True)
							{
								if($bandera_datos==true)
								{
									$enviar = new EnviarMail;
									$body = file_get_contents("plantilla/FaltanteKCmail.html");
									$sustituirCliente="%datos%";
									$body= str_replace($sustituirCliente,$datos,$body);
									$codigoN= "&Ntilde;";
									$sustituirN="Ñ";
									$body= str_replace($sustituirN,$codigoN,$body);
									$adjunto1="http://ourmycis.com/mycis_kc_ws/plantilla/faltanteFarmacias.xlsx";
									$no="faltanteFarmacias.xlsx";
									//ENVIO DE CORREO CON ADJUNTO
									/*$para == destino|| $copia == direccion copia ||asunto concatenada con fecha || $direccion del archivo adjunto || $nombre del archivo*/
									
									$enviar-> enviarCorreo2($para,$copia,"FARMA-REPORTE FALTANTE ".$fecha,$body,$adjunto1,$no);
								//	$enviar-> enviarCorreo2("kevin.barrios@novaservicios.com.gt",null,"FARMA-REPORTE FALTANTE ".$fecha,$body,$adjunto1,$no);
									//$enviar-> enviarCorreo2("kevin.barrios@novaservicios.com.gt",null," REPORTE FALTANTE ".$fecha,$body,$adjunto1,$no);
								}
								elseif ($bandera_datos==false)
								{
									$enviar = new EnviarMail;
									$body = file_get_contents("plantilla/FaltanteKCmail.html");
									$sustituirCliente="%datos%";
									$body= str_replace($sustituirCliente,$datos,$body);
									//ENVIO DE CORREO SIN ADJUNTO
									
									$enviar-> enviarCorreo($para,$copia,"FARMA-REPORTE FALTANTE  ".$fecha,$body);
									
									//$enviar-> enviarCorreo("kevin.barrios@novaservicios.com.gt",null," FARMA-REPORTE FALTANTE ".$fecha,$body);
									
									//$enviar-> enviarCorreo("kevin.barrios@novaservicios.com.gt",null," REPORTE FALTANTE ".$fecha,$body);
								
								}
										


							}
						}
						catch(Exception $e)
							{
								echo "captura del error";
								echo $e;
							}

			}
}


?>