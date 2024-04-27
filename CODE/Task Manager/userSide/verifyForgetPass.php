<?php
      include 'config.php';
      $token=$_GET['token'];
      $sql = "SELECT * FROM task_employees where token='{$token}'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
       
      } else {
        header ('location:userLoginForm.php');
        exit();
      } 
      $conn->close();
    ?>
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
        <div class="card shadow-lg " style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <img src="../assets/imgs/logoblue.png" alt="" class="img-fluid mb-4" style="height: 90px;" >
            <?php 
            if(isset($success)){
              if($success==1){
                echo '<div class="alert alert-danger">incorrect email or password</div>';
              }
            }
          ?>
            <!-- <h2 class="mb-5 fw-bold lh-1">Sign in</h3> -->
           <form action="verifyForgetPassSql.php" method="post">
          

            <div class="form-outline mb-4">
            <input type="password" id="form2Example2" class="form-control" placeholder="New Password" name="pass" />
            </div>

            <div class="form-outline mb-4">
            <input type="password" id="form2Example2" class="form-control" placeholder="Re-type New Password" name="repass" />
            </div>

          

                <div class="d-grid gap-2">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
              <input type="submit" class="btn text-light " style="background-color: #22abe3;">
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
