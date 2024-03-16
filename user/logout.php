<?php
	Session_start();

	
	if (isset($_SESSION['USER_ROLE'])) 
	{
		if (isset($_SESSION['USER_ROLE'])) {
    		unset($_SESSION['USER_ROLE']);
		}
		if (isset($_SESSION['SESS_UID'])) {
    		unset($_SESSION['SESS_UID']);
		}
		if (isset($_SESSION['SESS_UNAME'])) {
    		unset($_SESSION['SESS_UNAME']);
		}

		header('location:../login.php');
	}
	
?> 