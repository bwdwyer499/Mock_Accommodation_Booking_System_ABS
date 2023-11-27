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

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/add_user.css">
    
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <h3 align="center">Add User</h3>
    <form id="addUser" action="./backend/insert_user.php" method="POST"  enctype="multipart/form-data">
      <p>
        <lable>User image</lable><br>
        <input type="file" class="form-control" name="image">
      </p>
        <p>
        <lable>User name</lable>
        <input class="form-control" type="text" name="username" placeholder="User name" required>
      </p>
      <p>
        <lable>First Name</lable>
        <input class="form-control" type="text" name="first_name" placeholder="First name" required>
      </p>
      <p>
        <lable>Last Name</lable>
        <input class="form-control" type="text" name="last_name" placeholder="Last name" required>
      </p>
      <p>
        <lable>Email</lable>
        <input class="form-control" type="email" name="email" placeholder="email" required>
      </p>
      <p>
        <lable>Mobile</lable>
        <input class="form-control" type="text" name="mobile" placeholder="mobile" required>
      </p>
      <p>
        <lable>Address</lable>
        <input class="form-control" type="text" name="address" placeholder="Address" required>
      </p>
      <p>
        <lable>Password</lable>
        <input class="form-control" type="password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#$%]).{6,12}$" 
        name="password" id="password" placeholder="6 to 12 characters in length
        Contains at least 1 lower case letter, 1 uppercase letter, 1 number and one of following special characters ! @ # $ % 
        "required title="6 to 12 characters in length 
        Contains at least 1 lower case letter, 1 uppercase letter, 1 number and one of following special characters ! @ # $ % ">
      </p>
      <p>
        <lable>Password confirmation</lable>
        <input class="form-control" type="password" placeholder="Confirm password" id="passwordConfirmation" required>
      </p>
      <p>
        <lable>User type</lable>
          <select class="form-control"  name="UserTypeSelect" id="UserTypeSelect" onchange="changeStatus()" required>
            <option value="" disabled selected>Select user type</option>
            <option value="Client">Client</option>
            <option value="Host">Host</option>
            <option value="System_manager">System Manager</option>
        </select>
      </p>
      <p>
        <label for="ABN" class="form-label" name="abn" id="ABN-label">ABN</label>
        <input type="text" class="form-control" id="ABN" placeholder="ABN Number" required>
      </p>
      <p>
        <lable>Access level</lable>
        <select class="form-control" name="access_level" id="accesslevel" required>
          <option value="" disabled selected>Select access level</option>
          <option>0</option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
        </select>
      </p>
    </form>  
    <div class="saveCancel">
      <input type="submit" name="sumbit" id="submit" form="addUser" value="Save" class="btn btn-primary"></input> 
     <button class="btn btn-danger" onclick="location.href='user2.php'" type="button">Cancel</button>
    </div>
  </div>
</main>

<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span class="text-muted"><p>© 2021 UniTas Pty Ltd</p></span>
  </div>
</footer>
      
<script>
function _id(name) {
  return document.getElementById(name);
}

function changeStatus() {
  var status = _id("UserTypeSelect")
  if (status.value == "Host") {
    _id("ABN").style.display = "block";
    _id("ABN-label").style.display = "block";
    _id("ABN").setAttribute("required", "required");
  } else {
    _id("ABN").style.display = "none";
    _id("ABN-label").style.display = "none";
    _id("ABN").removeAttribute("required");
  }
}

  var password = document.getElementById("password");
  var password_confirmation = document.getElementById("passwordConfirmation");

  function password_confirmation1(){
    if(password.value != password_confirmation.value) {
      password_confirmation.setCustomValidity("Password Doesn't Match");
    } else {
      password_confirmation.setCustomValidity('');
    }
  }

  password.onchange = password_confirmation1;
  password_confirmation.onkeyup = password_confirmation1;

 
</script>

  </body>
</html>
