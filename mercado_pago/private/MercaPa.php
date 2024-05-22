<?php

require '../vendor/autoload.php';
include_once 'helper/ComunHelper.php';

class MercaPa{

    private $hostApi;
    private $accessToken;

    function __construct(){
        $this->hostApi = 'https://api.mercadopago.com';
        //$this->accessToken = 'APP_USR-3389036778673031-011316-b621d649ed91b4274d60fb56963b0e4e-1286665637';
        $this->accessToken = 'TEST-4646605633582722-062718-c94aaf0a7aba347aa205502c610e1b9a-53238234';
    }

    public function crearPago(){
        try{
            MercadoPago\SDK::setAccessToken($this->accessToken);
            $preference = new MercadoPago\Preference();
            $items = array();
            for($i = 1; $i < 4; $i++){
                $item = new MercadoPago\Item();
                $item->title = 'SKU-00'.$i;
                $item->quantity = rand(1,5);
                $item->unit_price = rand(200,1000) / 10;
                $item->currency_id = 'MXN';
                $items[] = $item;
            }
            $preference->items = $items;
            //datos del comprador
            $payer =  new MercadoPago\Payer();
            $payer->name = 'kike';
            $payer->surname = 'demo local';
            $payer->email = 'micorreo@hotmail.com';
            $payer->phone = array(
                'area_code' => '',
                'number' => '2461234567'
            );
            $payer->address = array(
                'street_name' => 'Privada playas acuitlapilco',
                'street_number' => 11,
                'zip_code' => '90110',
            );
            $preference->payer = $payer;
            //url de respuestas
            $preference->back_urls = array(
                'success' => 'http://localhost/personales/metodos_pago/mercado_pago/respuesta_mp.php',
                'failure' => 'http://localhost/personales/metodos_pago/mercado_pago/respuesta_mp.php',
                'pending' => 'http://localhost/personales/metodos_pago/mercado_pago/respuesta_mp.php',
            );
            $preference->auto_return = 'approved';
            $preference->payment_methods = array(
//                "excluded_payment_methods" => array(
//                    array("id" => "master")
//                ),
                "excluded_payment_types" => array(
                    array("id" => "bank_transfer"), //transferencia electronica
                    array("id" => "atm"), //despositos en efectivo banco
                    //array("id" => "ticket"), //efectivo oxxo ?
                ),
                "installments" => 12
            );
            //fecha actual
            $dateNow = date('Y-m-d H:i:s',strtotime('-8 hours'));
            $dateTimeNow = new DateTime($dateNow,new DateTimeZone('America/Argentina/Buenos_Aires'));
            //fecha mas 24 horas
            $date = date('Y-m-d H:i:s',strtotime('+32 hours'));
            $dateTime = new DateTime($date,new DateTimeZone('America/Argentina/Buenos_Aires'));
            $preference->expires = true;
            $preference->expiration_date_from = $dateTimeNow->format('c');
            $preference->expiration_date_to = $dateTime->format('c');
            //$preference->date_of_expiration = $dateTime->format('c');
            $preference->save();
            //var_dump($preference->sandbox_init_point,$preference->id);
            $retorno['status'] = true;
            $retorno['msg'] = array('Se obtuvo la preferencia correctamente');
            $retorno['id'] = $preference->id;
            $retorno['init_point'] = $preference->sandbox_init_point;
            $retorno['items'] = (array)$items;
            $retorno['preference_array'] = (array)$preference;
            $retorno['preference'] = $preference->toArray();
        }catch (Exception $ex){
            $retorno['status'] = true;
            $retorno['msg'][] = 'Lo siento no fue posible crear la orden';
            $retorno['msg'][] = $ex->getMessage();
        }
        return $retorno;

    }

    public function validarPago($idPayment){
        $url = $this->hostApi.'/v1/payments/'.$idPayment;
        $options = array(
            //CURLOPT_POST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$this->accessToken,
                'Content-Type: application/json',
            ),
        );

        //return $this->curlopt($url,$options);
        $return = ComunHelper::curlopt($url,$options);
        $return = json_decode($return);
        return $return;
    }

}
