<?php

require_once __DIR__ . "/../database/db.php";
require_once __DIR__ . "/../classes/Task.php";

$database = new Database();
$taskManager = new TaskManager($database);


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])){

    $id = intval($_POST['id']);

    if($taskManager->deleteTask($id)){
        header("Location: ../public/index.php");
        exit;
    }else{
        header("Location: ../public/index.php?error=1");
        exit;
    }
    
}