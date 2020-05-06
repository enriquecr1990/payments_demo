<?php

include 'DecidirPayment.php';

$decidirPayment = new DecidirPayment();

$requets = (object)$_POST;

$response = $decidirPayment->processPayment($requets);

echo json_encode($response);exit;