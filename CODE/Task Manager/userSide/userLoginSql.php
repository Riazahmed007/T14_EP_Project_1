<?php

include 'config.php';

// Sanitize user input to prevent SQL injection
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['pass']);

// Construct and execute the SQL query
$sql = "SELECT emp_username, emp_pass FROM task_employees WHERE emp_username ='$username'";
$result = $conn->query($sql);

if ($result === false) {
    // Query execution failed
    echo "Query failed: " . $conn->error;
} else {
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row["emp_pass"])) {

                // Set the cookie
                setcookie('userLogin', rand(), time() + (86400 * 30), "/");
                setcookie('userName', $username, time() + (86400 * 30), "/");

                // Redirect to the dashboard page
                header("Location: userDashboard.php");
                exit();
            } else {
                header('location:userLoginForm.php?success=0'); // incorrect email or password 
            }
        }
    } else {
        // Redirect to the login form with a parameter indicating unsuccessful login
        header("Location: userLoginForm.php?success=0");
        exit();
    }
}

$conn->close();
?>
