<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['email'])) {
  echo "<script>window.location='index.php';</script>";
  exit();
}

$title=$_SESSION['email'];
$url="https://api.coursera.org/api/courses.v1";
$fetchData=file_get_contents($url);
$data=json_decode($fetchData, true);
$courses=$data['elements'];
$records=$data['paging'];

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
  }
  else {
    echo "<script>alert('Failed');</script>";
    $con->error;
    $con->close();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>(All Courses) Welcome <?php echo $title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
 <div class="container-fluid">
   <div class="navbar-header">
     <a class="navbar-brand" href="home.php">Coursera Courses</a>
   </div>
   <ul class="nav navbar-nav">
     <li class="active"><a href="home.php">All Courses</a></li>
     <li><a href="savedcourses.php">Saved Courses</a></li>
   </ul>
   <ul class="nav navbar-nav navbar-right">
     <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
     <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
   </ul>
 </div>
</nav>

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <table class="table table-responsive table_cont">
          <thead>
            <tr>
              <th>Course No.</th>
              <th>Course ID</th>
              <th>Course Name</th>
              <th>Course Type</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            for($i=0; $i<$records['next']; $i++){
              $row=$courses[$i];
              require_once "connection.php";
              $email=$_SESSION['email'];
              $cid=$row['id'];
              $sql="select courseID from savedcourses where courseID='$cid' and email='$email'";
              $result=$con->query($sql);
              if ($result->num_rows > 0){
              echo "<tr class='savedRow'>
              <td>".($i+1)."</td>
              <td>".$row['id']."</td>
              <td>".$row['name']."</td>
              <td>".$row['courseType']."</td>
              <td><input type='submit' class='btn btnSave customBtn' name='saveCourse' disabled value='Saved' id='disabledBtn'></td>
              </tr>";
            }
              else {
                echo "<form action='savecourse.php' method='post'><tr>
                <td>".($i+1)."</td>
                <td>".$row['id']."</td>
                <input type='hidden' value='".$row['id']."' name='id'>
                <td>".$row['name']."</td>
                <input type='hidden' value='".$row['name']."' name='name'>
                <td>".$row['courseType']."</td>
                <input type='hidden' value='".$row['courseType']."' name='courseType'>
                <td><input type='submit' class='btn btn-info btnSave customBtn' name='saveCourse' value='Save'></td>
                </tr></form>";
              }
            ;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
