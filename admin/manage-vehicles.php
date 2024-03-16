<?php
session_start(); // Start the session (if not already started)
include_once '../conn.php'; // Include your database connection file

// Add new vehicle
if (isset($_POST['vehicleAddId'])) {
    $cat_id = $_POST['cat_id'];
    $city_id = $_POST['city_id'];
    $veh_make = $_POST['veh_make'];
    $veh_model = $_POST['veh_model'];
    $veh_year = $_POST['veh_year'];
    $veh_number = $_POST['veh_number'];
    $veh_color = $_POST['veh_color'];
    $veh_rent = $_POST['veh_rent'];
    $veh_seats = $_POST['veh_seats'];
    $veh_gear = $_POST['veh_gear'];
    $veh_conditioning = $_POST['veh_conditioning'];

    if ($city_id  == 0 OR $cat_id  == 0 OR $veh_make  == 0 OR $veh_gear  == 0 OR $veh_conditioning  == 0 )
    {
        echo "<div class='alert alert-warning'><strong>Errors</strong> Fill the form correctly please.</div>";
        exit();
    }

    // Insert new vehicle into the database
    $sql = "INSERT INTO vehicles (cat_id,city_id,veh_make, veh_model, veh_year, veh_number, veh_color,veh_rent,veh_seats,veh_gear,veh_conditioning) 
            VALUES ('$cat_id','$city_id','$veh_make', '$veh_model', '$veh_year', '$veh_number', '$veh_color', '$veh_rent', '$veh_seats', '$veh_gear', '$veh_conditioning')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'> <strong>Success!</strong> Vehicle added successfully...Redirecting...</div>";
        echo "<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";
        exit();
    } else {
        echo "<div class='alert alert-danger'> <strong>Error!</strong> Error in adding the vehicle record.</div>";
        echo "Error description: " . mysqli_error($conn);
    }
}

// Edit vehicle
if (isset($_POST['vehicleEditId'])) {
    $veh_id = $_POST['vehicleEditId'];
    $cat_id = $_POST['cat_id'];
    $city_id = $_POST['city_id'];
    $veh_make = $_POST['veh_make'];
    $veh_model = $_POST['veh_model'];
    $veh_year = $_POST['veh_year'];
    $veh_number = $_POST['veh_number'];
    $veh_color = $_POST['veh_color'];
    $veh_rent = $_POST['veh_rent'];
    $veh_seats = $_POST['veh_seats'];
    $veh_gear = $_POST['veh_gear'];
    $veh_conditioning = $_POST['veh_conditioning'];

    if ($city_id  == 0 OR $cat_id  == 0 OR $veh_make  == 0 OR $veh_gear  == 0 OR $veh_conditioning  == 0 )
    {
        echo "<div class='alert alert-warning'><strong>Errors</strong> Fill the form correctly please.</div>";
        exit();
    }
    // Update the vehicle in the database
    $sql = "UPDATE vehicles 
            SET  cat_id='$cat_id', city_id='$city_id',veh_make='$veh_make', veh_model='$veh_model', veh_year='$veh_year', veh_number='$veh_number', veh_color='$veh_color', veh_rent='$veh_rent' , veh_seats='$veh_seats'  , veh_gear='$veh_gear'  , veh_conditioning='$veh_conditioning' 
            WHERE veh_id='$veh_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'> <strong>Success!</strong> Vehicle updated successfully...Redirecting...</div>";
        echo "<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";
        exit();
    } else {
        echo "<div class='alert alert-danger'> <strong>Error!</strong> Error in updating the vehicle record.</div>";
        echo "Error description: " . mysqli_error($conn);
    }
}

// Delete vehicle
if (isset($_GET['vehicleDelId'])) {
    $vehicle_id = $_GET['vehicleDelId'];

    // Delete the vehicle from the database
    $sql = "DELETE FROM vehicles WHERE veh_id='$vehicle_id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['MSG'] = "<div class='alert alert-success'> <strong>Success!</strong> Vehicle record deleted successfully... Redirecting...</div>";
        header('location:' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $_SESSION['MSG'] = "<div class='alert alert-danger'> <strong>Error!</strong> Error in deleting the vehicle record.</div>";
        header('location:' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

// upload pet photo

  if (isset($_POST['vehPhotoId'])) 
  {
    $veh_id=$_POST['vehPhotoId'];
    $files = $_FILES['file'];

    $filename = $files['name'];
    $filetmp = $files['tmp_name'];
    $fileerror = $files['error'];

    $fileext = explode('.', $filename);
    $filecheck = strtolower(end($fileext));
    $fileextstored = array('png'  , 'jpg' , 'jpeg', 'webp');

    if(in_array($filecheck , $fileextstored))
    {
      $newName=time().".".$filecheck;
      $destinationfile = '../assets/img/vehicles/uploaded/'.$newName  ;
      move_uploaded_file($filetmp, $destinationfile);
      $conn->query("INSERT INTO images (veh_id,veh_image) VALUES ('$veh_id','$newName')");
      $_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong> Vehicle Photo Uploaded successfuly... Redirecting..</div><script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";
      header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    else
    {
      $_SESSION['MSG']= "<div class='alert alert-danger'> <strong>Error ! </strong> Error in UPLOADING pet photo</div>";
      header('Location: '.$_SERVER['HTTP_REFERER']);
    }
  }
?>
