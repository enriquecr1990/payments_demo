<?php

include 'DecidirPayment.php';

$decidirPayment = new DecidirPayment();

$requets = (object)$_POST;

$response = $decidirPayment->processToken($requets);

echo json_encode($response);exit;