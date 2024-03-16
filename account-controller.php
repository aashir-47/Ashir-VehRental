

<?php 
include_once 'conn.php';
if(isset($_POST['register']))
{
  
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $contact=$_POST['contact'];
  $address=$_POST['address'];


  $password=md5($password);


  $sql="SELECT * FROM users WHERE  email='$email' ";
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
    echo "<div class='alert alert-warning'><strong>Errors</strong> User with given Email already exists.</div>";
    exit();
  }
    // inserting
    $sql="INSERT INTO users (name,password,email,contact,address,user_type,profile_status) VALUES ('$name','$password','$email' ,'$contact','$address','1','0') ";
      if($conn->query($sql)===TRUE)
      {
      echo "<div class='alert alert-success'> <strong>Success ! </strong> Registration Successfull. Please Login...Redirecting...!</div>".
      "<script>setTimeout(function(){ window.location.href='login.php'; }, 2000);</script>";    
      exit();
      }
      else
      {
      echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in inserting record.</div>";
      echo("Error description: " .mysqli_error($conn));
      }

}

// login
  if(isset($_POST['login']))
  {
    $email=$_POST['email'];
    $password=$_POST['password'];


    $password=md5($password);

    $sql="SELECT * FROM users WHERE email='$email' AND password='$password' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
      $row = $result->fetch_assoc();

      if ($row['profile_status']==0) {
      echo "<div class='alert alert-warning'> <strong> Wait !! </strong> for Account approval by admin.......!</div>".
      "<script>setTimeout(function(){ window.location.href='#'; }, 3000);</script>";
      exit();
      }
      
      if ($row['user_type']==1)
      {
        $_SESSION['USER_ROLE'] = 'User';
        $_SESSION['SESS_UID']=$row['user_id'];
        $_SESSION['SESS_UNAME']=$row['name'];

        echo "<div class='alert alert-success border-success'> <strong>Success ! </strong>You've Logged in Successfully. ...Redirecting...!</div>".
        "<script>setTimeout(function(){ window.location.href='user/index.php'; }, 2000);</script>";    
        exit();
      }

      elseif ($row['user_type']==0)
      {
        $_SESSION['ADMIN_ROLE'] = 'admin';
        $_SESSION['SESS_ADID']=$row['user_id'];
        $_SESSION['SESS_ADNAME']=$row['name'];

        echo "<div class='alert alert-success border-success'> <strong>Success ! </strong>You've Logged in Successfully. ...Redirecting...!</div>".
        "<script>setTimeout(function(){ window.location.href='admin/index.php'; }, 2000);</script>";    
        exit();
      } 
    }
    else
    {
      
        echo "<div class='alert alert-danger'> <strong>Error ! </strong> Invalid User ID / Password.</div>";    
        exit();
    }

  }

?>

   