<?php

class Post
{
    public $pdo;
    public $id;
    public $title;
    public $body;
    public $author;
    public $created_at;

    public function __construct($db)
    {
        $this->pdo = $db;
    }

    public function getPosts()
    {
        $sql = $this->pdo->prepare(
            "SELECT
                c.name as category_name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at
            FROM posts p
            LEFT JOIN categories c
            ON p.category_id = c.id
            ORDER BY p.created_at DESC
                "
        );

        $sql->execute();
        return $sql;
    }

    public function getPost(){
        $sql = $this->pdo->prepare(
            "SELECT
                c.name as category_name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at
            FROM posts p
            LEFT JOIN categories c
            ON p.category_id = c.id
            WHERE p.id = :id
                "
        );

        $sql->bindParam(
            ":id", $this->id
        );

        $sql->execute();

        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $this->title = $row["title"];
        $this->body = $row["body"];
        $this->author = $row["author"];
        $this->category_id = $row["category_id"];
        $this->category_name = $row["category_name"];
    }

    public function create(){
        $sql = $this->pdo->prepare(
            "INSERT INTO posts
            (title, body, author, category_id)
        VALUES (:title, :body, :author, :category_id)");

            //validate data
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
      }

        $this->title = test_input($this->title);
        $this->author = test_input($this->author);
        $this->body = test_input($this->body);
        $this->category_id = test_input($this->category_id);

        $sql->bindParam(":title",$this->title);
        $sql->bindParam(":body",$this->body);
        $sql->bindParam(":author",$this->author);
        $sql->bindParam(":category_id",$this->category_id);

        if($sql->execute()){
            return true;
        }
        return false;

    }


}
