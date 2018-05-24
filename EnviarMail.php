<?php
require 'class.phpmailer.php';

class EnviarMail
	{
		public function enviarCorreo($correo,$cc,$asunto,$mensaje)
			{
				
				$correo= explode (",",$correo);
				$cc= explode(",",$cc);
				$copia=array();
				$destinatario=array();
				if(is_null($correo))
				{
					echo "NO HAY CORREOS";
				}
				else
				{	
					
						$mail = new PHPMailer();
						$mail->IsSMTP();
						//	$mail->SMTPDebug = 2;
						$mail->Host = 'smtp.gmail.com';
						$mail->Helo = 'smtp.gmail.com';
						$mail->Port = 465;
						$mail->SMTPSecure = 'ssl';
						$mail->SMTPAuth   = true;
						$mail->Username   = "admin@novaservicios.com.gt";
						$mail->Password   = "ADN0va2016*/";
						$mail->SetFrom('admin@novaservicios.com.gt', 'M&CIS');
						$mail->Subject = $asunto;
						$mail->CharSet = 'UTF-8';
						for($i=0 , $e=0; $e<=count($cc) or $i<= count($correo); $i++,$e++)
						{
							$destinatario = $correo[$i];
							$mail->AddAddress($destinatario);
							$copia=$cc[$e];
							$mail->AddCC($copia);
						}
						$mail->MsgHTML($mensaje);
						if(!$mail->Send())
						{
							echo "Error: " . $mail->ErrorInfo;
						}
						else
						{
							//echo "ENVIADO";
						}
				
						
				}
			}

		//para enviar correos con archivos adjuntos ubicados en el servidor

		public function enviarCorreo2($correo,$cc,$asunto,$mensaje,$adjunto,$nombre_adjunto)
				{
	
					$correo= explode (",",$correo);
					$cc= explode(",",$cc);
					$copia=array();
					$destinatario=array();
					if(is_null($correo))
					{
						echo "NO HAY CORREOS";
					}
					else
					{
	
							$mail = new PHPMailer();
							$mail->IsSMTP();
							//	$mail->SMTPDebug = 2;
							$mail->Host = 'smtp.gmail.com';
							$mail->Helo = 'smtp.gmail.com';
							$mail->Port = 465;
							$mail->SMTPSecure = 'ssl';
							$mail->SMTPAuth   = true;
							$mail->Username   = "admin@novaservicios.com.gt";
							$mail->Password   = "ADN0va2016*/";
							//$url="https://ourmycis.com/mycis_kc_ws/plantilla/faltante.xlsx";
							$url=$adjunto;
							$nombre=$nombre_adjunto;
							$fichero = file_get_contents($url);
							$mail->addStringAttachment($fichero, $nombre);
							$mail->SetFrom('admin@novaservicios.com.gt', 'M&CIS');
							$mail->Subject = $asunto;
	
							for($i=0 , $e=0; $e<=count($cc) or $i<= count($correo); $i++,$e++)
							{
								$destinatario = $correo[$i];
								$mail->AddAddress($destinatario);
								$copia=$cc[$e];
								$mail->AddCC($copia);
							}
							$mail->MsgHTML($mensaje);
							if(!$mail->Send())
							{
								echo "Error: " . $mail->ErrorInfo;
							}
							else
							{
								//echo "ENVIADO";
							}
	
	
					}
				}
	}
?>