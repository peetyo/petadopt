<?php
  require_once 'mariadb.php';

  try{
    $sQuery = $mariadb->prepare('CREATE TABLE users_Dec2018 LIKE users; INSERT INTO users_Dec2018 SELECT * FROM users');
    $sQuery->execute();

    echo '{"status":"1","message":"table backup created"}';
  }catch(PDOException $e){
    $e->getMessage();
    echo $e;
    // echo '{"status":"0","message":"could not backup table"}';
    exit();
  }