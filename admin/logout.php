<?php
session_name('EASYSALON-ADMIN');
$prms = session_get_cookie_params();
session_set_cookie_params($prms['lifetime'], '/admin/', $prms['domain'], $prms['secure'], $prms['httponly']);
session_start();

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
	// session_destroy();
	// unset($_SESSION['logged_in']);
	// setcookie(session_name(), session_id(), time()-60, '/');
	setcookie(session_name(), session_id(), time(), '/admin/');
	$_SESSION = array();
}

header("Location: index.php");
?>