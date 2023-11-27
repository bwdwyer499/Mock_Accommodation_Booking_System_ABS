<?php
  include_once './backend/tablecreation.php';
  session_start();
  $id=$_GET["id"];
  $select_user = "SELECT * FROM accountDetails WHERE account_id = $id";
  $get_user = $conn->query($select_user);
  $user_details = mysqli_fetch_array($get_user);
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
  <p></p>
  <div class="container">
    <form id="addUser" action="user.html">
     <!-- <p>
        <lable>User image</lable><br>
        <img src="img/Elon Musk.jpg" alt="People"><br>
        <input type="file" class="form-control">
      </p> -->
        <p>
        <lable>User name</lable>
        <input class="form-control" type="text" name="username" value="<?php echo $user_details["username"]; ?>" required>
      </p>
      <p>
        <lable>First Name</lable>
        <input class="form-control" type="text" name="first_name" value="<?php echo $user_details["firstName"]; ?>" required>
      </p>
      <p>
        <lable>Last Name</lable>
        <input class="form-control" type="text" name="last_name" value="<?php echo $user_details["lastName"]; ?>" required>
      </p>
      <p>
        <lable>Email</lable>
        <input class="form-control" type="text" name="email" value="<?php echo $user_details["email"]; ?>" required>
      </p>
      <p>
        <lable>Mobile</lable>
        <input class="form-control" type="text" name="mobile" value="<?php echo $user_details["mobile"]; ?>" required>
      </p>
      <p>
        <lable>Address</lable>
        <input class="form-control" type="text" name="address" value="<?php echo $user_details["postalAddress"]; ?>" required>
      </p>
      <p>
        <lable>Password</lable>
        <input class="form-control" type="password" name="password" value="<?php echo $user_details["password"]; ?>" required>
      </p>
      <p>
        <lable>User type</lable>
          <select class="form-control" name="UserTypeSelect" id="UserTypeSelect" required>
            <option value="Client"<?=$user_details['userType'] == 'Client' ? ' selected="selected"' : '';?>>Client</option>
            <option value="Host"<?=$user_details['userType'] == 'Host' ? ' selected="selected"' : '';?>>Host</option>
            <option value="System Manager"<?=$user_details['userType'] == 'System Manager' ? ' selected="selected"' : '';?>>System Manager</option>
        </select>
      </p>
      <p>
        <lable>Access level</lable>
        <select class="form-control" name="access_level" id="access_level" required>
          <option value="0"<?=$user_details['accessLevel'] == '0' ? ' selected="selected"' : '';?>>0</option>
          <option value="1"<?=$user_details['accessLevel'] == '1' ? ' selected="selected"' : '';?>>1</option>
          <option value="2"<?=$user_details['accessLevel'] == '2' ? ' selected="selected"' : '';?>>2</option>
          <option value="3"<?=$user_details['accessLevel'] == '3' ? ' selected="selected"' : '';?>>3</option>
          <option value="4"<?=$user_details['accessLevel'] == '4' ? ' selected="selected"' : '';?>>4</option>
        </select>
      </p>
    </form>
  </div>

<!--  <div class="container">
    <h3>Review History</h3>
    <table id="table">
      <thead>
        <tr>
          <th class="houseCol">House</th>
          <th class="reviewCol">Review</th>
          <th class="rateHouse">House rating</th>
          <th class="rateHost">Host rating</th>
          <th class="button"></th>
        </tr>
      </thead>
      <tbody>
        <tr id="review1">
          <td><img src="img/house1.jpg" alt="House"><br><br></td>
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
          <td id="button"><button class="btn btn-danger" onclick="deleteRow('review1')"><i class="fa fa-trash"> Delete</i></button></td>
        </tr>
      </tbody>
    </table>
  </div> -->

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
    <span class="text-muted"><p>© 2021 UniTas Pty Ltd</p></span>
  </div>
</footer>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/del_Id.js"></script>
      
  </body>
</html>
