<?php

require_once __DIR__ . "/../database/db.php";
require_once __DIR__ . "/../classes/Task.php";

$database = new Database();
$taskManager = new TaskManager($database);

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
if($id === null || $id < 0 || $id === false){
    header("Location: index.php");
    exit;
}

$task = $taskManager->getTaskById($id);
if(!$task){
    header("Location: index.php?error=not_found");
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $newTitle = isset($_POST['title']) ? trim($_POST['title']) : '';
    $is_completed = isset($_POST['is_completed']) ? 1 : 0;

    if($newTitle === ''){
        header("Location: update.php?id={$id}&error=empty_title");
        exit;
    }

    $data =[
        'title' => $newTitle,
        'is_completed' => $is_completed,
        'id' => $id
    ];

    if($taskManager->updateTask($data)){
        header("Location: index.php");
        exit;
    }else{
        header("Location: index.php?error=1");
        exit;
    }
    
}