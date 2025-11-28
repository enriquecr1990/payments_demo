<?php

class ComunHelper
{

    public static function curlopt($url_curl,$options){
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