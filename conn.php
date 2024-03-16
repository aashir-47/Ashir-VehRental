<?php
	if(!isset($_SESSION)) session_start();
		$conn = new mysqli("localhost", "root","", "ovr"); 
		if($conn->connect_errno){
			die('Error in DB Connection. Please create a database with name <b>ovr</b> by using <b>phpMyAdmin</b> with user as <b>root</b> and without password.');
		}
?> 