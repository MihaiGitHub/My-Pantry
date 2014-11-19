<?php
try {

	if(($_POST['id'] == 'undefined') && ($_POST['fname'] == 'undefined') && ($_POST['lname'] == 'undefined')){
		throw new PDOException('Empty data');
	} 

	include 'dbconnect.php';
	
	$flag = 0;	
	$sql = 'SELECT id, fname, lname, address, phone, inhouse FROM clients WHERE ';
	
	$values = array();
	if($_POST['id'] != 'undefined'){
		$sql .= "id LIKE :id";
		$values['id'] = '%'.$_POST['id'].'%';
		$flag = 1;
	}
	if($_POST['fname'] != 'undefined'){
		if($flag == 0){
			$sql .= "fname LIKE :fname";
			$flag = 1;
		} else {
			$sql .= " AND fname LIKE :fname";
		}
		$values['fname'] = '%'.$_POST['fname'].'%';
	}
	if($_POST['lname'] != 'undefined'){
		if($flag == 0){
			$sql .= "lname LIKE :lname";
			$flag = 1;
		} else {
			$sql .= " AND lname LIKE :lname";
		}
		$values['lname'] = '%'.$_POST['lname'].'%';
	}
	
	$stmt = $objDb->prepare($sql);
	$result = $stmt->execute($values);
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$row = $stmt->fetchAll();	

	echo json_encode(array(
		'error' => false,
		'clients' => $row
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}