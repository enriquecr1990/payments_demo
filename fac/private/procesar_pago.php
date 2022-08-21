<?php

include_once 'FacRsk.php';

$facRsk = new FacRsk();

$resultado = $facRsk->procesarPago();
$data['resultado'] = json_decode($resultado);

echo json_encode($data);exit;