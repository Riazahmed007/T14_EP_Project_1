
<?php 
include 'config.php';
$id = $_GET['id'] ;
// sql to delete a record
$sql = "DELETE  FROM task_employees WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  echo '<script>window.location.href = "location:employees.php";</script>';
} else {
  echo '<script>window.location.href = "location:employees.php";</script>';
}

$conn->close();
 ?>