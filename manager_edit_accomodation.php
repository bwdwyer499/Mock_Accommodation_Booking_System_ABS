<?php
session_start();
include_once './backend/tablecreation.php';

$id = $_GET["id"];
$select_accomodation = "SELECT * FROM accomodationdetails WHERE accomodation_id = $id";

$get_accomodation = $conn->query($select_accomodation);
$accomodation_details = mysqli_fetch_array($get_accomodation);
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Paul Watts, David Chui Fan Hui, Beven Dwyer, and Bootstrap contributors">
  <title>Accommodation Booking System · ABS</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/main.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/edit_user.css">

  <!-- Add icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

  <!-- Begin page content -->
  <main class="flex-shrink-0">
    <p></p>
    <div class="container">
      <form id="addUser" action="user.html">
        <p>
          <lable>House image</lable><br><br>
          <?php
          echo '<img id="houseImage" src="data:image/jpeg;base64,' . base64_encode($accomodation_details["houseImage"]) . '"/>';
          ?>
          <br /><br />
          <input type="file" class="form-control" accept="image/*" id="imgLoad" onchange="previewFile()">
        </p>
        <p>
          <lable><p><b>House name</b></p></lable>
          <input class="form-control" type="text" name="houseName" value="<?php echo $accomodation_details["houseName"]; ?>" required>
        </p>
      </form>
    </div>
    <div class="container">
      <div class="saveCancel">
        <input type="submit" name="sumbit" id="submit" form="addUser" value="Save" class="btn btn-primary"></input>
        <button class="btn btn-danger" onclick="location.href='user.html'" type="button">Cancel</button>
      </div>
    </div>
    </div>
  </main>

  <footer class="footer mt-auto py-3 bg-light">
    <div class="container">
      <span class="text-muted">
        <p>© 2021 UniTas Pty Ltd</p>
      </span>
    </div>
  </footer>


  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/del_Id.js"></script>
  <script>
    function previewFile() {
      var preview = document.querySelector('img');
      var file = document.querySelector('input[type=file]').files[0];
      var reader = new FileReader();

      reader.addEventListener("load", function() {
        preview.src = reader.result;
      }, false);

      if (file) {
        reader.readAsDataURL(file);
      }
    }
  </script>
</body>

</html>