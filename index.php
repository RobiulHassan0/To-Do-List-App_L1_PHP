
<!DOCTYPE html>
<html>
<head>
    <title>Simple To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>📝 My To-Do List</h2>

    <form action="../actions/add.php" method="POST">
        <input type="text" name="title" placeholder="Enter new task..." required>
        <button type="submit">Add</button>
    </form>

    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <form action="../actions/toggle.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    <button type="submit"><?= $task['is_completed'] ? '✅' : '⬜' ?></button>
                </form>
                <span style="<?= $task['is_completed'] ? 'text-decoration: line-through;' : '' ?>">
                    <?= htmlspecialchars($task['title']) ?>
                </span>
                <form action="../actions/delete.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    <button type="submit">🗑️</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
