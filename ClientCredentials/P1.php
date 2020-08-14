<?php

/**
 * P1 all the methods related to first the practice
 */
class P1 {

    private $bearer_token;
    
     /**
     * setBearerToken
     * @param string $bearer_token, OAuth2 bearer token
     * @return none
     */
    public function setBearerToken($bearer_token){
        $this->bearer_token = $bearer_token;
    }

    /**
     * List all the contacts returned by the API
     * @return none
     */
    public function readList(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.softwareavanzado.world/index.php?webserviceClient=administrator&webserviceVersion=1.0.0&option=contact&api=Hal&filter%5Bsearch%5D=201404007&list%5Blimit%5D=100",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$this->bearer_token,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        foreach($response['_embedded']['item'] as $contact){
            echo "* ".$contact['name']."\n";
        } // foreach
    }

    /**
     * Creates a contact with an API request
     * @param string $name, the name of the contact to create
     * @return none
     */
    private function create($name){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.softwareavanzado.world/index.php?webserviceClient=administrator&webserviceVersion=1.0.0&option=contact&api=Hal",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('name' => $name),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$this->bearer_token,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);
        //print_r($response);

        if($response['result'] == "true"){
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