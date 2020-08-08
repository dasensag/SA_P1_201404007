<?php

/**
 * SOAPClient basic client to make SOAP request with curl at base
 */
class SOAPClient {
 
    /**
     * Makes a SOAP request with the parameters given
     * @param string $soap_endpoint, SOAP URL for sending request
     * @param string $envelope_file, name of XML file to read containing the SOAP envelope structure
     * @param array $search_values (optional), variables to be replaced in XML file. Needs to have same size as $replace_values
     * @param array $replace_values (optional),  values to be replaced in XML file. Needs to have same size as $search_values
     * @return none
     */
    public static function soap_request($endpoint, $envelope_file, $bearer_token, $search_values = array(), $replace_values = array()){
    
        $soap_request = file_get_contents(dirname(__FILE__)."/xml/".$envelope_file.".xml", false); // reads soap envelope body from XML file
        if(count($search_values) === count($replace_values)){ // replace variables in XML file with the actual value
            $soap_request = str_replace($search_values, $replace_values, $soap_request);
        } // if
    
        $header = array(
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Content-length: ".strlen($soap_request),
            "Authorization: Bearer $bearer_token",
        );
    
        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $endpoint);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST,           true );
        curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $soap_request); // pass the SOAP envelope body
        curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $header);
    
        $result = curl_exec($soap_do);
        return $result;
    }
}