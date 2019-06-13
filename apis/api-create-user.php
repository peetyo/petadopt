<?php
  require_once __DIR__.'/../mariadb.php';
  
  // Used for testing  
  // $_POST['email'] = 'Kxx@x.com';
  // $_POST['name'] = 'xX';
  // $_POST['lastName'] = 'xXXX';
  // $_POST['address'] = 'x street';
  // $_POST['region'] = 'Xtown';
  // $_POST['postcode'] = 1234;
  // $_POST['number1'] = 88232338;
  // $_POST['number2'] = 99434348;
  // $_POST['password'] = '123456';
  // $_POST['confirmPassword'] = '123456';
  
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
  if( $_POST['password'] != $_POST['confirmPassword'])
  {
    echo '{"status":"0","message":"Passwords do not match."}';
    exit();
  }
  function insertNumber($db,$id,$number){
    $sQueryNumbers = $db->prepare('CALL insertPhoneNumber(:iId,:iNumber)');
    $sQueryNumbers->bindValue(':iId', $id);
    $sQueryNumbers->bindValue(':iNumber', $number);
    $sQueryNumbers->execute();
    if(!$sQueryNumbers->rowCount()){
      echo '{"status":"0","message":"Something went wrong when saving number."}';
      $mariadb->rollBack();
      exit();
    }
  }
  $mariadb->beginTransaction();
  try{
    $sQuery = $mariadb->prepare('INSERT INTO users VALUES(null, :sEmail, :sPassword, :sName,:sLastName, :sAddress, :sRegion, :iPostcode, 1, null)');
    $sQuery->bindValue(':sEmail', $_POST['email']);
    $sQuery->bindValue(':sPassword', $_POST['password']);
    $sQuery->bindValue(':sName', $_POST['name']);
    $sQuery->bindValue(':sLastName', $_POST['lastName']);
    $sQuery->bindValue(':sAddress', $_POST['address']);
    $sQuery->bindValue(':sRegion', $_POST['region']);
    $sQuery->bindValue(':iPostcode', $_POST['postcode']);
    $sQuery->execute();
    if(!$sQuery->rowCount()){
      echo '{"status":"0","message":"Something went wrong when creating user."}';
      $mariadb->rollBack();
      exit();
    }
    $iUserId = $mariadb->lastInsertId();

  }catch(PDOException $e){
    echo '{"status":"0","message":"Could not create user."}';
    $mariadb->rollBack();
    exit();
  }

  if(!empty($_POST['number1'])){
    try{
      insertNumber($mariadb,$iUserId,$_POST['number1']);
    }catch( PDOException $e){
      echo '{"status":"0","message":"Could not save number 1."}';
      $mariadb->rollBack();
      exit();
    }
  }
   
  if(!empty($_POST['number2'])){
    try{
      insertNumber($mariadb,$iUserId,$_POST['number2']);
    }catch( PDOException $e){
      echo '{"status":"0","message":"Could not save number 2."}';
      $mariadb->rollBack();
      exit();
    }
  }

  $mariadb->commit();
  
  session_start();
  $_SESSION['aUser']['id'] = $iUserId;
  $_SESSION['aUser']['email'] = $_POST['email'];
  $_SESSION['aUser']['name'] = $_POST['name'];
  $_SESSION['aUser']['lastName'] = $_POST['lastName'];
  $_SESSION['aUser']['address'] = $_POST['address'];
  $_SESSION['aUser']['region'] = $_POST['region'];
  $_SESSION['aUser']['postcode'] = $_POST['postcode'];
  
  if(!empty($_POST['number1'])){
    $_SESSION['aUser']['number1'] = $_POST['number1'];
  }
  if(!empty($_POST['number2'])){
    $_SESSION['aUser']['number2'] = $_POST['number2'];
  }

  echo '{"status":"1","message":"The user was created."}';