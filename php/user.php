<?php 
$user=json_decode(file_get_contents('php://input'));  //get user from 

if($user->mail == 'demo' && $user->pass == 'demo'){ 
	session_start();
	$_SESSION['uid'] = uniqid('ang_');
	print $_SESSION['uid'];
}
if($user->mail == 'admin' && $user->pass == 'admin'){ 
	session_start();
	$_SESSION['uid'] = uniqid('ang_');
	$_SESSION['role'] = 'admin';
	echo json_encode($_SESSION);
}
?>