<?php
include 'config.php';
$id=$_GET['id'];



$sql = "UPDATE task_tasks SET task_status=1 WHERE id=$id ";

if ($conn->query($sql) === TRUE) {
    echo '<script>window.location.href = "completedtasks.php";</script>';
} else {
    echo '<script>window.location.href = "completedtasks.php";</script>';
}

$conn->close();
?>
