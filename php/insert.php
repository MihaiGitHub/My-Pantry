<?php
try {
	if(empty($_POST['id']) || empty($_POST['fname']) || empty($_POST['lname'])){
		throw new PDOException('Invalid request');
	} else {
		$id = $_POST['id'];
	}

	include 'dbconnect.php';

	$stmt = $objDb->prepare('INSERT INTO clients (`id`, `fname`, `lname`, `address`, `phone`, `email`, `inhouse`, `comments`) 
							 VALUES (:id, :fname, :lname, :address, :phone, :email, :inhouse, :comments)');
	if(!$stmt->execute(array('id' => $_POST['id'], 'fname' => $_POST['fname'], 'lname' => $_POST['lname'], 'address' => $_POST['address'], 
							 'phone' => $_POST['phone'], 'email' => $_POST['email'], 'inhouse' => $_POST['howManyInHouse'], 'comments' => $_POST['clientNotes']))){
		throw new PDOException('The execute method failed');
	}

	$id = $objDb->lastInsertId();
	
	$stmt = $objDb->prepare('SELECT * FROM clients WHERE id = :id');
	if(!$stmt->execute(array('id' => $id))){
		throw new PDOException('The result returned no object');
	}
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$client = $stmt->fetch();

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