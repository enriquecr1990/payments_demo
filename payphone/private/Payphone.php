<?php

include_once 'helper/ComunHelper.php';

class Payphone
{

    private $hostApi;
    private $accessToken;

    function __construct()
    {
        $this->hostApi = 'https://pay.payphonetodoesposible.com/api/';
        $this->accessToken = '_WJDlqPgS1d2vMmbzyTYcrXc4R1iteDV6gQFvrJfSfdABJ2zg7rDloZebTTnHeZYqw7eKKgLtdmVeIvit-XKr67UY-KMWrjDoJD0SwxoY4f-JCPNgxVRpcbixsH-GchGjJMLOQyaVXDnDdE7DB_5V2dyPtAecpe6ff0zw3X8FoJJnmMnaSpj5wHGOXJqM_pBnwglCjQOcUYkWuaHCAhbyIfGurGNIL-xMFEDI7N-BeJq_VKaz0DH9CsXhJBaYSnaChdOFq8lJceJJLn76OBXX3iMghXudP_85g1jscV2hA0Fp_z14HEzluEoNBdzM5wzppU0dv8FkrGjkyU1DlFFDKG28jk';
    }

    public function prepareButton(){
        try{
            $url = $this->hostApi.'button/Prepare';
            $parametros = [
                'responseUrl' => 'http://localhost/personales/metodos_pago/payphone/respose.php',
                'amount' => 1000,
                'amountWithoutTax' => 1000,
                'currency' => 'USD',
                'clientTransactionId' => date('YmdHis'),
                //'phoneNumber' => '592467575099',
                'email' => 'enrique_cr1990@hotmail.com',
                //'documentId' => '0918273465'
            ];
            $options = array(
                //CURLOPT_POST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => json_encode($parametros),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$this->accessToken,
                    'Content-Type: application/json',
                ),
            );

            //return $this->curlopt($url,$options);
            $curlopt = ComunHelper::curlopt($url,$options);
            $response = [
                'status' => true,
                'msg' => ['se genero el boton correctamente'],
                'data' => json_decode($curlopt),
                'curlopt' => $curlopt
            ];
            //var_dump($response);exit;
            return json_encode($response);
        }catch (Exception $ex){
            return json_encode([
                'status' => false,
                'msg' => array(
                    $ex->getMessage()
                )
            ]);
        }
    }

    public function checkPayment($post){
        try{
            $url = $this->hostApi.'button/V2/Confirm';
            $parametros = [
                'id' => $post['id'],
                'clientTxId' => $post['clientTxId']
            ];
            $options = array(
                //CURLOPT_POST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => json_encode($parametros),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$this->accessToken,
                    'Content-Type: application/json',
                ),
            );

            //return $this->curlopt($url,$options);
            $curlopt = ComunHelper::curlopt($url,$options);
            $data = json_decode($curlopt);
            $response = [
                'status' => true,
                'msg' => ['se obtuvo la orden de pago'],
                'data' => $data,
                'extra' => [
                    'authorizationCode' => $data->authorizationCode,
                    'transactionStatus' => $data->transactionStatus,
                    'transactionId' => $data->transactionId,
                ]
            ];
            //var_dump($response);exit;
            return json_encode($response);
        }catch (Exception $ex){
            return json_encode([
                'status' => false,
                'msg' => array(
                    $ex->getMessage()
                )
            ]);
        }
    }

}