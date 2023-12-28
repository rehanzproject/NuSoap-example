<?php
require 'lib/nusoap.php';
require 'data.php';

$server = new nusoap_server(); // Create a instance for nusoap server

$server->configureWSDL("Soap Demo","urn:soapdemo"); // Configure WSDL file

$server->register(
	"getUserByID", // name of function
	array("id"=>"xsd:integer"),  // inputs
	array("return"=>"xsd:string")   // outputs
);
$server->register(
	"createData", // name of function
	array("param"=>"xsd:string"),  // inputs
	array("return"=>"xsd:string")   // outputs
);

$server->service(file_get_contents("php://input"));