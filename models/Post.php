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
}
