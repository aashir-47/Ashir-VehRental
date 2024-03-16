<?php
include_once '../conn.php';
//  add new product
if(isset($_POST['bookingAddId']))
{
	$veh_id=$_POST['bookingAddId'];
	$booking_start=$_POST['booking_start'];
	$booking_end=$_POST['booking_end'];
	$pickup_time=$_POST['pickup_time'];
	$pickup_location=$_POST['pickup_location'];
	$user_id=$_SESSION['SESS_UID'];
	$is_available = true;
	// Retrieve booked dates for the vehicle from the database
		$sql = "SELECT booking_start, booking_end FROM bookings WHERE veh_id = $veh_id";
		$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0)
{
		// Store booked dates in an array
		$booked_dates = array();
			while ($row = mysqli_fetch_assoc($result)) {
		$booked_dates[] = array(
		'start' => $row['booking_start'],
		'end' => $row['booking_end']
		);
			}
		
		// Check if any part of the desired booking period overlaps with the booked dates
		foreach ($booked_dates as $date_range) {
	$start = $date_range['start'];
	$end = $date_range['end'];
	if (($booking_start >= $start && $booking_start <= $end) || ($booking_end >= $start && $booking_end <= $end)) {
	$is_available = false;
	break;
	}
		}
	}
		if (!$is_available) {
			echo "<div class='alert alert-warning'> <strong> Wait ! </strong> This vehicle is not available for the booking in your desired period.</div>";
	echo "<br>" ;
	echo "<p class='text-success'><b>Available days in the selected booking period are.</b></p>"  ;
	$available_dates = array();
			$current_date = new DateTime($booking_start);
			while ($current_date <= new DateTime($booking_end)) {
		       $is_available = true;
		  foreach ($booked_dates as $date_range) {
			$start = new DateTime($date_range['start']);
			$end = new DateTime($date_range['end']);
			if ($current_date >= $start && $current_date <= $end) {
			$is_available = false;
	break;
	}
		}
		if ($is_available) {
	     $available_dates[] = $current_date->format('Y-m-d');
		}
		$current_date->modify('+1 day');
			}
			// Display the available dates
			foreach ($available_dates as $date) {
	     	echo $date . "<br><br>";
			}
		}
		else
		{
				$date_now = time();
		if ($booking_start < $date_now)
		{
			echo "<div class='alert alert-warning'><strong>Error  !! </strong> You can not book a car in the past </div>";
			exit();
		}
		// inserting
			$sql="INSERT INTO bookings (veh_id,user_id,booking_start,booking_end,pickup_time,pickup_location,booking_status) VALUES ('$veh_id','$user_id','$booking_start','$booking_end','$pickup_time','$pickup_location','0') ";
			if($conn->query($sql)===TRUE)
			{
				echo "<div class='alert alert-success'> <strong>Success ! </strong> Booking ADDED Successfully...Redirecting...!</div>".
					"<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";
		exit();
     }
else
     {
		echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in ADDING record.</div>";
		echo("Error description: " .mysqli_error($conn));
     }
}
}
			// delete booking by user
		 if(isset($_GET['bookingDelId']))
{
			$booking_id=$_GET['bookingDelId'];
			$sql="DELETE FROM bookings WHERE booking_id='$booking_id'";
			if($conn->query($sql)===TRUE)
     {
		$_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong> Booking Record DELETED successfuly... Redirecting..</div><script>setTimeout(function(){ window.location.reload(); }, 1000);</script>";
		header('location:'.$_SERVER['HTTP_REFERER']);exit();
  }
   else
    {
			$_SESSION['MSG']= "<div class='alert alert-danger'> <strong>Error ! </strong> Error in DELETING record</div>";
			header('location:'.$_SERVER['HTTP_REFERER']);exit();
   }
 }
			//maid approve booking
			if(isset($_GET['bookingAcceptId']))
  {  
			$booking_id=$_GET['bookingAcceptId'];
			$sql="UPDATE bookings SET  booking_status='1' WHERE booking_id='$booking_id'";
			if($conn->query($sql)===TRUE)
{
			$_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong> Booking APPROVED successfully...Redirecting...!</div><script>setTimeout(function(){ window.location.reload(); }, 1000);</script>";
			header('location:'.$_SERVER['HTTP_REFERER']);exit();
		}
   else
{
			$_SESSION['MSG']= "<div class='alert alert-danger'> <strong>Error ! </strong> Error in DELETING record</div>";
			header('location:'.$_SERVER['HTTP_REFERER']);exit();
     }
   }
?>