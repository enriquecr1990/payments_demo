<?php

include "PayPal.php";

$paypal = new PayPal();

$responseToken = json_decode($paypal->getAccessToken());

$captureOrder = $paypal->captureOrder($responseToken->access_token,$_GET['order_id']);

$data['capture_order'] = json_decode($captureOrder);
echo json_encode($data);exit;