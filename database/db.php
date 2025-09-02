<?php

class Database{
    private $host = 'localhost';
    private $dbname = 'todo_app';
    private $username = 'robin';
    private $password = '1234';
    private $connection;

    public function __construct()
    {
        try{
            $this->connection = new mysqli($this->host, $this->dbname, $this->username, $this->password);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

