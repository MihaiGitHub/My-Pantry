<?php
try{
	if($_POST['id'] === 'undefined'){
		throw new PDOException('Empty data');
	} 

	include 'dbconnect.php';

	$stmt = $objDb->prepare('SELECT c.id as id, c.fname as fname, c.lname as lname, c.address as address, c.phone as phone, c.email as email, c.inhouse as inhouse, c.comments, v.date_of_visit as dateOfVisit, v.program as program, v.volunteer as volunteer 
							 FROM clients as c left join visits as v on c.id = v.client_id WHERE c.id = :id');
	if(!$stmt->execute(array('id' => $_POST['id']))){
		throw new PDOException('The result returned no object');
	}
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$client = $stmt->fetchAll();

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