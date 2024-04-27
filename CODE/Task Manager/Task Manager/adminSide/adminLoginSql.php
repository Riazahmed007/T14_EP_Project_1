<?php
include 'config.php';

// Sanitize user input to prevent SQL injection
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['pass']);

// Construct and execute the SQL query
$sql = "SELECT username, pass, role FROM task_admin WHERE username='$username' AND pass='$password'";
$result = $conn->query($sql);

if ($result === false) {
    // Query execution failed
    echo "Query failed: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        // Fetch user data including role
        $row = $result->fetch_assoc();
        $role = $row['role'];

        // Start the session (if needed) and set session variables here if required

        // Set the adminLogin cookie with both a random value and the role
        $cookieValue = $role; // You can modify this if you want a more complex value
        setcookie('adminLogin', $cookieValue, time() + (86400 * 30), "/");

        // Redirect to the dashboard page
        header("Location: dashboard.php");
        exit();
    } else {
        // Redirect to the login form with a parameter indicating unsuccessful login
        header("Location: adminLoginForm.php?success=0");
        exit();
    }
}

$conn->close();
?>
