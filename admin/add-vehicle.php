<script>
$("#loading").hide();
$("#myForm").submit(function()
{
    $("#info").html("");
    $("#loading").show();
    $("#saveBtn").prop('disabled', true);
    $.ajax({
               url: 'manage-vehicles.php',
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

  $vehicleEditId=$vehicle_id= $city_id=$cat_id=0;
 $veh_make = $veh_model = $veh_year = $veh_number = $veh_color = $veh_rent=$veh_seats= "";
 $veh_gear = $veh_conditioning= '';
  if(isset($_GET['vehEditId']))
    { 
      $vehicle_id=$_GET['vehEditId'];
      $sql="SELECT * FROM vehicles
      LEFT JOIN categories ON vehicles.cat_id=categories.cat_id
      WHERE vehicles.veh_id='$vehicle_id' ";
      $result = mysqli_query($conn, $sql);
      if($result->num_rows >=1)
      {
        $row = mysqli_fetch_array( $result);

        $cat_id=$row['cat_id'];
        $city_id=$row['city_id'];
        $cat_name=$row['cat_name'];
        $veh_make=$row['veh_make'];
        $veh_model=$row['veh_model'];
        $veh_year=$row['veh_year'];
        $veh_number=$row['veh_number'];
        $veh_color=$row['veh_color']; 
        $veh_rent=$row['veh_rent']; 
        $veh_seats=$row['veh_seats'];
        $veh_gear=$row['veh_gear'];
        $veh_conditioning=$row['veh_conditioning'];

      }
    }
?>
   
  <div>
    <div class="col-lg-12" style="padding:0px;">
      <div class="card">
        <div class="card-header bg-primary text-white">
         <center> <?=($vehicle_id>0?"Update":"Add")?> Vehicle Info </center>
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
                <label class="text-dark" for="city_id">City</label>
                <select class="form-control border-dark" name="city_id" id="city_id" value="<?=$city_name?>" required>
                  <option class="text-danger"  value="0" >---- No City Selected ----</option>
                      <?php
                        $sql="SELECT * FROM cities  ";
                        $result = mysqli_query($conn, $sql);
                      ?>
                  <?php while ($r = mysqli_fetch_array( $result)): ?>
                  <option value="<?=$r['city_id']?>" <?=($r['city_id']==$city_id?"selected":"")?> ><?=$r['city_name']?> 
                  </option>
                  <?php  endwhile; ?> 
                </select>
              </div>
              <div class="col-md-6 mb-6 mt-2">
                <label class="text-dark" for="cat_id">Vehicle Category</label>
                <select class="form-control border-dark" name="cat_id" id="cat_id" value="<?=$cat_name?>" required>
                  <option class="text-danger"  value="0" >---- No Category Selected ----</option>
                      <?php
                        $sql="SELECT * FROM categories  ";
                        $result = mysqli_query($conn, $sql);
                      ?>
                  <?php while ($r = mysqli_fetch_array( $result)): ?>
                  <option value="<?=$r['cat_id']?>" <?=($r['cat_id']==$cat_id?"selected":"")?> ><?=$r['cat_name']?> 
                  </option>
                  <?php  endwhile; ?> 
                </select>
              </div>
             <div class="col-md-6 mb-6 mt-2">
              <label class="text-dark" for="veh_make">Vehicle Make</label>
              <select name="veh_make" class="form-control border-dark" required>
                <option value="0">Select Vehicle Make</option>
                <?php
                  $vehicleMakes = array(
                    "Toyota",
                    "Honda",
                    "Ford",
                    "Chevrolet",
                    "Nissan",
                    "Suzuki",
                    "BMW",
                    "Mercedes-Benz",
                    "Audi",
                    "Volkswagen",
                    "Hyundai",
                    "Kia",
                    "Subaru",
                    "Mazda",
                    "Volvo"
                  );
                  
                  foreach ($vehicleMakes as $make) {
                    $selected = ($veh_make === $make) ? 'selected' : '';
                    echo "<option value=\"$make\" $selected>$make</option>";
                  }
                ?>
              </select>
            </div>
            
            <div class="col-md-6 mb-6 mt-2">
              <label class="text-dark" for="veh_model">Vehicle Model</label>
              <input type="text" name="veh_model" value="<?=$veh_model?>" class="form-control border-dark" placeholder="Enter Vehicle Model (GLI / Civic etc)" required>
            </div>
            <div class="col-md-6 mb-6 mt-2">
              <label class="text-dark" for="veh_year">Vehicle Year</label>
              <input type="number" name="veh_year" value="<?=$veh_year?>" class="form-control border-dark" placeholder="Enter Vehicle Year" required>
            </div>
            <div class="col-md-6 mb-6 mt-2">
              <label class="text-dark" for="veh_number">Vehicle Number</label>
              <input type="text" name="veh_number" value="<?=$veh_number?>" class="form-control border-dark" placeholder="Enter Vehicle Number" required>
            </div>
            <div class="col-md-6 mb-6 mt-2">
              <label class="text-dark" for="veh_color">Vehicle Color</label>
              <input type="text" name="veh_color" value="<?=$veh_color?>" class="form-control border-dark" placeholder="Enter Vehicle Color" required>
            </div>
            <div class="col-md-6 mb-6 mt-2">
              <label class="text-dark" for="veh_rent">Vehicle Rent (Per Day)</label>
              <input type="text" name="veh_rent" value="<?=$veh_rent?>" class="form-control border-dark" placeholder="Enter Vehicle Rent per day" required>
            </div>

            <div class="col-md-6 mb-6 mt-2">
              <label class="text-dark" for="veh_seats">Vehicle Seat Capacity</label>
              <input type="text" name="veh_seats" value="<?=$veh_seats?>" class="form-control border-dark" placeholder="Enter Vehicle Seat Capacity" required>
            </div>
            <div class="col-md-6 mb-6 mt-2">
              <label class="text-dark" for="veh_gear">Vehicle Gear Transmission</label>
              <select class="form-control border-dark" name="veh_gear" id="veh_gear" value="<?=$cat_name?>" required>
                <option class="text-danger"  value="0" >---- Not Selected ----</
              </select>
                <option class="text-dark"  value="auto" >Auto Gear</option>
                <option class="text-dark"  value="manual" >Manual Gear</option>
              </select>
            </div>
            <div class="col-md-6 mb-6 mt-2">
              <label class="text-dark" for="veh_conditioning">Vehicle Air Conditioning</label>
              <select class="form-control border-dark" name="veh_conditioning" id="veh_conditioning" value="<?=$veh_conditioning?>" required>
                <option class="text-danger"  value="0" >---- Not Selected ----</
              </select>
                <option class="text-dark"  value="yes" >Yes (Working) </option>
                <option class="text-dark"  value="no" >No (Not Working) </option>
              </select>
            </div>

             
              
              <?php if (isset($_GET['vehEditId'])): ?>
              <div class="form-row justify-content-lg-left  text-center mt-3">
                <div class="form-row col-lg-12 mb-2">
                  <input type="hidden" name="vehicleEditId" value="<?=$vehicle_id?>"/>
                  <input type="submit" id="saveBtn" class="btn btn-primary" value="Update" >
                </div>
              </div> 
              <?php else: ?>
              <div class="form-row justify-content-lg-left text-center mt-3">
                <div class="form-row col-lg-12 mb-2">
                  <input type="hidden" name="vehicleAddId" />
                  <input type="submit" id="saveBtn" class="btn btn-primary" value="Save" >
                </div>
              </div> 
              <?php endif ?> 
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

