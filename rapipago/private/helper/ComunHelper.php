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
            $return = $error;
        }else{
            $return = $response;
        }
        return $return;
    }

    public static function curloptHeaders($url_curl,$options){
        $headers = [];
        $curl = curl_init($url_curl);
        curl_setopt_array($curl,$options);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        curl_close($curl);
        if($error){

            $return = $error;
        }else{
            //convertir el header
            $output = rtrim($header);
            $data = explode("\n",$output);
            $headers['status'] = $data[0];
            array_shift($data);
            foreach($data as $part){
                //some headers will contain ":" character (Location for example), and the part after ":" will be lost, Thanks to @Emanuele
                $middle = explode(":",$part,2);
                //Supress warning message if $middle[1] does not exist, Thanks to @crayons
                if ( !isset($middle[1]) ) { $middle[1] = null; }
                $headers[trim($middle[0])] = trim($middle[1]);
            }
            $return['header'] = $headers;
            $return['body'] = json_decode($body);
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