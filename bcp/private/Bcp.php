<?php

include_once 'helper/ComunHelper.php';

class Bcp{

     private $params;

     public function __construct(){
          // $this->params['url'] = 'https://sandbox.openbanking.bcp.com.bo/Web_ApiQr/api/v4/Qr/Generated';
          // $this->params['username'] = 'OMNILIFE_USER';
          // $this->params['password'] = 'hhgce88a0234d3b43232a85464aadfr';
          // $this->params['user_id'] = 'OMNILIFEUser28032025';
          // $this->params['public_token'] = 'C9F13996-C678-4164-B54E-3195426AFEC5';
          // $this->params['service_code'] = '050'; //validar este campo con alan, probamos con el de la documentaicon
          // $this->params['bussiness_code'] = '0341';
          // // $this->params['certificate_pfx'] = 'D:\Desarrollo\personales\metodos_pago\bcp\private\BCP_SANDBOX_OPENBANKING.pfx';
          // // $this->params['certificate_pem'] = 'D:\Desarrollo\personales\metodos_pago\bcp\private\bcpcertificate.pem';
          // $this->params['certificate_pfx'] = __DIR__.'/BCP_SANDBOX_OPENBANKING.pfx';
          // $this->params['certificate_pem'] = __DIR__.'/bcpcertificate.pem';
          // // $this->params['certificate_pfx'] = 'D:\Desarrollo\personales\metodos_pago\bcp\private\bcpcertificate.pem';
          // $this->params['password_pfx'] = 'Arquitectura2025$';
          //datos para probar produccion
          $this->params['url'] = 'https://openbanking.bcp.com.bo/Web_ApiQr/api/v4/Qr/Generated';
          $this->params['username'] = 'OMNILIFE_USER';
          $this->params['password'] = 'm,szYTq4xL97ga.v';
          $this->params['user_id'] = 'OMNILIFEUser20250516';
          $this->params['public_token'] = 'A2A8E689-CDA5-46C4-9B82-9431EDD76688';
          $this->params['service_code'] = '050'; //validar este campo con alan, probamos con el de la documentaicon
          $this->params['bussiness_code'] = '0491';
          $this->params['certificate_pfx'] = __DIR__.'/OMNIB.pfx';
          $this->params['certificate_pem'] = __DIR__.'/OMNIB.pem';
          // $this->params['certificate_pfx'] = 'D:\Desarrollo\personales\metodos_pago\bcp\private\bcpcertificate.pem';
          $this->params['password_pfx'] = 'yGi4.50kDqo,jUel';
     }

     public function b64UP(){
          echo base64_encode($this->params['username'].':'.$this->params['password']);
     }

     public function createQR(){
          try{
               $curl = curl_init();
               $identificador = 'Omni-TestPROD-'.date('YmdHis');
               $authorization = base64_encode($this->params['username'].':'.$this->params['password']);
               $headers = [
                    'Content-Type: application/json',
                    'Correlation-Id: '.$identificador,
                    'Authorization: Basic '.$authorization
               ];
               $post = [
                    'appUserId' => $this->params['user_id'],
                    'currency' => 'BOB', //moneda de bolivia
                    'amount' => 150.55, //formato numerico con dos decimales
                    'gloss' => $identificador, //generar qr como campo dinamico
                    'enableBank' => 'ALL', //codigo de servicio asignado a la empresa
                    'serviceCode' => $this->params['service_code'], //codigo de servicio asignado a la empresa
                    'businessCode' => $this->params['bussiness_code'], //codigo de empresa asignado
                    'singleUse' => true, //qr de uso unico
                    'city' => 'La paz', //nombre de la ciudad de la sucursal
                    'branchOffice' => 'Omnilife Bolivia', //sucursal de la empresa
                    'teller' => 'online', //nombre o identificador de la caja
                    'phoneNumber' => '2467575099',
                    'publicToken' => $this->params['public_token'],
                    'expiration' => '00/00:05',//expiracion del qr dia/hora:minutos
               ];
               
               $this->pfxToPem();
               $options = array(
                    // CURLOPT_URL => 'https://sandbox.openbanking.bcp.com.bo/Web_ApiQr/api/v4/Qr/Generated',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($post),
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_SSL_VERIFYHOST => '2',
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSLCERT =>  $this->params['certificate_pem'],
                    CURLOPT_SSLCERTPASSWD => $this->params['password_pfx'],
               );

               $return = ComunHelper::curlopt($this->params['url'],$options);
               $response['status'] = true;
               $response['data']['bcp'] = json_decode($return);
               $response['data']['post_send'] = $post;
          }catch(Exception $ex){
               $response['msg'] = $ex->getMessage();
               $response['msg'] = $ex->getLine();
               $response['msg'] = $ex->getFile();
          }
          return $response;   
     }

