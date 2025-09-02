<?php
require_once __DIR__ . "../../database/db.php";

class Task{

    public function __construct(private Database $dbname)
    {
        
    }

    public function getAllTasks(){
        
    }
}

$database = new Database();
$tasks = new Task($database); 