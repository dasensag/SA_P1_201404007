<?php

include 'SOAPClient.php';

class P1 {

    private $soap_endpoint;

    public function __construct($soap_endpoint) {
		$this->soap_endpoint = $soap_endpoint;
	} // __construct


    public function readList($filterSearch = ""){
        $response = SOAPClient::soap_request($this->soap_endpoint, "readList", array('{$filterSearch}'), array($filterSearch));

        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
        $xml = new SimpleXMLElement($response);
        $list = $xml->xpath('//list')[0];
        $contact_list = json_decode(json_encode((array)$list), TRUE); 

        foreach($contact_list['item'] as $contact){
            echo "* ".$contact['name']."\n";
        } // foreach
    }

    private function create($name){
        $response = SOAPClient::soap_request($this->soap_endpoint, "create", array('{$name}'), array($name));

        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
        $xml = new SimpleXMLElement($response);
        $result = $xml->xpath('//result')[0];

        if($result->__toString() == "true"){
            echo "Contact created\n";
        } else {
            echo "There was an error creating the contact\n";
        } // else
    }

    public function createBatch($common_text = "201404007 David Asencio"){
        for ($i = 1; $i <= 10; $i++) { 
            $contact_name = "$common_text $i";
            echo "Creating contact -> $contact_name\n";
            $this->create($contact_name);
        } // for
    }

}