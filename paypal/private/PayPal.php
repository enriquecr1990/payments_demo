<?php

include __DIR__.'/helper/ComunHelper.php';
class PayPal
{

    private $host;
    private $host_risk;
    private $merchant_id;
    private $currency;
    private $countryCode;
    private $clientId;
    private $secretId;
    private $locale;
    private $reference_id;

    function __construct(){
        $this->host = 'https://api.sandbox.paypal.com';
        $this->host_risk = 'https://api-m.sandbox.paypal.com';
        $this->merchant_id = 'YLWTGD5MXCXG8'; // converti mi cuenta a empresa en sandbox para obtener este dato
        $this->clientId = 'Af-yarH2_LYxebYrY8w5rbVwklhjjQzI7AjMzpSqwcY4gkWBhWbO8JTNrzVA3HRUfqrjpUzPpUCzKctv';
        $this->secretId = 'EEQXioToMbJTSf8-_n0_tpq2omhcrttWYbVNCxLW3yfWokvpRy2Zo2gqOkRxMPpLz29kT5BK98kFWNSV';
        $this->locale = 'es_MX';
        $this->currency = 'MXN';
        $this->countryCode = 'MX';
        $this->reference_id = time();
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

    public function risk_transaction($accessToken){
        $url = $this->host_risk.'/v1/risk/transaction-contexts/'.$this->merchant_id.'/'.$this->reference_id;
        $data = $this->getDataPayment();
        $options = array(
            CURLOPT_POST => true,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$accessToken,
                'Content-Type: application/json',
            ),
            CURLOPT_POSTFIELDS => '{"tracking_id" : "'.$this->reference_id.'"}',
        );
        //return $this->curlopt($url,$options);
        return ComunHelper::curlopt($url,$options);
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
            CURLOPT_POSTFIELDS => $data,
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

    /** funciones para las pruebas de vault */
    public function vaultPayment($accessToken){
        try{
            $url = $this->host.'/v3/vault/setup-tokens';
            $data = $this->getDataPaymentVault();
            $options = array(
                CURLOPT_POST => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$accessToken,
                    'Content-type: application/json',
                ),
                CURLOPT_POSTFIELDS => $data,
            );
            return ComunHelper::curlopt($url,$options);
        }catch(Exception $ex){
            throw $ex;
        }
    }

    public function validarVaultPayment($accessToken,$referencia){
        try{
            $url = $this->host.'/v3/vault/setup-tokens/'.$referencia;
            $options = array(
                // CURLOPT_POST => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$accessToken,
                    'Content-type: application/json',
                ),
                // CURLOPT_POSTFIELDS => '',
            );
            return ComunHelper::curlopt($url,$options);
        }catch(Exception $ex){
            return ['error' => $ex->getMessage(),'status' => false ];
        }
    }

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
                    'reference_id' => $this->reference_id,
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

    private function getDataPaymentVault(){
        $payment = [
            "payment_source" => [
                "paypal" => [
                    "description" => "Pruebas para pagos por vault",
                    "shipping" => [
                        "name" => [
                            "full_name" => "Enrique Corona Developer"
                        ],
                        'address' => [
                            'address_line_1' => 'Villa Cardel 11, Sta Maria Acuitlapilco', //shipping line 1
                            'address_line_2' => '', //shipping line 2
                            'admin_area_2' => 'Tlaxcala', //shipping city
                            'admin_area_1' => 'Tlaxcala', //shipping state
                            'postal_code' => '90110',
                            'country_code' => $this->countryCode,
                        ]
                    ],
                    "permit_multiple_payment_tokens" => false,
                    "usage_pattern" => "IMMEDIATE",
                    "usage_type" => "MERCHANT",
                    "customer_type" => "CONSUMER",
                    "experience_context" => [
                        "user_action" => "SETUP_NOW",
                        "shipping_preference" => "SET_PROVIDED_ADDRESS",
                        "payment_method_preference" => "IMMEDIATE_PAYMENT_REQUIRED",
                        "brand_name" => "Desarrollo local paypal vaulting",
                        // "locale" => $this->locale,
                        "locale" => "en-US",
                        "return_url" => "http://broker.local.com/paypal/payment_success.php",
                        "cancel_url" => "http://broker.local.com/paypal/payment_cancel.php",
                        "app_switch_context" => [
                            "mobile_web" => [
                                "return_flow" => "AUTO",
                                "buyer_user_agent" => "Mozilla/5.0 (iPhone; CPU iPhone OS 16_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.4 Mobile/15E148 Safari/604.1"
                            ]
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