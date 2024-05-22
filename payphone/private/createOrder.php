<?php

include_once 'Payphone.php';

$pp = new Payphone();
$response = $pp->prepareButton();
echo $response;exit;