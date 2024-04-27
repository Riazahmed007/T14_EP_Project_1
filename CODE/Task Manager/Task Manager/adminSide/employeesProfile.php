<?php include "adminCheckLogin.php" ?> <!--checking login-->
<?php
if(isset($_GET['success'])){
  $success=$_GET['success'];
 }
?> 
<?php
 include 'config.php';
    $id=$_GET['id'];
      $sql = "SELECT * FROM task_employees where id=$id"; 
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // output data of each row
        
        while($row = $result->fetch_assoc()) {
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


<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Employee Profile</title>
  <?php include "../topcdn.php" ?>
  </head>
  <body class="sectionimg" >



  <div class="container-fluid ">
    <div class="row flex-nowrap">
      <?php include "nav.php" ?>
        <!-- ------------------------------------ content start -------------------------------  -->

        <div class="col  py-3 content ">
          <div class="container">
              
              <!-- Mobile Toggle Button -->
              <div class="mobile-toggle-icon ms-2">
            <div class="toggle-icon mt-2 mb-4" onclick="toggleSidebar()">
                <i class="bi bi-list fs-3"></i>
            </div>
        </div>

        <div class="row">
        <div class="d-flex justify-content-between">
        <h2 class="pb-2 heading">Employee Profile</h2>
   
        
       
    
        
        </div>
 
       <div class="col-md-4 ">
              <div class="card cardz shadow">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?php echo $target_file ?>" alt="Admin" class="rounded-circle empprofileimg" >
                    <div class="mt-3">
                     <strong class="text-muted">@<?php echo $empUsername; ?></strong><br>
                    <a  class=" buttons text-light fw-bold mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $id ?>" href="">Update</a>
                 
                    
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
                  
                  <div class="container">
                 
                  </div>

                  <div class="card-body p-5 text-center">
                  <div class="d-flex justify-content-between">
                  <h1 class="modal-title fs-3 text-center fw-bold mt-2" id="exampleModalLabel">Update Project</h1>
   
                 <a class="" href="#" onclick="confirmUserDelete('empDelete.php?id=<?php echo $id ?>')"  ><i class="bi bi-trash-fill fs-3 me-2 text-danger"></i></a>
        
                </div>
                <hr>
                  <!-- <h2 class="mb-5 fw-bold lh-1">Sign in</h3> -->
                  <form action="empimgUpdateSql.php" method="post" enctype="multipart/form-data" class="mb-4">
                    <h5 class="d-flex justify-content-start fw-bold">Update Image</h5>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="photo" value="<?php echo $target_file; ?>">
                  <div class="form-outline mb-4">
                <input type="file" class="form-control" name="fileToUpload"  placeholder="Upload Image" id="fileToUpload" required >
                </div>
                
                  <div class="d-grid gap-2">
                  <input type="submit" class="btn text-light " style="background-color: #22abe3;">
                  </div>
                  </form>

                  <form action="empContentUpdateSql.php" method="post">
                    <h5 class="d-flex justify-content-start fw-bold">Update Content</h5>
                  <input type="hidden" name="id" value="<?php echo $id ?>"  />
                  <div class="form-outline mb-4">
                  <input type="text" name="name" value="<?php echo $name ?>" placeholder=" Name" class="form-control form-control-lg" />
                  </div>
                  <div class="form-outline mb-4">
                  <input type="text" name="email" value="<?php echo $email ?>" placeholder="Email" class="form-control form-control-lg" />
                  </div>
                  <div class="form-outline mb-4">
                  <input type="text" name="phone" value="<?php echo $phone ?>" placeholder="Phone" class="form-control form-control-lg" />
                  </div>
                  <div class="form-outline mb-4">
                  <input type="text" name="address" value="<?php echo $address ?>" placeholder="Address" class="form-control form-control-lg" />
                  </div>
                  <div class="form-outline mb-4">
                  <input type="text" name="designation" value="<?php echo $designation ?>" placeholder="Designation" class="form-control form-control-lg" />
                  </div>
                  <div class="d-grid gap-2">
                  <input type="submit" class="btn text-light " style="background-color: #22abe3;">
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
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0 text-secondary">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <a href="mailto: <?php echo $email ?>" class="text-secondary text-decoration-none"> <?php echo $email ?></a>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0 text-secondary">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <a href="https://api.whatsapp.com/send?phone=<?php echo $phone ?>" class="text-secondary text-decoration-none"><?php echo $phone ?></a>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0 text-secondary">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $address ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0 text-secondary">Designation</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $designation ?>
                    </div>
                  </div>
                  <hr>
                 
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
                            <div class="count-data text-center">
                                <h6 class="count h2 text-secondary" data-to="500" data-speed="500">
                                <?php
                                    include 'config.php';
                                    $employee_id=$_GET['id'];
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
                                <p class="m-0px font-w-600 text-secondary">Completed Tasks</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4">
                            <div class="count-data text-center">
                                <h6 class="count h2 text-secondary" data-to="150" data-speed="150">
                                <?php
                                    include 'config.php';
                                    $employee_id=$_GET['id'];
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
                                <p class="m-0px font-w-600 text-secondary">Pending Tasks</p>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4">
                            <div class="count-data text-center">
                                <h6 class="count h2 text-secondary" data-to="850" data-speed="850">
                                <?php
                                    include 'config.php';
                                    $employee_id=$_GET['id'];
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
                                <p class="m-0px font-w-600 text-secondary"> In Progress</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
    </div>
    <!-- ------------------------------------------------------------------------------------->

  <!-- ------------------------------ tab -------------------------------  -->
  <div class="col-lg-12">
  <div class="row">
    <!-- -----  -->
    <div class="col-lg-12">
          <div class="card cardz shadow">
          <div class="card-header p-3">
            <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>In Progress</h5>
          </div>
          <div class="card-body" data-mdb-perfect-scrollbar="true" >
          <table class="table mb-0 table1">
          <thead>
                <tr class="">
                  <th  width="20%" class="text-secondary" >Title</th>
                  <th  width="20%" class="text-center text-secondary">Deadline</th>
                  <th  width="5%" class="text-center text-secondary">Priority</th>
                </tr>
              </thead>
          <!-- Table Body  -->
           <tbody> 

            <?php

                include 'config.php';
              
                $employee_id=$_GET['id'];
                $sql = "SELECT * FROM task_tasks WHERE task_status=2 AND employee_id=$employee_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                $counter=1;
                while($row = $result->fetch_assoc()) {
                  
                  $submitDate=$row['submit_date'];
                  $submitDate=date_create($submitDate);
                  $submitDate=date_format($submitDate, 'd-M-Y');


                    $expiryDate = $submitDate; // Replace with your expiry date
                    $currentDate = new DateTime();
                    $expiryDateObj = new DateTime($expiryDate);
                    $interval = $currentDate->diff($expiryDateObj);
                    $days = $interval->days;
                  if($days<1){
                    $days=' <h6 class="mb-0"><span class="badge text-danger w-100 ">Deadline Expired</span></h6>';
                  }
                  else{
                    $days=' <h6 class="mb-0"><span class="badge text-primary  ">'. $days.' Day Left.</span></h6>';
                  }
                  

                
              //  priority class dynamic CSS 
                  $priorityClass = '';
                  switch ($row['priority_level']) {
                      case 'High Priority':
                          $priorityClass = 'bg-danger w-100 ';
                          break;
                      case 'Priority':
                          $priorityClass = 'bg-warning text-dark w-100 ';
                          break;
                      case 'Normal':
                          $priorityClass = 'bg-secondary w-100 ';
                          break;
                      default:
                          $priorityClass = 'bg-info w-100 ';
                          break;
                  }
          
                  
                  echo'<tr >
                  
                  <td width="20%"  class="align-middle text-secondary" >'.$row['task_name'].'</td>
              
                  <td width="30%" class="text-center align-middle"><h6 class="mb-0"><span class="badge text-primary  ">'.$days.'</span></h6></td>
    
                  <td width="5%" class="text-center align-middle">
                  <h6 class="mb-0"><span class="badge text-center ' . $priorityClass . '">' . $row['priority_level'] . '</span></h6>
                  </td>
                 
                
                  
                </tr>';
   
                $counter++;
                }
                
                } else {
                echo "<div class='alert alert-danger'>No data available</div>";
                }
                $conn->close();
                ?>

         </tbody>
        </table>
          </div>
        </div>
    </div>
    <!-- -----  -->

    <div class="col-lg-6">
          <div class="card cardz shadow">
          <div class="card-header p-3">
            <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Pending Tasks</h5>
          </div>
          <div class="card-body" data-mdb-perfect-scrollbar="true" >
          <table class="table mb-0 table1">
          <thead>
                <tr class="">
                  <th  width="20%" class="text-secondary" >Title</th>
                  <th  width="20%" class="text-center text-secondary">Deadline</th>
                  <th  width="15%" class="text-center text-secondary">Priority</th>
                </tr>
              </thead>
          <!-- Table Body  -->
           <tbody> 

            <?php

                include 'config.php';
              
                $employee_id=$_GET['id'];
                $sql = "SELECT * FROM task_tasks WHERE task_status=0 AND employee_id=$employee_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                $counter=1;
                while($row = $result->fetch_assoc()) {
                  
                  $submitDate=$row['submit_date'];
                  $submitDate=date_create($submitDate);
                  $submitDate=date_format($submitDate, 'd-M-Y');


                    $expiryDate = $submitDate; // Replace with your expiry date
                    $currentDate = new DateTime();
                    $expiryDateObj = new DateTime($expiryDate);
                    $interval = $currentDate->diff($expiryDateObj);
                    $days = $interval->days;
                  if($days<1){
                    $days=' <h6 class="mb-0"><span class="badge text-danger w-100 ">Deadline Expired</span></h6>';
                  }
                  else{
                    $days=' <h6 class="mb-0"><span class="badge text-primary  ">'. $days.' Day Left.</span></h6>';
                  }
                  

                
              //  priority class dynamic CSS 
                  $priorityClass = '';
                  switch ($row['priority_level']) {
                      case 'High Priority':
                          $priorityClass = 'bg-danger w-100 ';
                          break;
                      case 'Priority':
                          $priorityClass = 'bg-warning text-dark w-100 ';
                          break;
                      case 'Normal':
                          $priorityClass = 'bg-secondary w-100 ';
                          break;
                      default:
                          $priorityClass = 'bg-info w-100 ';
                          break;
                  }
          
                  
                  echo'<tr >
                  
                  <td width="20%"  class="align-middle text-secondary" >'.$row['task_name'].'</td>
              
                  <td width="30%" class="text-center align-middle"><h6 class="mb-0"><span class="badge text-primary  ">'.$days.'</span></h6></td>
    
                  <td width="15%" class="text-center align-middle">
                  <h6 class="mb-0"><span class="badge text-center ' . $priorityClass . '">' . $row['priority_level'] . '</span></h6>
                  </td>
                 
                
                  
                </tr>';
   
                $counter++;
                }
                
                } else {
                echo "<div class='alert alert-danger'>No data available</div>";
                }
                $conn->close();
                ?>

         </tbody>
        </table>
          </div>
        </div>
    </div>
    <!-- ------------------------------------------ table 2 ----------------------------------------------  -->
    <div class="col-lg-6">
          <div class="card cardz shadow">
          <div class="card-header p-3">
            <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Completed Tasks</h5>
          </div>
          <div class="card-body" data-mdb-perfect-scrollbar="true" >

            <table class="table mb-0">
              <thead>
                <tr>
                  <th scope="col" width="60%" class="text-secondary">Task</th>
                  <th scope="col" width="20%" class="text-center text-secondary">Start Date</th>
                  <th scope="col" width="20%" class="text-center text-secondary">End Date</th>
                </tr>
              </thead>
              <tbody>
                
              <?php

                include 'config.php';
              
                $employee_id=$_GET['id'];
                $sql = "SELECT * FROM task_tasks  WHERE  task_status=1 AND employee_id=$employee_id ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                $counter=1;
                while($row = $result->fetch_assoc()) {
                  
                  $submitDate=$row['submit_date'];
                  $assignDate=$row['assign_date'];

                  $submitDate= date_create($row['submit_date']);
                  $submitDate = date_format($submitDate, 'd-M-y');
               
                  $assignDate= date_create($row['submit_date']);
                  $assignDate = date_format($assignDate, 'd-M-y');
               
                  

                
          
          
                  
                  echo'<tr >
                  
                  <td width="20%"  class="align-middle text-secondary" >'.$row['task_name'].'</td>
            
                  <td width="15%" class="text-center align-middle">
                 
                  <h6 class="mb-0"><span class="badge text-center text-secondary">' .$assignDate. '</span></h6>
                  </td>

                  <td width="15%" class="text-center align-middle">
                  <h6 class="mb-0"><span class="badge text-center text-secondary">' .$submitDate. '</span></h6>
                  </td>
                
                  
                </tr>';
   
                $counter++;
                }
                
                } else {
                echo "<div class='alert alert-danger'>No data available</div>";
                }
                $conn->close();
                ?>


              </tbody>
            </table>

          </div>
        
        </div>
    </div>
  </div>
  </div>
  <!-- ------------------------------ tab -------------------------------  -->
                 
   
   
                  </div>
                </div>
               
              </div>
              </div>
              </div>
        <!-- ----------------------------------------- progress bars ----------------------------------  -->




        </div>
       </div>
       </div>
       <!-- ---------------------- content end ------------------------------  -->   
    </div>
</div>

 

  <?php include "../bottomcdn.php" ?>
  </body>
</html>






