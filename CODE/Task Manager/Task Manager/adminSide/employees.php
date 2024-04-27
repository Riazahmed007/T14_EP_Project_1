
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Staff</title>
    <?php include "../topcdn.php" ?>
  
  </head>
  <body class="sectionimg">
    <div class="container-fluid ">
      <div class="row flex-nowrap">
        <?php include "nav.php" ?>
        <div class="col py-3 content" id="tasks-content">
          <div class="container">

          <!-- Mobile Toggle Button -->
 <div class="mobile-toggle-icon ms-2">
                      <div class="toggle-icon mt-2 mb-4" onclick="toggleSidebar()">
                          <i class="bi bi-list fs-3"></i>
                      </div>
                  </div>

            <div class="d-flex justify-content-between">
              <h2 class="pb-2 heading">Staff Management</h2>
              <button
                type="button"
                class="mb-3 text-light fw-bold me-2 btnn"
                data-bs-toggle="modal"
                data-bs-target="#exampleModal"
              >
                Add Staff Member
              </button>
            </div>
          </div>


       <!-- ------------------------ modal start ------------------------  -->



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

 <div class="modal-dialog modal-lg " >
 
   <div class="modal-content shadow-lg" style="border-radius: 1rem;">
    
 
     <div class="modal-body">
     <h1 class="fs-3 text-center text-secondary fw-bold mt-2" id="exampleModalLabel">Add Staff</h1>
     
         <div class="card-body p-5 text-center">
           <!-- <h2 class="mb-5 fw-bold lh-1">Sign in</h3> -->
          <form action="employeeAddNewSql.php" method="post" enctype="multipart/form-data">
           <div class="form-outline mb-4">
             <input type="text" name="name" placeholder="Staff Member Name" class="form-control form-control-lg transparent-input text-secondary" />
           </div>
           <div class="row">
                    
                    <div class="col-md-6 form-group mb-4">
                    <input type="text" name="emp_username" class="form-control form-control-lg transparent-input text-secondary"  placeholder="Username" required>
                    </div>
                    <div class="col-md-6 form-group mb-4">
                    <input type="password" name="emp_pass" class="form-control form-control-lg transparent-input text-secondary"  placeholder="Password" required>
                    </div>
  
                    </div>
           <div class="form-outline mb-4">
             <input type="text" name="email" placeholder="Email" class="form-control form-control-lg transparent-input text-secondary" />
           </div>

           <div class="form-outline mb-4">
             <input type="text" name="phone" placeholder="Phone" class="form-control form-control-lg transparent-input text-secondary" />
           </div>

           <div class="form-outline mb-4">
             <input type="text" name="address" placeholder="Address" class="form-control form-control-lg transparent-input text-secondary" />
           </div>


           <div class="form-outline mb-4">
             <input type="text" name="designation"  placeholder="Designation" class="form-control form-control-lg transparent-input text-secondary" />
           </div>

           <div class="form-outline mb-4">
           <input type="file" class="form-control transparent-input" name="fileToUpload"  placeholder="Upload Image" id="fileToUpload" required >
           </div>

        

           <div class="d-grid gap-2">
              <input type="submit" value="Add Staff" class="btn btn-primary" >
                </div>

             </form>

         </div>
       </div>

     </div>


 </div>
</div>
       <!-- ------------------------ modal end ------------------------  -->

          <div class="container profile-page">
            <div class="row">
              <?php
                include 'config.php';

                $sql = "SELECT * FROM task_employees ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  $counter = 1;
                  while ($row = $result->fetch_assoc()) {
                    echo '
                      <div class="col-xl-6 col-lg-7 col-md-12">
                        <div class="card cardz profile-header shadow-lg" style="border-radius: 1rem;">
                          <div class="body">
                            <div class="row pb-3">
                            <div class="col-lg-4 col-md-4 col-12 ">
                            <div class="profile-image float-md-right empimg "> <img src="'.$row ['photo'].'" alt="" > </div>
                        </div>
                              <div class="col-lg-8 col-md-8  col-12">
                                <h4 class="m-t-0 m-b-0 text-secondary">'.$row['name'].'</h4>
                                <span class="job_post text-secondary">'.$row['designation'].'</span>
                                <p class="text-secondary">'.$row['email'].'</p>
                                <a href="employeesProfile.php?id='.$row['id'].'" class="btn text-dark buttons empbtn">Visit Profile</a>
                                <div>
                                 
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    ';
                  }
                } else {
                  //echo "0 results";
                }
                $conn->close();
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include "../bottomcdn.php" ?>
  </body>
</html>
