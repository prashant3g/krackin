<?php
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION['email'])) {
  echo "<script>window.location='index.php';</script>";
  exit();
}
if (isset($_POST['update'])) {
  require_once "connection.php";
  $email=$_SESSION['email'];
  $oldpassword=md5($_POST['oldpassword']);
  $sql="select * from users where email='$email' and password='$oldpassword'";
  $result=$con->query($sql);
  if ($result->num_rows > 0) {
    $name=$_POST['name'];
    $newpassword=md5($_POST['newpassword']);
    $profession=$_POST['profession'];
    $sql="update users set name='$name', password='$newpassword', profession='$profession' where email='$email'";
    if ($con->query($sql)==TRUE) {
      echo "<script>alert('Profile Updated !');</script>";
    }
    else {
      echo "<script>alert('Error, Profile could not be Updated !');</script>";
    }
  }
  else {
    echo "<script>alert('email and password could not match');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>(Profile) Welcome <?php echo $_SESSION['email']; ?></title>
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
        <li><a href="savedcourses.php">Saved Courses</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="profile.php"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
      </ul>
    </div>
  </nav>

  <div class="container jumbotron" style="margin-top:60px">
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-primary">
          <div class="panel-heading" style="text-align:center">Update Profile</div>
          <div class="panel-body">
            <form method="post" action="profile.php">
              <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" disabled value="<?php echo $_SESSION['email'] ?>">
              </div>
              <div class="form-group">
                <label for="pwd">Name:</label>
                <input type="text" class="form-control" id="pwd" name="name" required>
              </div>
              <div class="form-group">
                <label for="pwd">Old Password:</label>
                <input type="password" class="form-control" id="pwd" maxlength="10" name="oldpassword" required>
              </div>
              <div class="form-group">
                <label for="pwd">New Password:</label>
                <input type="password" class="form-control" id="pwd" maxlength="10" name="newpassword" required>
              </div>
              <div class="form-group">
                <label for="sel1">Profession:</label>
                <select class="form-control" id="sel1" name="profession" required>
                  <option value="student">Student</option>
                  <option value="employed">Employed</option>
                  <option value="unemployed">Unemployed</option>
                </select>
              </div>
              <div class="btn-group btn-group-justified">
                <div class="btn-group">
                  <input type="submit" class="btn btn-success" name="update" value="Update">
                </div>
                <div class="btn-group">
                  <input type="reset" class="btn btn-danger" value="Clear">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
