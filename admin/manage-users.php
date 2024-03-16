 
<?php 
include_once '../conn.php';


  //update user data

  if(isset($_POST['userEditId']))
  {
        $user_id=$_POST['userEditId'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $password=md5($password);
        $contact=$_POST['contact'];
        $address=$_POST['address'];

    $sql="UPDATE users SET name='$name',email='$email',password='$password',contact='$contact',address='$address' WHERE user_id='$user_id'";

    if($conn->query($sql)===TRUE)
    {
      echo "<div class='alert alert-success'> <strong>Success ! </strong>User Record UPDATED Successfull...Redirecting...!</div>".
        "<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";    
      exit();
    }
    else
    {
      echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in inserting record.</div>";
      echo("Error description: " .mysqli_error($conn));
    }
  }
 

// delete USER profile

  if(isset($_GET['userDelId']))
  {
  $user_id=$_GET['userDelId'];

  $sql="DELETE FROM users WHERE user_id='$user_id'";
    if($conn->query($sql)===TRUE)
    {
      $_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong>User Record DELETED successfuly... Redirecting..</div><script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";
      header('location:'.$_SERVER['HTTP_REFERER']);exit();
    }
    else
    {
      $_SESSION['MSG']= "<div class='alert alert-danger'> <strong>Error ! </strong> Error in DELETING record</div>";
      header('location:'.$_SERVER['HTTP_REFERER']);exit();
    }
  }


  //admin approve user
if(isset($_GET['userApproveId']))
{
  $user_id=$_GET['userApproveId'];

  $sql="UPDATE users SET profile_status='1' WHERE user_id='$user_id'";
  if($conn->query($sql)===TRUE)
  {
    $_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong> Profile APPROVED successfully... Redirecting..</div><script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";
    header('location:'.$_SERVER['HTTP_REFERER']);exit();
  }
  else
  {
    $_SESSION['MSG']= "<div class='alert alert-danger'> <strong>Error ! </strong> Error in  updating record</div>";
    header('location:'.$_SERVER['HTTP_REFERER']);exit();
  } 
} 


?>

   