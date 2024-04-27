
<?php include "adminCheckLogin.php" ?> <!--checking login-->
<?php
if(isset($_GET['success'])){
  $success=$_GET['success'];
 }
?> 
<?php
 include 'config.php';
    // $username="abd56";
      $user=$_COOKIE['userName'];
      $sql = "SELECT * FROM task_employees where emp_username='{$user}'"; 
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
        
        while($row = $result->fetch_assoc()) {
            $id=$row['id'];
          $name=$row['name'];
          $empUsername=$row['emp_username'];
          $email=$row['email'];
          $phone=$row['phone'];
          $address=$row['address'];
          $designation=$row['designation'];
          $target_file=$row['photo'];

         
          
        }
      } else {
        echo "<div class='alert alert-danger'>No data available</div>";
      }
      $conn->close();
     
    ?>
      
      <?php
    session_start(); 
    $id = $id; 
    $_SESSION['empid'] = $id;
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My Profile</title>
  <?php include "../topcdn.php" ?>
  </head>
  <body class="sectionimg" >


<div class="container-fluid">
    <div class="row flex-nowrap">
    <?php include "nav.php" ?>
        <div class="col py-3">
            <!-- ------------------------------------- content start ------------------------------------ -->

            <div class="container">

             <!-- Mobile Toggle Button -->
             <div class="mobile-toggle-icon ms-2">
            <div class="toggle-icon mt-2 mb-4" onclick="toggleSidebar()">
                <i class="bi bi-list fs-3"></i>
            </div>
        </div>
 
        
        <div class="row">
        <div class="d-flex justify-content-between">
        <h2 class="pb-2 heading">Welcome! <?php echo $name; ?></h2>
   
        
       
        
        
        </div>
 
       <div class="col-md-4 ">
              <div class="card cardz shadow">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?php echo $target_file ?>" alt="Admin" class="rounded-circle empprofileimg" >
                    <div class="mt-3">
                     <strong class="text-muted">@<?php echo $empUsername; ?></strong><br>
                    <a  class=" buttons text-dark fw-bold mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $id ?>" href="">Update Profile Picture</a>
                 
                    
                    </div>
                  </div>
                </div>
              </div>
              </div>
         <?php 
            if(isset($success)){
              if($success==5){
                echo '<div class="alert alert-success">Updated Successfully</div>';
              }
              
            }
          ?>
    <!-- ------------------------------------ Update modal code starts ------------------------------------  -->
         <!-- Modal -->
         <div class="modal fade" id="exampleModal<?php echo $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg ">
                  <div class="modal-content shadow-lg" style="border-radius: 1rem;">
                 
                  <div class="modal-body">
                  <h1 class="modal-title fs-3 text-center text-secondary fw-bold mt-2" id="exampleModalLabel">Update Profile Image</h1>
                  <div class="card-body p-5 text-center">
                  <!-- <h2 class="mb-5 fw-bold lh-1">Sign in</h3> -->
                  <form action="empimgUpdateSql.php" method="post" enctype="multipart/form-data" class="mb-4">
                    <h5 class="d-flex justify-content-start fw-bold text-secondary">Update Image</h5>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="photo" value="<?php echo $target_file; ?>">
                  <div class="form-outline mb-4">
                <input type="file" class="form-control transparent-input" name="fileToUpload"  placeholder="Upload Image" id="fileToUpload" required >
                </div>
                
                  <div class="d-grid gap-2">
                  <input type="submit" class="btn btn-outline-secondary text-light " >
                  </div>
                  </form>
                  </div>
                  </div>
                  </div>
                  </div>
                  </div>
     <!-- ------------------------------------ Update modal code end ------------------------------------  -->
  
            

       <div class="col-md-8">
              <div class="card cardz shadow mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0 text-secondary">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $name ?>
                    </div>
                  </div>
                  <hr class="text-secondary">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0 text-secondary">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <a href="mailto: <?php echo $email ?>" class="text-secondary text-decoration-none"> <?php echo $email ?></a>
                    </div>
                  </div>
                  <hr class="text-secondary">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0 text-secondary">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <a href="https://api.whatsapp.com/send?phone=<?php echo $phone ?>" class="text-secondary text-decoration-none"><?php echo $phone ?></a>
                    </div>
                  </div>
                  <hr class="text-secondary">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0 text-secondary">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $address ?>
                    </div>
                  </div>
                  <hr class="text-secondary">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0 text-secondary">Designation</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $designation ?>
                    </div>
                  </div>
                  <hr class="text-secondary">
                 
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- ----------------------------------------- progress bars ----------------------------------  -->
        <div class="container">
        <div class="row">
    
        <div class="col-lg-12">
       <div class="counter card cardz shadow py-3">
                    <div class="row">
                        <div class="col-6 col-lg-4">
                            <div class="count-data text-center text-secondary">
                                <h6 class="count h2" data-to="500" data-speed="500">
                                <?php
                                    include 'config.php';
                                    $employee_id=$id;
                                      $sql = "SELECT COUNT(id) AS task_count FROM task_tasks WHERE employee_id=$employee_id AND task_status=1";
                                      $result = $conn->query($sql);

                                          if ($result->num_rows > 0) {
                                          // output data of each row
                                          $counter=1;
                                          while($row = $result->fetch_assoc()) {
                                          echo $row['task_count'];
                                          }
                                          } else {
                                          echo "<div class='alert alert-danger'>No data available</div>";
                                          }
                                      $conn->close();
                                    ?>
                                </h6>
                                <p class="m-0px font-w-600">Completed Tasks</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4">
                            <div class="count-data text-center text-secondary">
                                <h6 class="count h2" data-to="150" data-speed="150">
                                <?php
                                    include 'config.php';
                                    $employee_id=$id;
                                      $sql = "SELECT COUNT(id) AS task_count FROM task_tasks WHERE employee_id=$employee_id AND task_status=0 ";
                                      $result = $conn->query($sql);

                                          if ($result->num_rows > 0) {
                                          // output data of each row
                                          $counter=1;
                                          while($row = $result->fetch_assoc()) {
                                          echo $row['task_count'];
                                          }
                                          } else {
                                          echo "<div class='alert alert-danger'>No data available</div>";
                                          }
                                      $conn->close();
                                    ?>
                                </h6>
                                <p class="m-0px font-w-600">Pending Tasks</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4">
                            <div class="count-data text-center text-secondary">
                                <h6 class="count h2" data-to="850" data-speed="850">
                                <?php
                                    include 'config.php';
                                    $employee_id=$id;
                                      $sql = "SELECT COUNT(id) AS task_count FROM task_tasks WHERE employee_id=$employee_id AND task_status=2 ";
                                      $result = $conn->query($sql);

                                          if ($result->num_rows > 0) {
                                          // output data of each row
                                          $counter=1;
                                          while($row = $result->fetch_assoc()) {
                                          echo $row['task_count'];
                                          }
                                          } else {
                                          echo "<div class='alert alert-danger'>No data available</div>";
                                          }
                                      $conn->close();
                                    ?>
                                </h6>
                                <p class="m-0px font-w-600"> In Progress</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
    </div>



   



                 
   
   
                  </div>
                </div>
               
              </div>
              </div>
              </div>
        <!-- ----------------------------------------- progress bars ----------------------------------  -->




        </div>
       </div>

            <!-- ------------------------------------- content end ------------------------------------ -->
        </div>
    </div>
</div>
 

  <?php include "../bottomcdn.php" ?>
  </body>
</html>






