<?php

class Database
{
    private $host = "localhost";
    private $dbName = "blogs";
    private $username = "root";
    private $pdo;

    public function connect()
    {
        $this->pdo = null;
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->username);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "connection failed" . $e->getMessage();
        }
        return $this->pdo;
    }
}
