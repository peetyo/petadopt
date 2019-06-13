<?php

    require_once __DIR__ .'/../mongodb.php';

    // connect to mongo
    session_start();
    if(!isset($_SESSION['aUser']) || !isset($_POST['id']) || !isset($_POST['message'])){
        echo '{"status": 0, "message": "Cannot send message without post and session vars" }';
        exit();
    }
    $sUserId = 'id'.$_SESSION['aUser']['id'];
    $sUserName = $_SESSION['aUser']['name'];
    $sUserLastName = $_SESSION['aUser']['lastName'];

    $iRecipientId = $_POST['id'];
    $sRecipientId = 'id'.$iRecipientId;
    $sMessage = $_POST['message'];

    $currentTimestamp = time();
    $sMessageKey = $sUserId.'-'.$currentTimestamp;
    // echo $sMessageKey;

    try{
        $result = $mongodb->chats->updateOne([$sUserId => "", $sRecipientId => ""],['$set'=>['messages.'.$sMessageKey => $sMessage]],['upsert'=>true]);

        if($result){
        echo '{"status": 1, "message": "Message Sent"}';
        exit();
        }
        echo '{"status": 0, "message": "Message not sent" }';
        
    }catch(MongoException $ex){
        echo '{status: 0, message: "Something went wrong when sending message"}';
    };