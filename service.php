<?php
require 'lib/nusoap.php';
require 'data.php';

$server = new nusoap_server(); // Create a instance for nusoap server

$server->configureWSDL("Soap Demo","urn:soapdemo"); // Configure WSDL file
$server->register(
	"getAllUser", 
	array("id"=>"xsd:integer"),  
	array("return"=>"xsd:string")
);

$server->register(
	"getUserByID", 
	array("id"=>"xsd:integer"),  
	array("return"=>"xsd:string")
);

$server->register(
	"updateByID", 
	array("id"=>"xsd:integer"),  
	array("return"=>"xsd:string")
);

$server->register(
	"deleteByID", 
	array("id"=>"xsd:integer"),  
	array("return"=>"xsd:string")
);

$server->register(
	"createData", 
	array("param"=>"xsd:Array"),  
	array("return"=>"xsd:string")
);

$server->service(file_get_contents("php://input"));