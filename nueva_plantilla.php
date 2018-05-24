<?php
include('EnviarMail.php');
//include('conexion.php');



$enviar = new EnviarMail;
			$body = file_get_contents("reportesVarios.html");
									$codigoN= "&Ntilde;";
									$sustituirN="Ã‘";
									$body= str_replace($sustituirN,$codigoN,$body);
									
									
									$enviar-> enviarCorreo("kevin.barrios@novaservicios.com.gt","barrioskevin0@gmail.com"," UTT-REPORTE FALTANTE ",$body,null);
								



?>
