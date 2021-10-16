<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Method,Authorization, X-Requested-With');


require_once "../../config/Database.php";
require_once "../../models/Post.php";

//instatiate DB
$database = new Database();
$db = $database->connect();

//instatiate Posts

$post = new Post($db);

//Get raw data

$data  = json_decode(file_get_contents('php://input'));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//create post
if($post->create()){
    echo json_encode(array
    ('message' => 'Post created')
);
} else {
    echo json_encode(array
    ( 'message' => 'Post not created')   
);
}