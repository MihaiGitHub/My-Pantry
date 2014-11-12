<?php
include 'dbconnect.php';

$sql = 'SELECT id, fname, lname, address FROM clients';

$result = $objDb->query($sql);

if(!$result){
	throw new PDOException('The result returned no object');
}

$result->setFetchMode(PDO::FETCH_ASSOC); // returns the data as objects
$clients = $result->fetchAll();

echo json_encode(array(
	'error' => false,
	'clients' => $clients
), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);