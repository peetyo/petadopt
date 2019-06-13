<?php
  require_once __DIR__.'/../mariadb.php';

  try{
    
    $sQuery = $mariadb->prepare('DELETE FROM listings WHERE id = :iId');
    $sQuery->bindValue(':iId', $_GET['id']);
    $sQuery->execute();
    if( !$sQuery->rowCount() ){
      echo '{"status":0, "message":"Sorry, could not delete listing."}';
      exit;
    }
    echo '{"status":1, "message":"Listing was deleted."}';
  }catch(PDOException $ex){
    echo '{"status":0, "message":"Sorry, exception was thrown."}';
    exit;
  }