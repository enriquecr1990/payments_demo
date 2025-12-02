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
            $return['options'] = $options;
            if($error){
                $return['status'] = 'error';
                $return['curl'] = json_decode($error);
            }else{
                $return['status'] = 'success';
                $return['curl'] = json_decode($response);
            }
            return $return;
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