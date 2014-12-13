<?php
try{
	if($_POST['id'] === 'undefined'){
		throw new PDOException('Empty data');
	} 

	include 'dbconnect.php';

	$stmt = $objDb->prepare('DELETE FROM visits WHERE client_id = :id');
	if($stmt->execute(array('id' => $_POST['id']))){
		$stmt = $objDb->prepare('DELETE FROM clients WHERE id = :id');
		
		if(!$stmt->execute(array('id' => $_POST['id']))){
			throw new PDOException('Error while deleting');
		}
	}
/*	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$client = $stmt->fetchAll();
	
	$stmt = $objDb->prepare("SELECT volunteer FROM volunteers WHERE active = 'Y'");
	if(!$stmt->execute()){
		throw new PDOException('The result returned no object');
	}
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$volunteers = $stmt->fetchAll();
*/
	echo json_encode(array(
		'error' => false,
		'client' => 'client'
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}