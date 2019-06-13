<?php
  if( empty($_POST['email']) ||
      empty($_POST['password']) ||  
      !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ||
      !(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 20)
  ){
    echo '{"status":0, "message":"Invalid data was filled in."}';
    exit;
  }
  require_once '../mariadb.php';

  try{
    $sQuery = $mariadb->prepare('SELECT * FROM users WHERE email = :sEmail AND password = :sPassword AND active = 1 LIMIT 1');
    $sQuery->bindValue(':sEmail', $_POST['email']);
    $sQuery->bindValue(':sPassword', $_POST['password']);
    $sQuery->execute();
    $aUsers = $sQuery->fetchAll();
    if( count($aUsers) ){
      session_start();
      $_SESSION['aUser'] = $aUsers[0];
      unset($_SESSION['aUser']['password']);
      echo '{"status":1, "message":"login success"}';
      exit;
    }
    echo '{"status":0, "message":"No users match the credentials"}';
    
  }catch(PDOException $exception){
    echo '{"status":0, "message":"Something went wrong, cannot login"}';
  }








