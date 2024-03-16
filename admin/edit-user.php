<script>
$("#loading").hide();
$("#myForm").submit(function()
{
    $("#info").html("");
    $("#loading").show();
    $("#saveBtn").prop('disabled', true);
    $.ajax({
               url: 'manage-users.php',
               type: 'post',
               data: $('#myForm').serialize(),
               success: function(response)
               {
                  $("#loading").hide();
                  $("#info").html(response);
                  $("#saveBtn").prop('disabled', false);
               }
            });
return false;
});
</script>

<?php
  include_once '../conn.php';

  $user_id=0;
  $name=$email=$login_id=$contact=$address="";
  if(isset($_GET['userEditId']))
    { 
      $user_id=$_GET['userEditId'];
      $sql="SELECT * FROM users
      WHERE user_id='$user_id' ";
      $result = mysqli_query($conn, $sql);
      if($result->num_rows >=1)
      {
        $row = mysqli_fetch_array( $result);

        $name=$row['name'];
        $email=$row['email'];
        $contact=$row['contact'];
        $address=$row['address'];
      }
    }
?>
   
  <div>
    <div class="col-lg-12" style="padding:0px;">
      <div class="card">
        <div class="card-header bg-success text-white">
          <center>Update User Details</center>
        </div>
        <div class="card-body" style="max-width:950px;">
          <div id="info"> </div>
          <div id="loading" style="display:none;" class="card">
            <div class="card-body">
              <span> <i class="fas fa-spinner"></i> </span> <strong> Loading </strong>.....Please Wait....
              <span class="glyphicon glyphicon-time"></span>
            </div>
          </div>

          <form id="myForm" class="mt-2" method="" action="">
            <div class="row">
              <div class="col-md-6 mb-6 mt-2">
                <label class="text-dark"  for="name">Name</label>
                <input type="text" name="name" value="<?=$name?>" class="form-control border-dark" placeholder=" Service Provider Name" required>
              </div>
              <div class="col-md-6 mb-6 mt-2">
                <label class="text-dark"  for="Email">Email</label>
                <input type="email" name="email" value="<?=$email?>" class="form-control border-dark" placeholder=" Service Provider Email" required>
              </div>
                <div class="col-md-6 mb-6 mt-2">
                  <label class="text-dark"  for="password">Password</label>
                  <input type="password" name="password"  class="form-control border-dark" placeholder="Enter Password" required>
              </div>
              <div class="col-md-6 mb-6 mt-2">
                <label class="text-dark"  for="contact">Phone No</label>
                <input type="number" name="contact" value="<?=$contact?>" class="form-control border-dark" placeholder=" Service Provider Contact" required>
              </div>
              <div class="col-md-12 mb-6 mt-2">
                <label class="text-dark"  for="address">Address</label>
                <input type="text" name="address" value="<?=$address?>" class="form-control border-dark" placeholder=" Service Provider Contact" required>
              </div>
             
              
              <div class="form-row justify-content-lg-left text-center mt-3">
                <div class="form-row col-lg-12 mb-2">
                  <input type="hidden" name="userEditId" value="<?=$user_id?>"/>
                  <input type="submit" id="saveBtn" class="btn btn-success" value="Update" >
                </div>
              </div> 
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  