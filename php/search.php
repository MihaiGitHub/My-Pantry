<?php
try {

	if(!isset($_POST['id']) && !isset($_POST['fname']) && !isset($_POST['lname'])){
		throw new PDOException('Empty data');
	} 

	include 'dbconnect.php';
	
	$flag = 0;
	
	
	$sql = 'SELECT id, fname, lname, address, phone, inhouse FROM clients WHERE ';
	
	if(isset($_POST['id'])){
		$sql .= "id LIKE :id";
		$flag = 1;
	}
	if(isset($_POST['fname'])){
		if($flag == 0){
			$sql .= "fname LIKE :fname";
			$flag = 1;
		} else {
			$sql .= " AND fname LIKE :fname";
		}
	}
	if(isset($_POST['lname'])){
		if($flag == 0){
			$sql .= "lname LIKE :lname";
			$flag = 1;
		} else {
			$sql .= " AND lname LIKE :lname";
		}
	}
	
/*	$sql .= ($_POST['id'] == '') ? "" : "id = :id ";
	$sql .= ($_POST['fname'] == '') ? "" : " AND fname = :fname";
	$sql .= ($_POST['lname'] == '') ? "" : " AND lname = :lname";


	$stmt = $objDb->prepare($sql);
	$result = $stmt->execute(array('id' => '%'.$id.'%'));
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$row = $stmt->fetchAll();	
*/
	echo json_encode(array(
		'error' => false,
		'clients' => $sql
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}