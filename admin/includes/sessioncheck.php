<?php

function sessionCheck() {
	$sessionCheck = false; 
	$sessionAvailable = (isset($_SESSION['isLoggedin']) && $_SESSION['isLoggedin'] == true);

	if($sessionAvailable){
		$timestamp = time();
		$lastActive = $timestamp - $_SESSION['timestamp'];
		
		$sessionDuration = SESSION_EXPIRY*60; // 180 minutes (3 hours)
	
		$sessionCheck = ( 
			$lastActive < $sessionDuration && 
			$_SESSION['userip'] == $_SERVER['REMOTE_ADDR'] && 
			$_SESSION['useragent'] == $_SERVER['HTTP_USER_AGENT']
		);
		
	}	
	return $sessionCheck; // return true or false
}
?>