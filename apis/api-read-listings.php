<?php

  require_once '../mariadb.php';
  session_start();
  $currentUserId = $_SESSION['aUser']['id'];
  try{
    $sQuery = $mariadb->prepare('CALL selectAllListings()');
    $sQuery->execute();
    $aListings = $sQuery->fetchAll();
    if( count($aListings) ){
      
      $sListings = json_encode($aListings);
      echo '{"status":1, "message":"Listings found", "data":'.$sListings.', "currentUserId":'.$currentUserId.'}';
      exit;
    }
    echo '{"status":0, "message":"No listings found"}';
    
  }catch(PDOException $exception){
    echo '{"status":0, "message":"Something went wrong, cannot find listings"}';
  }