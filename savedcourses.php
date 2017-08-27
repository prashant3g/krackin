<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['email'])) {
  echo "<script>window.location='index.php';</script>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>(Saved Courses) Welcome <?php echo $_SESSION['email']; ?></title>
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
     <li><a href="home.php">All Courses</a></li>
     <li class="active"><a href="savedcourses.php">Saved Courses</a></li>
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
        <table class="table table-hover table-striped table-responsive table_cont">
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
            require_once "connection.php";
            $email=$_SESSION['email'];
            $sql="select courseID, courseName, courseType from savedcourses where email='$email'";
            $result=$con->query($sql);
            $count=1;
            if ($result->num_rows > 0) {
              while ($row= $result->fetch_assoc()) {
                echo "<form action='removecourse.php' method='post'>
                      <tr>
                      <td>".$count."</td>
                      <td>".$row['courseID']."</td>
                      <input type='hidden' value='".$row['courseID']."' name='courseID'>
                      <td>".$row['courseName']."</td>
                      <td>".$row['courseType']."</td>
                      <td><input type='submit' class='btn btn-danger btnSave' name='removecourse' value='Remove'></td>
                      </tr></form>";
                      $count++;
              }
            }
            else {
              echo "<tr><td colspan='5' align='center'>No Saved Courses ! Go back and save some courses.</td></tr>";
              echo $con->error;
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
