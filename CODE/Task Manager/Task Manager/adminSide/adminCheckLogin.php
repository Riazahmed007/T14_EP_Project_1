<?php
    if (isset($_COOKIE['adminLogin'])) {
        $adminRole = $_COOKIE['adminLogin'];
    }
    else{
        header('location:adminLoginForm.php');
        exit(); 
    }
?>