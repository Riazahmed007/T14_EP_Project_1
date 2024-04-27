<?php include "adminCheckLogin.php" ?> <!--checking login-->
<?php
      include 'config.php';
    ?>
   
   <?php
      include 'config.php';
      $id=$_GET['id'];
      $sql = "SELECT * FROM task_tasks where id=$id";
      $result = $conn->query($sql);
   
      if ($result->num_rows > 0) {
        // output data of each row
       

        while($row = $result->fetch_assoc()) {
          $task_name=$row['task_name'];
          $task_description=$row['task_description'];
          $submit_date=$row['submit_date'];
         
          
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
  <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Projects</title>
  <?php include "../topcdn.php" ?>
  </head>
  <body class="sectionimg" >



  <div class="container-fluid ">
    <div class="row flex-nowrap">
      <?php include "nav.php" ?>
        <!-- ------------------------------------ content start -------------------------------  -->
        <div class="col py-3  ">
        <div class="container mt-3 py-2">
        <!-- -------------------------------------  -->
                 
    <div class="container">
     <div class="card mt-5" style=" border-radius: 1rem;">           
    <div class="card-body p-5 text-center">
        <form action="taskUpdateSql.php" method="post" >
              <div class="row">
                <div class="col-md-12 form-group">
                <input type="text" value="<?php echo $task_name ?>" name="task_name" class="form-control form-select  transparent-input  text-secondary"  placeholder="Task Title" required>
                </div>

                </div>

                <div class="row"> 

                <div class="col-md-12 form-group mt-3">
                  <label class="form-label d-flex justify-content-start text-secondary" for="formControlReadonly">Task Deadline</label>
                  <input type="date" name="submit_date" value="<?php echo $submit_date ?>" class="form-control form-select  transparent-input  text-secondary datepicker" id="date" placeholder="Assign date" required>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <textarea  id="editor" name="task_description" class="form-control" ><?php echo $task_description ?></textarea>
                  </div>
                  <input type="hidden" name="id" value="<?php echo $id ?>">
              

                  <div class="d-grid gap-2 mt-3">
              <input type="submit" value="Update Task" class="btn btn-primary" >
                </div>
        </form>
    </div>
    </div>      
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


