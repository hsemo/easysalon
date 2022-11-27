<?php
session_name('EASYSALON');
session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
	// session_destroy();
	// unset($_SESSION['logged_in']);
	// setcookie(session_name(), session_id(), time()-60, '/');
	setcookie(session_name(), session_id(), time(), '/');
	$_SESSION = array();
}

header("Location: index.php");
?>