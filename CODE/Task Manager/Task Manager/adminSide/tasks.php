<?php include "adminCheckLogin.php" ?> <!--checking login-->
<?php
      include 'config.php';
    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tasks</title>
  <?php include "../topcdn.php" ?>
  </head>
  <body class="sectionimg" >



  <div class="container-fluid ">
    <div class="row flex-nowrap">
      <?php include "nav.php" ?>
        <!-- ------------------------------------ content start -------------------------------  -->
        <div class="col  py-3 content " id="tasks-content">
          <div class="container">
              <div class="mb-3 sticky-header fixed d-flex justify-content-between">
                <h2 class="heading ">Tasks Management</h2>
                <button type="button" class="text-light fw-bold me-2 btnn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Add New Task
                </button>
              </div>
              <!-- Mobile Toggle Button -->
              <div class="mobile-toggle-icon ms-2">
            <div class="toggle-icon mt-2 mb-4" onclick="toggleSidebar()">
                <i class="bi bi-list fs-3"></i>
            </div>

        </div>

        <!-- ------ Table Start -------------------------------  -->
       
            <table class="table-container table table-responsive  card  shadow-lg p-3" style="border-radius:17px">
              
     
  
    <!-- ------------------------ insert modal start ------------------------  -->

 
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg " >
      <div class="modal-content shadow-lg" style="border-radius: 1rem;">
        <div class="modal-body">
          <h1 class="fs-3 text-center text-secondary fw-bold mt-2" id="exampleModalLabel">Add New Task</h1>

            <div class="card-body p-5 text-center">
                <form action="taskAddNewSql.php" method="post" >
                  <div class="row">
                  <div class="col-md-12 form-group">
                  <input type="text" name="task_name" class="form-control form-control-lg transparent-input text-secondary"  placeholder="Task Title" required>
                  </div>
                  </div>


                  <div class="row">
                  <div class="col-md-12 form-group mt-3">
                    <select name="project_id" id="department" class="form-control">
                     <option value="">Select Project</option>
                      <?php
                      $sql = "SELECT * FROM task_projects ";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                      echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                      }
                      }
                      ?>
                    </select>
                  </div>
                  </div>

                  <div class="row">
                  <div class="col-md-6 form-group mt-3">
                    <select name="employee_id" id="department" class="form-control">
                    <option value="">Select Employee</option>
                      <?php
                      $sqlemp = "SELECT * FROM task_employees ";
                      $result = $conn->query($sqlemp);
                      if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                      echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                 
                      }
                      }
                      ?>
                    </select>
                  </div>

                    <div class="col-md-6 form-group mt-3 ">
                      <select name="priority_level" id="department" class="form-control">
                      <option value="">Priority Level</option>
                      <option value="High Priority">High Priority</option>
                      <option value="Priority">Priority</option>
                      <option value="Normal">Normal</option>
                      </select>
                    </div>
                  </div>
                  <div class="row"> 

                    <div class="col-md-12 form-group mt-3">
                    <label class="form-label d-flex justify-content-start text-secondary" for="formControlReadonly">Task Deadline</label>
                    <input type="date" name="submit_date" class="form-control datepicker form-control form-select  transparent-input  text-secondary" id="date" placeholder="Assign date" required>
                    </div>

                  </div>

                    <div class="form-group mt-3">
                    <textarea  id="editor" name="task_description" class=" form-control form-select  transparent-input text-dark text-secondary" ></textarea>
                    </div>

                    <div class="d-grid gap-2 mt-3">
              <input type="submit" value="Assign" class="btn btn-primary" >
                </div>
                </form>

            </div>
        </div>
      </div>
    </div>
  </div>
        <!-- ------------------------ insert modal end ------------------------  -->

         
            <?php 
            if(isset($success)){
              if($success==2){
                echo '<div class="alert alert-success">New Project added</div>';
              }
              if($success==4){
                echo '<div class="alert alert-success">Data Updated Successfully</div>';
              }
              if($success==3){
                echo '<div class="alert alert-danger">Deleted Successfully</div>';
              }
            }
          ?>
         <!-- Table header  -->
              <thead>
                <tr class="">
                  <th scope="col" width="15%" class="text-secondary">Task</th>
                  <th scope="col" width="12%" class="text-secondary">Project</th>
                  <th scope="col" width="20%" class="text-secondary">Staff Member</th>
                  <th scope="col" width="10%" class="text-center text-secondary">Priority</th>
                  <th scope="col" width="5%" class="text-center text-secondary">Deadline</th>
                  <th scope="col" width="5%" class="text-center text-secondary">Status</th>
                  <th scope="col" width="10%" class="text-center text-secondary">Action</th>
                </tr>
              </thead>
          <!-- Table Body  -->
           <tbody> 

            <?php

                include 'config.php';

                $sql = "SELECT * FROM task_tasks ORDER BY id DESC ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                $counter=1;
                $ck_counter=1;
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
                  $taskStatus=$row['task_status'];
                  if($taskStatus==0){
                    $taskStatus='<i class="bi bi-clock-fill text-danger">Pending</i> ';
                  }
                  else{
                    if($taskStatus==2){
                      $taskStatus='<i class="bi bi-hourglass-split text-primary">Working</i>';
                    }
                    else{
                      $taskStatus='<i class="bi  bi-check-circle-fill fw-bold text-success">Completed</i>';
                    }
                    
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
          

                  echo'<tr class="">
                  
                  <td width="20%" class="text-secondary">'.$row['task_name'].'</td>';

                  $proId=$row['project_id'];

                  $sqlpro = "SELECT * FROM task_projects where id=$proId";
                  $resultpro = $conn->query($sqlpro);
                  if ($resultpro->num_rows > 0) {
                    while($rowpro = $resultpro->fetch_assoc()) {
                      echo '<td width="10%" class="text-secondary">'.$rowpro['name'].'</td>';
                    }
                  }

                  $empId=$row['employee_id'];

                  $sqlemp = "SELECT * FROM task_employees where id=$empId";
                  $resultemp = $conn->query($sqlemp);
                  if ($resultemp->num_rows > 0) {
                    while($rowemp = $resultemp->fetch_assoc()) {
                      echo '<td width="15%" class="text-secondary">'.$rowemp['name'].'</td>';
                    }
                  }
                    
                  echo'
                  
                  <td width="10%">
                  <h6 class="mb-0"><span class="badge ' . $priorityClass . '">' . $row['priority_level'] . '</span></h6>
                  </td>
              
                  <td width="20%" class="text-center">    <h6 class="mb-0"><span class="badge text-primary  ">'.$days.'</span></h6></td>
                  <td width="5%"  class="text-center">'.$taskStatus.'</td>

                  '; ?>
                  <td width="20%" class="text-center">

                  <div class="dropdown pb-4">
                    <a href="#" class="btn btn-primary text-white d-flex align-items-center text-decoration-none dropdown-toggle"
                       id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="d-sm-inline  text-white">Action</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                      <li><a class="dropdown-item" href="taskView.php?id=<?php echo $row['id']; ?>">View Task</a>
                      </li>
                      <?php if($_COOKIE['adminLogin']==1){ ?>
                      <li><a class="dropdown-item" href="taskUpdate.php?id=<?php echo $row['id']; ?>">Update</a></li>
                      <li><a class="dropdown-item" href="#"onclick="confirmDelete('taskDeleteSql.php?id=<?php echo $row['id']; ?>')">Delete</a></li>
                    </ul>
                                  <?php } ?>

                </div>
                 </td>


                  <?php echo '

                  </tr>' ;
                  ?>
                  
       

    


    
                   
                  <?php
                  $counter++;
                  $ck_counter++;
                }

                } else {
                echo "<div class='alert alert-danger'>No data available</div>";
                }
                $conn->close();
                ?>

         </tbody>
        </table>
       

  
</div>



  

        <!-- -------------------------------------  -->
        </div>
    </div>
</div>

 

  <?php include "../bottomcdn.php" ?>
  </body>
</html>






<script>
  ClassicEditor
    .create(document.querySelector('#editor'))
    .then(editor => {
      console.log('Editor initialized:', editor);
    })
    .catch(error => {
      console.error('Error initializing editor:', error);
    });


</script>









