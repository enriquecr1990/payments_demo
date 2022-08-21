<?php
/**
 * Created by PhpStorm.
 * User: enriq
 * Date: 09/12/2019
 * Time: 01:10 PM
 */

class CsPayme
{

    private $decidirVars;
    private $orderNumber;
    private $json_response_curl;

    function __construct(){

    }

    public function getParamsForm(){
        $response['status'] = true;
        $response['msg'] = array();
        $transaction_uuid = uniqid();
        $order_number = time();
        $data = array(
            'access_key' => 'a28cf855e817353bbfa7bb879541d090',
            'profile_id' => 'F2099F9B-BEB3-4F33-BF9D-EF55274509CC',
            'transaction_uuid' => $transaction_uuid,
            //'signed_field_names' => 'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency',
            'signed_field_names' => 'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,bill_to_forename,bill_to_surname,bill_to_address_line1,bill_to_address_city,bill_to_address_state,bill_to_address_postal_code,bill_to_address_country,bill_to_phone,bill_to_email,merchant_defined_data3,merchant_defined_data4,merchant_defined_data6,merchant_defined_data11,merchant_defined_data16,merchant_defined_data17,merchant_defined_data18,merchant_defined_data24,device_fingerprint_id',
            'signed_date_time' => gmdate("Y-m-d\TH:i:s\Z"),
            'unsigned_field_names' => '',
            'locale' => 'es-es',
            'transaction_type' => 'sale',
            'reference_number' => $order_number,
            'amount' => '105.8',
            'currency' => 'BOB',
            //extra params - validar con el extra config por el cifrado de la firma
            'bill_to_forename' => 'Enrique',
            'bill_to_surname' => 'Corona Ricaño',
            'bill_to_address_line1' => 'AV CIUDAD DEL NIÑO, CALLE 1 NRO.14',
            'bill_to_address_city' => 'La Paz', //localidad validar
            'bill_to_address_state' => 'L', //codigo iso del estado provincia
            'bill_to_address_postal_code' => '0000', //para bolivia son 4 ceros por default
            'bill_to_address_country' => 'BO', //country code ISO
            'bill_to_phone' => '61012387',
            'bill_to_email' => 'enrique_cr1990@hotmail.com',
            'merchant_defined_data3' => '0', //numero total de compras que ha realizado el usuario
            'merchant_defined_data4' => '', //fecha de la ultima compra realizada
            'merchant_defined_data6' => 'Si', //comprador recurrente 'SI' - 'NO'
            'merchant_defined_data11' => '1234567LP', //numero de documento
            'merchant_defined_data16' => 'Sucursal boliviana #1, La Paz',
            'merchant_defined_data17' => 'NO', //compra hecha por un tercero NO APLICA
            'merchant_defined_data18' => '-', //nombre comprador tercero
            'merchant_defined_data24' => '10', //cantidad total de productos
            'device_fingerprint_id' => $transaction_uuid
        );
        $data['signature'] = $this->getSecretParams($data);
        $data['order_number'] = $order_number;
        $data['country_id'] = 2;
        $data['form_action'] = 'https://testsecureacceptance.cybersource.com/pay';
        //extra params
        //$data['bill_to_address_city'] =
        $response['data'] = $data;
        return $response;
    }

    private function getSecretParams($dataForm){
        return $this->signData($this->buildDataToSign($dataForm), '0258b2fa56f240e494517c534a9e69b7a4f8b59b7eca4cc9a0193f981021572777d60d4977e84575815af262dfef21ee5145661a06df4fb5a00093f30da51224e2313b354c944da2a81b8ff92f5317e1872be5aebfe646f3a56e06ea8f1222a2310fd908771b41f7a458c9e12c1cb6532d6a5e4ec3e44974a0a7161ab3a7ff0a');
    }

    private function signData($data,$secretKey){
        return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
    }

    private function buildDataToSign($params){
        $signedFieldNames = explode(",",$params["signed_field_names"]);
        foreach ($signedFieldNames as $field) {
            $dataToSign[] = $field . "=" . $params[$field];
        }
        return $this->commaSeparate($dataToSign);
    }

    private function commaSeparate($dataToSign){
        return implode(",",$dataToSign);
    }
}