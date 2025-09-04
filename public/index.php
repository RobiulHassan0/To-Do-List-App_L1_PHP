<?php
require_once __DIR__ . "/../database/db.php";
require_once __DIR__ . "/../classes/Task.php";

$db = new Database();
$taskManager = new TaskManager($db);

$tasks = $taskManager->getAllTasks();

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
  <form action="/actions/add.php" class="todo-form d-flex mb-4" method="POST">
    <input type="text" name="title" class="form-control me-2" placeholder="Enter a new task..." required>
    <button type="submit" class="btn">Add</button>
  </form>
  
  <!-- Task List -->
  <?php if(empty($tasks)): ?>
    <p>No Task yet. add one above</p>
  <?php else : ?>
    <?php foreach($tasks as $task): ?>
      <form class="task" action="../actions/update.php" method="POST">
        <div class="d-flex align-items-center">
          <input type="hidden" name="id" value="<?= htmlspecialchars($task['id']) ?>">
          <input type="checkbox" name="is_completed" class="form-check-input task-checkbox" onchange="this.form.submit()" <?= $task['is_completed'] ? 'checked' : '' ?>>
          <p class="task-text mb-0"><?= htmlspecialchars($task['title']) ?></p>
        </div>

        <!-- Delete Form -->
        <form action="../actions/delete.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this task?');">
          <input type="hidden" name="id" value="<?= $task['id'] ?>">
          <button type="submit" class="delete-btn"><i class="fas fa-trash"></i></button>
        </form>
      </form>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

</body>
</html>
