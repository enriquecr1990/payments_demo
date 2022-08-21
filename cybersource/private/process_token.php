<?php

include 'CsPayme.php';

$decidirPayment = new CsPayme();

$requets = (object)$_POST;

$response = $decidirPayment->processToken($requets);

echo json_encode($response);exit;