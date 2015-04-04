<?php
try {

	$user = file_get_contents('php://input');
	$user = json_decode($user);
	$username = $user->mail;
	$password = $user->pass;

	include 'dbconnect.php';
		
	$stmt = $objDb->prepare("SELECT id, username, password, role FROM users WHERE username = :username");
	if(!$stmt->execute(array('username' => $username))){
		throw new PDOException('The result returned no object');
	}
	$stmt->setFetchMode(PDO::FETCH_ASSOC);	
	
	while($row = $stmt->fetch()){
				
		if(md5($password) == $row['password']){
			session_start();
			$_SESSION['id'] = $row['id'];
			$_SESSION['role'] = $row['role'];
			$_SESSION['auth'] = true;
			$_SESSION['last_access'] = time();
			$_SESSION['uid'] = uniqid('ang_');
			break;
		} else {
			$_SESSION['auth'] = false;
		}

	}

	if($_SESSION['auth']){
		echo json_encode($_SESSION);
	}

} catch(PDOException $e) {

	echo json_encode(array(
		'error' => true,
		'message' => $e->getMessage()
	), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
	
}
?>