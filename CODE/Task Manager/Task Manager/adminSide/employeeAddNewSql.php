<?php include "adminCheckLogin.php" ?> <!--checking login-->
<?php
include 'config.php';


$name=$_POST['name'];
$empUsername=$_POST['emp_username'];
$empPass=$_POST['emp_pass'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$address=$_POST['address'];
$designation=$_POST['designation'];


// Image Upload Code start //
$target_dir = "../assets/employeeimgs/";
$target_file = $target_dir . rand() .'-FileName-'. basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "zip"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
// Image Upload Code ends //
 
$hashed_password = password_hash($empPass, PASSWORD_DEFAULT);
$sql = "INSERT INTO task_employees (name, emp_username , emp_pass , email , phone , address , designation , photo )
VALUES ('$name', '$empUsername', '$hashed_password', '$email' , '$phone' , '$address' , '$designation' , '$target_file')";
 
if ($conn->query($sql) === TRUE) {
  echo '<script>window.location.href = "employees.php";</script>';
} else {
  echo '<script>window.location.href = "employees.php";</script>';
}
 
$conn->close();

?>