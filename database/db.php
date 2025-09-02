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
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            if($this->connection->connect_error){
                throw new Exception("Connection Failed " . $this->connection->connect_error);
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}

