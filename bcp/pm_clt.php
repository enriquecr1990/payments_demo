<?php
$client = new \Client();
$headers = [
  'Content-Type' => 'application/json',
  'Correlation-Id' => 'TEST-OMNI-20250407130100',
  'Authorization' => 'Basic T01OSUxJRkVfVVNFUjpoaGdjZTg4YTAyMzRkM2I0MzIzMmE4NTQ2NGFhZGZy'
];
$body = '{
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
}';
$request = new \Request('POST', 'https://sandbox.openbanking.bcp.com.bo/Web_ApiQr/api/v4/Qr/Generated', $headers, $body);
$res = $client->sendAsync($request)->wait();
echo $res->getBody();