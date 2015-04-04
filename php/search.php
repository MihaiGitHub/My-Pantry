<?php
try {
/*
	if(($_POST['id'] == 'undefined') && ($_POST['fname'] == 'undefined') && ($_POST['lname'] == 'undefined') && ($_POST['address'] == 'undefined') && ($_POST['phone'] == 'undefined')){
		throw new PDOException('Empty data');
	} 
*/
	include 'dbconnect.php';
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$flag = 0;	
		$sql = 'SELECT id, fname, lname, address, phone, inhouse, email FROM clients WHERE ';
		
		$values = array();
		if($_POST['id'] != 'undefined'){
			$sql .= "id LIKE :id";
	
			if($_POST['idType'] == 'contains'){
				$values['id'] = '%'.$_POST['id'].'%';
			} else {
				$values['id'] = $_POST['id'].'%';
			}
			
			$flag = 1;
		}
		if($_POST['fname'] != 'undefined'){
			if($flag == 0){
				$sql .= "fname LIKE :fname";
				$flag = 1;
			} else {
				$sql .= " AND fname LIKE :fname";
			}
			
			if($_POST['fnameType'] == 'contains'){
				$values['fname'] = '%'.$_POST['fname'].'%';
			} else {
				$values['fname'] = $_POST['fname'].'%';
			}
		}
		if($_POST['lname'] != 'undefined'){
			if($flag == 0){
				$sql .= "lname LIKE :lname";
				$flag = 1;
			} else {
				$sql .= " AND lname LIKE :lname";
			}
			
			if($_POST['lnameType'] == 'contains'){
				$values['lname'] = '%'.$_POST['lname'].'%';
			} else {
				$values['lname'] = $_POST['lname'].'%';
			}
		}
		if($_POST['address'] != 'undefined'){
			if($flag == 0){
				$sql .= "address LIKE :address";
				$flag = 1;
			} else {
				$sql .= " AND address LIKE :address";
			}
			
			if($_POST['addressType'] == 'contains'){
				$values['address'] = '%'.$_POST['address'].'%';
			} else {
				$values['address'] = $_POST['address'].'%';
			}
		}
		if($_POST['phone'] != 'undefined'){
			if($flag == 0){
				$sql .= "phone LIKE :phone";
				$flag = 1;
			} else {
				$sql .= " AND phone LIKE :phone";
			}
			
			if($_POST['phoneType'] == 'contains'){
				$values['phone'] = '%'.$_POST['phone'].'%';
			} else {
				$values['phone'] = $_POST['phone'].'%';
			}
		}
		
		if($_POST['email'] != 'undefined'){
			if($flag == 0){
				$sql .= "email LIKE :email";
				$flag = 1;
			} else {
				$sql .= " AND email LIKE :email";
			}
			
			if($_POST['emailType'] == 'contains'){
				$values['email'] = '%'.$_POST['email'].'%';
			} else {
				$values['email'] = $_POST['email'].'%';
			}
		}
		
		if($_POST['numInHouse'] != 'undefined'){
			if($flag == 0){
				$sql .= "inhouse LIKE :numInHouse";
				$flag = 1;
			} else {
				$sql .= " AND inhouse LIKE :numInHouse";
			}
			
			if($_POST['numInHouseType'] == 'contains'){
				$values['numInHouse'] = '%'.$_POST['numInHouse'].'%';
			} else {
				$values['numInHouse'] = $_POST['numInHouse'].'%';
			}
		}
		
		if($_POST['comments'] != 'undefined'){
			if($flag == 0){
				$sql .= "comments LIKE :comments";
				$flag = 1;
			} else {
				$sql .= " AND comments LIKE :comments";
			}
			
			if($_POST['comments'] == 'contains'){
				$values['comments'] = '%'.$_POST['comments'].'%';
			} else {
				$values['comments'] = $_POST['comments'].'%';
			}
		}
		
		$stmt = $objDb->prepare($sql);
		$result = $stmt->execute($values);
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->fetchAll();	
	
		echo json_encode(array(
			'error' => false,
			'clients' => $row
		), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
	} else {
		$sql = 'SELECT MAX(id) + 1 AS id FROM clients';
		$stmt = $objDb->prepare($sql);
		$result = $stmt->execute($values);
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->fetch();	
	
		echo json_encode(array(
			'error' => false,
			'id' => $row['id']
		), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	}

} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}