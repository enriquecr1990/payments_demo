<?php

require __DIR__ . '/vendor/autoload.php';

MercadoPago\SDK::setAccessToken('TEST-4646605633582722-062718-c94aaf0a7aba347aa205502c610e1b9a-53238234');

$preference = new MercadoPago\Preference();
$item = new MercadoPago\Item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75.56;
$preference->items = array($item);
$preference->save();
echo '<pre>';
echo print_r($preference);
echo '</pre>';
var_dump($preference->sandbox_init_point,$preference->id);