<?php
    include_once 'dbconn.php';

    //image
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  

    //store form user username
    $uname = $_POST['username'];

    //store form user first name
    $first = $_POST['first_name'];

    //store form user last name
    $last = $_POST['last_name'];

    //store form user email
    $email  = $_POST['email'];

    //store form user mobile
    $mobile = $_POST['mobile'];

    //store form user address
    $address = $_POST['address'];
    
    //store form user password and hash it
    $pw = $_POST ["password"];
    $hpw = password_hash($pw, PASSWORD_DEFAULT);

    //store form user user type
    $utype = $_POST['UserTypeSelect'];

    //store form user user type
    $access_lv = $_POST['access_level'];
    
    mysqli_query($conn, "INSERT INTO `accountdetails` (`image`, `username`, `firstName`, `lastName`,
     `email`, `mobile`, `postalAddress`, `password`, `userType`, `accessLevel`) 
    VALUES ('$file', '$uname', '$first', '$last', '$email', '$mobile', '$address', '$hpw', '$utype', '$access_lv')");

    header("Location: ../index.php");
