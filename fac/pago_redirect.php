<?php

include_once 'private/FacRsk.php';
include_once 'private/ConfigFac.php';

//obtendremos los datos conforme al pais que llegue del front
$country = $_GET['country'];
$data_country = ConfigFac::countryConfig($country);
$procesar_pago = sizeof($data_country) > 0;

if($procesar_pago){
     $data_country['url'] = 'https://staging.ptranz.com/api';
     $facRsk = new FacRsk(
          $data_country['url'],
          $data_country['id'],
          $data_country['pass'],
          $data_country['country'],
          $data_country['currency'],
          $data_country['hosted_page_set'],
          $data_country['hosted_page_name'],
     );
     
     $facRsk->procesarPagoRedirect();
}else{
     $data['status'] = false;
     $data['msg'] = ['No llego el pais como parametro'];
     echo json_encode($data);exit;
}
