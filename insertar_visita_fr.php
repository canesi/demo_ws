<html>

<style type="text/css">

</style>

<script type="text/js">

</script>

<?php
require 'class.phpmailer.php';
$mail = new PHPMailer();
//********************************************************************************************
//lo que si se inserta en la tabla visita fuera de ruta
//para tabla visita fuera de ruta
$cliente = $_POST['cliente'];

$buscar = "Codigo";
$resultado = strpos($cliente, $buscar);
 
if($resultado !== FALSE)
{
	$division = explode(" ",$cliente);

	$cliente = $division[1];
}

$merca = $_POST['merca'];//coigo del mercaderista
$fecha = $_POST['fecha'];
$item = $_POST['item']; //codigo del item
$respuesta = $_POST['valor']; //respuesta del cuestionario
$longitud = $_POST['longitud'];
$latitud = $_POST['latitud'];
$cliente_externo = $_POST['cliente_externo']; //codigo del cliente externo
$procesado = $_POST['procesado']; //valor por defecto 0

//para correo
$nombre_tienda = $_POST['nombre_tienda'];
$validar = $_POST['validar'];//valor 1 si es supervisor y  2 valor si es merca
$direccion = $_POST['direccion'];
$zona = $_POST['zona'];
$territorio = $_POST['territorio'];
$municipio = $_POST['municipio'];
$departamento = $_POST['departamento'];
$id_supervisor= $_POST['id_supervisor'];//codigo del supervisor
$region = $_POST['region']; //convertir a entero

$val1 = "1";
$val2 = "2";
$idmerca = "100";

//para la direccion de la tienda concatenar las variables
//$direccion_tienda = "7 Avenida 3-51 Zona 10, Barrio Ciudad Vieja, Guatemala, Guatemala";
$direccion_tienda = "<br>".$direccion."<br>".$departamento."<br>".$municipio."<br>".$territorio."<br>".$zona."<br>";

/* incluir script de conexion */
include('connect.php');

/* crear objeto de conexion */
$con = new Conexion();

/* obtener la conexion en variable $conn */    
$enlace = $con->conectar_comp();

//variables constantes para correos de coordinadores CP
define("GT","fernando.azmitia@novaservicios.com.gt");
define("ES","hugo.sosa@novaservicios.com.gt");
define("HN","hugo.sosa@novaservicios.com.gt");
define("NI","hugo.sosa@novaservicios.com.gt");
define("PA","hugo.sosa@novaservicios.com.gt");
define("CR","hugo.sosa@novaservicios.com.gt");

