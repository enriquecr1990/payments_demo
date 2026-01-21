<?php

class ComunHelper
{

    public static function curlopt($url_curl,$options){
        $curl = curl_init($url_curl);
        curl_setopt_array($curl,$options);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        if($error){
            $return['status'] = false;
            $return['msg'] = $error;
        }else{
            $return['status'] = true;
            $return['data'] = $response;
        }
        return $return;
    }

    public static function base_url(){
        $scheme = 'http://';
        if(isset($_SERVER['REQUEST_SCHEME'])){
            $scheme = $_SERVER['REQUEST_SCHEME'].'://';
        }if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != '' && $_SERVER['HTTPS'] == 'on'){
            $scheme = 'https://';
        }
        $request = str_replace('index.php','',$_SERVER['SCRIPT_NAME']);
        $request = explode('/',$request);
        $url = $scheme.$_SERVER['HTTP_HOST'].implode('/',$request);
        return $url;
    }

}