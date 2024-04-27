
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



       <!-- ------------------------ modal start ------------------------  -->


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


  </body>
</html>
