<?php

include "PayPal.php";

$paypal = new PayPal();
$responseToken = json_decode($paypal->getAccessToken());
$order = $paypal->createOrder($responseToken->access_token);

$data['access_token'] = $responseToken->access_token;
$data['order'] = json_decode($order);
echo json_encode($data);exit;