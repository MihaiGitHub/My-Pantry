<?php
try {

	include 'dbconnect.php';
		
	if($_POST['volunteers'] == 'update'){
			$id = $_POST['id'];
			$active = $_POST['active'];
			
			if($active == 'Y'){
				$stmt = $objDb->prepare("UPDATE volunteers SET active = 'N' WHERE id = $id");
				$stmt->execute();
			} else {
				$stmt = $objDb->prepare("UPDATE volunteers SET active = 'Y' WHERE id = $id");
				$stmt->execute();
			}
	}
	if ($_POST['volunteers'] == 'insert'){
			$stmt = $objDb->prepare("INSERT INTO volunteers (`volunteer`, `active`) VALUES (:volunteer, :active)");
			$stmt->execute(array('volunteer' => $_POST['volunteer'], 'active' => $_POST['active']));
	}
	if($_POST['volunteers'] == 'delete'){
			$stmt = $objDb->prepare('DELETE FROM volunteers WHERE id = :id');
			$stmt->execute(array('id' => $_POST['id']));
	} 
	
	if(!isset($_POST['volunteers'])){
			$stmt = $objDb->prepare("SELECT volunteer FROM volunteers WHERE active = 'Y'");
	} else {
			$stmt = $objDb->prepare("SELECT * FROM volunteers ORDER BY volunteer ASC");
	}
	
	$stmt->execute();
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