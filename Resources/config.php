<?php

$config = array(
	"urls" => array(
		"baseUrl" => "http://chargifydirectphp.azurewebsites.net"
	),
	"paths" => array(
		"resources" => $_SERVER["DOCUMENT_ROOT"] . "/Content",
		"images" => $_SERVER["DOCUMENT_ROOT"] . "/Images",
        "redirectUrl" => "http://localhost:65165/verify.php"
	),
    "Chargify" => array(
        "apiKey" => "",
        "secret" => ""
    )
);

/* 
    Error reporting. 
*/  
ini_set("error_reporting", "true");  
error_reporting(E_ALL|E_STRCT);  

?>