<?php

include 'helper/ComunHelper.php';

class FacRsk
{

    public function procesarPago(){
        $url = 'https://staging.ptranz.com/api/spi/sale';
        $dataPost = json_encode($this->getDataPost(),JSON_FORCE_OBJECT);
        //var_dump($dataPost);exit;
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
                //HONDURAS
                'PowerTranz-PowerTranzId: 88804800',
                'PowerTranz-PowerTranzPassword: JUU6szD5Bjt5QJmWu29QT8xbp8i9DJ0nCp4HrUQw2N5jvSeeWf7QN3'
                //GUATEMALA
                //'PowerTranz-PowerTranzId: 88801205',
                //'PowerTranz-PowerTranzPassword: h3WZZ46NA9zjrzYLoEpf5XqUC1WzkSR4dGz5iaDxkjYpvfHGAMMEkx'
            ),
        );

        //return $this->curlopt($url,$options);
        $return = ComunHelper::curlopt($url,$options);
        return $return;
    }

    public function execPago($spiToken){
        $url = 'https://staging.ptranz.com/api/spi/payment';
        //var_dump($dataPost);exit;
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
                //'PowerTranz-PowerTranzId: 88801430',
                //'PowerTranz-PowerTranzPassword: 9q4npw0qOR3cV07eYT9xBNBICz9g3VttoVIyCnWw'
                //HONDURASS
                'PowerTranz-PowerTranzId: 88804800',
                'PowerTranz-PowerTranzPassword: JUU6szD5Bjt5QJmWu29QT8xbp8i9DJ0nCp4HrUQw2N5jvSeeWf7QN3'
            ),
        );

        //return $this->curlopt($url,$options);
        var_dump($options);
        $return = ComunHelper::curlopt($url,$options);
        var_dump(json_decode($return));exit;
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
            "CurrencyCode" => '340', //honduras
            // "CurrencyCode" => '340', //nicaragua
            //"CurrencyCode" => '320', //guatemala
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
                'countryCode' => '340', //codigo de pais de la sesion country code NICARAGUA
                // 'countryCode' => '558', //codigo de pais de la sesion country code NICARAGUA
                //'countryCode' => '320', //codigo de pais de la sesion country code GUATEMALA
                'emailAddress' => 'enrique_cr1990@hotmail.com',
                'phoneNumber' => '2467575099',
            ),
            'AddressMatch' => false, //campo en booleano solamente true si es que coincide el domicilio con el del envio
            'ExtendedData' => array(
                'threeDSecure' => array(
                    'challengeWindowSize' => 3, //dimensiones del panel de la solicitud 3DS que se le presenta al th (ver doc)
                    'challengeIndicator' => '01',
                ),
                'MERCHANTRESPONSEURL' => 'http://broker.local.com/fac/respuesta.php',
                'HOSTEDPAGE' => array(
                    'PAGESET' => 'CssOmniTemplate',
                    'PAGENAME' => 'CssOmniTemplate'
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