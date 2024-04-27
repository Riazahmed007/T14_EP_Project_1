<?php
include 'config.php';
$token=$_POST['token'];
$password=$_POST['pass'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "UPDATE task_employees SET  emp_pass='$hashed_password' WHERE token='{$token}'";

if ($conn->query($sql) === TRUE) {
   
    header ('location:userLoginForm.php?success=3'); 
} else {
    header ('location:userLoginForm.php'); 
}

$conn->close();
?>