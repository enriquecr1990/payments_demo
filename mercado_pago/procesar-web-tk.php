<?php

require_once 'vendor/autoload.php';

MercadoPago\SDK::setAccessToken('TEST-4646605633582722-062718-c94aaf0a7aba347aa205502c610e1b9a-53238234');

$token = $_REQUEST["token"];
$payment_method_id = $_REQUEST["payment_method_id"];
$installments = $_REQUEST["installments"];
$issuer_id = $_REQUEST["issuer_id"];

$payment = new MercadoPago\Payment();
$payment->transaction_amount = 189;
$payment->token = $token;
$payment->description = "Probando el pago de 'Mercado Pago'";
$payment->installments = $installments;
$payment->payment_method_id = $payment_method_id;
$payment->issuer_id = $issuer_id;
$payment->payer = array(
    "email" => "enriquecr1990@gmail.com"
);
// Guarda y postea el pago
$payment->save();
//...
// Imprime el estado del pago
echo json_encode($_REQUEST);
echo json_encode($payment);exit;
echo $payment->status;