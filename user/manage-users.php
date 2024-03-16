 
<?php 
include_once '../conn.php';


  //update user data

  if(isset($_POST['userEditId']))
  {
      $user_id=$_SESSION['SESS_UID'];
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
 
if(isset($_POST['profileEditId']))
  {
      $user_id=$_SESSION['SESS_UID'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $contact=$_POST['contact'];
        $address=$_POST['address'];

    $sql="UPDATE users SET name='$name',email='$email',contact='$contact',address='$address' WHERE user_id='$user_id'";

    if($conn->query($sql)===TRUE)
    {
      echo "<div class='alert alert-success'> <strong>Success ! </strong>Profile Record UPDATED Successfull...Redirecting...!</div>".
        "<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";    
      exit();
    }
    else
    {
      echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in updating record.</div>";
      echo("Error description: " .mysqli_error($conn));
    }
  }
?>

   