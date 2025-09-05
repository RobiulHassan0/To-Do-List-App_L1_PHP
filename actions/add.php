<?php

require_once __DIR__ . "/../database/db.php";
require_once __DIR__ . "/../classes/Task.php";

$database = new Database();
$taskManager = new TaskManager($database);


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    
    if($title === ''){
        header("Location: ../public/index.php?error=empty_title");
        exit;
    }

    $data = [
        'title' => $title,
        'is_completed' => 0
    ];

    if($taskManager->addTask($data)){
        header("Location: ../public/index.php");
        exit;
    }else{
        header("Location: ../public/index.php?error=1");
        exit;
    }   

}