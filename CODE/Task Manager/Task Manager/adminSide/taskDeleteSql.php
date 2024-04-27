<?php
include "adminCheckLogin.php";
include 'config.php';

class Task {
    private $conn;
    private $id;

    public function __construct($conn, $id) {
        $this->conn = $conn;
        $this->id = $id;
    }

    public function delete() {
        $sql = "DELETE FROM task_tasks WHERE id=$this->id";

        if ($this->conn->query($sql) === TRUE) {
            echo '<script>window.location.href = "tasks.php";</script>';
        } else {
            echo '<script>window.location.href = "tasks.php";</script>';
        }

        $this->conn->close();
    }
}

$id = $_GET['id'];

$task = new Task($conn, $id);
$task->delete();
?>