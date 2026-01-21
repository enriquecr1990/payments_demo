<?php

include 'helper/ComunHelper.php';

class FacRsk
{

    private $url;
    private $id_tranz;
    private $pass_tranz;
    private $country;
    private $currency;
    private $hosted_page;
    private $hosted_page_name;
    
    function __construct($url,$id_tranz,$pass_tranz,$country,$currency,$hosted_page,$hosted_page_name){
        $this->url = $url;
        $this->id_tranz = $id_tranz;
        $this->pass_tranz = $pass_tranz;
        $this->country = $country;
        $this->currency = $currency;
        $this->hosted_page = $hosted_page;
        $this->hosted_page_name = $hosted_page_name;
    }

    public function procesarPago(){
        $url = $this->url.'/spi/sale';
        $dataPost = json_encode($this->getDataPost(),JSON_FORCE_OBJECT);
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            //CURLOPT_HEADER => false,
            CURLOPT_POSTFIELDS => $dataPost,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'PowerTranz-PowerTranzId: '.$this->id_tranz,
                'PowerTranz-PowerTranzPassword: '.$this->pass_tranz, 
            ),
        );

        $curl = ComunHelper::curlopt($url,$options);
        if($curl['status']){
            //decodificamos el response del curl
            $fac_response = json_decode($curl['data']);
            if(isset($fac_response->IsoResponseCode) && $fac_response->IsoResponseCode == 'SP4'){
                $return['status'] = true;
                $return['msg'] = ['Se proceso la respuesta correctamente'];
                $return['data'] = $fac_response;
            }else{
                $return['status'] = false;
                $return['msg'] = [$fac_response->ResponseMessage];
                if(isset($fac_response->Errors) && is_array($fac_response->Errors)){
                    foreach($fac_response->Errors as $error){
                        $return['msg'][] = $error->Message;
                    }
                }
            }
        }else{
            $return['status'] = false;
        }
        return $return;
    }

    public function procesarPagoRedirect(){
        $resultado = $this->procesarPago();
        if($resultado['status']){
            $html = $resultado['data']->RedirectData;
            // Indicamos que la respuesta es HTML real
            header("Content-Type: text/html; charset=UTF-8");

            // Imprimimos el HTML tal cual
            echo $html;exit;
        }else{
            var_dump($resultado);exit;
        }
    }

    public function execPago($spiToken){
        $url = $this->url.'/spi/payment';
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            //CURLOPT_HEADER => false,
            CURLOPT_POSTFIELDS => '"'.$spiToken.'"',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'PowerTranz-PowerTranzId: '.$this->id_tranz,
                'PowerTranz-PowerTranzPassword: '.$this->pass_tranz,
            ),
        );

        //return $this->curlopt($url,$options);
        $return = ComunHelper::curlopt($url,$options);
        return $return;
    }

    private function getDataPost(){
        $ti = $this->com_create_guid();
        $ti = str_replace('{','',$ti);
        $ti = str_replace('}','',$ti);
        $data = array(
            //"TransactionIdentifier" => 'Omn1-TESTing-OML-'.date('YmdHis'),
            "TransactionIdentifier" => $ti,
            "TotalAmount" => '100',
            "CurrencyCode" => ''.$this->currency,
            "ThreeDSecure" => true,
            "source" => array(
//                'CardPan' => '5115010000000001',
//                'CardCvv' => '123',
//                'CardExpiration' => '2512',
//                'CardholderName' => 'Kike Corona',
            ),
            "OrderIdentifier" => date('YmdHis'),
            "BillingAddress" => array(
                'firstName' => 'Enrique',
                'lastName' => 'Corona',
                'line1' => 'Privada villa cardel 11',
                'line2' => '',
                'city' => 'MANAGUA',
                'state' => '', //debe ser en formato ISO
                'postalCode' => '11101',
                'countryCode' => ''.$this->country, 
                'emailAddress' => 'enrique_cr1990@hotmail.com',
                'phoneNumber' => '2467575099',
            ),
            'AddressMatch' => false, //campo en booleano solamente true si es que coincide el domicilio con el del envio
            'ExtendedData' => array(
                'threeDSecure' => array(
                    'challengeWindowSize' => 3, //dimensiones del panel de la solicitud 3DS que se le presenta al th (ver doc)
                    'challengeIndicator' => '01',
                ),
                'MERCHANTRESPONSEURL' => 'http://broker.dev.com/fac/respuesta.php',
                'HOSTEDPAGE' => array(
                    'PAGESET' => ''.$this->hosted_page,
                    'PAGENAME' => ''.$this->hosted_page_name
                )
            ),
        );
        return  $data;
    }

    private function com_create_guid()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        $data = openssl_random_pseudo_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

}