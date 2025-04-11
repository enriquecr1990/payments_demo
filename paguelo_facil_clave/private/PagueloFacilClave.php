<?php

include_once 'helper/ComunHelper.php';

class PagueloFacilClave
{

    private $cclw;
    function __construct(){
        $this->cclw = '72BB9FDFB2E8D97F9115B11DF1283706A9EEEA5046B3600C4404BC90F309C802A00CCAD8AB9A12FB154DC8E48B536F01B743BE8801AB9C8A07BD82156596B45F';
    }
    
    public function createButton(){
        try{
            $paramsData = $this->getDataPFClv();
            $data = array(
                "CCLW" => $this->cclw,
                "CMTN" => 1,
                "CDSC" => 'Pago de prueba omnilife without portal project',
                "RETURN_URL" => $paramsData['return_url'],
                "CARD_TYPE" => "CLAVE,CARD",
                "PF_CF" => $paramsData['pf_cf'],
                "EXPIRES_IN" => 350, //cantidad de segundos para recibir el pago
                );
            $postR="";
            foreach($data as $mk=>$mv) { $postR .= "&".$mk."=".$mv; }
            $url = 'https://sandbox.paguelofacil.com/LinkDeamon.cfm?';
            $options = array(
                CURLOPT_POST => true,
                CURLOPT_AUTOREFERER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded','Accept: */*'),
                CURLOPT_POSTFIELDS => $postR,
            );

            //return $this->curlopt($url,$options);
            $curlopt = ComunHelper::curlopt($url,$options);
            //var_dump($curlopt);exit;
            $response = [
                'status' => true,
                'msg' => ['se genero el boton correctamente'],
                'data' => json_decode($curlopt),
                'paramst_send' => $postR,
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

    public function createButtonOld(){
        $paramsData = $this->getDataPFClv();
        $data = array(
            "CCLW" => $this->cclw,
            "CMTN" => 1,
            "CDSC" => 'Pago de prueba omnilife without portal project',
            // "RETURN_URL" => $paramsData['return_url'],
            // "CARD_TYPE" => "NEQUI,CASH,CLAVE,CARD",
            // "PF_CF" => $paramsData['pf_cf'],
            // "EXPIRES_IN" => 350, //cantidad de segundos para recibir el pago
            );
        $postR="";
        foreach($data as $mk=>$mv) { $postR .= "&".$mk."=".$mv; }
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, "https://sandbox.paguelofacil.com/LinkDeamon.cfm?".$postR);
        
        //curl_setopt($ch,CURLOPT_URL, "https://secure.paguelofacil.com/LinkDeamon.cfm/AUTH");   ****En Caso de querer Pre-autorizar  y capturar en procesos separados.
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','Accept: */*'));
        //curl_setopt($ch,CURLOPT_POSTFIELDS,$postR);
        $result = curl_exec($ch);
        var_dump($result);
        return $result;
    }

    private function getDataPFClv(){
        $data = [
            'return_url' => 'http://personales-local.com/metodos_pago/paguelo_facil_clave/response.php?order_id=12345',
            'pf_cf' => json_encode([
                'order_id'=> 12345,'order_number' => 7001236548, 'eo' => 'CDOOMN010101'
            ])
        ];
        return $data;
    }

}