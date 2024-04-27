<?php include "adminCheckLogin.php" ?> <!--checking login-->
<?php
include 'config.php';


$name=$_POST['name'];
$url=$_POST['url'];
$country=$_POST['country'];
 

$sql = "INSERT INTO task_projects (name, url , country)
VALUES ('$name', '$url' , '$country')";
 
if ($conn->query($sql) === TRUE) {
  echo '<script>window.location.href = "projects.php?success=2";</script>';

} else {
  echo '<script>window.location.href = "projects.php";</script>';
}
 
$conn->close();

?>