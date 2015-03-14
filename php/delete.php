<?php
try{
	if($_POST['id'] === 'undefined'){
		throw new PDOException('Empty data');
	} 

	include 'dbconnect.php';

	if($_POST['delete'] == 'volunteer'){
		$stmt = $objDb->prepare('DELETE FROM volunteers WHERE id = :id');
		if($stmt->execute(array('id' => $_POST['id']))){
			$stmt = $objDb->prepare("SELECT * FROM volunteers ORDER BY volunteer ASC");
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$volunteers = $stmt->fetchAll();
			
			echo json_encode(array(
				'error' => false,
				'volunteers' => $volunteers
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