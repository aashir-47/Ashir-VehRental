<script>
  $("#loading").hide();
  $("#myForm").submit(function()
  {
      $("#info").html("");
      $("#loading").show();
      $("#saveBtn").prop('disabled', true);
      $.ajax({
                 url: 'manage-cities.php',
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

  $cityEditId=$city_id=0;
  $city_name="";
  if(isset($_GET['cityEditId']))
  { 
   
    $city_id=$_GET['cityEditId'];
    $sql="SELECT * FROM cities WHERE city_id='$city_id'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows ==1)
    {
      $row = mysqli_fetch_array( $result);
      $city_name=$row['city_name'];
    }
  }
?>
   
  <div class="row">
    <div class="col-lg-12" style="padding:0px;">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <?=($cityEditId>0?"Update":"Add")?> City
        </div>
        <div class="card-body" style="min-width:450px;">
          <div class="form-row justify-content-lg-center justify-content-md-center">
            <div class="form-group col-lg-12 col-md-12 col-sm-12" >
              <div id="info"></div>
              <div id="loading" style="display:none;" class="card" >
                <div class="card-body">
                  <span> <i class="fas fa-spinner"></i> </span> <strong> Loading </strong>.....Please Wait.... <span class="glyphicon glyphicon-time"></span>
                </div>
              </div>
            </div>
          </div>
          <form id="myForm" action="" method="">
            <div class="form-row justify-content-lg-left justify-content-md-center">
              <div class="form-group col-lg-12 col-md-12 col-sm-12" >
                <label for="cat_name">City Name</label>
                <input type="text" class="form-control border-secondary mt-3" name="city_name" id="city_name" value="<?=$city_name?>" placeholder="Enter City Name">
              </div>
            </div>    
              
            <?php if (isset($_GET['cityEditId'])): ?>
              <div class="form-row justify-content-lg-left  text-center mt-3">
                <div class="form-row col-lg-12 mb-2">
                  <input type="hidden" name="cityEditId" value="<?=$city_id?>"/>
                  <input type="submit" id="saveBtn" class="btn btn-primary" value="Update" >
                </div>
              </div> 
              <?php else: ?>
              <div class="form-row justify-content-lg-left text-center mt-3">
                <div class="form-row col-lg-12 mb-2">
                  <input type="hidden" name="cityAddId" />
                  <input type="submit" id="saveBtn" class="btn btn-primary" value="Save" >
                </div>
              </div> 
              <?php endif ?> 
          </form>
        </div>
      </div>
    </div>
  </div>

