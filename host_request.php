<?php
session_start();
include_once './backend/tablecreation.php';

$uid = $_SESSION["id"];

//get accommodation details
$select_request = "SELECT accountdetails.account_id, bookingdetails.*, accomodationdetails.houseImage, accomodationdetails.houseName FROM bookingdetails 
INNER JOIN accomodationdetails ON accomodationdetails.accomodation_id = bookingdetails.accommodationId 
INNER JOIN hostdetails ON hostdetails.host_id = accomodationdetails.hostID 
INNER JOIN accountdetails ON accountdetails.account_id = hostdetails.userId
where accountdetails.account_id = $uid";
$get_request = $conn->query($select_request);

//SELECT accountdetails.account_id, bookingdetails.* FROM bookingdetails INNER JOIN accomodationdetails ON accomodationdetails.accomodation_id = bookingdetails.accommodationId INNER JOIN hostdetails ON hostdetails.host_id = accomodationdetails.hostID INNER JOIN accountdetails ON accountdetails.account_id = hostdetails.userId

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
  <link href="css/host.css" rel="stylesheet">

  <!-- Bootstrap5 JavaScript -->
  <script src="js/bootstrap.bundle.min.js"></script>

  <!-- jQuery with Ajax JavaScript -->
  <script src="js/jquery-3.6.0.min.js"></script>

  <!-- Datepicker JavaScript -->
  <script src="js/datepicker-full.min.js"></script>

  <!-- Bootstrap bi bi style sheet-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
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
        <div class="d-flex justify-content-between collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <?php if (!isset($_SESSION["id"])) : ?>
              <li class="nav-item">
                <a class="nav-link" href="registration.php">Registration</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
            <?php endif ?>

            <?php if (isset($_SESSION["id"])) : ?>
              <li class="nav-item">
                <a class="nav-link" href="./backend/logout.php">Logout</a>
              </li>
            <?php endif ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Begin banner -->
  <section class="main-banner position-relative p-3 p-md-0 text-center bg-light text-white">
    <div class="p-lg-5 mx-auto my-5">
      <h1 class="display-4 fw-normal">Host Dashboard</h1>
      <button class="btn btn-outline-light btn-lg" onclick="location.href='host_house.php'" type="button">
        House
      </button>
      <button class="btn btn-outline-light btn-lg" onclick="location.href='host_request.php'" type="button">
        Request
      </button>
      <button class="btn btn-outline-light btn-lg" onclick="location.href='host_review.php'" type="button">
        Review
      </button>
      <button class="btn btn-outline-light btn-lg" onclick="location.href='host_inbox.php'" type="button">
        Inbox
      </button>
    </div>
  </section>

  <!-- Begin page content -->
  <main class="flex-shrink-0">
    <div class="container">
      <h1>Request</h1>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        while ($request = mysqli_fetch_array($get_request)) {
        ?>

          <div class="col">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-text">
                  <p style="font-weight: bold;">
                    Check-in date:
                    <span style="float:right;font-weight: normal;">
                      <?php echo $request['checkIndate']; ?>
                    </span>
                    <br>
                    Check-out date:
                    <span style="float:right;font-weight: normal;">
                      <?php echo $request['checkOutdate']; ?>
                    </span>
                    <br>
                    Number of Guest:
                    <span style="float:right;font-weight: normal;">
                      <?php echo $request['numGuest']; ?>
                    </span>
                    <br>
                    Total Price:
                    <span style="float:right;font-weight: normal;">
                      <?php echo $request['amount']; ?>
                    </span>
                    <br>
                  <p>
                </div>
                <div style="float:right;">
                  <a href="view_accommodation.php?id=<?php echo $request['hostConfirmation']; ?>" class="btn btn-outline-danger">
                    <i class="fa fa-eye"> Reject</i>
                  </a>
                  <a href="booking.php?id=<?php echo $request['hostConfirmation']; ?>" class="btn btn-outline-success">
                    <i class="fa fa-calendar-plus-o"> Accept</i>
                  </a>
                </div>
              </div>
            </div>
          </div>

        <?php
        }
        ?>
      </div>
    </div>
  </main>

  <!-- Being Footer Here-->
  <footer class="footer mt-auto py-3 bg-light">
    <div class="container">
      <span class="text-muted">
        <p>© 2021 UniTas Pty Ltd</p>
      </span>
    </div>
  </footer>

  <!-- JS to Delete Table Rows-->
  <script>

  </script>

</body>

</html>