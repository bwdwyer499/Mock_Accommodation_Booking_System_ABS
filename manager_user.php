<?php
  session_start();
  include_once './backend/dbconn.php';

  //get user details
  $select_user = "SELECT * FROM accountDetails";
  $get_user = $conn->query($select_user);
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
    <link rel="stylesheet" type="text/css" href="css/user.css">

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
      <p></p>
      <div class="container">
        <button
          id="addUser"
          class="btn btn-primary"
          onclick="location.href='add_user.php'"
          type="button"
        >
          <i class="fa fa-plus"> Add user</i>
        </button>
      </div>
      <div class="container">
        <div class="table-responsive">
          <!--header-->
          <h3 align="center">User Details</h3>
          <table id="table">
            <thead>
              <tr>
                <th>User</th>
                <th>User Name</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>User type</th>
                <th>Access level</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
                while ($user_details = mysqli_fetch_array($get_user)) {
              ?>
              <tr>
              <td><img src="data:image/jpeg;base64,<?php echo base64_encode( $user_details['image'] ); ?>" /></td>
                <?php
                  echo '
                    <td>' . $user_details["username"] . '</td>
                    <td>' . $user_details["firstName"] . '</td>
                    <td>' . $user_details["lastName"] . '</td>
                    <td>' . $user_details["email"] . '</td>
                    <td>' . $user_details["mobile"] . '</td>
                    <td>' . $user_details["postalAddress"] . '</td>
                    <td>' . $user_details["userType"] . '</td>
                    <td>' . $user_details["accessLevel"] . '</td>
                  ';
                ?>
              <td><a class="btn btn-primary" href=edit_user.php?id=<?php echo $user_details['account_id']; ?>>Edit</a></td>    
            </tr>
              <?php
                }
              ?>
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
    <script src="js/del_par.js"></script>
  </body>
</html>
