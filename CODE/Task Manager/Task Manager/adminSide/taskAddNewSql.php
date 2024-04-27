<?php include "adminCheckLogin.php" ?> <!--checking login-->
<?php
include 'config.php';

$task_name = mysqli_real_escape_string($conn, $_POST['task_name']);
$task_description = mysqli_real_escape_string($conn, $_POST['task_description']);
$project_id=$_POST['project_id'];
$employee_id=$_POST['employee_id'];
$priority_level=$_POST['priority_level'];
$submit_date=$_POST['submit_date'];

$sql = "INSERT INTO task_tasks (task_name, task_description , project_id ,  employee_id , priority_level , submit_date ) 
VALUES ('$task_name', '$task_description' , '$project_id' , '$employee_id' , '$priority_level' , '$submit_date') ";
 
if ($conn->query($sql) === TRUE) {
   
  $sqlemp = "SELECT * FROM task_employees where id=$employee_id";
    $result = $conn->query($sqlemp);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    $empEmail=$row['email'];
    }
  }


   // Sending verification link //
   $headers = '';
$to = $empEmail;
$subject = $task_name;

// Create the HTML message content using the template
$template = '
<!DOCTYPE html>
<html>
<head>
    <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
  }
  .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
  }
  h2 {
      color: #333333;
      font-size: 24px;
      margin-bottom: 20px;
  }
  p {
      color: #666666;
      font-size: 16px;
      margin-bottom: 10px;
  }
  .task-details {
      margin-bottom: 30px;
  }
  .task-details h3 {
      color: #333333;
      font-size: 20px;
      margin-bottom: 10px;
  }
  .task-details p {
      color: #666666;
      font-size: 16px;
      margin-bottom: 5px;
  }
    </style>
</head>
<body>
    <div class="container">
        <h2>A new task has been assigned to you. Please log in to your portal to check the task details.</h2>
        <a href="https://task.muftienterprises.com/userSide/userLoginForm.php" class="btn btn-lg btn-primary">Login</a>
       
        <div class="task-details">
            <h3>Task Details:</h3>
            <p><strong>Task:</strong> ' . $task_name . '</p>
            <p><strong>Description:</strong> ' . $task_description . '</p>
            
        </div>
        <p>Thank you for your attention.</p>
        
    </div>
</body>
</html>
';

// Decode the HTML entities
$message = html_entity_decode($template);

// Set the headers for the email
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: nadirarainz@gmail.com' . "\r\n";
$headers .= 'Cc: myboss@example.com' . "\r\n";

// Send the email
mail($to, $subject, $message, $headers);

   

   
   echo '<script>window.location.href = "tasks.php";</script>';
} else {
  echo '<script>window.location.href = "tasks.php";</script>';
}
 
$conn->close();

?>