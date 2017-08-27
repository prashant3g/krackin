<?php
session_start();
if (isset($_POST['saveCourse'])) {
  require_once "connection.php";
  $email=$_SESSION['email'];
  $id=$_POST['id'];
  $name=$_POST['name'];
  $courseType=$_POST['courseType'];
  $sql="insert into savedcourses values('$email','$id','$name','$courseType')";
  if ($con->query($sql)==TRUE) {
    echo "<script>alert('Course Saved');</script>";
    $con->close();
    echo "<script>window.location='home.php';</script>";
  }
  else {
    echo "<script>alert('Failed');</script>";
    echo $con->error;
    $con->close();
    echo "<script>window.location='home.php';</script>";
  }
}
 ?>
