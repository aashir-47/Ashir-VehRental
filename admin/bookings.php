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
          <li class="nav-item"><a class="nav-link " href="vehicles.php">Vehicles</a></li>
          <li class="nav-item"><a class="nav-link active" href="bookings.php">Bookings</a></li>
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
          <div class="row ">
            <div class="col-lg-12">
              <div class="card  border-primary mb-5">
                <div class="col-lg-12 text-center mt-2" id="heading2 ">
                  <h1><p class="animate__animated animate__fadeInUp" > Booking</p></h1>
                  <p class="animate__animated animate__fadeInUp" class="lead">(Manage Booking Info) </p>
                </div>
                <?php $booking_start=0; if(isset($_GET['booking_start'])) $booking_start=$_GET['booking_start']; ?>
                <?php $booking_end=0; if(isset($_GET['booking_end'])) $booking_end=$_GET['booking_end']; ?>
                <?php $booking_status=''; if(isset($_GET['booking_status'])) $booking_status=$_GET['booking_status']; ?>
                <div class="card mx-1 my-1">
                  <form action="" method='get'>
                    <div class="row">
                      <div class="col-12 d-flex">
                        <div class="col-4">
                          <div class="input-group">
                            <input type="date" name="booking_start" id="booking_start" value="<?=$booking_start?>" class="form-control border-dark"  placeholder="Search By start Date" >
                            <div class="input-group-append">
                              <button type="submit" id="searchBtn" class="btn btn-success btn-block" >Search By Start Date</button>
                            </div>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="input-group">
                            <input type="date" name="booking_end" id="booking_end" value="<?=$booking_end?>" class="form-control border-dark"  placeholder="Search By End Date" >
                            <div class="input-group-append">
                              <button type="submit" id="searchBtn" class="btn btn-success btn-block" >Search By End Date</button>
                            </div>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="input-group">
                            <select class="form-control border-dark" name="booking_status" id="booking_status" value="<?=$user_id?>" >
                              <option value="" >----Search By Status----</option>
                              <option value="0" >-Pending-</option>
                              <option value="1" >-Accepted-</option>
                              <option value="2" >-Completed-</option>
                            </select>
                            <div class="input-group-append">
                              <button type="submit" id="searchBtn" class="btn btn-success btn-block" >Search By Status</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-lg-12">
                      <div class="card  border-dark">
                        <div class="card-body">
                          <?php
                          $sql="SELECT * FROM bookings
                          LEFT JOIN users ON users.user_id=bookings.user_id 
                          LEFT JOIN vehicles ON vehicles.veh_id=bookings.veh_id
                           ";
                          if($booking_start>0 and $booking_end>0 and $booking_status>=0)
                            $sql.="  WHERE bookings.booking_start>='$booking_start' AND bookings.booking_end<='$booking_end' AND bookings.booking_status='$booking_status'  ORDER BY booking_status ASC ";

                           elseif($booking_start>0 and $booking_end>0 )
                            $sql.="  WHERE bookings.booking_start>='$booking_start' AND bookings.booking_end<='$booking_end'   ORDER BY booking_status ASC ";
                          
                          elseif($booking_start>0  )
                            $sql.=" WHERE bookings.booking_start='$booking_start' ORDER BY booking_status ASC ";
                          elseif($booking_end>0  )
                            $sql.=" WHERE bookings.booking_end='$booking_end'  ORDER BY booking_status ASC ";   
                          elseif($booking_status>=0  )
                            $sql.=" WHERE bookings.booking_status='$booking_status'  ORDER BY booking_status ASC ";
                          $result = mysqli_query($conn, $sql);
                          ?>
                          <?php if(isset($_SESSION['MSG'])){echo $_SESSION['MSG']; unset($_SESSION['MSG']);} ?>
                          <table class="table table-sm text-start table-responsive text-dark table-hover align-middle table-responsive"  id="myTable">
                            <thead>
                              <tr>
                                <th scope="col" class="col-0">#</th>
                                <th scope="col" class="col-2">Car</th>
                                <th scope="col" class="col-2"> Datails</th>
                                <th scope="col" class="col-3">Customer Datails</th>
                                <th scope="col" class="col-2">Booking Dateial</th>
                                <th scope="col" class="col-1">Status</th>
                                <th scope="col" class="col-2">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $i=0; while ($row = mysqli_fetch_array( $result)): ?>
                              <?php 
                                    $veh_id=$row['veh_id'];
                                    $q="SELECT * FROM images WHERE veh_id='$veh_id'";
                                    $res = mysqli_query($conn, $q);
                                    $r = $res->fetch_assoc();
                                  ?>
                              <tr>
                                <td scope="row"><?=(++$i)?></td>
                                <td>
                                  <img class="img-fluid " src="../assets/img/vehicles/uploaded/<?=($r['veh_image']==""?"vehicle.png":$r['veh_image'] )?>" style="width:100%; height:200px;" alt="" >
                                </td>
                                <td>
                                  <b> <?=$row['veh_make']?> - <?=$row['veh_model']?>  &nbsp; ( <?=$row['veh_year']?> )</b><br>
                                  <b>Reg Num : <?=$row['veh_number']?>  &nbsp;</b><br>
                                  <b>Color : <?=$row['veh_color']?>  &nbsp;</b><br>
                                  <b>Rent (Per day) : <?=$row['veh_rent']?> &nbsp;</b><br>

                                </td>
                                <td>
                                  <b>Customer Name: <?=$row['name']?> &nbsp;</b><br>
                                  <b>Email : <?=$row['email']?> &nbsp;</b><br>
                                  <b>Contact :  <?=$row['contact']?> &nbsp;</b><br>
                                  <b>Address : <?=$row['address']?> &nbsp;</b><br>
                                  
                                </td>
                                <td>
                                  <?php
                                  $veh_rent=$row['veh_rent'] ;
                                  $booking_start=$row['booking_start'] ;
                                  $booking_end=$row['booking_end'] ;                               
                                   // Creating DateTime objects for the start and end dates
                                  $startDate = new DateTime($booking_start);
                                  $endDate = new DateTime($booking_end);

                                  // Calculating the difference between the dates
                                  $interval = $startDate->diff($endDate);

                                  // Retrieving the total number of days
                                  $totalDays = $interval->days + 1; // Adding 1 to include both the start and end dates
                                  $totalBill = $totalDays*$veh_rent; 
                                  ?>

                                  Booking Start:<?=$row['booking_start']?><br>
                                  Booking End:<?=$row['booking_end']?><br>
                                  Total Days : <?=$totalDays?><br>
                                  Total Bill : <?=$totalBill?> Rs.<br>
                                  Pickup Time :<?=$row['pickup_time']?><br>
                                  Pickup Address :<br><?=$row['pickup_location']?><br>
                                </td>
                                <td>
                                  <?php if ($row["booking_status"]==0): ?>
                                  <p class="badge text-white bg-danger mt-2">Pending</p>
                                  <?php elseif ($row["booking_status"]==1): ?>
                                  <p class="badge text-dark bg-warning mt-2">Accepted</p>
                                  <?php elseif ($row["booking_status"]==2): ?>
                                  <p class="badge text-white bg-success mt-2">Completed</p>
                                  <?php endif ?>
                                </td>
                                <td>
                                   <?php if ($row["booking_status"]==0): ?>
                                  <a href="manage-bookings.php?bookingDelId=<?=$row['booking_id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this booking ?');"><i class="fa fa-trash fa-fw"></i></a>
                                  <a href="manage-bookings.php?bookingAcceptId=<?=$row['booking_id']?>" class="btn btn-sm btn-success align-items-center" onclick="return confirm('Are you sure you want to change booking status to APPROVED ?');"><i class="fa fa-check fa-fw"></i> Accept</a>
                                  <?php elseif ($row["booking_status"]==1): ?>
                                  
                                  <?php elseif ($row["booking_status"]==2): ?>
                                  
                                  <?php 
                                    $booking_id=$row['booking_id'];
                                    $q="SELECT * FROM ratings WHERE booking_id='$booking_id'";
                                    $res = mysqli_query($conn, $q);
                                    $r = $res->fetch_assoc();
                                  ?>
                                    <?php if ($r["veh_rating"]==1): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php elseif ($r["veh_rating"]==2): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php elseif ($r["veh_rating"]==3): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php elseif ($r["veh_rating"]==4): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php elseif ($r["veh_rating"]==5): ?>
                                    <i class="fa fa-star text-warning star-light mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php endif; ?><br>
                                    <b>( <?=$r['feedback']?> )</b><br>
                                  <?php endif ?>
                                </td>
                                
                              </tr>
                              <?php  endwhile; ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
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