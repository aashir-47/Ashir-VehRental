<?php 
include_once '../conn.php';


//  add new category  

if(isset($_POST['cityAddId']))
{
	$city_name=$_POST['city_name'];
	

	// updating
	$sql="INSERT INTO cities (city_name) VALUES ('$city_name') ";
	if($conn->query($sql)===TRUE)
	{
		echo "<div class='alert alert-success'> <strong>Success ! </strong> City ADDED Successfully...Redirecting...!</div>".
    	"<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";    
    	exit();
    	
	}
	else
	{
	echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in ADDING record.</div>";
    echo("Error description: " .mysqli_error($conn));
	}
}

//  category edit 

if(isset($_POST['cityEditId']))
{
	$city_id=$_POST['cityEditId'];
	$city_name=$_POST['city_name'];
	
	// updating
	$sql="UPDATE cities SET city_name='$city_name' WHERE city_id='$city_id' ";
	if($conn->query($sql)===TRUE)
	{
		echo "<div class='alert alert-success'> <strong>Success ! </strong> City  UPDATED Successfully...Redirecting...!</div>".
    		"<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";    
    	exit();
	}
	else
	{
	echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in Updating record.</div>";
    echo("Error description: " .mysqli_error($conn));
	}
}


// delete category info

if(isset($_GET['cityDelId']))
{
  $city_id=$_GET['cityDelId'];

  $sql="DELETE FROM cities WHERE city_id='$city_id'";
  if($conn->query($sql)===TRUE)
  {
    $_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong> City Record DELETED successfuly... Redirecting..</div><script>setTimeout(function(){ window.location.reload(); }, 1000);</script>";
    header('location:'.$_SERVER['HTTP_REFERER']);exit();
  }
  else
  {
    $_SESSION['MSG']= "<div class='alert alert-danger'> <strong>Error ! </strong> Error in DELETING record</div>";
    header('location:'.$_SERVER['HTTP_REFERER']);exit();
  }
}



?>