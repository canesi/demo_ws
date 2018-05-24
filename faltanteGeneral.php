<?php
//include('FaltantesUtt.php');
include('Faltantes.php');
/*
$correoFaltanteUtt= new FaltantesUtt;
$correoFaltanteUtt->EnviarUtt();

*/
$correoFaltante= new Faltantes;
$correoFaltante->EnviarFarmacias();
$correoFaltante->EnviarUtt();
//echo "aqui estoy";
?>