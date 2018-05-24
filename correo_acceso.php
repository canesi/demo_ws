<html>
<style type="text/css">
	
</style>

<script type="text/js">
	
</script>

<?php
require 'class.phpmailer.php';
$mail = new PHPMailer();

//recibir parametros
$username = $_POST['username'];
$fecha = $_POST['fecha'];
$app = $_POST['app'];
	
	try{
				$mail->IsSMTP();
				$mail->SMTPDebug = 2;
				$mail->Host = 'smtp.gmail.com';
				$mail->Helo = 'smtp.gmail.com';
				$mail->Port = 465;
				$mail->SMTPSecure = 'ssl';
				$mail->SMTPAuth   = true;
				$mail->Username   = "admin@novaservicios.com.gt";
				$mail->Password   = "ADN0va2016*/";
				$mail->SetFrom('admin@novaservicios.com.gt', 'MYCIS');
				$mail->AddAddress('hugo.sosa@novaservicios.com.gt', 'Hugo Sosa');
				$mail->Subject = "El Usuario ".$username." ha intentado loguearse en la aplicacion ".$app." ";
				
				//Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
				$mail->MsgHTML(
					'<html>'.
					'<body>.
					</h1><h2>Usuario: </h2></h1> '.$username.' <h2>Fecha_Hora: </h2>'.$fecha.'<h2>'.
					'</body>'.
					'</html>');
			   //Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
				$mail->AltBody = 'This is a plain-text message body';
				//Enviamos el correo
				if(!$mail->Send()) {
					echo "Error: " . $mail->ErrorInfo;
				} else {
					echo "Enviado!";
				}
	}catch(Exception $e){
		echo $e;
	}
?>
</html>
