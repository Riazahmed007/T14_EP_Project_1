<?php
if(!isset($_COOKIE['userLogin'])){
    header('location:userLoginForm.php');
    exit(); 
}
?>