$flag = False;



	/* comprobar la conexión */
	if (mysqli_connect_errno()) {
		echo "Fallo la conexion a la Base de datos";
		exit();
		$flag = False;
	}else{
		//*******************************INSERTA LOS DATOS DE LA VISITA
		$query ="INSERT INTO fuera_ruta (cliente,mercaderista,fecha,item,valor,longitud,latitud,cliente_externo,procesado) VALUES ('$cliente','$merca','$fecha','$item','$respuesta','".$longitud."','".$latitud."','$cliente_externo','$procesado')";
		$insercion = mysqli_query($enlace,$query);
		if(!$insercion) die('Error');
		
		//******************************************** HACE LA CONSULTA DEL IDENTIFICADOR DE FUERA DE RUTA A LA BASE DE DATOS
		$queryId_Fuera_de_ruta="SELECT id_fuera_ruta FROM fuera_ruta WHERE mercaderista = '".(int)$merca."' ORDER BY id_fuera_ruta DESC LIMIT 1";
		$resultadoIdFueraRuta=mysqli_query($enlace,$queryId_Fuera_de_ruta);
		mysqli_data_seek ($resultadoIdFueraRuta, 0);
		$idFueraRutaRecuperado=mysqli_fetch_array($resultadoIdFueraRuta);
		$idFueraRuta=$idFueraRutaRecuperado['id_fuera_ruta'];
		//******************************************* OBTIENE DE LA BASE DE DATOS EL NOMBRE DEL Usuario
		$queryNombreMerca="SELECT nombre FROM mercaderista WHERE id_mercaderista = '".(int)$merca."' 'utf8'";
		$result= mysqli_query($enlace,$queryNombreMerca);
		mysqli_data_seek ($result, 0);
		$nombreMerca= mysqli_fetch_array($result);
		$noms= ($nombreMerca['nombre']);
		//******************************************************OBTIENE EL MAIL DEL Destinatario
		$querySupervisor="select email from supervisor where id_supervisor = '".(int)$id_supervisor."'";
		$resultSupervisor= mysqli_query($enlace,$querySupervisor);
		mysqli_data_seek ($resultSupervisor,0);
		$mailRecuperado= mysqli_fetch_array($resultSupervisor);
		$mailSupervisor=$mailRecuperado['email'];

		$flag = True;
	}
	mysqli_close($enlace);

	//condicion para tarea si es supervisor o si es merca
	try{
		if($flag == True){//si la insercion de la visita es exitosa entonces
			if(strcmp($validar,$val2)){//si es supervisor entonces 1
				//enviar correo al coordinador de la region
				$mail->IsSMTP();
				$mail->SMTPDebug = 2;
				$mail->Host = 'smtp.gmail.com';
				$mail->Helo = 'smtp.gmail.com';
				$mail->Port = 465;
				$mail->SMTPSecure = 'ssl';
				$mail->SMTPAuth   = true;
				$mail->Username   = "admin@novaservicios.com.gt";
				$mail->Password   = "ADN0va2016*/";
				$mail->SetFrom('admin@novaservicios.com.gt', 'M&CIS');
				$mail->Subject = "El Usuario ".$noms." esta fuera de ruta!!!";

				$body = file_get_contents("plantilla/mailCoordinador.html");
				// Aquí cambiamos las etiquetas de la plantilla por los datos del formulario
				$sustituir_encargado="%encargado%";
				$sustituir_usuario="%usuario%";
				$sustituir_nombre = "%nombre_mercaderista%";
				$sustituir_tienda= "%nombre_tienda%";
				$sustituir_cliente= "%cliente%";
				$sustituir_respuesta= "%valor%";
				$sustituir_direccion="%direccion%";
				$sustituir_id="%id_Fuera_de_ruta%";
				$body = str_replace($sustituir_id,$idFueraRuta, $body);
				$body = str_replace($sustituir_nombre, $noms, $body);
				$body = str_replace($sustituir_cliente, $cliente, $body);
				$body = str_replace($sustituir_respuesta, $respuesta, $body);
				$body = str_replace($sustituir_tienda, $nombre_tienda, $body);
				$body = str_replace($sustituir_direccion, $direccion_tienda, $body);
				$body = str_replace($sustituir_encargado,"Coordinador", $body);
				$body = str_replace($sustituir_usuario,"Supervisor", $body);


					switch(((int)$region))
						{
							case 1:
									{
									$mail->AddAddress(GT, 'Guatemala');
									break;
									}
							case 2:
									{
									$mail->AddAddress(ES, 'El Salvador');
									break;
									}
							case 3:
									{
									$mail->AddAddress(HN, 'Homduras');
									break;
									}
							case 4:
									{
									$mail->AddAddress(NI, 'Nicaragua');
									break;
									}
							case 5:
									{
									$mail->AddAddress(CR, 'Costa Rica');
									break;
									}
							case 6:
									{
									$mail->AddAddress(PA, 'Panama');
									break;
									}
							default:
									echo'Esto no deberia de pasar';
									break;
						}



				//******************************************************************************************************************
			//	$mail->AddAddress('kevin.barrios@novaservicios.com.gt', 'El Destinatario');
				//******************************************************************************************************************


				//Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
				$mail->MsgHTML($body);
			   //Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
				$mail->AltBody = 'This is a plain-text message body';
				//Enviamos el correo
				if(!$mail->Send()) {
					echo "Error: " . $mail->ErrorInfo;
				} else {
					echo "Enviado!";
				}
			}else if(strcmp($validar,$val1)){//si es mercaderista 2 entonces
				//enviar correo al supervisor de dicho mercaderista
				//hacer consulta para obtener el correo del supervisor en la tabla Supervisor enviandole el id supervisor
				//hacer solo un query para el correo del supervisor

				$mail->IsSMTP();
				$mail->SMTPDebug = 2;
				$mail->Host = 'smtp.gmail.com';
				$mail->Helo = 'smtp.gmail.com';
				$mail->Port = 465;
				$mail->SMTPSecure = 'ssl';
				$mail->SMTPAuth   = true;
				$mail->Username   = "admin@novaservicios.com.gt";
				$mail->Password   = "ADN0va2016*/";
				$mail->SetFrom('admin@novaservicios.com.gt', 'M&CIS');

				//************************************************************************************************************


				//************************************************************************************************************
				$mail->Subject = "El Usuario ".$noms." esta fuera de ruta!!";
				$body = file_get_contents("plantilla/mailCoordinador.html");
				// Aquí cambiamos las etiquetas de la plantilla por los datos del formulario
				$sustituir_encargado2="%encargado%";
				$sustituir_nombre = "%nombre_mercaderista%";
				$sustituir_tienda= "%nombre_tienda%";
				$sustituir_cliente= "%cliente%";
				$sustituir_respuesta= "%valor%";
				$sustituir_direccion="%direccion%";
				$encargado="Supervisor";
				$sustituir_usuario="%usuario%";
				$sustituir_id="%id_Fuera_de_ruta%";
				$body = str_replace($sustituir_id,$idFueraRuta, $body);
				$body = str_replace($sustituir_respuesta, $respuesta, $body);
				$body = str_replace($sustituir_nombre, $noms, $body);
				$body = str_replace($sustituir_cliente, $cliente, $body);
				$body = str_replace($sustituir_tienda, $nombre_tienda, $body);
				$body = str_replace($sustituir_direccion, $direccion_tienda, $body);
				$body = str_replace($sustituir_encargado2,$encargado, $body);
				$body = str_replace($sustituir_usuario,"Mercaderista", $body);

				$mail->AddAddress($mailSupervisor,'Supervisor');

				//ya establecido mail dinamico
				//$mail->AddAddress($mailSupervisor,'El Destinatario');

				//se utiliza solo como prueba
				//$mail->AddAddress('kevin.barrios@novaservicios.com.gt', 'El Destinatario');
				//Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
				$mail->MsgHTML($body);
			   //Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
				$mail->AltBody = 'This is a plain-text message body';
				//Enviamos el correo
				if(!$mail->Send()) {
					echo "Error: " . $mail->ErrorInfo;
				} else {
					echo "Enviado!";
				}
			}else{
			//que hacer sino se pudo insertar la visita de fuera de ruta
				echo "no es ni merca ni supervisor";
			}
		}else{
			echo "error al insertar la visita";
		}
	}catch(Exception $e){
		echo "captura del error";
	}
?>
</html>
