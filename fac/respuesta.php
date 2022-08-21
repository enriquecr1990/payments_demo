<?php

include_once ('private/FacRsk.php');

$facRsk = new FacRsk();
var_dump($_POST,json_decode($_POST['Response']));
$resultado = $facRsk->execPago($_POST['SpiToken']);
$data['resultado'] = json_decode($resultado);
echo json_encode($data);exit;