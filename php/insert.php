<?php
try {
	if(empty($_POST['id']) || empty($_POST['fname']) || empty($_POST['lname'])){
		throw new PDOException('Invalid request');
	}

	include 'dbconnect.php';

	$stmt = $objDb->prepare('INSERT INTO clients (`id`, `fname`, `lname`, `address`, `phone`, `email`, `inhouse`, `comments`) 
							 VALUES (:id, :fname, :lname, :address, :phone, :email, :inhouse, :comments)');
	if($stmt->execute(array('id' => $_POST['id'], 'fname' => $_POST['fname'], 'lname' => $_POST['lname'], 'address' => $_POST['address'], 
							'phone' => $_POST['phone'], 'email' => $_POST['email'], 'inhouse' => $_POST['howManyInHouse'], 'comments' => $_POST['clientNotes']))){
		
		$stmt = $objDb->prepare('INSERT INTO visits (`date_of_visit`, `lname`, `fname`, `how_many_in_house`, `phone`, `email`, `program`, `volunteer`, `client_id`) 
						VALUES (:dateOfVisit, :lname, :fname, :howManyInHouse, :phone, :email, :program, :volunteer, :clientID)');
		if(!$stmt->execute(array('dateOfVisit' => $_POST['dateOfVisit'], 'lname' => $_POST['lname'], 'fname' => $_POST['fname'], 'howManyInHouse' => $_POST['howManyInHouse'], 
						'phone' => $_POST['phone'], 'email' => $_POST['email'], 'program' => $_POST['program'], 'volunteer' => $_POST['volunteer'], 'clientID' => $_POST['id']))){
							 
			throw new PDOException('The execute method failed');
		}
	}

	
	/*
	$id = $objDb->lastInsertId();
	
	$stmt = $objDb->prepare('SELECT * FROM clients WHERE id = :id');
	if(!$stmt->execute(array('id' => $id))){
		throw new PDOException('The result returned no object');
	}
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$client = $stmt->fetch();
*/
	echo json_encode(array(
		'error' => false,
		'fname' => $_POST['fname'],
		'lname' => $_POST['lname']
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
	
} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}