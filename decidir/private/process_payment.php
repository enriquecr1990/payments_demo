<?php

include 'DecidirPayment.php';

$decidirPayment = new CsPayme();

$requets = (object)$_POST;

$response = $decidirPayment->processPayment($requets);

echo json_encode($response);exit;