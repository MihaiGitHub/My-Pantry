<?php
try {
//	session_start();
	$user = file_get_contents('php://input');  //get user from 
	$user = json_decode($user, true);
	
	include 'dbconnect.php';
	
	echo $user['mail'];
	/*
	$stmt = $objDb->prepare("SELECT id, username, password, role FROM users WHERE username = :username");
	if(!$stmt->execute(array('username' => $user['mail']))){
		throw new PDOException('The result returned no object');
	}
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	
	
	$row = $stmt->fetchAll();

	
	
	
	while($row = $stmt->fetchAll()){
		echo 'inside';
		
		echo md5($user['pass']);
		
		if(md5($user['pass']) == $row['password']){
			$_SESSION['id'] = $row['id'];
			$_SESSION['auth'] = true;
			$_SESSION['last_access'] = time();
			break;
		} else {
			$_SESSION['auth'] = false;
		}

	}
	
	if($_SESSION['auth']){

		$_SESSION['uid'] = uniqid('ang_');
		$_SESSION['role'] = 'standard';
		echo json_encode($_SESSION);
	} else {
		echo 'false';	
	}
	*/
/**/	
	
	
	
	/*
	
	if($user->mail == 'demo' && $user->pass == 'demo'){ 
		//session_start();
		$_SESSION['uid'] = uniqid('ang_');
		$_SESSION['role'] = 'standard';
		echo json_encode($_SESSION);}
	if($user->mail == 'admin' && $user->pass == 'admin'){ 
		//session_start();
		$_SESSION['uid'] = uniqid('ang_');
		$_SESSION['role'] = 'admin';
		echo json_encode($_SESSION);
	}
	*/
} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}
?>