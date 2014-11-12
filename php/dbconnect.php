<?php
try {
	$host = "db550972663.db.1and1.com";
	$dbname = "db550972663";
	$user = "dbo550972663";
	$pass = "pantry123";

	$objDb = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$objDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
}