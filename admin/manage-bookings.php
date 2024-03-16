<?php
include_once '../conn.php';


// delete booking by admin

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
