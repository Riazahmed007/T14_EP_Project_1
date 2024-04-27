<?php include "adminCheckLogin.php" ?> <!--checking login-->
<?php
if(isset($_GET['success'])){
  $success=$_GET['success'];
 }
?> 
<?php
 include 'config.php';
      $user=$_COOKIE['userName'];
      $sql = "SELECT * FROM task_employees where emp_username='{$user}'"; 
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
        
        while($row = $result->fetch_assoc()) {
            $id=$row['id'];
          
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
  <title>Pending Tasks</title>
  <?php include "../topcdn.php" ?>
  </head>
  <body class="sectionimg" >



  <div class="container-fluid ">
    <div class="row flex-nowrap">
      <?php include "nav.php" ?>
        <!-- ------------------------------------ content start -------------------------------  -->

        <div class="col py-3  ">
       <div class="container">

        <!-- Mobile Toggle Button -->
        <div class="mobile-toggle-icon ms-2">
            <div class="toggle-icon mt-2 mb-4" onclick="toggleSidebar()">
                <i class="bi bi-list fs-3"></i>
            </div>
        </div>

        <div class="row">
      


  <!-- ------------------------------ tab -------------------------------  -->
  <div class="col-lg-12">
  <div class="row">
    <!-- -----  -->
    <div class="col-lg-12">
          <div class="card cardz shadow">
          <div class="card-header  p-3">
            <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Pending</h5>
          </div>
          <div class="card-body" data-mdb-perfect-scrollbar="true" >
            <div class="table-responsive">
          <table class="table mb-0 table1">
          <thead>
                <tr class="">
                  <th  width="20%" class="text-secondary" >Title</th>
                  <th  width="30%" class="text-center text-secondary">Deadline</th>
                  <th  width="5%" class="text-center text-secondary">Priority</th>
                  <th  width="30%" class="text-center text-secondary">View</th>
                
                </tr>
              </thead>
          <!-- Table Body  -->
           <tbody> 

            <?php

                include 'config.php';
                $counter=1;
              
                $employee_id=$id;
                $sql = "SELECT * FROM task_tasks WHERE employee_id=$employee_id AND task_status=0 ORDER BY id DESC"; 

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
                    $days=' <h6 class="mb-0"><span class="badge text-primary  ">'. $days.'Day Left.</span></h6>';
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
              
                  <td width="40%" class="text-center align-middle"><h6 class="mb-0"><span class="badge text-primary  ">'.$days.'</span></h6></td>
    
                  <td width="10%" class="text-center align-middle">
                  <h6 class="mb-0"><span class="badge text-center ' . $priorityClass . '">' . $row['priority_level'] . '</span></h6>
                  </td>
                  <td width="20%" class="text-center align-middle">
                  <a class="" href="taskView.php?id='.$row['id'].'"><span class="badge text-primary "> View Task</span></a>
                  
                  </td>
                  
                 
                 
                
                  
                </tr>';
                ?>




     <?php 
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
    <!-- -----  -->
   
  </div>
  </div>
  <!-- ------------------------------ tab -------------------------------  -->
                 
   
   




        </div>
       </div>
       </div>
       <!-- ---------------------- content end ------------------------------  -->   
    </div>
</div>

 

  <?php include "../bottomcdn.php" ?>
  </body>
</html>






