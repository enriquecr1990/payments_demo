<?php

class ConfigFac {

     public static function countryConfig($country_post){
          $data_country = [];
          switch($country_post){
               case 'honduras':
                    // anteriores credenciales
                    // $data_country['id'] = '88804800';
                    // $data_country['pass'] = 'JUU6szD5Bjt5QJmWu29QT8xbp8i9DJ0nCp4HrUQw2N5jvSeeWf7QN3';
                    // nuevas credenciales
                    $data_country['id'] = '77701560';
                    $data_country['pass'] = 'GeyztlWRzQEp6NO2M6dRxfrYLXXxaB621mAkz87rLzpAyV38XgZ8kF1';
                    $data_country['country'] = '340';
                    $data_country['currency'] = '340';
                    $data_country['hosted_page_set'] = 'ptz/CssOmniTemplate';
                    $data_country['hosted_page_name'] = 'CssOmniTemplate';
                    break;
               case 'panama':
                    $procesar_pago = true;
                    $data_country['id'] = '77700512';
                    $data_country['pass'] = 'NlbZ2jcBlSQEyiQ3H3jqTKJKJCFoAq9QBdMAw1bv6R6ZLUmKvNSME1';
                    $data_country['country'] = '840';
                    $data_country['currency'] = '840';
                    $data_country['hosted_page_set'] = 'ptz/CssOmniTemplate';
                    $data_country['hosted_page_name'] = 'CssOmniTemplate';
                    break;
                    
               default:
                    break;
          }
          return $data_country;
     }

}