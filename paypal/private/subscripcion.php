<?php

include_once 'PayPal.php';

$operacion = $_POST['operacion'];
$ppSubs = new PaypalSubscriptions();
http_response_code(200);
switch ($operacion){
     case 'listado_producto':
          $peticion = $ppSubs->listadoProductosSubscripcion();
          $respuesta = [
               'status' => 'ok',
               'message' => ['Operacion con exito','El listado de productos desde paypal se obtuvo correctamente'],
               'data' => ['productos' => $peticion['curl']->products]
          ];
          break;
     case 'agregar_producto':
          $producto_nuevo = $ppSubs->crearProductoSubscripcion();
          $respuesta = [
               'status' => 'ok',
               'message' => ['Operacion con exito','Se guardo el producto en paypal correctamente'],
               'data' => ['producto' => $producto_nuevo['curl']]
          ];
          break;
     case 'listado_plan':
          $planes = $ppSubs->listarPlanSubscripcion();
          $respuesta = [
               'status' => 'ok',
               'message' => ['Operacion con exito','el listado de planes desde paypal se obtuvo correctamente'],
               'data' => [
                    'planes' => $planes['curl']->plans
               ]
          ];
          break;
     case 'agregar_plan':
          $plan_nuevo = $ppSubs->crearPlanSubscripcion();
          $respuesta = [
               'status' => 'ok',
               'message' => ['Operacion con exito','el listado de planes desde paypal se obtuvo correctamente'],
               'data' => [
                    'planes' => $plan_nuevo['curl']
               ],
               'curl_opt' => $plan_nuevo['options'],
          ];
          break;
     default:
          http_response_code(404);
          $respuesta = [
               'status' => 'not_found',
               'message' => ['pagina no encontrada'],
          ];
          break;
}
echo json_encode($respuesta);exit;

class PaypalSubscriptions {

     private $paypal;
     private $accessToken;

     function __construct(){
          $this->paypal = new PayPal();
          $responseToken = $this->paypal->getAccessToken();
          $this->accessToken = $responseToken['curl']->access_token;
     }
     public function listadoProductosSubscripcion(){
          return $this->paypal->listadoProductosSubscripcion($this->accessToken);
     }

     public function crearProductoSubscripcion(){
          $post = $_POST;
          unset($post['operacion']);//quitamos el parametro de operacion para que no llegue al objeto de paypal
          return $this->paypal->crearProductoSubscripcion($post,$this->accessToken);
     }

     public function listarPlanSubscripcion(){
          return $this->paypal->listarPlanSubscripcion($this->accessToken);
     }

     public function crearPlanSubscripcion(){
          $post = $_POST;
          unset($post['operacion']);//quitamos el parametro de operacion para que no llegue al objeto de paypal
          return $this->paypal->crearPlanSubscripcion($post,$this->accessToken);
     }
}