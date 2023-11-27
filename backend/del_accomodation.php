<?php
  session_start();
  include_once 'tablecreation.php';
  
  //get accomodation id
  $id=$_GET["id"];
  echo $id;

  //$conn->query("DELETE FROM `review` WHERE `review`.`accommodationId` = $id");
  
  

  //header("Location: ../manager_accomodation.php");
?>