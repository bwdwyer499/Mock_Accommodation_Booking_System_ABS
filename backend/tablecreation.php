<?php
  /*
  File name: tablecreation
  Description: insert tables into database
  */
  include_once 'dbconn.php';

  //create table account details
  $create_table_account = "CREATE TABLE if not exists accountDetails (
      account_id int(20) not null PRIMARY KEY AUTO_INCREMENT,
      username varchar(255) not null,
      image BLOB,
      firstName varchar(255) not null,
      lastName varchar(255) not null, 
      email varchar(255) not null,
      mobile int(20) not null,
      postalAddress text not null,
      password varchar(255),
      userType varchar(20) not null,
      accessLevel int(1) not null
  )";      

  //create table inbox
  $create_table_inbox = "CREATE TABLE if not exists inbox (
      inbox_id int(20) not null PRIMARY KEY AUTO_INCREMENT,
      message text not null,
      readStatus BOOLEAN not null,
      senderId int(10) not null,
      recieverId int(10) not null,
      FOREIGN KEY (senderId) REFERENCES accountDetails(account_id),
      FOREIGN KEY (recieverId) REFERENCES accountDetails(account_id)
  )";  

  //create table creditCardDetails
  $create_table_credit_card = "CREATE TABLE if not exists creditCardDetails (
    credit_card_id int(20) not null PRIMARY KEY AUTO_INCREMENT,
    cardNumber int(20) not null,
    expiryDate date not null,
    userId int(10) not null,
    FOREIGN KEY (userId) REFERENCES accountDetails(account_id)
  )";  


  //create table hostDetails
  $create_table_host = "CREATE TABLE if not exists hostDetails (
    host_id int(20) not null PRIMARY KEY AUTO_INCREMENT,
    rate float(24) not null,
    abnNumber varchar(20) not null,
    userId int(20) not null,
    FOREIGN KEY (userId) REFERENCES accountDetails(account_id)
  )";  


  //create table accommodation
  $create_table_accommodation = "CREATE TABLE if not exists accomodationDetails (
      accomodation_id int(20) not null PRIMARY KEY AUTO_INCREMENT,
      houseName varchar(255) not null,
      houseImage BLOB,
      houseDescription text not null,
      avaliableStartDate date not null,
      avaliableEndDate date not null,
      pricePerNight int(20) not null,
      numRoom int(20) not null,
      numBath int(20) not null,
      smorkingAllowed BOOLEAN not null,
      garage int(20) not null,
      petFriendly BOOLEAN not null,
      internetProvided BOOLEAN not null,
      entireHouse BOOLEAN not null,
      address text not null,
      city varchar(255),
      numGuestAllowed int(20) not null,
      rateHouse float(24) not null,
      hostID int(20) not null,
      FOREIGN KEY (hostID) REFERENCES hostDetails(host_id)
  )"; 

  //create table Review
  $create_table_review = "CREATE TABLE if not exists review (
    review_id int(20) not null PRIMARY KEY AUTO_INCREMENT,
    accomodationReview text,
    accomodationRate float(24),
    hostReview text,
    hostRate float(24),
    userId int(20) not null,
    accommodationId int(20) not null,
    hostID int(20) not null,
    FOREIGN KEY (userId) REFERENCES accountDetails(account_id),
    FOREIGN KEY (accommodationId) REFERENCES accomodationDetails(accomodation_id),
    FOREIGN KEY (hostID) REFERENCES hostDetails(host_id)
  )";        

  //create table booking Details
  $create_table_booking = "CREATE TABLE if not exists bookingDetails (
    booking_id int(20) not null PRIMARY KEY AUTO_INCREMENT,
    checkIndate date not null,
    checkOutdate date not null,
    numGuest int(20) not null,
    amount int(20) not null,
    paymentMade BOOLEAN not null,
    hostConfirmation BOOLEAN not null,
    UserCancel BOOLEAN not null,
    rejectReason text not null,
    accommodationId int(20) not null,
    userId int(20) not null,
    FOREIGN KEY (accommodationId) REFERENCES accomodationDetails(accomodation_id),
    FOREIGN KEY (userId) REFERENCES accountDetails(account_id)
  )";   

  //create table guest details
  $create_table_guest = "CREATE TABLE if not exists guestDetails (
    guest_id int(10) not null PRIMARY KEY AUTO_INCREMENT,
    firstName varchar(255) not null,
    lastName varchar(255) not null, 
    email varchar(255) not null,
    mobile int(20) not null,
    bookingId int(10) not null,
    FOREIGN KEY (bookingId) REFERENCES bookingDetails(booking_id)
  )";      

  //create relational table join to show the relationship between table bookingDetails and guestDetails
  $create_table_join = "CREATE TABLE if not exists guestInvitaion (
    invitaion_id int(20) not null PRIMARY KEY AUTO_INCREMENT,
    bookingId int(20) not null,
    guestId int(20) not null,
    FOREIGN KEY (bookingId) REFERENCES bookingDetails(booking_id),
    FOREIGN KEY (guestId) REFERENCES guestDetails(guest_id)
  )";  

  $conn->query("ALTER IGNORE TABLE accountDetails ADD UNIQUE INDEX del_duplicate (username)");
  $conn->query("ALTER IGNORE TABLE hostdetails ADD UNIQUE INDEX del_duplicate (userId)");
  $conn->query("ALTER IGNORE TABLE guestdetails ADD UNIQUE INDEX del_duplicate 
  (`firstName`, `lastName`, `email`, `mobile`, `bookingId`)");

  $apw = password_hash("a", PASSWORD_DEFAULT);
  $bpw = password_hash("b", PASSWORD_DEFAULT);
  $cpw = password_hash("c", PASSWORD_DEFAULT);
  $dpw = password_hash("d", PASSWORD_DEFAULT);

  $conn->query("INSERT INTO `accountdetails` 
  (`account_id`, `username`, `firstName`, `lastName`, `email`, `mobile`, `postalAddress`, 
  `password`, `userType`, `accessLevel`) VALUES 
  (NULL, 'a', 'a', 'a', 'a@a', '1', 'a', '$apw', 'client', '1'), 
  (NULL, 'b', 'b', 'b', 'b@b', '2', 'b', '$bpw', 'host', '2'), 
  (NULL, 'c', 'c', 'c', 'c@c', '3', 'c', '$cpw', 'manager', '3'),
  (NULL, 'd', 'd', 'd', 'd@d', '4', 'd', '$dpw', 'host', '2') ");

  $conn->query("INSERT INTO `hostdetails` (`host_id`, `rate`, `abnNumber`, `userId`) VALUES 
  (NULL, '', '1', '2'), 
  (NULL, '', '2', '4')");

  $conn->query("ALTER IGNORE TABLE accomodationdetails ADD UNIQUE INDEX del_duplicate (address)");

  $conn->query(" INSERT INTO `accomodationdetails` (`accomodation_id`, `houseName`, `houseImage`, 
  `houseDescription`, `avaliableStartDate`, `avaliableEndDate`, `pricePerNight`, `numRoom`, 
  `numBath`, `smorkingAllowed`, `garage`, `petFriendly`, `internetProvided`, `entireHouse`, 
  `address`, `city`, `numGuestAllowed`, `rateHouse`, `hostID`) VALUES 
  (NULL, '1', NULL, '1', '2021-05-01', '2021-05-31', '100', '1', '1', '1', '1', '1', 
  '1', '1', '1', '1', '1', '', '1'), 
  (NULL, '1.1', NULL, '1.1', '2021-05-01', '2021-05-31', '101', '1', '1', '1', 
  '1.1', '1', '1', '1', '1.1', '1.1', '1.1', '', '1'),
  (NULL, '2', NULL, '2', '2021-06-01', '2021-06-30', '200', '2', '2', '0', 
  '2.2', '0', '0', '0', '2.2', '2.2', '2.2', '', '2')
  ");

  mysqli_query($conn, $create_table_account);
  mysqli_query($conn, $create_table_inbox);
  mysqli_query($conn, $create_table_credit_card);
  mysqli_query($conn, $create_table_host);
  mysqli_query($conn, $create_table_accommodation);
  mysqli_query($conn, $create_table_review);
  mysqli_query($conn, $create_table_booking);
  mysqli_query($conn, $create_table_guest);
  //mysqli_query($conn, $create_table_join);

  //INSERT INTO `accountdetails` (`id`, `image`, `username`, `firstName`, `lastName`, `email`, `phone`, `postalAddress`, `password`, `userType`, `accessLevel`) VALUES (NULL, '', 'ElonSpaceX', 'Elon', 'Musk', 'elonmusk@gmail.com', '0487029235', '8, view street, North Hobart', NULL, 'Client', '1'), (NULL, '', 'StevePhone', 'Steve', 'Jobs', 'stevephone@gmail.com', '0489532942', '82, view street, Sandy Bay', NULL, 'Host', '2')
?>