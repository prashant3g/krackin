<?php
session_start();
$_SESSION['email']==null;
unset($_SESSION['email']);
echo "<script>window.location='index.php';</script>";
 ?>
