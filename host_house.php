<?php
session_start();
include_once './backend/tablecreation.php';

$uid = $_SESSION["id"];

//get accommodation details
$select_accommodation = "SELECT accountdetails.account_id, accomodationdetails.* FROM accountdetails 
  INNER JOIN hostdetails ON hostdetails.userId = accountdetails.account_id 
  INNER JOIN accomodationdetails ON accomodationdetails.hostID = hostdetails.host_id 
  where accountdetails.account_id = $uid";
$get_accommodation = $conn->query($select_accommodation);

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
      <div>
        <btn class="btn btn-outline-light btn-lg" id="registerAction" data-bs-toggle="modal" data-bs-target="#propertyModal">Register Property
        </btn>
      </div>
    </div>


  </section>

  <!-- Begin page content -->
  <main class="flex-shrink-0">
    <div class="container">
      <h1>Your accommodation</h1>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        while ($accommodation = mysqli_fetch_array($get_accommodation)) {
        ?>

          <div class="col">
            <div class="card h-100">
              <div class="ratio ratio-4x3">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($accommodation['houseImage']); ?>" class="card-img-top" />
              </div>
              <div class="card-body">
                <div class="card-text">
                  <p style="font-weight: bold;">
                    Rate:
                    <span style="float:right;font-weight: normal;">
                      <?php echo $accommodation['rateHouse']; ?>
                    </span>
                    <br>
                    Location:
                    <span style="float:right;font-weight: normal;">
                      <?php echo $accommodation['city']; ?>
                    </span>
                    <br>
                    From:
                    <span style="float:right;font-weight: normal;">
                      <?php echo $accommodation['avaliableStartDate']; ?>
                    </span>
                    <br>
                    To:
                    <span style="float:right;font-weight: normal;">
                      <?php echo $accommodation['avaliableEndDate']; ?>
                    </span>
                    <br>
                    Max guest:
                    <span style="float:right;font-weight: normal;">
                      <?php echo $accommodation['numGuestAllowed']; ?>
                    </span>
                  <p>
                </div>
                <div style="float:right;">
                  <a href="view_accommodation.php?id=<?php echo $accommodation['accomodation_id']; ?>" class="btn btn-outline-primary">
                    <i class="fa fa-eye"> View</i>
                  </a>
                  <?php if (isset($_SESSION["id"])) : ?>
                    <a href="booking.php?id=<?php echo $accommodation['accomodation_id']; ?>" class="btn btn-outline-success">
                      <i class="fa fa-calendar-plus-o"> Book</i>
                    </a>
                  <?php endif ?>
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

  <!-- Bootstrap modal dialog box for registration -->
  <div class="modal" id="propertyModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Register A New Property</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class=form-inline id="prop_Reg_Form" action="./backend/insert_property.php" method="POST" enctype="multipart/form-data">

            <!-- Begin Property Registration Modal Form Contents -->
            <div class="row g-3">
              <div class="col-md-12">
                <label for="prop_address">Property Address</label>
                <input type="name" class="form-control" id="pAdress" name="prop_address" placeholder="Property Street Address" required>
                <div class="invalid-feedback"> Address is required</div>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="prop_type" class="form-label">Property Type</label>
                <select name="prop_type" class="form-control" id="prop_type" name="prop_type" required>
                  <option value="" disable selected>Select Type</option>
                  <option value="House">House</option>
                  <option value="Apartment">Apartment</option>
                  <option value="Room">Room</option>
                  <option value="Villa">Villa</option>
                  <option value="Masion">Masion</option>
                  <option value="Duplex">Duplex</option>
                  <option value="Castle">Castle</option>
                  <option value="Shack">Shack</option>
                  <option value="Cave">Cave</option>
                </select>
                <div class="invalid-feedback">Property type is required</div>
              </div>
              <div class="col-sm-6">
                <label for="num_rooms" class="form-label">Number Of Rooms</label>
                <input type="Number" class="form-control" id="num_rooms" name="num_rooms" placeholder="Number Of Rooms" min="0" required>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="num_brooms" class="form-label">Number of Bathrooms</label>
                <input type="number" class="form-control" id="num_brooms" name="num_brooms" placeholder="Number Of Bathrooms" min="0" required>
              </div>
              <div class="col-sm-6">
                <label for="pp_night" class="form-label">Price Per Night</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="pp_night" name="pp_night" required>
                  <span class="input-group-text">$</span>
                  <span class="input-group-text">0.00</span>
                </div>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="smoking" class="form-label">Smoking Allowed</label>
                <select name="smoking" class="form-control" id="smoking" required>
                  <option value="" disable selected>Select Smoking Allowence</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="pet_fren" class="form-label">Pets Allowed</label>
                <select name="pet_fren" class="form-control" id="pet_fren" required>
                  <option value="" disable selected>Select Pets Allowance</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="internet" class="form-label">Internet Access</label>
                <select name="internet" class="form-control" id="internet" required>
                  <option value="" disable selected>Select Internet Access</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="city" class="form-label">City</label>
                <select name="city" class="form-control" id="city" name="city" required>
                  <option value="" disable selected>Select City</option>
                  <option value="Brisbane">Brisbane</option>
                  <option value="Hobart">Hobart</option>
                  <option value="Melboure">Melboure</option>
                  <option value="Sydney">Sydney</option>
                  <option value="Darwin">Darwin</option>
                  <option value="Perth">Perth</option>
                  <option value="Adelaide">Adelaide</option>
                  <option value="Canberra">Canberra</option>
                  <option value="Cairns">Cairns</option>
                </select>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="num_garage" class="form-label">Garage Spaces</label>
                <input type="number" class="form-control" id="num_garage" name="num_garage" placeholder="Number Of Car Spaces" min="0" required>
              </div>
              <div class="col-sm-6">
                <label for="num_guests" class="form-label">Number Of Guests</label>
                <input type="number" class="form-control" id="num_guests" name="num_guests" placeholder="Number Of Guests" min="0" required>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="entire_house" class="form-label">Entire House</label>
                <select name="entire_house" class="form-control" id="entire_house" required>
                  <option value="" disable selected>Select</option>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="prop_name" class="form-label">Property Name</label>
                <input type="text" class="form-control" id="prop_name" name="prop_name" placeholder="Property Name (optional)">
              </div>
            </div>
            <div id="bookingDate" class="row g-3">
              <div class="col-sm-6">
                <label for="start_date" class="form-label">Avaliability Start Date</label>
                <input type="date" class="form-control start" name="start_date" placeholder="Check-In" required>
              </div>
              <div class="col-sm-6">
                <label for="end_date" class="form-label">Avaliability End Date</label>
                <input type="date" class="form-control end" name="end_date" placeholder="Check-Out" required>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-md-12">
                <label for="prop_image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="prop_image" name="prop_image">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" id="submit" name="submit" class="btn btn-primary bnt-lg">Submit</button>
              <button type="reset" class="btn btn-secondary bnt-lg"> Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Being Footer Here-->
  <footer class="footer mt-auto py-3 bg-light">
    <div class="container">
      <span class="text-muted">
        <p>© 2021 UniTas Pty Ltd</p>
      </span>
    </div>
  </footer>
</body>

</html>