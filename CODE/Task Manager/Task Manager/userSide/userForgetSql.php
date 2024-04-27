<?php
include 'config.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
// $email = mysqli_real_escape_string($conn, $_POST['email']);

$sql = "SELECT * FROM task_employees  WHERE emp_username='{$username}'" ;
$result = $conn->query($sql);

$token= md5(uniqid());

if ($result->num_rows > 0) {
    $sql = "UPDATE task_employees SET  token='{$token}' WHERE emp_username='{$username}'";
    if ($conn->query($sql) === TRUE) {
    
        // Sending forgot passwors link //
        $to = $email;
        $subject = "Forgot Password Link";
        $message = "<a href='verifyForgetPass.php?token=".$token."'>Reset Your Password</a>";
        // More headers
        $headers .= 'From: <webmaster@example.com>' . "\r\n";
        $headers .= 'Cc: myboss@example.com' . "\r\n";
        mail($to,$subject,$message,$headers);



        header ('location:userLoginForm.php?success=4'); 
     } else {
        header ('location:forgetpass.php?success=5' ); // email not found
     }
} 
else {
  header ('location:forgetpass.php?success=5' ); // email not found
}
  $conn->close();
?>
