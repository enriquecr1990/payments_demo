<?php

include_once 'MercaPa.php';

$mp = new MercaPa();
$response = $mp->validarPago($_POST['payment_id']);
echo json_encode($response);exit;