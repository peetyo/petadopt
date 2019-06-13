<?php
  require_once __DIR__.'/../mariadb.php';
  session_start();

  try{
    $iUserId = $_SESSION['aUser']['id'];
    $sQuery = $mariadb->prepare('DELETE FROM users WHERE id = :iUserId');
    $sQuery->bindValue(':iUserId', $iUserId);
    $sQuery->execute();
    if( !$sQuery->rowCount() ){
      echo '{"status":0, "message":"Sorry, could not delete profile."}';
      exit;
    }
  session_destroy();
    echo '{"status":1, "message":"Profile was deleted."}';
  }catch(PDOException $ex){
    echo '{"status":0, "message":"Sorry, exception was thrown."}';
  }