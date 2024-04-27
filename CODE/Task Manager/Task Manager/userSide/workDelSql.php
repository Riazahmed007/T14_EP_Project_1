<?php 
include 'config.php';
$id = $_GET['id'] ;
// sql to delete a record
$sql = "DELETE FROM task_work WHERE id=$id";

if ($conn->query($sql) === TRUE) {

  echo '<script>window.location.href = "userDashboard.php";</script>';
} else {
  echo '<script>window.location.href = "userDashboard.php";</script>';
}

$conn->close();
 ?>