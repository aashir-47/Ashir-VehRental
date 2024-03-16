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
          <li class="nav-item"><a class="nav-link active" href="profile.php">Profile</a></li>
          <li class="nav-item"><a class="nav-link " href="vehicles.php">Vehicles</a></li>
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
                    <h1><p class="animate__animated animate__fadeInUp" >My Profile</p></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                   <div class="m-3">
                
                    </div>
                    <?php if(isset($_SESSION['MSG'])){echo $_SESSION['MSG']; unset($_SESSION['MSG']);} ?>
                    <form id="form" action="" method="">
                      <table class="table table-striped table-bordere text-lg-center align-text-bottom" id="myTable">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th colspan="col">Address</th>
                            <th colspan="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $user_id=$_SESSION['SESS_UID'];
                            $sql="SELECT * FROM users WHERE user_id='$user_id' ";
                              $results = mysqli_query($conn, $sql);
                            ?>
                            <?php $i=0; while ($row = mysqli_fetch_assoc( $results)): ?>
                          <tr> 
                            <td scope="row"><?=(++$i)?></td>
                            <td><?=$row['name']?></td>
                            <td><?=$row['email']?></td>
                            <td><?=$row['contact']?></td>
                            <td><?=$row['address']?></td>
                            <td>
                                <a data-fancybox data-type="ajax" data-src="edit-user.php?userEditId=<?=$row['user_id']?>" href="javascript:void();" class="btn btn-sm btn-primary fancybox.ajax"><i class="fa fa-edit fa-fw"></i></a>
                            </td>
                          </tr>
                          <?php  endwhile; ?>
                        </tbody> 
                      </table>
                    </form>
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

</body>

</html>