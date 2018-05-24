<!DOCTYPE html>
<html>
<head>
<title>Autorizacion Fuera de Ruta</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<link href='//fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<style type = "text/css">

html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,dl,dt,dd,ol,nav ul,nav li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline;}
article, aside, details, figcaption, figure,footer, header, hgroup, menu, nav, section {display: block;}
ol,ul{list-style:none;margin:0px;padding:0px;}
blockquote,q{quotes:none;}
blockquote:before,blockquote:after,q:before,q:after{content:'';content:none;}
table{border-collapse:collapse;border-spacing:0;}
/* start editing from here */
a{text-decoration:none;}
.txt-rt{text-align:right;}/* text align right */
.txt-lt{text-align:left;}/* text align left */
.txt-center{text-align:center;}/* text align center */
.float-rt{float:right;}/* float right */
.float-lt{float:left;}/* float left */
.clear{clear:both;}/* clear float */
.pos-relative{position:relative;}/* Position Relative */
.pos-absolute{position:absolute;}/* Position Absolute */
.vertical-base{	vertical-align:baseline;}/* vertical align baseline */
.vertical-top{	vertical-align:top;}/* vertical align top */
nav.vertical ul li{	display:block;}/* vertical menu */
nav.horizontal ul li{	display: inline-block;}/* horizontal menu */
img{max-width:100%;}
/*end reset*/
body{
	font-family: 'Oswald', sans-serif;
	background:#34495e;
}
/*-- main --*/
.main{
	padding:5.7em 0 4em;
}
.main h1{
	text-align:center;
	color:#d0e2f5;
	margin: 0 0 3em;
    font-size: 1.5em;
}
.main-bdy{
	width: 45%;
    margin: 0 auto;
    padding: 5em 3em;
    background: #fff;
    border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	-o-border-radius: 5px;
	-ms-border-radius: 5px;
}
.main-body-left{
	float: left;
    width: 45%;
    border-right: 1px solid #D7D7D7;
    padding-right: 2em;
	padding-bottom: 3em;
}
.main-body-left ul{
	padding:0 0 1em;
	margin:0;
	text-align: center;
}
.main-body-left ul li{
	display:inline-block;
}
.main-body-left ul li a.in{
	background: url(../images/img-sp.png) no-repeat -3px -13px;
    display: block;
    width: 81px;
    height: 80px;
}
.main-body-left ul li a.in:hover{
	background: url(../images/img-sp.png) no-repeat -3px -97px;
    display: block;
}
.main-body-left ul li a.v{
	background: url(../images/img-sp.png) no-repeat -92px -13px;
    display: block;
    width: 81px;
    height: 80px;
}
.main-body-left ul li a.v:hover{
	background: url(../images/img-sp.png) no-repeat -92px -97px;
    display: block;
}
.main-body-left ul li a.twitter{
	background: url(../images/img-sp.png) no-repeat -180px -13px;
    display: block;
    width: 81px;
    height: 80px;
}
.main-body-left ul li a.twitter:hover{
	background: url(../images/img-sp.png) no-repeat -180px -97px;
    display: block;
}
.main-body-right{
	float:left;
	width:43%;
	padding-left:2em;
}
.main-body-left h2{
	margin:0;
	color:#8e44ad;
	font-size:1.5em;
}
.main-body-left p{
	font-size:14px;
	color:#999;
	margin:1em 0 0;
	line-height:1.8em;
}
.main-body-right input[type="text"],.main-body-right input[type="email"],.main-body-right textarea{
	outline:none;
	border:1px solid #D7D7D7;
	font-size:14px;
	color:#999;
	padding:10px;
	background:none;
	width:100%;
	font-family: 'Oswald', sans-serif;
}
.main-body-right input[type="email"]{
	margin:1.5em 0;
}
.main-body-right textarea{
	resize:none;
	min-height:100px;
}
.main-body-right input[type="submit"]{
	outline: none;
    border: none;
    background:#8e44ad;
    font-size: 16px;
    padding: 10px 0px;
    width: 35%;
    margin: 1.5em 0 0 13.7em;
    color: #fff;
	cursor:pointer;
	font-family: 'Oswald', sans-serif;
}
.main-body-right input[type="submit"]:hover{
	background:#999;
}
.copy-right{
	margin:2em 0 0;
	text-align:center;
}
.copy-right p{
	font-size:14px;
	color:#fff;
	margin:0;
}
.copy-right p a{
	color:#fff;
}
.copy-right p a:hover{
	color:#8E44AD;
}
/*-- //main --*/
/*-----start-responsive-design------*/
@media (max-width:1440px){
	.main-body-right input[type="submit"] {
		margin: 1.5em 0 0 12.3em;
	}
}
@media (max-width:1366px){
	.main-bdy {
		width: 48%;
	}
}
@media (max-width: 1280px){
	.main-bdy {
		width: 51%;
	}
}
@media (max-width: 1024px){
	.main-bdy {
		width: 65%;
	}
	.main {
		padding: 4em 0;
	}
	.main-body-right input[type="submit"] {
		margin: 1.5em 0 0 12.6em;
	}
}
@media (max-width:768px){
	.main h1 {
		font-size: 1.7em;
		margin: 0 0 1.5em;
	}
	.main-body-right {
		width: 41%;
		padding-left: 1.5em;
	}
	.main-body-left {
		padding-right: 1.5em;
	}
	.main-body-right input[type="submit"] {
		font-size: 13px;
		padding: 8px 0px;
		width: 45%;
		margin:1.5em 0 0 11.3em;
	}
	.main-bdy {
		padding: 3em 2em;
		width: 75%;
	}
	.main {
		min-height: 610px;
	}
}
@media (max-width:736px){
	.main-body-left {
		width: 48%;
	}
	.main-body-right input[type="submit"] {
		margin: 1.5em 0 0 11em;
	}
}
@media (max-width: 667px){
	.main-body-left {
		width: 100%;
		border-right: none;
		float: none;
		padding-bottom: 2em;
	}
	.main-body-right {
		width: 95%;
		padding-left: 0;
	}
}
@media (max-width:480px){
	.main {
		padding: 3em 0;
	}
	.main-bdy {
		padding: 2em 2em;
	}
	.main-body-right input[type="submit"] {
		margin: 1.5em 0 0 15.5em;
	}
}
@media (max-width: 414px){
	.main-body-right input[type="submit"] {
		margin: 1.5em 0 0 13.5em;
	}
}
@media (max-width:384px){
	.main h1 {
		font-size: 1.5em;
		margin: 0 0 1em;
	}
	.main-body-left h2 {
		font-size: 1.2em;
	}
	.main-body-right input[type="submit"] {
		margin: 1.5em 0 0 12.7em;
	}
}
@media (max-width:320px){
	.main-body-left {
		padding-right: 0;
		padding-bottom: 1.5em;
	}
	.main-bdy {
		padding: 1.5em 1em;
		width: 83%;
	}
	.main-body-left p {
		font-size: 13px;
		margin: 0.5em 0 0;
	}
	.main-body-right input[type="text"], .main-body-right input[type="email"], .main-body-right textarea {
		font-size: 13px;
		width: 95%;
	}
	.main-body-right input[type="email"] {
		margin: 0.5em 0;
	}
	.main-body-right input[type="submit"] {
		margin: 1.5em 0 0 10.7em;
	}
	.copy-right p {
		font-size: 13px;
	}
	.main h1 {
		font-size: 1.3em;
	}
}
</style>
</head>
<?php

