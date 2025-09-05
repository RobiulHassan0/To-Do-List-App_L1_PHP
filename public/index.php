<?php
require_once __DIR__ . "/../database/db.php";
require_once __DIR__ . "/../classes/Task.php";

$db = new Database();
$taskManager = new TaskManager($db);

$tasks = $taskManager->getAllTasks();

$editTask = null;
if(isset($_GET['edit'])){
  $editId = intval($_GET['edit']);
  $editTask = $taskManager->getTaskById($editId);
}

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

    <!-- Task Add / Edit Form -->
  <form action="<?= $editTask ? '../actions/update.php' : '../actions/add.php' ?>" class="todo-form d-flex mb-4" method="POST">
    
    <?php if($editTask): ?>
      <input type="hidden" name="id" value="<?= $editTask['id'] ?>">
    <?php endif; ?>
    
    <input type="text"name="title" class="form-control me-2" value="<?= $editTask ? htmlspecialchars($editTask['title']) : '' ?>" placeholder="Enter a new task..." required>
    
    <button type="submit" class="btn"><?= $editTask ? 'Update' : 'Add' ?></button>
  </form>
  
  <!-- Task List -->
  <?php if(empty($tasks)): ?>
    <p>No Task yet. add one above</p>
  <?php else : ?>

    <?php foreach($tasks as $task): ?>
      <div class="task <?= $task['is_completed'] ? 'completed' : '' ?> d-flex align-items-center justify-content-between">

        <!-- Checkbox + Title -->
        <form action="../actions/update.php" method="POST" class="d-flex align-items-center flex-grow-1">
            <input type="hidden" name="id" value="<?= $task['id'] ?>">
            <input type="hidden" name="title" value="<?= htmlspecialchars($task['title'])?>">
            
            <input type="checkbox" name="is_completed" class="form-check-input task-checkbox me-2" onchange="this.form.submit()" <?= $task['is_completed'] ? 'checked' : '' ?> >

            <p class="task-text mb-0 me-2"><?= htmlspecialchars($task['title']) ?></p>
        </form>
        
        <!-- Edit Icon -->
        <a href="index.php?edit=<?= $task['id'] ?>" class="text-warning ms-2"><i class="fas fa-pen-to-square"></i></a>

        <!-- Delete Icon -->
        <form action="../actions/delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
            <input type="hidden" name="id" value="<?= $task['id'] ?>">
            <button type="submit" class="delete-btn">
                <i class="fas fa-trash"></i>
            </button>
        </form>

      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

</body>
</html>
