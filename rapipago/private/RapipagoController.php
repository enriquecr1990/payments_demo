<?php

include __DIR__.'\helper\ComunHelper.php';

class RapipagoController
{

    private $username;
    private $gspassword;
    private $privatekey;
    private $merchantID;
    private $urltransaccion;
    private $varsCurlopt;

    public function __construct(){
        //$this->username = 'CLIENTE_PRUEBA';
        $this->username = 'CLIENTE_EFECTIVO';
        $this->gspassword = 'C25F2BA94D4DE71482FEBABC9107ABB268FB4A6AB24246653C117C30804D9694';
        $this->privatekey = '64eea4cce73a812270ce38aedcf4ccb1b164285a57dd76b6763294bf10bccf8b';
        //$this->merchantID = 'gire';
        $this->merchantID = 'gire_efectivo';
        $this->urltransaccion = 'https://test.gsbotondepago.com/ws/';

    }

    public function processDataForm(){
        $data['success'] = true;
        $data['form_rapipago'] = array();
        $data['msg'] = array();
        try{
            $data['form_rapipago']['gs_username'] = $this->username;
            $data['form_rapipago']['gs_password'] = $this->gspassword;
            $data['form_rapipago']['gs_email'] = 'enrique_cr1990@hotmail.com';
            $data['form_rapipago']['gs_client_id'] = 'CORE900406';
            $data['form_rapipago']['gs_tx_id'] = '10001';
            $data['form_rapipago']['gs_monto_base'] = '1000,00'; //subtotal de la venta
            $data['form_rapipago']['gs_monto_adicional'] = '0,00';
            $data['form_rapipago']['gs_impuestos'] = '210,00'; //importe de los impuestos
            $data['form_rapipago']['gs_importe'] = '1210,00'; //importe total de la transaccion
            $data['form_rapipago']['gs_merchant_id'] = $this->merchantID;
            $data['form_rapipago']['gs_ref_01'] = 'RF-2009-001';
            $data['form_rapipago']['gs_ref_02'] = '';
            $data['form_rapipago']['gs_ref_03'] = '';
            $data['form_rapipago']['gs_moneda'] = 'ARS';
            $data['form_rapipago']['gs_cuotas'] = '1';
            $data['form_rapipago']['gs_recargo'] = '0,00';
            $data['form_rapipago']['ambiente'] = 'test';
            //las url del confirm y confirm se integraran en el JS
            $data['form_rapipago']['gs_url_home'] = ComunHelper::base_url();
            //$data['form_rapipago']['gs_url_confirm'] = 'test';
            $data['form_rapipago']['gs_producto'] = ''; //opcional dado que se activa en el merchant_id validar el dato CON EL PROVEEDOR
            $data['form_rapipago']['gs_dias_vencimiento'] = '0';
            $data['form_rapipago']['gs_tipo_operacion'] = '1';
            $data['form_rapipago']['gs_shasing'] = $this->getHashing($data);
        }catch (\Exception $ex){
            $data['success'] = false;
            $data['msg'] = array('No se pudo procesar las variables del metodo de pago');
        }
        return $data;
    }

