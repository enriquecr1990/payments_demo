<?php

include __DIR__.'\helper\ComunHelper.php';

class PayPal
{

    private $host;
    private $currency;
    private $countryCode;
    private $clientId;
    private $secretId;
    private $locale;

    function __construct(){
        $this->host = 'https://api.sandbox.paypal.com';
        $this->clientId = 'AcfUYK-HphIfaLeyBu_T4KMVB3y89_miFCcnbC0JAm2Ni5TFb7SdOyVDMJc-e_ussi7sT6Yvb9G3Wiep';
        $this->secretId = 'EJ5tbv2ThRtNttYfeBhg0JOYy5OXupkf8-BTI8tV0QCge35tj42RfewdyxoVPyxNufBif1Q_H9G19mFj';
        $this->locale = 'es_MX';
        $this->currency = 'MXN';
        $this->countryCode = 'MX';
    }

    public function getAccessToken(){
        $url = $this->host.'/v1/oauth2/token';
        $options = array(
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Accept-Language: '.$this->locale,
                'Content-type: application/json'
            ),
            CURLOPT_USERPWD => $this->clientId.':'.$this->secretId
        );

        //return $this->curlopt($url,$options);
        $return = ComunHelper::curlopt($url,$options);
        return $return;
    }

    public function createOrder($accessToken){
        $url = $this->host.'/v2/checkout/orders';
        $data = $this->getDataPayment();
        $options = array(
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$accessToken,
                'Content-type: application/json',
            ),
            CURLOPT_POSTFIELDS => $data
        );
        //return $this->curlopt($url,$options);
        return ComunHelper::curlopt($url,$options);
    }

    public function captureOrder($accessToken,$orderId){
        $url = $this->host.'/v2/checkout/orders/'.$orderId.'/capture';
        $data = array();
        $options = array(
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$accessToken,
                'Content-type: application/json',
            ),
            CURLOPT_POSTFIELDS => $data
        );
        //return $this->curlopt($url,$options);
        return ComunHelper::curlopt($url,$options);
    }

    /*public function createPayment($accessToken){
        $url = $this->host.'/v1/payments/payment';
        $data = $this->getDataPayment();
        $options = array(
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$accessToken,
                'Accept: application/json',
                'Content-type: application/json'
            ),
            CURLOPT_POSTFIELDS => $data
        );
        return ComunHelper::curlopt($url,$options);
    }*/

    /**
     * apartado de funciones privadas
     */
    private function getDataPayment(){
        $items = $this->getItemsSell();
        $payment = [
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => '',
                'cancel_url' => '',
                'shipping_preference' => 'SET_PROVIDED_ADDRESS',
                'user_action' => 'PAY_NOW'
            ],
            'purchase_units' => [
                [
                    'reference_id' => time(),
                    'description' => "Omnilife",
                    'invoice_id' => date('Ymdhis'),
                    'custom_id' => 'PayPalTestMX',
                    'amount' => [
                        'currency_code' => $this->currency,
                        'value'    => '27.24',
                        'breakdown' => [
                            'item_total' => [ //total producto(s)
                                'currency_code' => $this->currency,
                                'value' => '18.88'
                            ],
                            'shipping' => [ //envio
                                'currency_code' => $this->currency,
                                'value' => '7.81'
                            ],
                            'tax_total' => [ //impuesto
                                'currency_code' => $this->currency,
                                'value' => '0.55'
                            ],
                            'handling' => [ //manejo
                                'currency_code' => $this->currency,
                                'value' => '0'
                            ],
                            'shipping_discount' => [ //descuento
                                'currency_code' => $this->currency,
                                'value' => '0'
                            ],
                            'insurance' => [ //seguro
                                'currency_code' => $this->currency,
                                'value' => '0'
                            ],
                        ]
                    ],
                    'items' => $items,
                    'shipping' => [
                        'address' => [
                            'address_line_1' => 'Villa Cardel 11, Sta Maria Acuitlapilco', //shipping line 1
                            'address_line_2' => '', //shipping line 2
                            'admin_area_2' => 'Tlaxcala', //shipping city
                            'admin_area_1' => 'Tlaxcala', //shipping state
                            'postal_code' => '90110',
                            'country_code' => $this->countryCode,
                        ]
                    ]
                ]
            ]
        ];
        return json_encode($payment,JSON_UNESCAPED_SLASHES);
    }

    private function getItemsSell(){
        $items = [
            [
                'name'        => 'producto 1',
                'description' => 'Descripcion del producto #1',
                'sku' => '10111289',
                'unit_amount' => [
                    'currency_code' => 'MXN',
                    'value' => '7.80'
                ],
                'quantity'    => 1,
            ],
            [
                'name'        => 'producto numero 2',
                'description' => 'Descripcion del producto #2',
                'sku' => '10111213',
                'unit_amount' => [
                    'currency_code' => 'MXN',
                    'value' => '7.80'
                ],
                'quantity'    => 1,
            ],
            [
                'name'        => 'producto tres',
                'description' => 'Descripcion del producto #3',
                'sku' => '10851213',
                'unit_amount' => [
                    'currency_code' => 'MXN',
                    'value' => '3.28'
                ],
                'quantity'    => 1,
            ],
        ];
        return $items;
    }

    private function getDataOrder(){
        $data =  array(
            'intent' => 'CAPTURE',
            'purchase_units' =>
                array(
                    array(
                        'amount' =>
                            array(
                                'currency_code' => 'MXN',
                                'value' => '100.50'
                            )
                    )
                )
        );
        return json_encode($data,JSON_UNESCAPED_SLASHES);
    }

    private function curlopt($url_curl,$options){
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

}