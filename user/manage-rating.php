<?php

include_once '../conn.php';


if(isset($_POST["rating_data"]))
{
	$user_id=$_SESSION['SESS_UID']; 
	$booking_id=$_POST['booking_id'];
	$veh_id=$_POST['veh_id'];
	$rating_data=$_POST['rating_data'];
	$feedback=$_POST['feedback'];

	$sql = "INSERT INTO ratings (booking_id, user_id, veh_id, veh_rating,feedback) VALUES ('$booking_id','$user_id','$veh_id','$rating_data','$feedback') ";

	if($conn->query($sql)===TRUE)
	{
		$q="UPDATE bookings SET booking_status='2' WHERE booking_id='$booking_id' ";
		if($conn->query($q)===TRUE)
		{
		echo "<div class='alert alert-success'> <strong>Success ! </strong>Thanks for rating ...Redirecting...!</div>".
				"<script>setTimeout(function(){ window.location.reload(); }, 2000);</script>";   
    	exit();
		}	
	}
	else
	{
	echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in Rating submition.</div>";
			echo("Error description: " .mysqli_error($conn));
			exit();		
	}
	

}
?>
