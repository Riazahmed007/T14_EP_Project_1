<?php
include "adminCheckLogin.php";
include 'config.php';

class Task {
    private $conn;
    private $id;
    private $task_name;
    private $task_description;
    private $submit_date;

    public function __construct($conn, $id, $task_name, $task_description, $submit_date) {
        $this->conn = $conn;
        $this->id = $id;
        $this->task_name = $task_name;
        $this->task_description = $task_description;
        $this->submit_date = $submit_date;
    }

    public function update() {
        $sql = "UPDATE task_tasks SET  task_name='$this->task_name', task_description='$this->task_description' , submit_date='$this->submit_date' WHERE id=$this->id";

        if ($this->conn->query($sql) === TRUE) {
            echo '<script>window.location.href = "tasks.php";</script>';
        } else {
            echo '<script>window.location.href = "tasks.php";</script>';
        }

        $this->conn->close();
    }
}

$id = $_POST['id'];
$task_name = $_POST['task_name'];
$task_description = $_POST['task_description'];
$submit_date = $_POST['submit_date'];

$task = new Task($conn, $id, $task_name, $task_description, $submit_date);
$task->update();
?>