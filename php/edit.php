<?php
try{
	if($_POST['id'] === 'undefined'){
		throw new PDOException('Empty data');
	} 

	include 'dbconnect.php';

	$stmt = $objDb->prepare('SELECT c.id as id, c.fname as fname, c.lname as lname, c.address as address, c.city as city, c.state as state, c.postalCode as postalCode, c.phone as phone, c.email as email, c.employed as employed, c.lastDateWorked as lastDateWorked, c.annual_income as annualIncome, c.income_updated as incomeUpdated, c.inhouse as inHouse, c.howManyMales as howManyMales, c.howManyFemales as howManyFemales, c.ageGroups as ageGroups, c.comments as comments, v.date_of_visit as dateOfVisit, v.program as program, v.numBags as numBags, v.weight as weight, v.volunteer as volunteer 
							 FROM clients as c LEFT JOIN visits as v ON c.id = v.client_id WHERE c.id = :id');
	if(!$stmt->execute(array('id' => $_POST['id']))){
		throw new PDOException('The result returned no object');
	}
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$client = $stmt->fetchAll();
	
	$stmt = $objDb->prepare("SELECT volunteer FROM volunteers WHERE active = 'Y'");
	if(!$stmt->execute()){
		throw new PDOException('The result returned no object');
	}
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$volunteers = $stmt->fetchAll();

	echo json_encode(array(
		'error' => false,
		'client' => $client,
		'volunteers' => $volunteers
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}