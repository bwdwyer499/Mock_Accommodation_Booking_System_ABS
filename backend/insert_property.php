<?php

    include_once 'dbconn.php';

    $file = addslashes(file_get_contents($_FILES["image"]["propImage"])); //image

    $pname = $_POST['prop_name']; //store user form property name

    $hdesc = $_POST['prop_type']; //store user form house type description

    $sdate = $_POST['start_date']; //store user form start date

    $edate = $_POST['end_date']; //store user form end date

    $ppn = $_POST['pp_night']; //store user form price per night

    $nroom  = $_POST['num_rooms']; //store user form user number of rooms

    $nbath = $_POST['num_brooms']; //store user form user number of baths

    $smoking = $_POST['smoking']; //store user form user smoking allowed details

    $garage = $_POST['num_garage']; //store user orm user number of garage spaces

    $petf = $_POST['pet_fren']; //store user form user pet friendly status  

    $internet = $_POST['internet']; //store user form user internet provided status  

    $ehouse = $_POST['entire_house']; //store user form user entire house rented or only smaller space

    $haddress = $_POST['prop_address']; //store user form user house address 

    $city = $_POST['city']; //store user form user city the house is in

    $nguest = $_POST['num_guests']; //store user form user number of guest allowed

    $hrate = $_POST['rating']; //store user form user current house rating    

    $hostid = $_POST['host_id']; //store user form user host id.

    mysqli_query($conn, "INSERT INTO `accomodationdetails` (`houseImage`, `houseName`,
    `houseDescription`, `avaliableStartDate`, `avaliableEndDate`, `pricePerNight`, `numRoom`,`numBath`, `smorkingAllowed`, `garage`,
    `petFriendly`, `internetProvided`, `entireHouse`, `address`, `city`, `numGuestAllowed`, 
    `rateHouse`, `hostID`) 
    VALUES ('$file', '$pname','$hdesc', '$sdate', '$edate', '$ppn', '$nroom', '$nbath', '$smoking',
     '$garage','$petf','$internet','$ehouse','$haddress','$city',
     '$nguest','$hrate','$hostid')");

    header("Location: ../host_house.php");
