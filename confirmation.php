<?php
  session_start();
  include_once './backend/tablecreation.php';
  if (isset($_POST['submit'])) { 
    
    $id=$_GET["id"];

    $start_date = $_POST['start']; 

    $end_date = $_POST['end']; 

    $num_guest = $_POST['guests']; 

    $datetime1 = date_create($start_date);
    $datetime2 = date_create($end_date);
    $interval = $datetime1->diff($datetime2);
    $night = $interval->format('%a');
    $int_night = intval($night);
    $select_accommodation = "SELECT * FROM `accomodationdetails` WHERE `accomodation_id` = $id";
    $get_accommodation = $conn->query($select_accommodation);
    $accommodation = mysqli_fetch_array($get_accommodation);
    $pricePerNight = intval($accommodation['pricePerNight']);
    $total_price = $int_night*$pricePerNight;

    //SELECT accountdetails.account_id, hostdetails.host_id, accomodationdetails.accomodation_id FROM accountdetails INNER JOIN hostdetails ON hostdetails.userId = accountdetails.account_id INNER JOIN accomodationdetails ON accomodationdetails.hostID = hostdetails.host_id where accountdetails.account_id = 2
  }
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

    <style>
      table {
        width: 80%;
        border-collapse: collapse;
        border: 1px solid black;
      }
      th, td {
        padding: 5px;
        text-align: left;
      }
    </style>
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
        <div class="row">
          <div class="col-4">
            <h5>Your Reservation</h5>
            <table>
              <tr>
                <th>Check In:</th>
                <td><?php echo $start_date; ?></td>
              </tr>
              <tr>
                <th>Check Out:</th>
                <td><?php echo $end_date; ?></td>
              </tr>
              <tr>
                <th>Guest(s):</th>
                <td><?php echo $num_guest; ?></td>
              </tr>
              <tr>
                <th>Night Stay(s):</th>
                <td><?php echo $night;?></td>
              </tr>
              <tr>
                <th>Total Price:</th>
                <td>$<?php echo $total_price; ?></td>
              </tr>
            </table>
          </div>
          <div class="col-6">
            <h5>Guest details</h5>
            <hr>
            <form class="row g-3" action="./backend/guest.php" method="post">
              <span style="display: none;">
                <input type="text" name="aid" value=<?php echo $id; ?>>
              </span>
              <span style="display: none;">
                <input type="text" name="num_guest" value=<?php echo $num_guest; ?>>
              </span>
              <span style="display: none;">
                <input type="text" name="start_date" value=<?php echo $start_date; ?>>
              </span>
              <span style="display: none;">
                <input type="text" name="end_date" value=<?php echo $end_date; ?>>
              </span>
              <span style="display: none;">
                <input type="text" name="total_price" value=<?php echo $total_price; ?>>
              </span>
              <?php
                for ($x = 0; $x < $num_guest; $x++) {
              ?>
                <b>Guest <?php echo $x+1; ?></b>
                <div class="col-md-6">
                  <label class="form-label">First name</label>
                  <input type="text" class="form-control" name="fname<?php echo $x; ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Last name</label>
                  <input type="text" class="form-control" name="lname<?php echo $x; ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email Address</label>
                  <input type="email" class="form-control" name="email<?php echo $x; ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Mobile</label>
                  <input type="text" class="form-control" name="mobile<?php echo $x; ?>" required>
                </div>
                <hr>
              <?php
                }
              ?>
              <div class="col-12">
                <a href="index.php" class="btn btn-outline-secondary"> Cancel </a>
                <button type="submit" name="submit" class="btn btn-outline-danger" style="float: right;">Confirm</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>


    <!-- Bootstrap Footer -->
    <footer class="footer mt-auto py-3 bg-light">
      <div class="container">
        <span class="text-muted"><p>© 2021 UniTas Pty Ltd</p></span>
      </div>
    </footer>

  </body>
</html>