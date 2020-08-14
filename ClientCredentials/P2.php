<?php

/**
 * P2 all the methods related to the second practice
 */
class P2 {

    private $oauth2_url;

     /**
     * Class constructor
     * @param string $oauth2_url, OAuth2 URL to get token 
     * @return none
     */
    public function __construct($oauth2_url) {
        $this->oauth2_url = $oauth2_url;
	} // __construct

     /**
     * Class constructor
     * @param string $client_id, OAuth2 client id
     * @param string $client_secret, OAuth2 client secret
     * @return none
     */
    public function getClientCredentialsToken($client_id, $client_secret){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->oauth2_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array('client_id' => $client_id,'client_secret' => $client_secret,'grant_type' => 'client_credentials'),
        CURLOPT_HTTPHEADER => array(
            "Cookie: __cfduid=dc888e7a09ff0a0265045153781f00e891596296720; 1bb11e6f2dacb1c375d150942d6da0cd=gdv4qmo66dn2tqpiblg4fsq3cf"
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        return $response['access_token'];
    } // getClientCredentialsToken

}