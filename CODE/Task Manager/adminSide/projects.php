<?php include "adminCheckLogin.php" ?> <!--checking login-->
<?php
      include 'config.php';
    ?>
   
 


<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Projects</title>
  <?php include "../topcdn.php" ?>
  </head>
  <body class="sectionimg" >



  <div class="container-fluid ">
    <div class="row flex-nowrap">
      <?php include "nav.php" ?>
        <!-- ------------------------------------ content start -------------------------------  -->
        <div class="col  py-3 content " id="projects-content">
          <div class="container">
              
              <!-- Mobile Toggle Button -->
              <div class="mobile-toggle-icon ms-2">
            <div class="toggle-icon mt-2 mb-4" onclick="toggleSidebar()">
                <i class="bi bi-list fs-3"></i>
            </div>
        </div>

        <!-- -------------------------------------  -->
        <table class="table table-responsive table-borderless card cardz shadow-lg p-3" style="border-radius: 1rem;">
       
        <div class="d-flex justify-content-between">
        <h2 class="pb-2 heading">Project Management</h2>
        <button type="button"  class="  mb-3 text-light fw-bold me-2 btnn " data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add New Project
        </button>
        </div>
        <!-- ------------------------ modal start ------------------------  -->
     <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg " >
  
    <div class="modal-content shadow-lg" style="border-radius: 1rem;">
     
  
      <div class="modal-body">
      <h1 class="fs-3 text-center fw-bold mt-2 text-secondary" id="exampleModalLabel">Add New Project</h1>
      
          <div class="card-body p-5 text-center">
            <!-- <h2 class="mb-5 fw-bold lh-1">Sign in</h3> -->
           <form action="projectAddNewSql.php" method="post">
            <div class="form-outline mb-4">
              <input type="text" name="name" placeholder="Project Name" class="form-control form-control-lg transparent-input text-secondary" />
            </div>

            <div class="form-outline mb-4">
              <input type="text" name="url"  placeholder="URL" class="form-control form-control-lg transparent-input text-secondary" />
            </div>

            <div class="form-outline mb-4">
              <select name="country" id="department" class="form-control">
                      <option value="">Country</option>
                      <option value="United Kingdom" class="text-color">United Kingdom</option>
                      <option value="Germany" class="text-color">Germany</option>
                      <option value="United States" class="text-color">United States</option>
                      </select>
            </div> 

                <div class="d-grid gap-2">
              <input type="submit" value="Add Project" class="btn btn-primary" >
                </div>

              </form>

          </div>
        </div>

      </div>


  </div>
</div>
        <!-- ------------------------ modal end ------------------------  -->

         
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
            
            <thead>
            
            <tr class="text-center">

            <th scope="col" width="10%" class="text-secondary">id</th>
            <th scope="col" width="20%" class="text-secondary">Name</th>
            <th scope="col" width="25%" class="text-secondary">URL</th>
            <th scope="col" width="15%" class="text-secondary">Country</th>
            <th scope="col" width="20%" class="text-secondary">Date</th>
            <th scope="col" width="30%" class="text-secondary">Action</th>

            </tr>
            </thead>
            <tbody>

            

            <?php

                include 'config.php';

                $sql = "SELECT * FROM task_projects ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                $counter=1;
               
                while($row = $result->fetch_assoc()) {
                  $submitDate= date_create($row['date']);
                  $submitDate = date_format($submitDate, 'd-M-y');
                  echo'<tr class="text-center">
                  <td width="10%" class="text-secondary">'.$counter++.'</td>
                  <td width="20%" class="text-secondary">'.$row ['name'].'</td>
                  <td width="20%"> <a href="'.$row ['url'].'" class="text-primary text-decoration-none">'.$row ['url'].'</a></td> 
                  <td width="15%" class="text-secondary">'.$row ['country'].'</td>
                  <td width="15%" class="text-secondary">'.$submitDate.'</td>

                  <td width="30%"> <div class=" pb-4">
                  
                  <a class="ms-lg-2" data-bs-toggle="modal" data-bs-target="#exampleModal'.$counter.'" href=""><i class="bi bi-pencil-fill"></i></a>
                  '; ?>

                     <a class="ms-lg-2 me-lg-2" href="#" onclick="confirmDelete('projectDeleteSql.php?id=<?php echo $row['id']; ?>')"><i class="bi bi-trash-fill"></i></a>

                    <?php echo '</li>
                  </ul>
                  </div></td>

                  </tr>' ;
                  ?>
                  
                  <!-- ------------------------ modal #2 start ------------------------  -->
                  <!-- Button trigger modal -->
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal<?php echo $counter ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg ">
                  <div class="modal-content shadow-lg" style="border-radius: 1rem;">
                 
                  <div class="modal-body">
                  <h1 class="modal-title fs-3 text-center fw-bold mt-2" id="exampleModalLabel">Update Project</h1>
                  <div class="card-body p-5 text-center">
                  <!-- <h2 class="mb-5 fw-bold lh-1">Sign in</h3> -->
                  <form action="projectUpdateSql.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>"  />
                  <div class="form-outline mb-4">
                  <input type="text" name="name" value="<?php echo $row['name'] ?>" placeholder="Project Name" class="form-control form-control-lg transparent-input text-secondary" />
                  </div>
                  <div class="form-outline mb-4">
                  <input type="text" name="url" value="<?php echo $row['url']; ?>" placeholder="URL" class="form-control form-control-lg transparent-input text-secondary" />
                  </div>
                  <div class="form-outline mb-4">
                  <input type="text" name="country" value="<?php echo  $row['country'];  ?>" placeholder="Country" class="form-control form-control-lg transparent-input text-secondary" />
                  </div>
                 <div class="d-grid gap-2">
              <input type="submit" class="btn btn-outline-secondary " >
                </div>
                  </form>
                  </div>
                  </div>
                  </div>
                  </div>
                  </div>
                  <!-- ------------------------ modal #2 end ------------------------  -->
                  
                  <?php

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






