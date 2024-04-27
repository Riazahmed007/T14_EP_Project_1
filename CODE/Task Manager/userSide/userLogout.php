<?php
// Set the cookie expiration time to a time in the past
$expiration_time = time() - 3600; // Subtracting one hour (3600 seconds)

// Set the cookie with the expired time
setcookie('userLogin', '', $expiration_time, '/');
setcookie('userName', '', $expiration_time, '/');

// Alternatively, you can also specify the domain and secure parameters if necessary:
// setcookie('cookie_name', '', $expiration_time, '/', 'example.com', true);

// After setting the cookie with an expired time, you also need to unset it from the $_COOKIE superglobal array
unset($_COOKIE['userLogin']);
unset($_COOKIE['userName']);

echo '<script>window.location.href = "userLoginForm.php";</script>';

?>
