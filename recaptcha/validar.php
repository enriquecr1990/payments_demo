<?php

$response_captcha = [
     'success' => true,
     'msg' => ['Se proceso la validacion del captcha']
];

$input = json_decode(file_get_contents('php://input'),true);
$apiKeyPublic = '6Ld8svkrAAAAAO6mdTW-E2OqwHo2LKqADkXOHqYJ';
$token = $input['token'] ?? '';

$response_captcha['data']['key'] = $apiKeyPublic;
$response_captcha['data']['token'] = $token;

if(!$token){
     echo json_encode(['success' => false, 'error' => 'No llego el captcha']);
     exit;
}

$url = 'https://www.google.com/recaptcha/api/siteverify';
$post_send = [
     'secret' => $apiKeyPublic,
     'response' => $token,
     'remoteip' => $_SERVER['REMOTE_ADDR']
];

$options = array(
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_SSL_VERIFYPEER => false,
     CURLOPT_SSL_VERIFYHOST => false,
     CURLOPT_POSTFIELDS => http_build_query($post_send)
);

$exeCurlopt = curlopt($url,$options);
echo json_encode($exeCurlopt);exit;
function curlopt($url_curl,$options){
     try{
          $curl = curl_init($url_curl);
          curl_setopt_array($curl,$options);
          $response = curl_exec($curl);
          $error = curl_error($curl);
          curl_close($curl);
          if($error){
               $return = $error;
          }else{
               $return = $response;
          }
          return json_decode($return);
     }catch(Exception $ex){
          var_dump($ex->getMessage(),$ex->getFile(),$ex->getLine());exit;
     }
}

?>