<?php

    use Guzzle\Http\Client;

    class ChargifyClient {
        const BaseUrl = 'https://api.chargify.com/api/v2';
        private $_apiKey = '';
        private $_apiPassword = '';
        private $_apiSecret = '';

        public function __construct($apiKey, $apiPassword, $apiSecret) 
        {
            $this->$_apiKey = $apiKey;
            $this->$_apiPassword = $apiPassword;
            $this->$_apiSecret = $apiSecret;
        }

        public function getApiKey() {
            return $this->$_apiKey;
        }

        public function getApiPassword() {
            return $this->$_apiPassword;
        }

        public function getApiSecret() {
            return $this->$_apiSecret;
        }

        public function ExecuteGet()
        {
            $client = new Guzzle\Http\Client(ChargifyClient::BaseUrl);
            $request = $client->get('/user')->setAuth($this->$_apiKey, $this->$_apiPassword);
            $request->setHeader('Accept', 'application/json');
            $response = $request->send();
        }
    }

?>