<?php
session_start();
if (isset($_POST['removecourse'])) {
  require_once "connection.php";
  $email=$_SESSION['email'];
  $id=$_POST['courseID'];
  $sql="delete from savedcourses where email='$email' and courseID='$id'";
  if ($con->query($sql)==TRUE) {
    echo "<script>alert('Course Deleted');</script>";
    $con->close();
    echo "<script>window.location='savedcourses.php';</script>";
  }
  else {
    echo "<script>alert('Failed');</script>";
    echo $con->error;
    $con->close();
    echo "<script>window.location='savedcourses.php';</script>";
  }
}
 ?>
