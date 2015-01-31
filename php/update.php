<?php
try{
	if($_POST['id'] === 'undefined'){
		throw new PDOException('Empty data');
	} 

	include 'dbconnect.php';

	if(isset($_POST['dateOfVisit']) && isset($_POST['program']) && isset($_POST['volunteer'])){
	
		$stmt = $objDb->prepare('INSERT INTO visits (`date_of_visit`, `lname`, `fname`, `how_many_in_house`, `phone`, `email`, `program`, `volunteer`, `numBags`, `client_id`) 
						VALUES (:dateOfVisit, :lname, :fname, :inHouse, :phone, :email, :program, :volunteer, :numBags, :id)');
		if(!$stmt->execute(array('dateOfVisit' => $_POST['dateOfVisit'], 'lname' => $_POST['lname'], 'fname' => $_POST['fname'], 'inHouse' => $_POST['inHouse'], 
						'phone' => $_POST['phone'], 'email' => $_POST['email'], 'program' => $_POST['program'], 'volunteer' => $_POST['volunteer'], 'numBags' => $_POST['numBags'], 'id' => $_POST['id']))){
							 
			throw new PDOException('The execute method failed');
		}
		
		$stmt = $objDb->prepare('SELECT date_of_visit as dateOfVisit, program, volunteer, numBags FROM visits WHERE client_id = :id');
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
	
		$stmt = $objDb->prepare('UPDATE clients SET fname = :fname, lname = :lname, address = :address, city = :city, state = :state, postalCode = :postalCode, phone = :phone,
		email = :email, employed = :employed, lastDateWorked = :lastDateWorked, inhouse = :inHouse, howManyMales = :howManyMales, howManyFemales = :howManyFemales, ageGroups = :ageGroups, comments = :comments
		WHERE id = :id');
		if(!$stmt->execute(array('fname' => $_POST['fname'], 'lname' => $_POST['lname'], 'address' => $_POST['address'], 'city' => $_POST['city'], 'state' => $_POST['state'],
'postalCode' => $_POST['postalCode'], 'phone' => $_POST['phone'], 'email' => $_POST['email'], 'employed' => $_POST['employed'], 'lastDateWorked' => $_POST['lastDateWorked'], 'inHouse' => $_POST['inHouse'], 'howManyMales' => $_POST['howManyMales'],
'howManyFemales' => $_POST['howManyFemales'], 'ageGroups' => $_POST['ageGroups'], 'comments' => $_POST['comments'],	'id' => $_POST['id']))){ 
			throw new PDOException('The execute method failed');
		}				
		
		echo json_encode(array(
			'error' => false,
			'test' => 'passed'
		), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
		
	}
} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}