    public function procesarOrdenPendiente(){
        $response['success'] = true;
        $response['msg'] = array();
        try{
            $this->startVarsCurloptLogin();
            $login = ComunHelper::curloptHeaders($this->urltransaccion.'login',$this->varsCurlopt);
            var_dump($login);
            $this->resetVarsCurl();
            $this->startVarsCurloptTransactionInfo();
            $this->varsCurlopt[CURLOPT_HTTPHEADER][] = 'Authorization:'.$login['header']['Authorization'];
            $this->varsCurlopt[CURLOPT_HTTPHEADER][] = 'Companyid:'.$login['body']->CompanyId;
            //consultar que valor va en este campo transaccionId, si es el id del boleto de rapipago o si es uno de los valores del formulario: gs_tx_id o el gs_ref_01
            $this->varsCurlopt[CURLOPT_POSTFIELDS] = '{
                {
                    "merchantId":"'.$this->merchantID.'",
                    "clienteId":"CORE900406",
                    "transaccionId":"RF-2009-001",
                    "fechaOperacion":""
                }
            }';
            $trasactionInfo = ComunHelper::curlopt($this->urltransaccion.'transactionInfo',$this->varsCurlopt);
            //codigo ejemplo de la documentacion
            //$trasactionInfo = '{ "STS": 1, "TRANSACCIONES": "[{\"GS_MEDIO_PAGO\":\"MASTERCARD 1008\",\"GS_ORIGEN_OPERACION\":\"Web\",\"GS_REF_03\":\"N/A\",\"GS_MONEDA\":\"ARS\",\"GS_REF_02\":\"10-9\",\"GS_MERCHANT_ID\":\"gire\",\"GS_REF_01\":\"02-000000470339\",\"GS_ESTATUS\":\"Aprobada\",\"GS_CODIGO_AUTORIZACION\":\"349169\",\"GS_FECHA_OPERACION\":\"13/11/2019\",\"GS_CLIENT_ID\":\"JNT1211780\",\"GS_IMPORTE\":\"1166,32\",\"GS_TX_ID\":\"1011\"}]" }';
            var_dump($trasactionInfo);exit;
            $trasactionInfo = json_decode($trasactionInfo);
            $transaccion = json_decode($trasactionInfo->TRANSACCIONES);
            var_dump($transaccion);exit;
        }catch (\Exception $ex){
            $response['success'] = false;
            $response['msg'] = array('No fue posible procesar la orden');
            return $response;
        }
    }

    private function getHashing($data){
        $strHasing = 'GS_USERNAME='.$data['form_rapipago']['gs_username'];
        $strHasing .= 'GS_MERCHANT_ID='.$data['form_rapipago']['gs_merchant_id'];
        $strHasing .= 'GS_CLIENT_ID='.$data['form_rapipago']['gs_client_id'];
        $strHasing .= 'GS_TX_ID='.$data['form_rapipago']['gs_tx_id'];
        $strHasing .= 'GS_IMPORTE='.$data['form_rapipago']['gs_importe'];
        $strHasing .= 'GS_CUOTAS='.$data['form_rapipago']['gs_cuotas'];
        $strHasing .= 'GS_MONEDA='.$data['form_rapipago']['gs_moneda'];
        $strHasing .= 'GS_REF_01='.$data['form_rapipago']['gs_ref_01'];
        $strHasing .= $this->privatekey;
        return hash('sha3-256',$strHasing);
    }

    private function startVarsCurloptLogin(){
        $this->varsCurlopt[CURLOPT_RETURNTRANSFER] = true;
        $this->varsCurlopt[CURLOPT_HEADER] = true; //para obtener el header del response
        $this->varsCurlopt[CURLOPT_ENCODING] = "";
        $this->varsCurlopt[CURLOPT_MAXREDIRS] = 10;
        $this->varsCurlopt[CURLOPT_TIMEOUT] = 30;
        $this->varsCurlopt[CURLOPT_HTTP_VERSION]  = CURL_HTTP_VERSION_1_1;
        $this->varsCurlopt[CURLOPT_CUSTOMREQUEST] = "POST";
        $this->varsCurlopt[CURLOPT_HTTPHEADER][] = 'content-type: application/json';
        $this->varsCurlopt[CURLOPT_POSTFIELDS] = '{
            "userName" : "'.$this->username.'",
            "password" : "'.$this->gspassword.'"
        }';
        $this->varsCurlopt[CURLOPT_SSL_VERIFYHOST]  = false;
        $this->varsCurlopt[CURLOPT_SSL_VERIFYPEER]  = false;
    }

    private function startVarsCurloptTransactionInfo(){
        $this->varsCurlopt[CURLOPT_RETURNTRANSFER] = true;
        //$this->varsCurlopt[CURLOPT_HEADER] = true; //para obtener el header del response
        $this->varsCurlopt[CURLOPT_ENCODING] = "";
        $this->varsCurlopt[CURLOPT_MAXREDIRS] = 10;
        $this->varsCurlopt[CURLOPT_TIMEOUT] = 30;
        $this->varsCurlopt[CURLOPT_HTTP_VERSION]  = CURL_HTTP_VERSION_1_1;
        $this->varsCurlopt[CURLOPT_CUSTOMREQUEST] = "POST";
        $this->varsCurlopt[CURLOPT_HTTPHEADER][] = 'content-type: application/json';
        $this->varsCurlopt[CURLOPT_SSL_VERIFYHOST]  = false;
        $this->varsCurlopt[CURLOPT_SSL_VERIFYPEER]  = false;
    }

    private function resetVarsCurl(){
        $this->varsCurlopt = array();
    }
}