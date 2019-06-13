<?php

  require_once __DIR__ .'/../mongodb.php';

  session_start();
  if(!isset($_SESSION['aUser'])){
      header("Location: ../login.php");
      exit();
  };

  $sUserId = 'id'.$_SESSION['aUser']['id'];
  $sUserName = $_SESSION['aUser']['name'];
  $sUserLastName = $_SESSION['aUser']['lastName'];

  $iRecipientId = $_GET['id'];
  $sRecipientId = 'id'.$iRecipientId;
  if(isset($_GET['lastMessage'])){
    $tmstmpLastMessage = $_GET['lastMessage'];
  }else{
    $tmstmpLastMessage = 0;
  }

  try{
      $result = $mongodb->chats->findOne([$sUserId => "", $sRecipientId => ""]);
      if($result){
        $oMessages = $result->messages;
        $oNewMessages = json_decode('{}');
        foreach($oMessages as $idTimestamp => $sMessage){
          $lastTimestamp = substr($idTimestamp, strpos($idTimestamp, "-") + 1);    
          if($lastTimestamp > $tmstmpLastMessage){
            $oNewMessages->$idTimestamp = $sMessage;
          };
        };
        $soMessages = json_encode($oMessages);
        $soNewMessages = json_encode($oNewMessages);

        echo '{"status": 1, "messages": '.$soNewMessages.'}';
        exit();
      }
      echo '{"status": 0, "message": "Start Conversation" }';
      
  }catch(MongoException $ex){
      echo '{status: 0, message: "Something went wrong when loading chat history"}';
  };