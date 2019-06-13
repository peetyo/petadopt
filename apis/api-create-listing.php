<?php
  require_once __DIR__.'/../mariadb.php';
  session_start();
  $iUserId = $_SESSION['aUser']['id'];

  if($_FILES['image']){
    if(move_uploaded_file($_FILES['image']['tmp_name'], '../images/'.$_FILES['image']['name'])){
      $sImage = $_FILES['image']['name'];
    }else{
      echo '{"status":0, "message":"Failed to upload photo."}';
      exit;
    }
  }

  try{
    $sQuery = $mariadb->prepare('INSERT INTO `listings` VALUES (NULL, :iUserId, :sTitle, :sAnimalType , :sDescription, :sImage, NULL);');
    $sQuery->bindValue(':iUserId', $iUserId);
    $sQuery->bindValue(':sTitle', $_POST['title']);
    $sQuery->bindValue(':sAnimalType', $_POST['animalType']);
    $sQuery->bindValue(':sDescription', $_POST['description']);
    $sQuery->bindValue(':sImage', $sImage);
    $sQuery->execute();
    if( !$sQuery->rowCount() ){
      echo '{"status":0, "message":"Listing was not created."}';
      exit;
    }
    echo '{"status":1, "message":"Listing was created."}';
  }catch(PDOException $ex){
    echo '{"status":0, "message":"Sorry, exception was thrown."}';
  }