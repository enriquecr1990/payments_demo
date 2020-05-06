<?php
/**
 * Created by PhpStorm.
 * User: enriq
 * Date: 09/12/2019
 * Time: 01:10 PM
 */

class DecidirPayment
{

    private $decidirVars;
    private $orderNumber;
    private $json_response_curl;

    function __construct(){

    }

    public function processToken($request){
        $this->getDecidirVars('token');
        $this->decidirVars[CURLOPT_POSTFIELDS] = $this->getCurlopPostFields($request->post_fields,'token');
        return $this->executeCurl();
    }

    public function processPayment($request){
        $this->getDecidirVars('payment');
        $this->decidirVars[CURLOPT_POSTFIELDS] = $this->getCurlopPostFields($request->post_fields,'payment');
        $result = $this->executeCurl();
        $result['status_sale'] = false;
        if(isset($this->json_response_curl->status) && $this->json_response_curl->status == 'approved'){
            $result['status_sale'] = true;
        }
        return $result;
    }

    private function getCurlopPostFields($request,$type = 'token'){
        $total_amount = 59575;
        $email_buyer = 'enriquecr1990@gmail.com';
        $post_fields = json_decode($request);
        if(isset($post_fields->card_expiration_month) && strlen($post_fields->card_expiration_month) == 1){
            $post_fields->card_expiration_month = '0'.$post_fields->card_expiration_month;
        }
        $post_fields->amount = (int)$total_amount;
        $post_fields->email = $email_buyer;
        $post_fields->customer = [
            'email' => $email_buyer
        ];
        $post_fields->site_transaction_id = substr(time(),-10);
        if($type == 'payment'){
            $post_fields->fraud_detection->purchase_totals->amount = $total_amount;
        }
        if($type != 'token'){
            //var_dump($post_fields);exit;
        }
        return json_encode($post_fields);
    }

    private function getDecidirVars($type='token'){
        $this->decidirVars[CURLOPT_RETURNTRANSFER] = true;
        $this->decidirVars[CURLOPT_ENCODING] = "";
        $this->decidirVars[CURLOPT_MAXREDIRS] = 10;
        $this->decidirVars[CURLOPT_TIMEOUT] = 30;
        $this->decidirVars[CURLOPT_HTTP_VERSION]  = CURL_HTTP_VERSION_1_1;
        $this->decidirVars[CURLOPT_CUSTOMREQUEST] = "POST";
        switch ($type){
            case 'token':
                $this->decidirVars[CURLOPT_URL] = 'https://developers.decidir.com/api/v2/tokens';
                //$this->decidirVars[CURLOPT_HTTPHEADER][] = "apikey: 96e7f0d36a0648fb9a8dcb50ac06d260";//key de omnilife sin cs
                $this->decidirVars[CURLOPT_HTTPHEADER][] = "apikey: dff5d13b20d541e8a7f203fd71449656";//key de omnilife con cs
                //$this->decidirVars[CURLOPT_HTTPHEADER][] = "apikey: 070e4ae588a34f6d8fe67f69247daafd";//key de la documentacion
                break;
            case 'payment':
                $this->decidirVars[CURLOPT_URL] = 'https://developers.decidir.com/api/v2/payments';
                //$this->decidirVars[CURLOPT_HTTPHEADER][] = "apikey: 1b19bb47507c4a259ca22c12f78e881f";//key de omnilife sin cs
                $this->decidirVars[CURLOPT_HTTPHEADER][] = "apikey: db0ab77607504dad9e92917cfd695e97";//key de omnilife con cs
                //$this->decidirVars[CURLOPT_HTTPHEADER][] = "apikey: 6f7e29682a5d4a41bb872513622bc554";//key de la documentacion
                break;
        }
        $this->decidirVars[CURLOPT_HTTPHEADER][] = 'cache-control: no-cache';
        $this->decidirVars[CURLOPT_HTTPHEADER][] = 'content-type: application/json';
        $this->decidirVars[CURLOPT_SSL_VERIFYHOST]  = false;
        $this->decidirVars[CURLOPT_SSL_VERIFYPEER]  = false;
    }

    private function executeCurl($payment = false){
        $return = array(
            'status' => false,
            'error_msg' => array()
        );
        $curl = curl_init();
        curl_setopt_array($curl,$this->decidirVars);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        if($error){
            $return['response_curl'] = $error;
        }else{
            $return['status'] = true;
            $return['response_curl'] = $response;
            $this->json_response_curl = json_decode($response);
        }return $return;
    }
}