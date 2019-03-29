<?php
require 'lib/nusoap.php';
require 'data.php';

$ns  = "http://localhost/phpwebservices/";
$server = new nusoap_server(); // Create a instance for nusoap server

$server->configureWSDL("nuSOAP Web Service Client Side for a TTS call",$ns,"urn:demo"); // Configure WSDL file
$server->wsdl->schemaTargetNamespace=$ns;

$server->register(
	"make_call", // name of function
	array("ext"=>"xsd:integer","msg"=>"xsd:string"),  // inputs
	array("return"=>"xsd:string")   // outputs
);

$server->service(file_get_contents("php://input"));

?>
