<?php

class SOAPClient {
 
    public static function soap_request($endpoint, $envelope_file, $search_values = array(), $replace_values = array()){
    
        $soap_request = file_get_contents(dirname(__FILE__)."/xml/".$envelope_file.".xml", false);
        if(count($search_values) === count($replace_values)){
            $soap_request = str_replace($search_values, $replace_values, $soap_request);
        } // if
    
        $header = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",

            "Content-length: ".strlen($soap_request),
        );
    
        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $endpoint);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST,           true );
        curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $soap_request);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $header);
    
        $result = curl_exec($soap_do);
        return $result;
    }
}