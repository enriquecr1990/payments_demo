<?php

include_once 'PagueloFacilClave.php';

$pp = new PagueloFacilClave();
$response = $pp->createButton();
echo $response;exit;