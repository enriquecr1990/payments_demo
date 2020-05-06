<?php

require_once 'vendor/autoload.php';

MercadoPago\SDK::setAccessToken('TEST-4646605633582722-062718-c94aaf0a7aba347aa205502c610e1b9a-53238234');

$post = $_POST;

$payment = new MercadoPago\Payment();
$payment->transaction_amount = 189; //el monto lo determinaremos en el sistema a implementar ya sea en el backend o el frontend
$payment->token = $post['token'];
/** la descripcion la determinaremos por el pago del curso
 *  considerar utilizar un codigo de pago para el manejo interno de la BD y el proceso de pagos
 */
$payment->description = "Probando el pago de 'Mercado Pago'";
/**
 * es para el numero de pagos en los que se hara el monto total
 * por el momento solo manejar 1 para pago en una sola exhibición
 */
$payment->installments = 1;
$payment->payment_method_id = $post['payment_method_id'];
/**
 * es el correo que agregaria el usuario que esta pagando con la tarjeta
 * verificar si es necesario el campo y si puede ir vacio
 */
$payment->payer = array(
    "email" => "enrique_cr1990@hotmail.com"
);
/**
 * de igual forma considerar si es obligatorio los campos de documentos de identidad para los pagos
 */

// Guarda y postea el pago
$payment->save();


// Imprime el estado del pago
var_dump($payment);
//echo '<pre>';print_r($payment);
