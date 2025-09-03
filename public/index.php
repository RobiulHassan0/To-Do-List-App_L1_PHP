<?php
require_once __DIR__ . "../../classes/Task.php";
require_once __DIR__ . "../../database/db.php";

$db = new Database();
$taskManager = new Task($db);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])){
  // Get data from the FORM
  $title = $_POST['title'];

  // Prepare data for the addTask function
  $data = [
    'title' => $title,
    'is_completed' => 0
  ];
  
  // Call addTask method to add the task
  if($taskManager->addTask($data)){
    header("Location: index.php");
    exit;
  }else{
    header("Location: index.php?error=1");
    exit;
  }
}

  // Fetch tasks for displaying
  $tasks = json_decode($taskManager->getAllTasks(), true);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My To-Do List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- External CSS -->
     <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="todo-app">
  <div class="todo-header">
    <i class="fas fa-clipboard-list text-primary"></i>
    My To-Do List
  </div>

  <!-- Task Add Form -->
  <form class="todo-form d-flex mb-4" method="POST">
    <input type="text" name="title" class="form-control me-2" placeholder="Enter a new task..." required>
    <button type="submit" class="btn">Add</button>
  </form>

  <!-- Task Item -->
  <?php if(empty($tasks)) :?>
    <li>No task yet. add one</li>
  <?php else: ?>

  <?php foreach ($tasks as $index => $task) :?>    
  <div class="task">
    <div class="d-flex align-items-center">
      <input class="form-check-input task-checkbox" type="checkbox">
      <p class="task-text mb-0"><?= htmlspecialchars($task['title']) ?></p>
    </div>
    <button class="delete-btn" title="Delete"><i class="fas fa-trash"></i></button>
  </div>
  <?php endforeach; ?>
  <?php endif; ?>
  

  <div class="task completed">
    <div class="d-flex align-items-center">
      <input class="form-check-input task-checkbox" type="checkbox" checked>
      <p class="task-text mb-0">Finish assignment</p>
    </div>
    <button class="delete-btn" title="Delete"><i class="fas fa-trash"></i></button>
  </div>
</div>

</body>
</html>
