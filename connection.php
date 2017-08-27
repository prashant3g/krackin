<?php
$con=new mysqli("localhost","root","1234","coursera");
if ($con->connect_error) {
  die("Failed to connect: ".$con->connect_error);
}
?>
