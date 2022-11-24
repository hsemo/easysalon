<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $title = 'Registration successfull';
  include('header.php');
  ?>
</head>
<body>
  
<?php
$active = '';
include("nav.php");
?>
<div class="f-container">
  <div class="form-signup d-flex flex-column border rounded shadow-lg justify-content-center align-items-center">
    <h1 class="h6">Registration is successfull.</br>You can proceed to login</h1>
    <a class="f-btn rounded" href="login.php">Login</a>
  </div>
</div>
<?php
include('footer.php');
?>
</body>
</html>