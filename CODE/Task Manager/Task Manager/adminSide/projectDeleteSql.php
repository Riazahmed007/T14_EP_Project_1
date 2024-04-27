<?php include "adminCheckLogin.php" ?> <!--checking login-->
<?php 
include 'config.php';
$id = $_GET['id'] ;
// sql to delete a record
$sql = "DELETE FROM task_projects WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  echo '<script>window.location.href = "projects.php?success=3";</script>';

} else {
  echo '<script>window.location.href = "projects.php";</script>';
}

$conn->close();
 ?>