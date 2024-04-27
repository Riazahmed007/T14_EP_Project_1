<?php
if(isset($_GET['success'])){
  $success=$_GET['success'];
 }
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Task Manager</title>
  <?php include "../topcdn.php" ?>
  </head>
  <body >
  
<section class="vh-100 sectionimg" >
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card cardz shadow-lg " style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <img src="../assets/imgs/logo.jpg" alt="" class="img-fluid mb-4" style="height: 90px;" >
            <?php 
            if(isset($success)){
              if($success==0){
                echo '<div class="alert alert-danger">incorrect username or password</div>';
              }
              if($success==1){
                echo '<div class="alert alert-danger">Incorrect Username</div>';
              }
              if($success==2){
                echo '<div class="alert alert-success">Password changed Successfully</div>';
              }
              if($success==3){
                echo '<div class="alert alert-success">Password Updated Successfully ! </div>';
              }
              if($success==4){
                echo '<div class="alert alert-success">Success! We have sent a verification link to your email address. Click on the link to reset your password. </div>';
              }
              if($success==5){
                echo '<div class="alert alert-danger">Username Not Found</div>';
              }
            }
          ?>
            <!-- <h2 class="mb-5 fw-bold lh-1">Sign in</h3> -->
           <form action="userLoginSql.php" method="post">
            <div class="form-outline mb-4">
              <input type="text" name="username" id="typeEmailX-2" placeholder="Username" class="form-control form-control-lg transparent-input text-secondary" />
            </div>

            <div class="form-outline mb-4">
              <input type="password" name="pass" id="typePasswordX-2" placeholder="Password" class="form-control form-control-lg transparent-input text-secondary" />
            </div>

            <!-- Checkbox -->
          
          

                <div class="d-grid gap-2 mb-3">
              <input type="submit" class="btn btn-primary mb-3" value="Login">
                </div>

                <div class="mt-3 d-flex justify-content-between">
                 <a href="userForget.php" class="text-secondary">Forgot password?</a>
              </div>
              
              </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>


 

  <?php include "../bottomcdn.php" ?>
  </body>
</html>