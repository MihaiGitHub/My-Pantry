<?php
try{
	if($_POST['id'] === 'undefined'){
		throw new PDOException('Empty data');
	} 

	include 'dbconnect.php';

	if($_POST['id'] != 'undefined' && $_POST['dateOfVisit'] != 'undefined' && $_POST['program'] != 'undefined' && $_POST['volunteer'] != 'undefined'){
	
		$stmt = $objDb->prepare('INSERT INTO visits (`date_of_visit`, `lname`, `fname`, `how_many_in_house`, `phone`, `email`, `program`, `volunteer`, `client_id`) 
						VALUES (:dateOfVisit, :lname, :fname, :inHouse, :phone, :email, :program, :volunteer, :id)');
		if(!$stmt->execute(array('dateOfVisit' => $_POST['dateOfVisit'], 'lname' => $_POST['lname'], 'fname' => $_POST['fname'], 'inHouse' => $_POST['inHouse'], 
						'phone' => $_POST['phone'], 'email' => $_POST['email'], 'program' => $_POST['program'], 'volunteer' => $_POST['volunteer'], 'id' => $_POST['id']))){
							 
			throw new PDOException('The execute method failed');
		}
		
		$stmt = $objDb->prepare('SELECT date_of_visit as dateOfVisit, program, volunteer FROM visits WHERE client_id = :id');
		if(!$stmt->execute(array('id' => $_POST['id']))){ 
			throw new PDOException('The execute method failed');
		}
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->fetchAll();

		echo json_encode(array(
			'error' => false,
			'client' => $row
		), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
		
	} else {
	
	}
} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}