<?php

include_once 'Payphone.php';

$pp = new Payphone();
$response = $pp->checkPayment($_POST);
echo $response;exit;