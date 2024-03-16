<?php
	Session_start();
	if (isset($_SESSION['ADMIN_ROLE'])) {
		
		if (isset($_SESSION['ADMIN_ROLE'])) {
    		unset($_SESSION['ADMIN_ROLE']);
		}
		if (isset($_SESSION['SESS_ADID'])) {
    		unset($_SESSION['SESS_ADID']);
		}
		if (isset($_SESSION['SESS_ADNAME'])) {
    		unset($_SESSION['SESS_ADNAME']);
		}
		header('location:../login.php');
	}

?>  