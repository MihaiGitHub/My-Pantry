<?php 
	session_start();
	//if( isset($_SESSION['uid']) ) print 'authentified';
	echo json_encode($_SESSION);
?>