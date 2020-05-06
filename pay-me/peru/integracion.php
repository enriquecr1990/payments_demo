<?php

$urlws = 'https://integracion.alignetsac.com/WALLETWS/services/WalletCommerce?wsdl';
$sc = new SoapClient($urlws);

$idEntCommerce = 2478; // este id es el del wallet y no el del comercio
$codCardHolderCommerce = 'TST001';
$mail = 'enriquecr1990@gmail.com';
$clvWallet = 'heCUGEkXpTHMDhw?27222257';

$registerVerification = openssl_digest($idEntCommerce.$codCardHolderCommerce.$mail.$clvWallet,'sha512');

$parameters = [
    'idEntCommerce' => $idEntCommerce,
    'codCardHolderCommerce' => $codCardHolderCommerce,
    'names' => 'Quique',
    'lastNames' => ' Pangado Peru',
    'mail' => $mail,
    'registerVerification' => $registerVerification //firma para lo del wallet
];
var_dump($parameters);
$response = $sc->RegisterCardHolder($parameters);
var_dump($response);