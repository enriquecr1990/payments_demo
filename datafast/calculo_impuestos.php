<?php

$orders = array();

//1
$order = new stdClass();
$order->id = 154196;
$order->order_number = 7000000046;
$order->total = 194.32;
$order->subtotal = 142.72;
$order->management = 30.76;
$orders[] = $order;
//2
$order = new stdClass();
$order->id = 154227;
$order->order_number = 7000000048;
$order->total = 230.79;
$order->subtotal = 172.53;
$order->management = 33.53;
$orders[] = $order;
//3
$order = new stdClass();
$order->id = 154377;
$order->order_number = 7000000081;
$order->total = 50.42;
$order->subtotal = 36;
$order->management = 9.02;
$orders[] = $order;
//4
$order = new stdClass();
$order->id = 154767;
$order->order_number = 7000000105;
$order->total = 50.42;
$order->subtotal = 36;
$order->management = 9.02;
$orders[] = $order;
//5
$order = new stdClass();
$order->id = 154779;
$order->order_number = 7000000106;
$order->total = 46.41;
$order->subtotal = 32.42;
$order->management = 9.02;
$orders[] = $order;
//6
$order = new stdClass();
$order->id = 154889;
$order->order_number = 7000000124;
$order->total = 35.71;
$order->subtotal = 22.87;
$order->management = 9.02;
$orders[] = $order;
//7
$order = new stdClass();
$order->id = 155047;
$order->order_number = 7000000139;
$order->total = 84.81;
$order->subtotal = 63.11;
$order->management = 12.61;
$orders[] = $order;
//8
$order = new stdClass();
$order->id = 155058;
$order->order_number = 7000000140;
$order->total = 50.42;
$order->subtotal = 36;
$order->management = 9.02;
$orders[] = $order;
//9
$order = new stdClass();
$order->id = 155162;
$order->order_number = 7000000147;
$order->total = 564.29;
$order->subtotal = 414.54;
$order->management = 89.3;
$orders[] = $order;

/**
 * calcular los impuestos
 */
$ci = new CalculoImpuestos();
$response = array();
echo '<table border="1">
<thead>
<tr>
<td>id</td>
<td>order_number</td>
<td>total</td>
<td>base12porcent</td>
<td>iva</td>
</tr>
</thead>';
foreach ($orders as $o){
    $customParams = $ci->getCustomParamsV2($o);
    $response[$o->id][] = $customParams;
    echo '<tr>
        <td>'.$o->id.'</td>
        <td>'.$o->order_number.'</td>
        <td>'.$customParams['total'].'</td>
        <td>'.$customParams['base12Porcent'].'</td>
        <td>'.$customParams['iva'].'</td>
    </tr>';
}
echo '</table>';exit;
var_dump($response);exit;
echo '<pre>';
echo print_r($response);exit;

class CalculoImpuestos {

    public function getCustomParams($amount) {
        $response = array();
        $total           = number_format($amount,2,'.','');
        $base12Percent   = number_format($total / 1.12,2,'.','');
        $iva             = number_format($total - $base12Percent,'2','.','');

        $response['name'] = '****** Calculo previo (funcion Vicente) ******';
        $response['total'] = $total;
        $response['base12Porcent'] = $base12Percent;
        $response['iva'] = $iva;
        return $response;
        $ivaForDataFast   = str_pad(str_replace('.','', $iva),12,'0', STR_PAD_LEFT);
        $totalForDataFast = str_pad(str_replace('.','', $base12Percent),12,'0', STR_PAD_LEFT);
        $base0ForDataFast = str_pad(str_replace('.','', $total),12,'0', STR_PAD_LEFT);

        $totalLength = '0081';
        $eCommerce   = '0030070103910';
        $iva         = "004012{$ivaForDataFast}";
        $provider    = "05100817913101";
        $base0       = "052012{$base0ForDataFast}";
        $total       = "053012{$totalForDataFast}";

        $response['ivaForDataFast'] = $iva;
        $response['totalForDataFast'] = $total;
        $response['base0ForDataFast'] = $base0;
        $response['strToBank']= "{$totalLength}{$eCommerce}{$iva}{$provider}{$base0}{$total}";

        return $response;
    }

    public function getCustomParamsOrder($order) {
        $monto = $order->total;
        $base12 = number_format($order->subtotal + $order->management,2,'.','');
        $iva = number_format($monto - $base12,2,'.','');

        $response['name'] = '****** Calculo actual ******';
        $response['total'] = $monto;
        $response['base12Porcent'] = $base12;
        $response['iva'] = $iva;
        return $response;
        $iva = str_replace('.','',$iva);
        $base12 = str_replace('.','',$base12);
        $monto = str_replace('.','',$monto);

        $ivaDatafast = str_pad($iva,12,'0',STR_PAD_LEFT);
        $base12DataFast = str_pad($base12,12,'0',STR_PAD_LEFT);
        $montoDataFast = str_pad($monto,12,'0',STR_PAD_LEFT);

        $paramComercio = '0030070103910';
        $paramProveedor = '05100817913101';
        $paramIva = '004012'.$ivaDatafast;
        $paramBase = '052012'.$base12DataFast;
        $paramMonto = '053012'.$montoDataFast;

        $customParams = '0081'.$paramComercio.$paramIva.$paramProveedor.$paramBase.$paramMonto;

        $response['ivaForDataFast'] = $paramIva;
        $response['totalForDataFast'] = $paramMonto;
        $response['base0ForDataFast'] = $paramBase;
        $response['strToBank']= $customParams;

        return $response;
    }

    public function getCustomParamsV2($order){
        $total_order = number_format($order->total,2,'.','');
        $base = number_format($total_order / 1.12,2,'.','');
        $impuesto = number_format($total_order - $base,'2','.','');

        $response['name'] = '****** Calculo impuesto ******';
        $response['total'] = $total_order;
        $response['base12Porcent'] = $base;
        $response['iva'] = $impuesto;
        return $response;
    }
}