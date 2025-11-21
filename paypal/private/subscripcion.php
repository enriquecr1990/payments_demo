<?php

include_once 'PayPal.php';

$operacion = $_POST['operacion'];
$ppSubs = new PaypalSubscriptions();

switch ($operacion){
     case 'listado':
          $respuesta = $ppSubs->listadoProductosSubscripcion();
          break;
}

echo json_encode($respuesta);exit;

class PaypalSubscriptions {

     private $paypal;
     private $accessToken;

     function __construct(){
          $this->paypal = new PayPal();
          $responseToken = json_decode($this->paypal->getAccessToken());
          $this->accessToken = $responseToken->access_token;
     }
     public function listadoProductosSubscripcion(){
          return $this->paypal->listadoProductosSubscripcion($this->accessToken);
     }

     public function crearProductoSubscripcion(){

     }


}