<?php
try {

	include 'dbconnect.php';
		
	$stmt = $objDb->prepare("SELECT volunteer FROM volunteers WHERE active = 'Y'");
	$result = $stmt->execute();
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$volunteers = $stmt->fetchAll();	

	echo json_encode(array(
		'error' => false,
		'volunteers' => $volunteers
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}