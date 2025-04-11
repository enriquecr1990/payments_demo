<?php

include_once 'Bcp.php';

$pp = new Bcp();
$response = $pp->createQR();
echo json_encode($response);exit;