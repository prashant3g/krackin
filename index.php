<?php
if (!isset($_SESSION)) {
  session_start();
}
if (isset($_SESSION['email'])) {
  echo "<script>window.location='home.php';</script>";
}

if (isset($_POST['register'])) {
  require_once "connection.php";
  $email=$_POST['email'];
  $sql="select * from users where email='$email'";
  $result=$con->query($sql);
  if ($result->num_rows > 0) {
    echo "<script>alert('mail address is already registered !');</script>";
  }
  else {
    $name=$_POST['name'];
    $password=$_POST['password']; $password=md5($password);
    $profession=$_POST['profession'];
    $sql="insert into users values ('$email','$name','$password','$profession')";
    if ($con->query($sql)==TRUE) {
      echo "<script>alert('User Registered !');</script>";
    }
    else {
      echo "<script>alert('Failed to Register !');</script>";
      echo $con->error;
    }
  }
  $con->close();
}

if (isset($_POST['login'])) {
  require_once "connection.php";
  $email=$_POST['email'];
  $password=$_POST['password']; $password=md5($password);
  $sql="select email,password from users where email='$email' and password='$password'";
  $result=$con->query($sql);
  if($result->num_rows > 0){
    $_SESSION['email']=$email;
    echo "<script>window.location='home.php';</script>";
    $con->close();
  }
  else {
    echo "<script>alert('Email or Password is incorrect !');</script>";
    $con->close();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Coursera Login or Sign Up</title>
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
        <a class="navbar-brand" href="index.php">Coursera Courses</a>
      </div>
    </div>
  </nav>

  <div class="container" style="margin-top: 60px">
    <div class="row">
      <div class="col-md-5 jumbotron">
        <div class="panel panel-primary">
          <div class="panel-heading" style="text-align:center">Login</div>
          <div class="panel-body">
            <form method="post" action="index.php">
              <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" maxlength="10" name="password" required>
              </div>
              <div class="btn-group btn-group-justified">
                <div class="btn-group">
                  <button type="submit" class="btn btn-success" name="login">Login</button>
                </div>
                <div class="btn-group">
                  <input type="reset" class="btn btn-danger" value="Clear">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-md-offset-1 jumbotron">
        <div class="panel panel-primary">
          <div class="panel-heading" style="text-align:center">Registration</div>
          <div class="panel-body">
            <form method="post" action="index.php">
              <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="pwd">Name:</label>
                <input type="text" class="form-control" id="pwd" name="name" required>
              </div>
              <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" maxlength="10" name="password" required>
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
                  <input type="submit" class="btn btn-success" name="register" value="Register">
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

</div>
</body>
</html>
