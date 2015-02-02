<?php
try {

	include 'dbconnect.php';
		
	if(!isset($_POST['volunteer'])){
		$stmt = $objDb->prepare("SELECT volunteer FROM volunteers WHERE active = 'Y'");
	} else {
		if(!isset($_POST['active'])){
			$stmt = $objDb->prepare("SELECT * FROM volunteers");
		} else {
			$id = $_POST['id'];
			$active = $_POST['active'];
			
			if($active == 'Y'){
				$stmt = $objDb->prepare("UPDATE volunteers SET active = 'N' WHERE id = $id");
				$result = $stmt->execute();
			} else {
				$stmt = $objDb->prepare("UPDATE volunteers SET active = 'Y' WHERE id = $id");
				$result = $stmt->execute();
			}
			
			$stmt = $objDb->prepare("SELECT * FROM volunteers");
		}
	}
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