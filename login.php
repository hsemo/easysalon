<?php
$err = '';
if(isset($_POST['submit'])){
  require('dbcon.php');

  $email = trim($_POST['email']);
  $pass = trim($_POST['pass']);
  $md5pass = md5($pass);

  if($email != '' && $pass != '') {
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$md5pass';";
    $result = $con->query($sql);
    check_error();
    if($result->num_rows < 1){
      $err = 'is-invalid';
    }
  } else{
    $err = 'is-invalid';
  }
  $con->close();
}

if($err == ''){
  header('Location: login_success.php');
  die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $title = 'Login';
  include('header.php');
  ?>
</head>
<body>
  
<?php
$active = 'login';
include("nav.php");
?>
<div class="f-container">
  <!-- <form class="needs-validation" action="login.php" method="post" novalidate> -->
  <form action="login.php" method="post" class="form-signin border rounded shadow-lg">
    <div class="d-flex justify-content-center">
      <h1 class="h3 fw-normal">Login to continue</h1>
    </div>
    <!-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->

    <div class="form-floating">
      <input type="email" class="form-control <?php echo $err; ?>" name="email" id="floatingEmail" required placeholder="Enter your email" value="<?php echo $email; ?>">
      <label for="floatingEmail">Email</label>
      <div class="invalid-feedback">
        Email or password is wrong.
      </div>
    </div>

    <div class="form-floating">
      <input type="password" class="form-control <?php echo $err; ?>" name="pass" id="floatingPassword" required placeholder="Enter your password">
      <label for="floatingPassword">Password</label>
      <div class="invalid-feedback">
        Email or password is wrong.
      </div>
    </div>

    <!-- <div class="padding d-flex justify-content-center">
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="remember-me" name="remember-me" >
        <label for="remember-me" class="form-check-label">Remember me</label>
      </div>
    </div> -->

    <div class="d-flex justify-content-center">
      <button class="f-btn rounded" type="submit" name="submit">Login</button>
    </div>
  </form>
</div>

<?php
include("footer.php");
?>
</body>
</html>