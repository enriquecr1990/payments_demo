<?php

include_once 'MercaPa.php';

$mp = new MercaPa();
$response = $mp->crearPago();
echo json_encode($response);exit;