<?php include "adminCheckLogin.php" ?> <!--checking login-->
<?php
include 'config.php';
$id=$_POST['id'];
$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$address=$_POST['address'];
$designation=$_POST['designation'];

$sql = "UPDATE task_employees SET  name='$name', email='$email' , phone='$phone' , address='$address' , designation='$designation' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  echo '<script>window.location.href = "employees.php?success=5";</script>';
} else {
  echo '<script>window.location.href = "employeesProfile.php";</script>';

}

$conn->close();
?>