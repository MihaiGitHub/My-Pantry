<?php
if(empty($_POST['id'])){
	throw new PDOException('Empty ID');
} else {
	$id = $_POST['id'];
}

include 'dbconnect.php';

$stmt = $objDb->prepare('SELECT id, fname, lname, address FROM clients WHERE id LIKE :id');
$result = $stmt->execute(array('id' => '%'.$id.'%'));
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$row = $stmt->fetchAll();	

echo json_encode(array(
	'error' => false,
	'clients' => $row
), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);