     public function createQR_(){
          try{
               $identificador = 'Omni-Test-'.date('YmdHis');
               $authorization = base64_encode($this->params['username'].''.$this->params['password']);
               $headers = [
                    'Content-Type: application/json',
                    'Correlation-Id: '.$identificador,
                    'Authorization: Basic '.$authorization
               ];
               $post = [
                    'appUserId' => $this->params['user_id'],
                    'currency' => 'BOB', //moneda de bolivia
                    'amount' => 150.55, //formato numerico con dos decimales
                    'gloss' => '', //generar qr como campo dinamico
                    'enableBank' => 'ALL', //codigo de servicio asignado a la empresa
                    'serviceCode' => $this->params['service_code'], //codigo de servicio asignado a la empresa
                    'businessCode' => $this->params['bussiness_code'], //codigo de empresa asignado
                    'singleUse' => true, //qr de uso unico
                    'city' => 'La paz', //nombre de la ciudad de la sucursal
                    'branchOffice' => 'Omnilife Bolivia', //sucursal de la empresa
                    'teller' => 'online', //nombre o identificador de la caja
                    'phoneNumber' => '2467575099',
                    'publicToken' => $this->params['public_token'],
                    'expiration' => '01/00:00',//expiracion del qr dia/hora:minutos
                    // 'collectors' => [
                    //      'name' => '',
                    //      'parameter' => '',
                    //      'paremeter' => '',
                    //      'value' => '',
                    // ],//este campo es opcional.... se probo en el postman
               ];

               $curl = curl_init();
               $pem = 'D:\Desarrollo\personales\metodos_pago\bcp\private\bcpcertificate_php.pem';
               if (openssl_pkcs12_read(file_get_contents('D:\Desarrollo\personales\metodos_pago\bcp\private\BCP_SANDBOX_OPENBANKING.pfx'), $certs, 'Arquitectura2025$')) {
                    file_put_contents($pem,$certs['cert'].$certs['pkey']);
                    echo 'se convirtio pfx correctamente<br>';
               }else{
                    echo 'ocurrio un error';exit;
               }

               curl_setopt_array($curl, array(
               CURLOPT_URL => 'https://sandbox.openbanking.bcp.com.bo/Web_ApiQr/api/v4/Qr/Generated',
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => '',
               CURLOPT_MAXREDIRS => 10,
               CURLOPT_TIMEOUT => 0,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => 'POST',
               CURLOPT_POSTFIELDS => json_encode($post),
               CURLOPT_HTTPHEADER => $headers,
               CURLOPT_SSL_VERIFYHOST => '2',
               CURLOPT_SSL_VERIFYPEER => false,
               CURLOPT_SSLCERT => $pem,
               // CURLOPT_SSLKEY => $pem,
               CURLOPT_SSLCERTPASSWD => 'Arquitectura2025$',
               ));

               $response = curl_exec($curl);
               $error = curl_error($curl);

               curl_close($curl);
               // var_dump($response,$error);
               $response['status'] = true;
               $response['data']['bcp'] = json_decode($response);
               $response['data']['post_send'] = $post;
          }catch(Exception $ex){
               $response['msg'] = $ex->getMessage();
               $response['msg'] = $ex->getLine();
               $response['msg'] = $ex->getFile();
          }
          return $response;    
     }

     private function pfxToPem(){
          try{
               //validamos si no existe el archivo PEM, para procesarlo para el curlopt
               if(!file_exists($this->params['certificate_pem'])){
                    if (openssl_pkcs12_read(file_get_contents($this->params['certificate_pfx']), $certs, $this->params['password_pfx'])) {
                         file_put_contents($this->params['certificate_pem'],$certs['cert'].$certs['pkey']);
                         // echo 'se convirtio pfx correctamente<br>';
                    }else{
                         // echo 'ocurrio un error';exit;
                    }
               }else{
                    // echo 'ya  existia el pem desde pfx';
               }
          }catch(Exception $ex){
               // echo 'ocurrio un error al transformar el PFX a PEM';
               // echo $ex->getMessage();
               // echo $ex->getFile();
               // echo $ex->getLine();
          }
     }

}