if (empty($_GET["id_fuera_ruta"]))
{
		echo "<div class='main'>";
		echo "<h1>Indicador fuera de ruta inv&aacute;lido</h1>";
		echo "<div class='main-bdy'>";
		echo "<div class='main-body-left'>";
			
			
		echo "</div>";
		echo "<div class='main-body-right'>";
			echo "<h2>Revisa nuevamente el correo generado por M&amp;CIS</h2>";
			
		echo "</div>";
		echo "<div class='copy-right'>";
				echo "<p>Powered by<a href='https://ourmycis.com'>Team M&CIS</a></p>";
				echo "</div>";
				echo "</div>";
}
else{

$id_fuera_ruta = $_GET["id_fuera_ruta"];

/* incluir script de conexion */
include('connect.php');

/* crear objeto de conexion */
$con = new Conexion();

/* obtener la conexion en variable $conn */    
$link = $con->conectar_comp();

 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$sql = "SELECT * FROM fuera_ruta WHERE id_fuera_ruta = ".$id_fuera_ruta;

$result = mysqli_query($link, "SET CHARSET utf8");

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
       
        while($row = mysqli_fetch_array($result)){
            
                $cliente = $row['cliente'];
                $mercaderista = $row['mercaderista'];
                $fecha = $row['fecha'];
                $item = $row['item'];
				$valor = $row['valor'];
				$longitud = $row['longitud'];
				$latitud = $row['latitud'];
				$cliente_externo = $row['cliente_externo'];
				$procesado = $row['procesado'];
            
        }
		
		$arrayFecha = explode(" ", $fecha, 2);
				
		if($procesado == 0)
		{
			
			$sql = "SELECT cliente.nombre AS nombre_cliente, cliente.direccion AS cliente_direccion, departamento.nombre AS nombre_departamento, municipio.nombre AS nombre_municipio, territorio.nombre AS nombre_territorio, zona.nombre AS nombre_zona, mercaderista.nombre AS nombre_mercaderista FROM fuera_ruta, cliente, mercaderista, departamento, municipio, zona, territorio WHERE fuera_ruta.cliente = cliente.id_cliente AND cliente.departamento = departamento.id_departamento AND cliente.municipio = municipio.id_municipio AND cliente.zona = zona.id_zona AND cliente.territorio = territorio.id_territorio AND fuera_ruta.mercaderista = mercaderista.id_mercaderista AND fuera_ruta.id_fuera_ruta = ".$id_fuera_ruta;

			$result = mysqli_query($link, "SET CHARSET utf8");
			if($result = mysqli_query($link, $sql)){
				if(mysqli_num_rows($result) > 0){
       
					while($row = mysqli_fetch_array($result)){
            
					$nombre_cliente = $row['nombre_cliente'];
					$nombre_mercaderista = $row['nombre_mercaderista'];
					$cliente_direccion = $row['cliente_direccion'];
					$nombre_departamento = $row['nombre_departamento'];
					$nombre_municipio = $row['nombre_municipio'];
					$nombre_zona = $row['nombre_zona'];
					$nombre_territorio = $row['nombre_territorio'];
					}
				}
			}
						
			echo "<body>";
			echo "<div class='main'>";
			echo "<h1>El Usuario ".$nombre_mercaderista." No visitar&aacute; el punto de venta ".$nombre_cliente."</h1>";
			echo "<div class='main-bdy'>";
				echo "<div class='main-body-left'>";
					echo "<h2>Ubicacion en donde ".$nombre_mercaderista." realiz&oacute; la operaci&oacute;n</h2><br />";
					echo "<div id='map' style='width:100%;height:350px;'></div>";
				echo "</div>";
				echo "<div class='main-body-right'>";
					echo "El usuario ".$nombre_mercaderista." ha indicado que el dia ".$arrayFecha[0]." a las ".$arrayFecha[1]." no podr&aacute; visitar el punto de venta ". $nombre_cliente." ubicado en ".$cliente_direccion.", ". $nombre_municipio.", ".$nombre_departamento." por la siguiente razon ".$valor." si esto es correcto por favor presionar el boton Aceptar de lo contrario presionar el boton Rechazar y contactarse con el usuario para las justificaciones pertinentes";
					echo "<form action='procesar_fuera_ruta.php' method='post'>";
						echo "<input type='hidden' name='id_fuera_ruta' id='id_fuera_ruta' value='".$id_fuera_ruta."'>";
						echo "<input type='hidden' name='cliente' id='cliente' value='".$cliente."'>";
						echo "<input type='hidden' name='mercaderista' id='mercaderista' value='".$mercaderista."'>";
						echo "<input type='hidden' name='fecha' id='fecha' value='".$fecha."'>";
						echo "<input type='hidden' name='item' id='item' value='".$item."'>";
						echo "<input type='hidden' name='valor' id='valor' value='".$valor."'>";
						echo "<input type='hidden' name='longitud' id='longitud' value='".$longitud."'>";
						echo "<input type='hidden' name='latitud' id='latitud' value='".$latitud."'>";
						echo "<input type='hidden' name='cliente_externo' id='cliente_externo' value='".$cliente_externo."'>";
						
						echo "<input type='submit' value='Autorizar'>";
					echo "</form>";
					echo "<form action='rechazar_fuera_ruta.php' method='post'>";
						echo "<input type='hidden' name='id_fuera_ruta' id='id_fuera_ruta' value='".$id_fuera_ruta."'>";
												
						echo "<input type='submit' value='Rechazar'>";
					echo "</form>";
				echo "</div>";
				echo "<div class='clear'></div>";
				echo "</div>";
				echo "<div class='copy-right'>";
				echo "<p>Powered by<a href='https://ourmycis.com'>Team M&CIS</a></p>";
				echo "</div>";
				echo "</div>";
			

		}
		else
		{
			$sql = "SELECT cliente.nombre AS nombre_cliente, cliente.direccion AS cliente_direccion, departamento.nombre AS nombre_departamento, municipio.nombre AS nombre_municipio, territorio.nombre AS nombre_territorio, zona.nombre AS nombre_zona, mercaderista.nombre AS nombre_mercaderista FROM fuera_ruta, cliente, mercaderista, departamento, municipio, zona, territorio WHERE fuera_ruta.cliente = cliente.id_cliente AND cliente.departamento = departamento.id_departamento AND cliente.municipio = municipio.id_municipio AND cliente.zona = zona.id_zona AND cliente.territorio = territorio.id_territorio AND fuera_ruta.mercaderista = mercaderista.id_mercaderista AND fuera_ruta.id_fuera_ruta = ".$id_fuera_ruta;

			$result = mysqli_query($link, "SET CHARSET utf8");
			if($result = mysqli_query($link, $sql)){
				if(mysqli_num_rows($result) > 0){
       
					while($row = mysqli_fetch_array($result)){
            
					$nombre_cliente = $row['nombre_cliente'];
					$nombre_mercaderista = $row['nombre_mercaderista'];
					$cliente_direccion = $row['cliente_direccion'];
					$nombre_departamento = $row['nombre_departamento'];
					$nombre_municipio = $row['nombre_municipio'];
					$nombre_zona = $row['nombre_zona'];
					$nombre_territorio = $row['nombre_territorio'];
					}
				}
			}
			echo "<body>";
			echo "<div class='main'>";
			echo "<h1>REGISTRO PROCESADO. <br />El Usuario ".$nombre_mercaderista." No visitar&aacute; el punto de venta ".$nombre_cliente."</h1>";
			echo "<div class='main-bdy'>";
				echo "<div class='main-body-left'>";
					echo "<h2>Ubicacion en donde ".$nombre_mercaderista." realiz&oacute; la operaci&oacute;n</h2><br />";
					echo "<div id='map' style='width:100%;height:350px;'></div>";
				echo "</div>";
				echo "<div class='main-body-right'>";
					echo "El usuario ".$nombre_mercaderista." ha indicado que el dia ".$arrayFecha[0]." a las ".$arrayFecha[1]." no podr&aacute; visitar el punto de venta ". $nombre_cliente." ubicado en ".$cliente_direccion.", ". $nombre_municipio.", ".$nombre_departamento." por la siguiente razon ".$valor." si esto es correcto por favor presionar el boton Aceptar de lo contrario presionar el boton Rechazar y contactarse con el usuario para las justificaciones pertinentes";
					
				echo "</div>";
				echo "<div class='clear'></div>";
				echo "</div>";
				echo "<div class='copy-right'>";
				echo "<p>Powered by<a href='https://ourmycis.com'>Team M&CIS</a></p>";
				echo "</div>";
				echo "</div>";
		}
       
        mysqli_free_result($result);
    } else{
        echo "No hay registros";
    }
} else{
    echo "ERROR: Servidor" . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
}
?>

<script>
function initMap() {

	var myLatLng = {lat: <?php echo $latitud?>, lng: <?php echo $longitud?>};

        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          scrollwheel: false,
          zoom: 12
        });

        // Create a marker and set its position.
        var marker = new google.maps.Marker({
          map: map,
          position: myLatLng,
          title: '<?php echo $nombre_cliente?>'
        });
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFd5TPtAB2yNG61drjphfVBjfGPmcYIhM&callback=initMap" async defer></script>
</body>
</html>
