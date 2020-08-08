<?php

include 'SOAPClient.php';

/**
 * P1 all the methods realted to the first practice
 */
class P1 {

    private $soap_endpoint;

    /**
     * Class constructor
     * @param string $soap_endpoint, SOAP URL for sending request
     * @return none
     */
    public function __construct($soap_endpoint) {
		$this->soap_endpoint = $soap_endpoint;
	} // __construct

    /**
     * List all the contacts returned by the SOAP request
     * @param string $filterSearch (optional), filter to apply on search
     * @return none
     */
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

    /**
     * Creates a contact with a SOAP request
     * @param string $name, the name of the contact to create
     * @return none
     */
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

    /**
     * Creates a batch of ten contacts using a common text for everyone
     * @param string $common_text, text to be used in all the contacts of the batch
     * @return none
     */
    public function createBatch($common_text = "201404007 David Asencio"){
        for ($i = 1; $i <= 10; $i++) { 
            $contact_name = "$common_text $i";
            echo "Creating contact -> $contact_name\n";
            $this->create($contact_name);
        } // for
    }

}