<?php
include 'config.php';


$notes=$_POST['notes'];
$task_id=$_POST['task_id'];
$user_id=$_POST['user_id'];



$sql = "INSERT INTO task_notes (notes, task_id , user_id  ) VALUES ('$notes', '$task_id', '$user_id')";
 
if ($conn->query($sql) === TRUE) {
  echo '<script>window.location.href = "taskView.php?id='.$task_id.'";</script>';
} else {
  echo '<script>window.location.href = "taskView.php?id='.$task_id.'";</script>';
}
 
$conn->close();

?>