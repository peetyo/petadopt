<?php

  require_once __DIR__.'/../mariadb.php';

  session_start();
  $iUserId = $_SESSION['aUser']['id'];
 
  try{
    $sQuery = $mariadb->prepare('UPDATE users SET active = 0 WHERE id = :iUserId');
    $sQuery->bindValue(':iUserId', $iUserId);
    $sQuery->execute();
    if( !$sQuery->rowCount() ){
      echo '{"status":0, "message":"No changes were made."}';
      exit();
    }
    session_destroy();
    echo '{"status":"1","message":"Profile was deactivated."}';
  }catch( PDOException $e){
    echo '{"status":"0","message":"Sorry, exception was thrown"}';
    exit();
  }