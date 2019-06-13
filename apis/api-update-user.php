<?php
  // echo '{"status":1, "message":"test"}';
  require_once __DIR__.'/../mariadb.php';

  if( 
    empty($_POST['email']) ||
    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ||
    empty($_POST['name']) ||
    strlen($_POST['name']) < 2 ||
    strlen($_POST['name']) > 20 ||
    empty($_POST['lastName']) ||
    strlen($_POST['lastName']) < 2 ||
    strlen($_POST['lastName']) > 20 ||
    empty($_POST['address']) ||
    strlen($_POST['address']) < 2 ||
    strlen($_POST['address']) > 30 ||
    empty($_POST['region']) ||
    strlen($_POST['region']) < 2 ||
    strlen($_POST['region']) > 30 ||
    empty($_POST['postcode']) ||
    strlen($_POST['postcode']) < 2 ||
    strlen($_POST['postcode']) > 4 ||
    !is_numeric($_POST['postcode']) ||
    strlen($_POST['password']) < 6 ||
    strlen($_POST['password']) > 20
  ){
    echo '{"status":"0","message":"Fill in the form correctly."}';
    exit();
  }
  session_start();
  $iUserId = $_SESSION['aUser']['id'];
  $sEmail = $_POST['email'];
  $sName = $_POST['name'];
  $sLastName = $_POST['lastName'];
  $sAddress = $_POST['address'];
  $sRegion = $_POST['region'];
  $iPostcode = $_POST['postcode'];
  $sPassword = $_POST['password'];
  // $iUserId =1;
  try{
    $sQuery = $mariadb->prepare('UPDATE users SET email=:sEmail, name=:sName, lastName=:sLastName, address=:sAddress, region=:sRegion,postcode=:iPostcode,  password=:sPassword WHERE id = :iUserId');
    $sQuery->bindValue(':iUserId', $iUserId);
    $sQuery->bindValue(':sEmail', $sEmail);
    $sQuery->bindValue(':sName', $sName);
    $sQuery->bindValue(':sLastName', $sLastName);
    $sQuery->bindValue(':sAddress', $sAddress);
    $sQuery->bindValue(':sRegion', $sRegion);
    $sQuery->bindValue(':iPostcode', $iPostcode);
    $sQuery->bindValue(':sPassword', $sPassword);
    $sQuery->execute();
    if( !$sQuery->rowCount() ){
      echo '{"status":0, "message":"No changes were made."}';
      exit();
    }

    $_SESSION['aUser']['email'] = $sEmail;
    $_SESSION['aUser']['name'] = $sName;
    $_SESSION['aUser']['lastName'] = $sLastName;
    $_SESSION['aUser']['address'] = $sAddress;
    $_SESSION['aUser']['region'] = $sRegion;
    $_SESSION['aUser']['postcode'] = $iPostcode;
    $_SESSION['aUser']['password'] = $sPassword;
    
    echo '{"status":"1","message":"Profile was updated."}';
  }catch( PDOException $e){
    echo '{"status":"0","message":"Sorry, exception was thrown"}';
    exit();
  }