<?php
session_name('EASYSALON');
session_start();

// checking if the user is already logged in
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
  header("Location: index.php");
}

$email = '';
$pass = '';
$err = '';
if(isset($_POST['submit'])){
  require('dbcon.php');

  $email = trim($_POST['email']);
  $pass = trim($_POST['pass']);
  $md5pass = md5($pass);

  if($email != '' && $pass != ''){
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$md5pass';";
    $result = query($sql);
    if($result->num_rows < 1){
      $err = 'is-invalid';
    }else{
      $_SESSION['logged_in'] = true;
      if(isset($_POST['remember_me']) && $_POST['remember_me'] == 'on')
        setcookie(session_name(), session_id(), time()+(60*60*24*7), '/');
    }
  } else{
      $err = 'is-invalid';
  }
  con_close();
}

if(isset($_POST['submit']) && $err == ''){
  header('Location: index.php');
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
      <?php
      if(isset($_SESSION['login_msg']))
        echo "<p class=\"h5\">".$_SESSION['login_msg']."</p>";
      else
        echo "<p class=\"h3\">Login to continue</p>";

      unset($_SESSION['login_msg']);
      ?>
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

    <div class="padding d-flex justify-content-center">
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="remember-me" name="remember_me" >
        <label for="remember-me" class="form-check-label">Remember me</label>
      </div>
    </div>

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