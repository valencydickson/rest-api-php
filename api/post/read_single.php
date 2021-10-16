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

$post->getPost();

$post_arr= array(
    "id"=> $post->id,
    "title"=> $post->title,
    "body"=> $post->body,
    "author"=> $post->author,
    "category_id"=> $post->category_id,
    "category_name"=> $post->category_name,
);

echo ( json_encode($post_arr));