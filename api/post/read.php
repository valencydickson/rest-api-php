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
$results = $post->getPosts();

//check if there is a post

if ($results->rowCount() > 0) {
    $posts_arr = array();
    $posts_arr["data"] = array();

    while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            "id" => $id,
            "title" => $title,
            "body" => $body,
            "author" => $author,
            "category_id" => $category_id,
            "category_name" => $category_name,
        );
        array_push($posts_arr["data"], $post_item);
    }
    echo json_encode($posts_arr);
} else {

    //No post
    echo json_encode(array(
        "message" => "No posts found",
    ));
}
