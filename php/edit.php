<?php
try{
	if($_POST['id'] === 'undefined'){
		throw new PDOException('Empty data');
	} 

	include 'dbconnect.php';

	$stmt = $objDb->prepare('SELECT id, fname, lname, address, phone, email, inhouse, comments FROM clients WHERE id = :id');
	if(!$stmt->execute(array('id' => $_POST['id']))){
		throw new PDOException('The result returned no object');
	}
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$client = $stmt->fetch();

	echo json_encode(array(
		'error' => false,
		'client' => $client
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}