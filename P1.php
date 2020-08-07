<?php

include 'SOAPClient.php';

class P1 {

    public static function readList(){
        $response = SOAPClient::soap_request("https://api.softwareavanzado.world/index.php?webserviceClient=administrator&webserviceVersion=1.0.0&option=contact&api=soap", "readList");
        return $response;
    }

}