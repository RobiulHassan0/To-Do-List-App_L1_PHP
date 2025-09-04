<?php

require_once __DIR__ . "/../database/db.php";
require_once __DIR__ . "/../classes/Task.php";

$database = new Database();
$taskManager = new TaskManager($database);


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])){

    $id = intval($_POST['delete']);

    if($taskManager->deleteTask($id)){
        header("Location: index.php");
        exit;
    }else{
        header("Location: index.php?error=1");
        exit;
    }
    
}