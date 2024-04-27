<?php
 include 'config.php';
    // $username="abd56";
      $user=$_COOKIE['userName'];
      $sql = "SELECT * FROM task_employees where emp_username='{$user}'"; 
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
        
        while($row = $result->fetch_assoc()) {
          
          $target_file=$row['photo'];
        }
      } else {
        echo "0 results";
      }
      $conn->close();
     
    ?>
<!-- -------------------------------------------  -->
<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0  sidebar">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 sidenavv ">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    
                    <li class="mb-2">
                        <a href="userDashboard.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi bi-person-circle"></i> <span class="ms-1 d-none d-sm-inline s">My Profile</span></a>
                    </li>
                    <li class="mb-2">
                        <a href="pendingtasks.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi bi-clock"></i> <span class="ms-1 d-none d-sm-inline s">Pending Tasks</span></a>
                    </li>
                    <li class="mb-2">
                        <a href="inprogresstasks.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi bi-hourglass-split"></i> <span class="ms-1 d-none d-sm-inline s">In Progress</span> </a>
                    </li>
                    <li class="mb-2">
                        <a href="completedtasks.php" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi bi-check2-circle"></i> <span class="ms-1 d-none d-sm-inline s">Completed</span></a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $target_file; ?>" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1 s">My profile</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                      
                        <li><a class="dropdown-item" href="userLogout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>