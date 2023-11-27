<?php
  session_start();
  if(!isset($_SESSION["id"])){
    header("location: login.php");
    exit(); 
  } 
  include_once './backend/tablecreation.php';
  
  //get accomodation id
  $id=$_GET["id"];
  $select_accommodation = "SELECT * FROM `accomodationdetails` WHERE `accomodation_id` = $id";
  $get_accommodation = $conn->query($select_accommodation);
  $accommodation = mysqli_fetch_array($get_accommodation);
?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Paul Watts, David Chui Fan Hui, Beven Dwyer, and Bootstrap contributors">
    <title>Accommodation Booking System · ABS</title>  

    <!-- Bootstrap5 core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Datepicker CSS -->
    <link href="css/datepicker.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">
    
    <!-- Bootstrap5 JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- jQuery with Ajax JavaScript -->
    <script src="js/jquery-3.6.0.min.js"></script>
    
    <!-- Datepicker JavaScript -->
    <script src="js/datepicker-full.min.js"></script>

    <!-- Add icon library -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    
  </head>
  <body class="d-flex flex-column h-100">
    
  <header>
  <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">ABS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <?php if(!isset($_SESSION["id"])): ?>
            <li class="nav-item">
              <a class="nav-link" href="registration.php">Registration</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <?php endif ?>

            <?php if(isset($_SESSION["id"])): ?>
            <li class="nav-item">
              <a class="nav-link" href="./backend/logout.php">Logout</a>
            </li>
            <?php endif ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>

<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
    <p></p>
    <div class="row">
      <div class="col">
        <img src="data:image/jpeg;base64,<?php echo base64_encode( $accommodation['houseImage'] ); ?>" style="width: 400px; height: 400px; object-fit:cover;"/>
      </div>
      <div class="col" >
        <h1><?php echo $accommodation['houseName']; ?></h1>
        <p>
          <?php echo $accommodation['rateHouse']; ?><i class="fa fa-star" aria-hidden="true" style="color: orange;"></i>
          (review)
          &emsp;
          <?php echo $accommodation['city']; ?>
        </p>
        <p>
          Price:
          $<?php echo $accommodation['pricePerNight']; ?>/night
        </p>
        <p>
        Bedroom:
          <?php echo $accommodation['numRoom']; ?> 
        </p>
        <p>
        Bathroom:
          <?php echo $accommodation['numBath']; ?> 
        </p>
        <p>
          Max Guest:
          <?php echo $accommodation['numGuestAllowed']; ?>
        </p>
      </div>
    </div>
  </div>         
  <form action="confirmation.php?id=<?php echo $accommodation['accomodation_id']; ?>" method="post">
    <div class="container">
      <h5>Booking dates</h5>
      <div id="bookingDate">
        <p>
          <input type="text" class="form-control start" name="start" placeholder="Check-In" required>
          <span>to</span>
          <input type="text" name="end" class="form-control end" placeholder="Check-Out" required>  
        </p>
      </div>
      <h5>No. of guests</h5>
      <select name="guests" id="guests" id="guests" class="form-control guests" required>
      <option value="" selected disabled hidden>Select No. of guests</option>  
      <?php
        for ($i = 1; $i <= $accommodation['numGuestAllowed']; $i++) {
          echo '<option value='.$i.'>'.$i.'</option>';
        } 
      ?>
      </select>
    </div>
    <div class="container"> 
      <div style="float: right;">
        <a href="index.php" class="btn btn-outline-info">
          <i class="fa fa-arrow-circle-o-left"> Back</i>
        </a>
        <button class="btn btn-outline-success" type="submit" name="submit">
          <i class="fa fa-calendar-plus-o"> Book</i>
        </button>
      </div>
    </div>
  </form>
</main>


<!-- Bootstrap Footer -->
<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span class="text-muted"><p>© 2021 UniTas Pty Ltd</p></span>
  </div>
</footer>

    <!-- Datepicker component for booking dates -->
    <script>
      const elem = document.getElementById('bookingDate');
      const rangepicker = new DateRangePicker(elem, {
        'autohide': true,
        format: 'yyyy-mm-dd',
        "minDate": "<?php echo $accommodation['avaliableStartDate']; ?>",
        "maxDate": "<?php echo $accommodation['avaliableEndDate']; ?>"
      }); 
    </script>
  </body>
</html>
