<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="Paul Watts, David Chui Fan Hui, Beven Dwyer, and Bootstrap contributors" />
  <title>Accommodation Booking System · ABS</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />

  <!-- Datepicker CSS -->
  <link href="css/datepicker.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/main.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/registration.css" rel="stylesheet" />

  <!-- Bootstrap5 JavaScript -->
  <script src="js/bootstrap.bundle.min.js"></script>

  <!-- jQuery with Ajax JavaScript -->
  <script src="js/jquery-3.6.0.min.js"></script>

  <!-- Datepicker JavaScript -->
  <script src="js/datepicker-full.min.js"></script>

  <!-- Custom JS for registration page -->
  <script src="js/registration.js"></script>


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
  <section class="main-banner position-relative p-3 p-md-5 text-center bg-light text-white">
    <div class="p-lg-5 mx-auto my-5">
      <h1 class="display-4 fw-normal">Accommodation Booking System</h1>
      <p class="lead fw-normal">Your home away from home</p>
    </div>
  </section>

  <!-- Begin page content -->
  <main class="flex-shrink-0">
    <div class="container">
      <h1 class="mt-5" id="regHead">Host & Client Registration Page</h1>
      <form class=form-inline id="regiForm" action="./backend/insert_user.php" method="POST" enctype="multipart/form-data">
        <hr class="my-4">
        </hr>

        <!-- Begin Form Contents -->
        <div class="form-row">
          <div class="row g-3">
            <div class="col-span">
              <label for="Registration">Client or Host</label>
              <select class="form-control" name="UserTypeSelect" id="UserTypeSelect" onchange="changeStatus()" required>
                <option value="" disable selected>Select User Type</option>
                <option value="Host">Host</option>
                <option value="Client">Client</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row g-3">          
          <div class="col-sm-6">
            <label for="Lname" class="form-label">Picture</label>
            <input type="file" class="form-control" name="image">
          </div>
          <div class="col-sm-6">
            <label for="FName" class="form-label">Username</label>
            <input class="form-control" type="text" name="username" placeholder="User name" required>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-sm-6">
            <label for="FName" class="form-label">First Name</label>
            <input type="name" class="form-control" id="Fname" name="first_name" placeholder="First Name" required>
          </div>
          <div class="col-sm-6">
            <label for="Lname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="Lname" name="last_name" placeholder="Last Name" required>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-sm-6">
            <label for="Email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="Email" name="email" placeholder="johnsmith@email.com" required>
            <small class="text-muted">A valid email address is required</small>
          </div>
          <div class="col-sm-6">
            <label for="Phone" class="form-label">Phone Number</label>
            <input type="number-hidden" class="form-control" id="Phone" name="mobile" placeholder="Phone Number">
          </div>
        </div>
        <div class="row g-3">
          <div class="col-sm-6">
            <label for="Pword" class="form-label">Password</label>
            <input type="password" class="form-control" id="pWord" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$]).{6,12}" placeholder="Password" required>
            <small class="text-muted">Password must consist of 6 to 12 characters, at least 1 lower case letter, 1
              uppercase letter, 1
              number and one of following special characters ! @ # $ % </small>
          </div>
          <div class="col-sm-6">
            <label for="PwordConfirm" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="pWordConfirm" name="password_confirm" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$]).{6,12}" placeholder="Confirm Password" required>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-sm-6">
            <label for="Address" class="form-label">Address</label>
            <input type="text" class="form-control" id="Street" name="address" placeholder="Street Address" required>
          </div>
          <div class="col-sm-4">
            <label for="ABN" class="form-label" id="ABN-label">ABN</label>
            <input type="text" class="form-control" id="ABN" name=ABN_Number placeholder="ABN Number" required>
          </div>
        </div>
        <hr class="my-4">
        </hr>
        <!-- Submit and Cancle buttons-->
        <div class="row g-100">
          <div class="col-span">
            <button type="reset" id="cancel" class="btn btn-secondary bnt-lg"> Cancel</button>
            <button type="submit" id="submit" name="submit" class="btn btn-primary bnt-lg">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </main>
  <!-- Bootstrap modal dialog box for login -->
  <div class="modal" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="./backend/login_validation.php" method="post">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
              <label for="psw" class="form-label">Password</label>
              <input type="password" class="form-control" name="psw" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <a href="registration.php" type="button" class="btn btn-outline-secondary">Register</a>
          <button type="submit" class="btn btn-outline-primary" data-bs-dismiss="modal" name="login">login</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer begins -->
  <footer class="footer mt-auto py-3 bg-light">
    <div class="container">
      <span class="text-muted">
        <p>© 2021 UniTas Pty Ltd</p>
      </span>
    </div>
  </footer>
</body>

</html>