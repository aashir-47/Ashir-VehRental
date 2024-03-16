<?php $veh_id=0; if(isset($_GET['veh_id'])) $veh_id=$_GET['veh_id']; ?>
<?php
include_once '../conn.php';
if(isset($_GET['bookingAddId'])) {
$veh_id = $_GET['bookingAddId'];
// Fetch details of the selected service
$serviceQuery = "SELECT * FROM vehicles
LEFT JOIN categories ON vehicles.cat_id=categories.cat_id
LEFT JOIN images ON images.veh_id=vehicles.veh_id
LEFT JOIN cities ON vehicles.city_id=cities.city_id
WHERE vehicles.veh_id = $veh_id";
$serviceResult = mysqli_query($conn, $serviceQuery);
if(mysqli_num_rows($serviceResult) > 0) {
$row = mysqli_fetch_assoc($serviceResult);
// Fetch images for the vehicle
$imagesQuery = "SELECT * FROM images WHERE veh_id = $veh_id";
$imagesResult = mysqli_query($conn, $imagesQuery);
} else {
// Redirect or handle the case where the service details are not found
header("Location: vehicles.php"); // Redirect
exit();
}
} else {
// Redirect or handle the case where bookingAddId is not set
header("Location: vehicles.php"); // Redirect
exit();
}
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Process the form data and make the booking
$name = mysqli_real_escape_string($conn, $_POST['name']);
$pickupLocation = mysqli_real_escape_string($conn, $_POST['pickup_location']);
$numberOfDays = mysqli_real_escape_string($conn, $_POST['number_of_days']);
$pickupDate = mysqli_real_escape_string($conn, $_POST['pickup_date']);
// Add more form fields as needed
// Example: Insert the booking details into the database
$bookingQuery = "INSERT INTO bookings (veh_id, user_name, pickup_location, number_of_days, pickup_date) VALUES ($serviceId, '$name', '$pickupLocation', $numberOfDays, '$pickupDate')";
$bookingResult = mysqli_query($conn, $bookingQuery);
if ($bookingResult) {
// Booking successful, redirect or show a success message
header("Location: index.php"); // Redirect to the homepage for example
exit();
} else {
// Handle the case where the booking failed
echo "Booking failed. Please try again.";
}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Include the necessary head content from your main file -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>OVRS-Prototype</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    
    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/fancybox/jquery.fancybox.min.css" media="screen" />
    <link href="../assets/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../assets/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../assets/datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />
    <script src="../assets/font-awesome/js/all.min.js" ></script>
    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <!-- Additional styles for the booking page -->
    <style>
    /* Add any additional styles specific to the booking page */
    #vehicle-details {
    display: flex;
    justify-content: space-between;
    }
    #vehicle-images img {
    width: 100%;
    height: auto;
    margin-bottom: 10px;
    }
    </style>
  </head>
  <body>
    <!--  header/navbar -->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="index.html">Online <span class="color-b"> Vehicle Rental System</span></a>

      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">

          <li class="nav-item"><a class="nav-link " href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link " href="profile.php">Profile</a></li>
          <li class="nav-item"><a class="nav-link active" href="vehicles.php">Vehicles</a></li>
          <li class="nav-item"><a class="nav-link " href="bookings.php">Bookings</a></li>
          <li class="nav-item"><a class="nav-link " href="logout.php">Logout</a></li>

        </ul>
      </div>

    </div>
  </nav>
    <!-- Main content for the booking page -->
    <main id="main">
      <section class="section-property section-t8">
        <div class="container mb-5">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="col-lg-12 text-center mt-3" id="heading2">
                    <h1><p class="animate__animated animate__fadeInUp">Book Service</p></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Vehicle Details and Images -->
      <div class="row mt-3">
        <div class="col-lg-12 d-flex">
          <div class="col-lg-6">
            <div class="col-lg-12">
              <div class="card">
                <div class="card">
                <div class="card-body">
                  <!-- Display service details here -->
                  <h2><?= $row['veh_make'] ?> - <?= $row['veh_model'] ?></h2>
                  <p> Model / Year : (<?= $row['veh_year'] ?>) </p>
                  <h4 class="mt-4 mb-4">
                  <?php if($row['veh_gear']=='manual' OR $row['veh_gear']=='Manual'): ?>
                  <i class="bi bi-gear text-success"></i> Manual transmission
                  <?php elseif($row['veh_gear']=='auto' OR $row['veh_gear']=='Auto'): ?>
                  <i class="bi bi-gear text-danger"></i> Auto  Transmission
                  <?php endif ?>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
                  <i class="fa fa-user text-dark"></i> <?= $row['veh_seats'] ?> Persons&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                  <?php if($row['veh_conditioning']=='Yes' OR $row['veh_conditioning']=='yes'): ?>
                  <i class="fa fa-snowflake text-success"></i> AC
                  <?php elseif($row['veh_conditioning']=='No' OR $row['veh_conditioning']=='no'): ?>
                  <i class="fa fa-snowflake text-danger"></i> Non AC
                  <?php endif ?>
                  </h4>
                  
                  <b>Reg Num : <?=$row['veh_number']?> &nbsp;</b><br>
                  <b>Color : <?=$row['veh_color']?> &nbsp;</b><br>
                  <b>Rent (Per day) : <?=$row['veh_rent']?> &nbsp;</b><br>
                </div>
              </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                <h3><p class="animate__animated animate__fadeInUp" >Profile Details</p></h3>
                <form id="myForm" action="" method="">
                  <div id="info"> </div>
                  <div id="loading" style="display:none;" class="card">
                    <div class="card-body">
                      <span> <i class="fas fa-spinner"></i> </span> <strong> Loading </strong>.....Please Wait....
                      <span class="glyphicon glyphicon-time"></span>
                    </div>
                  </div>
                   <?php
                    $user_id=$name=$address=$contact=$email=$addressId='';
                    $user_id=$_SESSION['SESS_UID'];
                    $sql="SELECT * FROM users  WHERE user_id='$user_id' ";
                    $result = mysqli_query($conn, $sql);
                    if($result->num_rows ==1)
                    {
                    $r = mysqli_fetch_array( $result);
                    $name=$r['name'];
                    $address=$r['address'];
                    $contact=$r['contact'];
                    $email=$r['email'];
                    }
                  ?>
                  <div class="row m-2">
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label class="text-dark text-capitalize"  for="name">Name</label>
                        <input type="text" name="name" value="<?=$name?>" class="form-control border-dark" placeholder="Your Full Name" required>
                      </div>
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label class="text-dark"  for="address">Address</label>
                        <input type="text" name="address" value="<?=$address?>" class="form-control border-dark" placeholder="Your Complete Address" required>
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label class="text-dark"  for="contact">Phone No</label>
                        <input name="contact" type="number" value="<?=$contact?>" class="form-control border-dark" placeholder="Your Contact" required>
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label class="text-dark"  for="email">Email</label>
                        <input type="text" name="email" value="<?=$email?>" class="form-control border-dark" placeholder=" Your Email Address" required>
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <input type="hidden" name="profileEditId" value="<?=$user_id?>"/>
                      <input type="submit" id="saveBtn" class="btn btn-success" value="Update" >
                    </div>
                  </div>
                </form>
              </div>
              </div>
            </div>
          </div>

          

          <div class="col-lg-6">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <!-- Vehicle Images -->
                  <div id="vehicle-images" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <?php $firstImage = true; ?>
                      <div class="carousel-item<?= $first ? ' active' : '' ?>">
                        <?php if(mysqli_num_rows($imagesResult) == 0): ?>
                        
                        <div class="carousel-item active">
                          <?php if($row['cat_name']=='Bike' OR $row['cat_name']=='bike'): ?>
                          <a data-fancybox="gallery<?= $row['veh_id'] ?>" href="../assets/img/vehicles/uploaded/bike.png">
                            <img class="d-block w-100" src="../assets/img/vehicles/uploaded/bike.png" style="width:100%; height:400px;" alt="Vehicle Image">
                          </a>
                          <?php else: ?>
                          <a data-fancybox="gallery<?= $row['veh_id'] ?>" href="../assets/img/vehicles/uploaded/vehicle.png">
                            <img class="d-block w-100" src="../assets/img/vehicles/uploaded/vehicle.png" style="width:100%; height:400px;" alt="Vehicle Image">
                          </a>
                          <?php endif ?>
                        </div>
                        
                        <?php else: ?>
                          <?php while ($image_row = mysqli_fetch_array($imagesResult)): ?>
                          <div class="carousel-item<?= $first ? ' active' : '' ?>">
                            <a data-fancybox="gallery<?= $row['veh_id'] ?>" href="../assets/img/vehicles/uploaded/<?= ($image_row['veh_image'] == "" ? ($row['cat_name'] == 'Bike' OR $row['cat_name'] == 'bike' ? 'bike.png' : 'vehicle.png') : $image_row['veh_image']) ?>" style="width:100%; height:400px;">
                              <img class="d-block w-100" src="../assets/img/vehicles/uploaded/<?= ($image_row['veh_image'] == "" ? ($row['cat_name'] == 'Bike' OR $row['cat_name'] == 'bike' ? 'bike.png' : 'vehicle.png') : $image_row['veh_image']) ?>" alt="Vehicle Image" style="width:100%; height:400px;">
                            </a>
                          </div>
                          <?php $first = false; endwhile; ?>
                        <?php endif ?>
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#vehicle-images" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#vehicle-images" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <center><p class="badge-danger bg-danger text-white"> <?=$row['city_name'];?> </p></center>
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <!-- Add your booking form here -->
              <div class="card-body" style="max-width:850px;">
              <div id="info2"> </div>
              <div id="loading2" style="display:none;" class="card">
                <div class="card-body">
                  <span> <i class="fas fa-spinner"></i> </span> <strong> Loading </strong>.....Please Wait....
                  <span class="glyphicon glyphicon-time"></span>
                </div>
              </div>
              <form id="myForm2" method="" action="">
                <div class="mb-3">
                  <label for="booking_start" class="form-label">Booking Start Date</label>
                  <input type="date" class="form-control" id="booking_start"  name="booking_start" required>
                </div>
                <div class="mb-3">
                  <label for="booking_end" class="form-label">Booking End Date</label>
                  <input type="date" class="form-control" id="booking_end" name="booking_end" required>
                </div>

                <div class="mb-3">
                  <label for="pickup_time" class="form-label">Pickup Time</label>
                  <input type="time" class="form-control" id="pickup_time" name="pickup_time" required>
                </div>
                <div class="mb-3">
                  <label for="pickup_location" class="form-label">Pickup Location <br><p class="font-weight-bold text-danger"> (must be in <?=$row['city_name'];?> otherwise your booking will be cancelled )<p> </label>
                  <input type="text" class="form-control" id="pickup_location"  name="pickup_location" required>
                </div>
                <input type="hidden" name="bookingAddId" value="<?=$veh_id?>" />
                <input type="submit" id="saveBtn2" class="btn btn-primary" value="Confirm Booking" >
                
              </form>
            </div>
          </div>
        </div>
      </div>
  </section>
</main>
<!-- Include the footer and other scripts from your main file -->
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>
<script src="../assets/datatables/js/dataTables.bootstrap.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="../assets/vendor/jquery-sticky/jquery.sticky.js"></script>
<script src="../assets/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../assets/fancybox/jquery.fancybox.min.js"></script>
<!-- Template Main JS File -->
<script src="../assets/js/main.js"></script>
<script>
$(document).ready(function () {
// Initialize Bootstrap Carousel
$('.carousel').carousel();
// Initialize Fancybox
$('[data-fancybox]').fancybox({
animationEffect: "fade",
transitionEffect: "slide",
loop: true
});
});
</script>
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
<script>
  $("#loading2").hide();
    $("#myForm2").submit(function()
    {
      $("#info2").html("");
      $("#loading2").show();
      $("#saveBtn2").prop('disabled', true);
      $.ajax({
      url: 'manage-bookings.php',
      type: 'post',
      data: $('#myForm2').serialize(),
      success: function(response)
      {
      $("#loading2").hide();
      $("#info2").html(response);
      $("#saveBtn2").prop('disabled', false);
    }
  });
  return false;
  });
</script>
</body>
</html>