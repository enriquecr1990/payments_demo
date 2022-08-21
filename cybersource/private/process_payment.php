<?php

include 'CsPayme.php';

$csPayme = new CsPayme();

$response = $csPayme->getParamsForm();

echo json_encode($response);