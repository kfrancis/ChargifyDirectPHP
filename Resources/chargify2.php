<?php

    class Client {
        const BaseUrl = 'https://api.chargify.com/api/v2';
        private $_apiKey = '';
        private $_apiPassword = '';
        private $_apiSecret = '';

        public function __construct($apiKey, $apiPassword, $apiSecret) {
            $this->$_apiKey = $apiKey;
            $this->$_apiPassword = $apiPassword;
            $this->$_apiSecret = $apiSecret;
        }
    }

?>