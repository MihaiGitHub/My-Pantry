<?php
include 'dbconnect.php';

$data = file_get_contents("php://input");

$objData = json_decode($data);

echo $objData->data;
/*
$sql = 'SELECT id, fname, lname, address FROM clients WHERE id LIKE ';

$result = $objDb->query($sql);

if(!$result){
	throw new PDOException('The result returned no object');
}

$result->setFetchMode(PDO::FETCH_ASSOC); // returns the data as objects
$clients = $result->fetchAll();

echo json_encode(array(
	'error' => false,
	'clients' => $objData->data
), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);*/