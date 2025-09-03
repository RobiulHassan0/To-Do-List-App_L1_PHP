<?php
require_once __DIR__ . "../../database/db.php";

class TaskManager{
    private $table = 'tasks';

    public function __construct(private Database $database)
    {
        
    }

// Add Task
    public function addTask(array $data){
        $sql = "INSERT INTO " . $this->table . " (title, is_completed, created_at) VALUES (?, ?, ?)";
        $statements = $this->database->connection->prepare($sql);
        $is_completed = 0;
        $created_at = date("Y-m-d H:i:s");

        $statements->bind_param('sis', $data['title'], $is_completed, $created_at);
        if($statements->execute()){
            return true; // Task Added Successfully
        }else{
            return false; // Failed to add task
        }
    }

// Delete Task
    public function deleteTask($id){
        $sql = "DELETE FROM ". $this->table . " WHERE id = ?";
        $statements = $this->database->connection->prepare($sql);
        $statements->bind_param('i', $id);

        if($statements->execute()){
            return true; // Task deleted successfully
        }else{
            return false; // Faild to delete task
        }
    }

// Edit Task
    public function updateTask(array $data){
        $sql = "UPDATE ". $this->table . " SET title = ?, is_completed = ? WHERE id = ?";
        $statements = $this->database->connection->prepare($sql);
        $statements->bind_param('sii', $data['title'], $data['is_completed'], $data['id']);

        if($statements->execute()){
            return true; // Task updated successfully
        }else{
            return false; // Faild to update task
        }
    }


// Get All Tasks 
    public function getAllTasks(){
        $sql = "SELECT * FROM ". $this->table;
        $result = $this->database->connection->query($sql);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($row, JSON_PRETTY_PRINT);
    }
}
