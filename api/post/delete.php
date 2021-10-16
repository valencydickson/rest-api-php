<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once "../../config/Database.php";
require_once "../../models/Post.php";

//instatiate DB
$database = new Database();
$db = $database->connect();

//instatiate Posts

$post = new Post($db);

//Get Id

$post->id = isset($_GET["id"]) ? $_GET["id"] : die();


if($post->delete()){
    echo json_encode(array
    ('message' => 'Post deleted')
);
} else {
    echo json_encode(array
    ( 'message' => 'Post not deleted')   
);

}