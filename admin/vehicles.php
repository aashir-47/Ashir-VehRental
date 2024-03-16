<?php
include_once '../conn.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
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
  </head>
  <body>
    <!-- ======= Header/Navbar ======= -->
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
          <li class="nav-item"><a class="nav-link " href="users.php">Users</a></li>
          <li class="nav-item"><a class="nav-link " href="categories.php">Categories</a></li>
          <li class="nav-item"><a class="nav-link active" href="vehicles.php">Vehicles</a></li>
          <li class="nav-item"><a class="nav-link " href="bookings.php">Bookings</a></li>
          <li class="nav-item"><a class="nav-link " href="logout.php">Logout</a></li>

        </ul>
      </div>

    </div>
  </nav>
    <!-- End Header/Navbar -->
    <!-- ======= Intro Section ======= -->
    <main id="main">
      
      <!-- ======= Latest Properties Section ======= -->
      <section class="section-property section-t8">
        <div class="container mb-5">
          <div class="row">
            <div class="row mt-3"></div>
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <div class="col-lg-12 text-center mt-3" id="heading2 ">
                      <h1><p class="animate__animated animate__fadeInUp" >Vehicles</p></h1>
                    </div>
                    <div class="col-lg-12 text-center mt-2">
                      <a data-fancybox data-type="ajax" data-src="add-vehicle.php" class="btn btn btn-success align-items-center" href="javascript:;"><i class="fas fa-feather-alt"></i> Add New Vehicel</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
            $sql = "SELECT * FROM vehicles
            LEFT JOIN categories ON vehicles.cat_id=categories.cat_id 
            LEFT JOIN cities ON vehicles.city_id=cities.city_id";
            $result = mysqli_query($conn, $sql);
            ?>
            <?php if(isset($_SESSION['MSG'])){echo $_SESSION['MSG']; unset($_SESSION['MSG']);} 
            ?>
            <div class="card-body">
              <div class="col-lg-12">
                <div class="row">
                    <?php $i = 0; while ($row = mysqli_fetch_array($result)): ?>
                      <div class="col-lg-3 mb-1">
                        <div class="card" style="width: 18rem;">
                          <div id="carousel<?= $row['veh_id'] ?>" class="carousel slide" data-ride="carousel" data-interval="1000">
                          <div class="carousel-inner" data-interval="1000">
                            <?php
                            // Fetch all images for the current vehicle
                            $images_query = "SELECT * FROM images WHERE veh_id = {$row['veh_id']}";
                            $images_result = mysqli_query($conn, $images_query);
                            $first = true;
                            ?>
                            <?php if (mysqli_num_rows($images_result) == 0): ?>
                            
                              <div class="carousel-item active">
                                <?php if($row['cat_name']=='Bike' OR $row['cat_name']=='bike'): ?>
                                <a data-fancybox="gallery<?= $row['veh_id'] ?>" href="../assets/img/vehicles/uploaded/bike.png">
                                  <img class="d-block w-100" src="../assets/img/vehicles/uploaded/bike.png" style="width:100%; height:200px;" alt="Vehicle Image">
                                </a>
                                <?php else: ?>
                                <a data-fancybox="gallery<?= $row['veh_id'] ?>" href="../assets/img/vehicles/uploaded/vehicle.png">
                                  <img class="d-block w-100" src="../assets/img/vehicles/uploaded/vehicle.png" style="width:100%; height:200px;" alt="Vehicle Image">
                                </a>
                                <?php endif ?>
                              </div>
                              
                              <?php else: ?>
                              <?php while ($image_row = mysqli_fetch_array($images_result)): ?>
                                <div class="carousel-item<?= $first ? ' active' : '' ?>">
                                  <a data-fancybox="gallery<?= $row['veh_id'] ?>" href="../assets/img/vehicles/uploaded/<?= ($image_row['veh_image'] == "" ? ($row['cat_name'] == 'Bike' OR $row['cat_name'] == 'bike' ? 'bike.png' : 'vehicle.png') : $image_row['veh_image']) ?>" style="width:100%; height:200px;">
                                    <img class="d-block w-100" src="../assets/img/vehicles/uploaded/<?= ($image_row['veh_image'] == "" ? ($row['cat_name'] == 'Bike' OR $row['cat_name'] == 'bike' ? 'bike.png' : 'vehicle.png') : $image_row['veh_image']) ?>" alt="Vehicle Image" style="width:100%; height:200px;">
                                  </a>
                                </div>
                              <?php $first = false; endwhile; ?>
                              <?php endif ?>
                          </div>

                          <a class="carousel-control-prev" href="#carousel<?= $row['veh_id'] ?>" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carousel<?= $row['veh_id'] ?>" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                        <center><p class="badge-danger bg-danger text-white"> <?=$row['city_name'];?> </p></center>
                          <div class="card-body">
                            <div class="border-dark p-2">
                            <p>
                              <?php if($row['veh_gear']=='manual' OR $row['veh_gear']=='Manual'): ?>
                                 <i class="bi bi-gear text-success"></i> Manual
                              <?php elseif($row['veh_gear']=='auto' OR $row['veh_gear']=='Auto'): ?>
                                 <i class="bi bi-gear text-danger"></i> Auto
                              <?php endif ?>&nbsp;&nbsp; 

                              <i class="fa fa-user text-dark"></i> <?= $row['veh_seats'] ?>&nbsp;&nbsp; 

                              <?php if($row['veh_conditioning']=='Yes' OR $row['veh_conditioning']=='yes'): ?>
                                 <i class="fa fa-snowflake text-success"></i> AC
                              <?php elseif($row['veh_conditioning']=='No' OR $row['veh_conditioning']=='no'): ?>
                                <i class="fa fa-snowflake text-danger"></i> Non AC
                              <?php endif ?>
                              <h5 class="card-title"><?=$row['veh_make']?> - <?=$row['veh_model']?>  </h5>
                               ( <?=$row['veh_year']?> ) <br>
                              <p class="card-text text-dark">
                              <b>Reg Num : <?=$row['veh_number']?> &nbsp;</b><br>
                              <b>Color : <?=$row['veh_color']?> &nbsp;</b><br>
                              <b>Rent (Per day) : <?=$row['veh_rent']?> &nbsp;</b><br>
                            </p>
                            <div class="mt-2">
                              <a data-fancybox data-type="ajax" data-src="add-vehicle.php?vehEditId=<?=$row['veh_id']?>" class="btn btn-sm btn-secondary"><i class="fa fa-edit fa-fw"></i></a>
                              <a href="manage-vehicles.php?vehicleDelId=<?=$row['veh_id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Vehicle?');"><i class="fa fa-trash fa-fw"></i></a>
                              <a data-fancybox data-type="ajax" data-src="vehicle-photo-upload.php?vehPhotoId=<?=$row['veh_id']?>" href="javascript:void();" class="btn btn-sm btn-success"><i class="fa fa-upload fa-fw"></i></a>
                           </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endwhile; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<!-- Vendor JS Files -->
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

</body>
</html>