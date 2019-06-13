<?php

    require_once __DIR__ .'/../mongodb.php';

    session_start();
    if(!isset($_SESSION['aUser'])){
        header("Location: ../login.php");
        exit();
    };
    if(!isset($_GET['id'])){
        echo '{"status": 0, "message": "Cannot start conversation, missing recipient" }';
        exit();
    };
    $sUserId = 'id'.$_SESSION['aUser']['id'];
    $sUserName = $_SESSION['aUser']['name'];
    $sUserLastName = $_SESSION['aUser']['lastName'];

    $iRecipientId = $_GET['id'];
    $sRecipientId = 'id'.$iRecipientId;


    try{
        $result = $mongodb->chats->findOne([$sUserId => "", $sRecipientId => ""]);
        if($result){
        $oMessages = $result->messages;
        $soMessages = json_encode($oMessages);
        echo '{"status": 1, "messages": '.$soMessages.'}';
        exit();
        }
        echo '{"status": 0, "message": "Start Conversation" }';
        
    }catch(MongoException $ex){
        echo '{status: 0, message: "Something went wrong when loading chat history"}';
    };