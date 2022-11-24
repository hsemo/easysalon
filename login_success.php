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
    <h1 class="h6">Login is successfull.</br>You can proceed to home page</h1>
    <a class="f-btn rounded" href="index.php">Home</a>
  </div>
</div>
<?php
include('footer.php');
?>
</body>
</html>