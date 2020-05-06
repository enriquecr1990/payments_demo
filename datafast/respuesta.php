<?php

$userId = '8a8294185a65bf5e015a6c8c728c0d95';
$authPass = 'bfqGqwQ32X';
//$entityId = '8a82941865aee2820165af643b570208';
$entityId = '8a82941865aee2820165af643b570208';
//$token = 'OGE4Mjk0MTg1MzNjZjMxZDAxNTMzZDA2ZmQwNDA3NDh8WHQ3RjIyUUVOWA==';
$token = 'OGE4Mjk0MTg1YTY1YmY1ZTAxNWE2YzhjNzI4YzBkOTV8YmZxR3F3UTMyWA==';
$mid = '1000000505';
$tid = 'PD100406';

$arrayData = explode('.',$_GET['id']);


$url = "https://test.oppwa.com".$_GET['resourcePath'];
$url .= "?".
    //"authentication.userId=".$userId.
    //"&authentication.password=".$authPass.
    "authentication.entityId=".$entityId;

echo $url;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer '.$token));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$responseData = curl_exec($ch);
if(curl_errno($ch)) {
    echo 'hay error';
    return curl_error($ch);
}
curl_close($ch);
var_dump($responseData);
var_dump(json_decode($responseData));
exit;