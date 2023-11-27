<?php
  session_start();
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

  <!-- Begin banner -->
  <section class="main-banner position-relative p-3 p-md-0 text-center bg-light text-white">
    <div class="p-lg-5 mx-auto my-5">
      <h1 class="display-4 fw-normal">Accommodation Booking System</h1>
      <p class="lead fw-normal">Your home away from home</p>
      <btn class="btn btn-outline-light btn-lg" id="registerAction" data-bs-toggle="modal"
        data-bs-target="#propertyModal">Register Property</btn>
    </div>
  </section>

  <!-- Begin page content -->
  <main class="container-fluid">
    <h1 class="mt-5" id="manPropHeader">Manage Your Properties</h1>
    <div class="table-responsive">
      <table class="table" id='propTable'>
        <thead>
          <tr>
            <th class="hostName" id="hostName">HostName</th>
            <th class="hostUsername" id="hostUsername">Username</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="name" id="name">Jake. J. Gittes</td>
            <td class="username" id="username">TheRealJJNicholson</td>
          </tr>
          <tr>
            <td colspan="4">
              <table class="table" id='propTableList'>

                <!-- Begin Table headings-->
                <tr>
                  <th class="propertyImage">Image</th>
                  <th class="propertyAddress">Address</th>
                  <th class="propertyType">Type</th>
                  <th class="propertyRooms">Rooms</th>
                  <th class="propertyBathrooms">Bathrooms</th>
                  <th class="propertyCost">Price</th>
                  <th class="propertySmoking">Smoking Allowed</th>
                  <th class="propertyPets">Pets Allowed</th>
                  <th class="propertyInternet">Internet Access</th>
                  <th class="reviewRating">Rating</th>
                  <th class="propertyEdit">Edit & Delete Property</th>
                </tr>

                <!--Begin Table Rows-->
                <!--Dummy Table Row 1-->
                <tr>
                  <td class="image"><img src="img/Duplex.jpg" class="img-thumbnail" id="propImage" alt="Duplex"></td>
                  <td class="address">357 Mulholland Drive</td>
                  <td class="type">Duplex</td>
                  <td class="rooms">8</td>
                  <td class="bathrooms">3</td>
                  <td class="cost">$1580</td>
                  <td class="smoking">no</td>
                  <td class="pets">yes</td>
                  <td class="internet">yes</td>
                  <td class="rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                      class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></td>
                  <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPropertyModal"><i
                        class="bi bi-pencil-square"></i>Edit</button>
                    <button class="btn btn-danger" onclick="deleteRow(this)"><i
                        class="bi bi-trash-fill"></i>Delete</button>
                  </td>
                </tr>

                <!--Dummy Table Row 2-->
                <tr>
                  <td><img src="img/Mansion.jpg" class="img-thumbnail" id="propImage" alt="Duplex"></td>
                  <td class="address">222 Lucky Lane</td>
                  <td class="type">Mansion</td>
                  <td class="rooms">24</td>
                  <td class="bathrooms">8</td>
                  <td class="cost">$5550</td>
                  <td class="smoking">yes</td>
                  <td class="pets">yes</td>
                  <td class="internet">yes</td>
                  <td class="rating"><i class="bi bi-star-fill"><i class="bi bi-star-fill"><i class="bi bi-star-fill"><i
                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></td>
                  <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPropertyModal"><i
                        class="bi bi-pencil-square"></i>Edit</button>
                    <button class="btn btn-danger" onclick="deleteRow(this)"><i
                        class="bi bi-trash-fill"></i>Delete</button>
                  </td>
                </tr>

                <!--Dummy Table Row 3-->
                <tr>
                  <td><img src="img/cave.jpg" class="img-thumbnail" id="propImage" alt="Duplex"></td>
                  <td class="address">1 Wilderness Rd</td>
                  <td class="type">Cave</td>
                  <td class="rooms">1</td>
                  <td class="bathrooms">1</td>
                  <td class="cost">$20</td>
                  <td class="smoking">yes</td>
                  <td class="pets">yes</td>
                  <td class="internet">no</td>
                  <td class="rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i><i
                      class="bi bi-star"></i><i class="bi bi-star"></i><i class="bi bi-star"></i></td>
                  <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPropertyModal"><i
                        class="bi bi-pencil-square"></i>Edit</button>
                    <button class="btn btn-danger" onclick="deleteRow(this)"><i
                        class="bi bi-trash-fill"></i>Delete</button>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
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
          <form class=form-inline action="/action_page.php">

            <!-- Begin Property Registration Modal Form Contents -->
            <div class="row g-3">
              <div class="col-md-12">
                <label for="Registration">Property Address</label>
                <input type="name" class="form-control" id="pAdress" placeholder="Property Street Address" required>
                <div class="invalid-feedback"> Address is required</div>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="pType" class="form-label">Property Type</label>
                <select name="pType" class="form-control" id="pType" required>
                  <option value="" disable selected>Select Type</option>
                  <option value="Australia">House</option>
                  <option value="USA">Apartment</option>
                  <option value="China">Room</option>
                  <option value="Denmark">Villa</option>
                  <option value="England">Masion</option>
                  <option value="France">Duplex</option>
                  <option value="HongKong">Castle</option>
                  <option value="Indonesia">Shack</option>
                  <option value="NewZealand">Cave</option>
                </select>
                <div class="invalid-feedback">Property type is required</div>
              </div>
              <div class="col-sm-6">
                <label for="Lname" class="form-label">Number Of Rooms</label>
                <input type="Number" class="form-control" id="nRooms" placeholder="Number Of Rooms" min="0" required>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="bRooms" class="form-label">Number of Bathrooms</label>
                <input type="number" class="form-control" id="bRooms" placeholder="Number Of Rooms" min="0" required>
              </div>
              <div class="col-sm-6">
                <label for="ppWeek" class="form-label">Price Per Week</label>
                <div class="input-group">
                  <input type="text" class="form-control" required>
                  <span class="input-group-text">$</span>
                  <span class="input-group-text">0.00</span>
                </div>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="Country" class="form-label">Country</label>
                <select name="Country" class="form-control" id="Country" required>
                  <option value="" disable selected>Select County</option>
                  <option value="Australia">Australia</option>
                  <option value="USA">America</option>
                  <option value="China">China</option>
                  <option value="Denmark">Denmark</option>
                  <option value="England">England</option>
                  <option value="France">France</option>
                  <option value="HongKong">Hong Kong</option>
                  <option value="Indonesia">Indonesia</option>
                  <option value="NewZealand">New Zealand</option>
                </select>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-md-12">
                <label for="pImage" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="inputGroupFile01" required>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary bnt-lg">Submit</button>
          <button type="reset" class="btn btn-secondary bnt-lg"> Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap modal dialog box for property editing -->
  <div class="modal" id="editPropertyModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Current Property</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class=form-inline action="/action_page.php">

            <!-- Begin Property Editing Modal Form Contents -->
            <div class="row g-3">
              <div class="col-md-12">
                <label for="Registration">Property Address</label>
                <input type="name" class="form-control" id="pAdress" placeholder="Property Street Address" required>
                <div class="invalid-feedback"> Address is required</div>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="pType" class="form-label">Property Type</label>
                <select name="pType" class="form-control" id="pType" required>
                  <option value="" disable selected>Select Type</option>
                  <option value="Australia">House</option>
                  <option value="USA">Apartment</option>
                  <option value="China">Room</option>
                  <option value="Denmark">Villa</option>
                  <option value="England">Masion</option>
                  <option value="France">Duplex</option>
                  <option value="HongKong">Castle</option>
                  <option value="Indonesia">Shack</option>
                  <option value="NewZealand">Cave</option>
                </select>
                <div class="invalid-feedback">Property type is required</div>
              </div>
              <div class="col-sm-6">
                <label for="Lname" class="form-label">Number Of Rooms</label>
                <input type="Number" class="form-control" id="nRooms" placeholder="Number Of Rooms" min="0" required>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="bRooms" class="form-label">Number of Bathrooms</label>
                <input type="number" class="form-control" id="bRooms" placeholder="Number Of Rooms" min="0" required>
              </div>
              <div class="col-sm-6">
                <label for="ppWeek" class="form-label">Price Per Week</label>
                <div class="input-group">
                  <input type="text" class="form-control" required>
                  <span class="input-group-text">$</span>
                  <span class="input-group-text">0.00</span>
                </div>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="Smoking" class="form-label">Smoking Allowed</label>
                <select name="Smoking" class="form-control" id="Smoking" required>
                  <option value="" disable selected>Select Smoking Allowence</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="Pets" class="form-label">Pets Allowed</label>
                <select name="Pets" class="form-control" id="pets" required>
                  <option value="" disable selected>Select Pets Allowance</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="Internet" class="form-label">Internet Access</label>
                <select name="Internet" class="form-control" id="internet" required>
                  <option value="" disable selected>Select Internet Access</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="Country" class="form-label">Country</label>
                <select name="Country" class="form-control" id="Country" required>
                  <option value="" disable selected>Select County</option>
                  <option value="Australia">Australia</option>
                  <option value="USA">America</option>
                  <option value="China">China</option>
                  <option value="Denmark">Denmark</option>
                  <option value="England">England</option>
                  <option value="France">France</option>
                  <option value="HongKong">Hong Kong</option>
                  <option value="Indonesia">Indonesia</option>
                  <option value="NewZealand">New Zealand</option>
                </select>
              </div>
            </div>
            <div class="row g-3">
              <div class="col-md-12">
                <label for="pImage" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="inputGroupFile01" required>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary bnt-lg">Submit</button>
          <button type="reset" class="btn btn-secondary bnt-lg"> Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap modal dialog box for login -->
  <div class="modal" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Remember me</label>
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
    function deleteRow(btn) {
      var row = btn.parentNode.parentNode;
      row.parentNode.removeChild(row);
    }
  </script>

</body>

</html>