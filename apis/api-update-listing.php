<?php
  require_once __DIR__.'/../mariadb.php';

  // $_POST['id']= 3;
  // $_POST['userId']= 2;
  // $_POST['sTitle']= 'HEYOOOOO';
  // $_POST['sDescription']= 'HEyoooo Heyooooo heeeyooo yooyo';
  try{
    $sQuery = $mariadb->prepare('UPDATE listings SET title = :sTitle, description = :sDescription WHERE listings.id = :iId;');
    $sQuery->bindValue(':sTitle', $_POST['title']);
    $sQuery->bindValue(':sDescription', $_POST['description']);
    $sQuery->bindValue(':iId', $_POST['id']);
    $sQuery->execute();
    if( !$sQuery->rowCount() ){
      echo '{"status":0, "message":"No changes were made."}';
      exit;
    }
    echo '{"status":1, "message":"Listing was updated."}';
  }catch(PDOException $ex){
    echo '{"status":0, "message":"Sorry, exception was thrown."}';
  }