<?php 
include_once 'conn.php';
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
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
 
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">



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

          <li class="nav-item">
            <a class="nav-link " href="index.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="login.php">Login</a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="register.php">Register</a>
          </li>
          
        </ul>
      </div>

    </div>
  </nav><!-- End Header/Navbar -->

  <main id="main">

   

    <!-- ======= Contact Single ======= -->
    <section class="contact">
      <div class="container mt-5">
        <div class="row mt-5">
          
          <div class="col-sm-12 section-t8">
            <div class="row mt-4">
              <h2 class="text-primary">Login</h2>
                <div>
                  <h4 class="text-dark">( Sign In ) </h4>
                </div>
              <div class="col-md-7">
                <div id="info" > </div>
                  <div id="loading" style="display:none;" class="card" >
                    <div class="card-body">
                      <span> <i class="fas fa-spinner"></i> </span> <strong> Loading </strong>.....Please Wait.... 
                      <span class="glyphicon glyphicon-time"></span>
                    </div>
                  </div>
                <form id="myForm" class="php-email-form" method="" action="">
                  <div class="row">
                    <div class="col-md-6 mb-3 mt-5">
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <input name="email" type="email" class="form-control form-control-lg form-control-a border-dark" placeholder="Enter Email Here" >
                      </div>
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-lg form-control-a  border-dark" placeholder="Enter Password Here" >
                      </div>
                    </div>
                    

                    <div class="col-md-12 text-center">

                      <input type="hidden" name="login" value="1"/>
                      <input type="submit" id="saveBtn" class="btn btn-a mb-5" value="Login" >
                    </div>
                  </div>
                </form>
              </div>
              
                
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Single-->

  </main><!-- End #main -->

  
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright-footer">
            <p class="copyright color-text-a">
              &copy; Copyright
              <span class="color-a">Online Vehicle Rental System</span> All Rights Reserved.
            </p>
          </div>
          <div class="credits">
            Developed by  </br><a href="#">Aashir Aftab - MC190404613</a></br>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



  <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/contact.js"></script>


  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Main jQuery -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/jquery/jquery.js"></script>
    <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
    <script src="assets/datatables/js/jquery.dataTables.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

   <script>
        $(function(){
            $("#myForm").submit(function()
            {
                $('html, body').animate({ scrollTop: 0 }, 'slow');
                $("#info").html("");
                $("#loading").show();
                $("#saveBtn").prop('disabled', true);
                $.ajax({
                           url: 'account-controller.php',
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
        });
   </script>

</body>

</html>