<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta
      name="author"
      content="Paul Watts, David Chui Fan Hui, Beven Dwyer, and Bootstrap contributors"
    />
    <title>Accommodation Booking System · ABS</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/manager.css">

    <!-- Add icon library -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

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
    <section
      class="main-banner position-relative p-3 p-md-0 text-center bg-light text-white"
    >
      <div class="p-lg-5 mx-auto my-5">
        <h1 class="display-4 fw-normal">System Manager Dashboard</h1>
        <button
          class="btn btn-outline-light btn-lg"
          onclick="location.href='manager_user.php'"
          type="button"
        >
          User
        </button>
        <button
          class="btn btn-outline-light btn-lg"
          onclick="location.href='manager_accomodation.php'"
          type="button"
        >
          House
        </button>
        <button
          class="btn btn-outline-light btn-lg"
          onclick="location.href='manager_review.php'"
          type="button"
        >
          Review
        </button>
        <button
          class="btn btn-outline-light btn-lg"
          onclick="location.href='manager_booking.php'"
          type="button"
        >
          Booking
        </button>
        <button
          class="btn btn-outline-light btn-lg"
          onclick="location.href='manager_inbox.php'"
          type="button"
        >
          Inbox
        </button>
      </div>
    </section>

    <!-- Begin page content -->
    <main class="flex-shrink-0">
      <div class="container">
        <div class="table-responsive">
          <table id="table">
            <thead>
              <tr>
                <th class="houseCol">House</th>
                <th class="clientCol">Client</th>
                <th class="commentCol">Review</th>
                <th class="rateHouse">House rating</th>
                <th class="rateHost">Host rating</th>
                <th class="button"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><img src="img/house1.jpg" alt="House" /><br /><br /></td>
                <td>
                  <img src="img/Elon Musk.jpg" alt="People" /><br />Elon Musk
                </td>
                <td>This is a modern house</td>
                <td class="rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-half"></i>
                </td>
                <td class="rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                </td>
                <td>
                  <button class="btn btn-danger" onclick="deleteRow(this)">
                    <i class="fa fa-trash"> Delete</i>
                  </button>
                </td>
              </tr>
              <tr>
                <td><img src="img/house2.jpg" alt="House" /><br /><br /></td>
                <td>
                  <img src="img/stevejobs.jpg" alt="People" /><br />Steve Jobs
                </td>
                <td>My family love it</td>
                <td class="rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                </td>
                <td class="rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star"></i>
                </td>
                <td>
                  <button class="btn btn-danger" onclick="deleteRow(this)">
                    <i class="fa fa-trash"> Delete</i>
                  </button>
                </td>
              </tr>
              <tr>
                <td><img src="img/house3.jpg" alt="House" /><br /><br /></td>
                <td>
                  <img src="img/Jeff Bezos.jpg" alt="People" /><br />Jeff bezos
                </td>
                <td>Very classic house</td>
                <td class="rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                </td>
                <td class="rating">
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                  <i class="bi bi-star-fill"></i>
                </td>
                <td>
                  <button class="btn btn-danger" onclick="deleteRow(this)">
                    <i class="fa fa-trash"> Delete</i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        
      </div>
    </main>
    <!-- Bootstrap modal dialog box for login -->
    <div class="modal" id="loginModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Login</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"
                  >Email address</label
                >
                <input
                  type="email"
                  class="form-control"
                  id="exampleInputEmail1"
                  aria-describedby="emailHelp"
                />
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"
                  >Password</label
                >
                <input
                  type="password"
                  class="form-control"
                  id="exampleInputPassword1"
                />
              </div>
              <div class="mb-3 form-check">
                <input
                  type="checkbox"
                  class="form-check-input"
                  id="exampleCheck1"
                />
                <label class="form-check-label" for="exampleCheck1"
                  >Remember me</label
                >
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">login</button>
            <a href="registration.html" type="button" class="btn btn-secondary">Register</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap Footer -->
    <footer class="footer mt-auto py-3 bg-light">
      <div class="container">
        <span class="text-muted"><p>© 2021 UniTas Pty Ltd</p></span>
      </div>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/del_row.js"></script>
  </body>
</html>
