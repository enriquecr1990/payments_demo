<?php

include_once 'PagueloFacil.php';

$pp = new PagueloFacil();
$response = $pp->createButton();
echo $response;exit;