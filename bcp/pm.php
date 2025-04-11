<?php

$curl = curl_init();
$pem = 'D:\Desarrollo\personales\metodos_pago\bcp\private\bcpcertificate_php.pem';
if (openssl_pkcs12_read(file_get_contents('D:\Desarrollo\personales\metodos_pago\bcp\private\BCP_SANDBOX_OPENBANKING.pfx'), $certs, 'Arquitectura2025$')) {
  file_put_contents($pem,$certs['cert'].$certs['pkey']);
  echo 'se convirtio pfx correctamente<br>';
}else{
  echo 'ocurrio un error';exit;
}

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sandbox.openbanking.bcp.com.bo/Web_ApiQr/api/v4/Qr/Generated',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "appUserId": "OMNILIFE_USER",
    "currency": "BOB",
    "amount": 150.55,
    "gloss": "",
    "serviceCode": "050",
    "enableBank": "ALL",
    "businessCode": "0341",
    "singleUse": true,
    "city": "La paz",
    "branchOffice": "Omnilife Bolivia",
    "teller": "online",
    "phoneNumber": "2467575099",
    "publicToken": "C9F13996-C678-4164-B54E-3195426AFEC5",
    "expiration": "01/00:00"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Correlation-Id: TEST-OMNI-20250407130100',
    'Authorization: Basic T01OSUxJRkVfVVNFUjpoaGdjZTg4YTAyMzRkM2I0MzIzMmE4NTQ2NGFhZGZy'
  ),
  CURLOPT_SSL_VERIFYHOST => '2',
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_SSLCERT => $pem,
  // CURLOPT_SSLKEY => $pem,
  CURLOPT_SSLCERTPASSWD => 'Arquitectura2025$',
));

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);
var_dump($response,$error);
