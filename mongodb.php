<?php

require __DIR__ . '/vendor/autoload.php';

try{
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $mongodb = $client->livechat;

}catch(MongoException $ex){
    echo '{status: 0, message: "Something went wrong when connecting to the database"}';
};