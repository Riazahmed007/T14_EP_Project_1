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
              
              <!-- Mobile Toggle Button -->
              <div class="mobile-toggle-icon ms-2">
            <div class="toggle-icon mt-2 mb-4" onclick="toggleSidebar()">
                <i class="bi bi-list fs-3"></i>
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
          
    

            <?php

                include 'config.php';
                $id=$_GET['id'];

                $sql = "SELECT * FROM task_tasks WHERE id=$id ";
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
                    $days='    <div class="thirteen">
                    <h1>Deadline Expired</h1>
                  </div>';
                  }
                  else{
                    $days=' 
                    <div class="thirteen">
                    <h1>'. $days.' Days Left.</h1>
                  </div>
                    ';
                  }
                  $taskStatus=$row['task_status'];
                  if($taskStatus==0){
                    $taskStatus='<i class="bi bi-clock-fill text-danger" ></i>';
                  }
                  else{
                    if($taskStatus==2){
                      $taskStatus='<i class="bi bi-hourglass-split text-primary" ></i>';
                    }
                    else{
                      $taskStatus='<i class="bi  bi-check-circle-fill fw-bold text-success"></i>';
                    }
                    
                  }
                  

                 
              //  priority class dynamic CSS 
                  $priorityClass = '';
                  switch ($row['priority_level']) {
                      case 'High Priority':
                          $priorityClass = 'bg-danger  ';
                          break;
                      case 'Priority':
                          $priorityClass = 'bg-warning text-dark  ';
                          break;
                      case 'Normal':
                          $priorityClass = 'bg-secondary  ';
                          break;
                      default:
                          $priorityClass = 'bg-info ';
                          break;
                  }
          

                 
                    
               
                  ?>
                  
       

      <!-- ----------------------- modal 3 start ------------------------------------------  -->
      
           
                   
                    <main>

<div class="doc"> <!-- doc start --> 
  <div class="container"> <!-- container start -->
     

    <div class="row mt-2">  
    <div class="col-lg-9"> <!-- col-lg-9 start -->
      <div class="row">

          <div class="col-lg-12">
              <div class=" card bg-white p-3 " style=" background-color:   rgb(233, 238, 255);">  <!--  Card start -->
               
                  <div class="d-flex justify-content-between">

                  <h3 class="text-secondary"><strong><?php echo $row['task_name']; ?></strong></h3>
                

              </div>
               
              </div>  <!-- Card end -->
          </div>
      
          <div class="col-lg-12">
              <div class=" card  p-3 text-secondary" >  <!--  Card start -->
                
                  <p class=" text-secondary mb-2 ">  <?php echo $row['task_description']; ?> </p>
                
              </div>  <!-- Card end -->
          </div>
      
          </div>
      </div>  <!-- col-lg-9 end -->

        
      <div class="col-lg-3"> <!-- col-lg-3 start -->
        <ul class="list-group w-20">
        <li class="list-group-item text-center card-header "  ><strong class="fs-5">Task Details</strong></li>
        <li class="list-group-item text-center py-3" ><?php echo $days ?></li>
        <li class="list-group-item text-center d-flex justify-content-center" > <div class="d-flex align-items-center ">
                          <div class="circle me-2 text-center <?php echo $priorityClass ?>"></div>
                          <p class="text-center mb-0 me-2"><?php echo $row['priority_level']; ?></p>
                         
                        </div></li>
        <li class="list-group-item text-center py-3" >
        <?php
                            $proId=$row['project_id'];

                            $sqlpro = "SELECT * FROM task_projects where id=$proId";
                            $resultpro = $conn->query($sqlpro);
                            if ($resultpro->num_rows > 0) {
                            while($rowpro = $resultpro->fetch_assoc()) {
                            echo '<p class="text-center mb-0">'.$rowpro['name'].'</p>';
                            }
                            }
                            ?>
        </li>
       
     
        </ul>

        <ul class="list-group w-20 mt-3">
        <li class="list-group-item text-center card-header fs-5" style="border-bottom:1px solid #4c545c"><strong>Notes</strong></li>

        <li class="list-group-item text-center"> 
          
        <?php

      $sql = "SELECT * FROM task_notes where task_id='{$id}' ORDER BY id DESC"; 
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
        
        while($row = $result->fetch_assoc()) {
          
          $submitDate= date_create($row['submit_date']);
         $submitDate = date_format($submitDate, 'd-M-y');
         echo' <p class="mt-2"><span class="badge text-secondary ">'.$submitDate.'</span></p>';
         echo'<p>'.$row['notes'].'</p>';
         echo'<hr>';
          
     
        }
      } else {
        echo "<div class='alert alert-danger'>No data available</div>";
      }
      
    ?>


     
       </li>
        
       
     
        </ul>

      </div> <!-- col-lg-3 end -->       
    </div> <!-- row -->
  </div> <!-- container end  -->
</div> <!-- doc end --> 

</main>

                 
     <!-- ----------------------- modal 3 end ------------------------------------------  -->






               <!-- ------------------------ modal start ------------------------  -->

               

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog modal-lg " >

  <div class="modal-content shadow-lg" style="border-radius: 1rem;">
   

    <div class="modal-body">
    <h1 class="fs-3 text-center fw-bold mt-2" id="exampleModalLabel">Add Notes</h1>
    
        <div class="card-body p-5 text-center">
          <!-- <h2 class="mb-5 fw-bold lh-1">Sign in</h3> -->
         <form action="notesSql.php" method="post" enctype="multipart/form-data">
          <div class="form-outline mb-4">
            <input type="text" name="notes" placeholder="Add Note here" class="form-control form-control-lg" />
          </div>
          
          <div class="form-outline mb-4">
            <input type="hidden" name="task_id" value="<?php echo $id; ?>" class="form-control form-control-lg" />
          </div>

          <div class="form-outline mb-4">
            <input type="hidden" name="user_id" value="<?php echo $id; ?>" class="form-control form-control-lg" />
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
      <!-- ------------------------ modal end ------------------------  -->















    
                   
                  <?php
                  $counter++;
                  $ck_counter++;
                }

                } else {
                echo "<div class='alert alert-danger'>No data available</div>";
                }
                $conn->close();
                ?>

      
       

  
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









