<?php

$params = $_POST;
$bambooAPI = new BambooApi();
if(isset($params['operacion']) && $params['operacion'] != ''){
    switch($params['operacion']){
        case 'crear_orden':
            http_response_code(200);
            $response = $bambooAPI->crearCompra();
            break;
        case 'validar_pago':
            http_response_code(200);
            $response = $bambooAPI->validarCompra($params['purchase_id']);
            break;
        default:
            http_response_code(401);
            $response['status'] = false;
            $response['msg'] = 'Operacion no valida';
            break;
    }
}else{
    http_response_code(404);
    $response['status'] = false;
    $response['msg'] = 'Operacion no valida';
}

echo json_encode($response);exit;

class BambooApi {

    private $url;
    private $private_key;

    function __construct(){
        $this->url = 'https://api.stage.bamboopayment.com/v1/api/';
        $this->url_token = 'https://directtoken.stage.bamboopayment.com/api/';
        $this->private_key = 'gmyI1xTmyW4HgIu_bU3ghd58BNEUanCCgg8JpNGi3G3zXTGq9xCryg__';
    }

    function __destruct(){
        $this->url = null;
    }

    public function crearCompra(){
        $response = [
            'status' => false
        ];
        try{
            
            $dataPost = [
                'Order' => date('dHis'),
                'Amount' => 106200,
                'Capture' => "true",
                'Installments' => 1,
                'Currency' => 'UYU',
                'TargetCountryISO' => "UY",
                'customer' => [
                    'email' => 'enrique_cr1990@hotmail.com',
                    'FirstName' => 'Enrique',
                    'LastName' => 'Corona',
                    'PhoneNumber' => '2467575099',
                    'BillingAddress' => [
                        'AddressType' => 1,
                        'Country' => 'Uruguay',
                        'State' => 'Montevideo',
                        'City' => 'MONTEVIDEO',
                        'AddressDetail' => 'Una calle uruguaya 11',
                        'PostalCode' => '150000',
                    ],
                ],
                'PaymentMediaId' => 101,
                'Redirection' => [
                    'Url_Approved' => 'http://metodospago.local.com/bamboo/pago_procesado.php',
                    'Url_Rejected' => 'http://metodospago.local.com/bamboo/pago_procesado.php',
                    'Url_Canceled' => 'http://metodospago.local.com/bamboo/pago_procesado.php',
                    'Url_Pending' => 'http://metodospago.local.com/bamboo/pago_procesado.php',
                    'Url_Notify' => 'http://metodospago.local.com/bamboo/pago_procesado.php'
                    ],
                'Description' => 'Una compra omnilife dev local',
                'MetaDataIn' => [
                    'PaymentExpirationInMinutes' => 180
                ]
            ];
            $options = array(
                //CURLOPT_URL => $this->url.'purchase',
                CURLOPT_POST => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                //CURLOPT_HEADER => false,
                CURLOPT_POSTFIELDS => json_encode($dataPost),
                CURLOPT_HTTPHEADER => array(
                    //'Accept: application/json',
                    'Content-Type: application/json',
                    'Authorization: Basic '.$this->private_key,
                    'lang: es'
                ),
            );
            $return = ComunHelper::curlopt($this->url.'purchase',$options);
            //var_dump($return);exit;
            $response['status'] = true;
            $response['data']['curlopt'] = json_decode($return);
            $response['data']['post_send'] = $dataPost;
        }catch(Exception $ex){
            $response['msg'] = $ex->getMessage();
            $response['msg'] = $ex->getLine();
            $response['msg'] = $ex->getFile();
        }
        return $response;
    }

    public function validarCompra($purchaseId){
        try{
            $options = array(
                CURLOPT_POST => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                //CURLOPT_HEADER => false,
                CURLOPT_HTTPHEADER => array(
                    //'Accept: application/json',
                    'Content-Type: application/json',
                    'Authorization: Basic '.$this->private_key,
                    'lang: es'
                ),
            );
            $return = ComunHelper::curlopt($this->url.'purchase/'.$purchaseId,$options);
            $response['status'] = true;
            $response['data']['curlopt'] = json_decode($return);
        }catch(Exception $ex){
            $response['status'] = false;
            $response['msg'] = [
                $ex->getMessage(),
                $ex->getLine()
            ];
        }
        return $response;
    }

}


class ComunHelper
{

    public static function curlopt($url_curl,$options){
        $curl = curl_init($url_curl);
        curl_setopt_array($curl,$options);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        if($error){
            $return = $error;
        }else{
            $return = $response;
        }
        return $return;
    }

    public static function base_url(){
        $scheme = 'http://';
        if(isset($_SERVER['REQUEST_SCHEME'])){
            $scheme = $_SERVER['REQUEST_SCHEME'].'://';
        }if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != '' && $_SERVER['HTTPS'] == 'on'){
            $scheme = 'https://';
        }
        $request = str_replace('index.php','',$_SERVER['SCRIPT_NAME']);
        $request = explode('/',$request);
        $url = $scheme.$_SERVER['HTTP_HOST'].implode('/',$request);
        return $url;
    }

}