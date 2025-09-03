<?php
require_once __DIR__ . "../../database/db.php";

class Task{
    private $table = 'tasks';

    public function __construct(private Database $database)
    {
        
    }

// Get All Tasks 
    public function getAllTasks(){
        $sql = "SELECT * FROM tasks";
        $result = $this->database->connection->query($sql);

        if(!$result){
            return ['Error!' => $this->database->connection->error];
        }

        $row = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($row, JSON_PRETTY_PRINT);
    }

// Add Task
    public function addTask(array $data){
$sql = "INSERT INTO " . $this->table . " (title, is_completed, created_at) VALUES (?, ?, ?)";
        $statements = $this->database->connection->prepare($sql);
        
        // Prepare values for the statement
        $created_at = date("Y-m-d H:i:s");  // Current timestamp
        $is_completed = 0;  // Default is not completed  

        // Bind parameters
        $statements->bind_param('sis', $data['title'], $is_completed, $created_at);

        if($statements->execute()){
            return true;  // Task added successfully
        }else{
            return false; // Failed to add task
        }
    }
}
