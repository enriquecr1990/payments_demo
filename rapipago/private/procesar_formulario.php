<?php

include 'RapipagoController.php';

$rapipagoCtrl = new RapipagoController();
$dataform = $rapipagoCtrl->processDataForm();
echo json_encode($dataform);exit;