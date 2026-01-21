<?php
// Permitir acceso desde cualquier origen
header("Access-Control-Allow-Origin: *");

// Opcional: Especificar los métodos HTTP permitidos
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

// Opcional: Especificar las cabeceras permitidas por el cliente
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, X-API-KEY");

// Manejar la solicitud "preflight" OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    die();
}

include_once ('private/FacRsk.php');

// $facRsk = new FacRsk();
var_dump($_POST);exit;
$resultado = $facRsk->execPago($_POST['SpiToken']);
$data['resultado'] = json_decode($resultado);
echo json_encode($data);exit;