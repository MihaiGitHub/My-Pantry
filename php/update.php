<?php
try{
	if($_POST['id'] === 'undefined'){
		throw new PDOException('Empty data');
	} 

	include 'dbconnect.php';

	$stmt = $objDb->prepare('UPDATE clients SET fname = :fname, lname = :lname, address = :address, phone = :phone, email = :email, inhouse = :inhouse, comments = :comments WHERE id = :cid');
	if(!$stmt->execute(array('fname' => $_POST['fname'], 'lname' => $_POST['lname'], 'address' => $_POST['address'], 'phone' => $_POST['phone'], 'email' => $_POST['email'], 'inhouse' => $_POST['inhouse'], 'comments' => $_POST['comments'], 'cid' => $_POST['id']))){
		throw new PDOException('There was an error updating the client');
	}
	
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