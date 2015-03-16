<?php
try{
	if($_POST['id'] === 'undefined'){
		throw new PDOException('Empty data');
	} 

	include 'dbconnect.php';

	if($_POST['visits'] == 'delete'){
		$stmt = $objDb->prepare('DELETE FROM visits WHERE id = :id');
		if($stmt->execute(array('id' => $_POST['visitid']))){
			$stmt = $objDb->prepare('SELECT id as vid, date_of_visit as dateOfVisit, program, volunteer, weight FROM visits WHERE client_id = :id');
			$stmt->execute(array('id' => $_POST['id']));
			
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$visits = $stmt->fetchAll();
		
			echo json_encode(array(
				'error' => false,
				'visits' => $visits
			), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

		}
	} else {
		$stmt = $objDb->prepare('DELETE FROM visits WHERE client_id = :id');
		if($stmt->execute(array('id' => $_POST['id']))){
			$stmt = $objDb->prepare('DELETE FROM clients WHERE id = :id');
			$stmt->execute(array('id' => $_POST['id']));
			
			echo json_encode(array(
				'error' => false,
				'client' => 'client'
			), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
		}
	}
} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}