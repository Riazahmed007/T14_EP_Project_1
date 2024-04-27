<?php
include 'config.php';
$id=$_GET['id'];


$sql = "UPDATE task_tasks SET task_status=2 WHERE id=$id ";

if ($conn->query($sql) === TRUE) {
    echo '<script>window.location.href = "inprogresstasks.php";</script>';
} else {
    echo '<script>window.location.href = "inprogresstasks.php";</script>';
}

$conn->close();
?>
