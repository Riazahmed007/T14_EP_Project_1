<?php include "adminCheckLogin.php" ?> <!--checking login-->
<?php
include 'config.php';
$id=$_POST['id'];
$name=$_POST['name'];
$url=$_POST['url'];
$country=$_POST['country'];

$sql = "UPDATE task_projects SET  name='$name', url='$url' , country='$country' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  echo '<script>window.location.href = "projects.php?success=4";</script>';

} else {
  echo '<script>window.location.href = "projects.php?success=4";</script>';
}

$conn->close();
?>