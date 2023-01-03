<?php
session_name('EASYSALON');
session_start();

// checking if the user is already logged in
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
  header("Location: index.php");
}

require('dbcon.php');
$submit = isset($_POST['submit']);
$error = false;

// default values
$fname = '';
$lname = '';
$email = '';
$pass = '';
$cpass = '';

// for form-validation
$isfname = '';
$islname = '';
$isemail = '';
$ispass = '';
// $iscpass = '';

// deault error messages
$errfname = 'Please enter your first name correctly.';
$errlname = 'Please enter your last name correctly.';
$erremail = 'Please enter your email correctly.';
$errpass = 'Please enter correct password.';

if($submit){
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $cpass = $_POST['cpass'];
  $pass = $_POST['pass'];
  if(trim($fname) == ''){
    $isfname = 'is-invalid';
    $fname = '';
    $error = true;
  }

  if(trim($lname) == ''){
    $islname = 'is-invalid';
    $lname = '';
    $error = true;
  }

  if(trim($email) == ''){
    $isemail = 'is-invalid';
    $email = '';
    $error = true;
  }
  else {
    $sql = "SELECT * FROM users WHERE email='$email';";

    $result = $con->query($sql);
    check_error();
    if($result->num_rows > 0){
      $isemail = 'is-invalid';
      $error = true;
      $erremail = "Please enter a different email, this email is registered.";
    }

    // $con->close();
  }

  if(trim($pass) == '' || trim($cpass) == ''){
    $ispass = 'is-invalid';
    $pass = '';
    $cpass = '';
    $error = true;
  } elseif($pass != $cpass){
    $ispass = 'is-invalid';
    $error = true;
    $errpass = 'Password should be identical.';
  }
}

// inserting data into database if everything is fine
if($submit && !$error){

  $md5pass = md5($pass);
  $sql = "INSERT INTO users(name, email, password) VALUES('$fname $lname', '$email', '$md5pass');";
  if($con->query($sql) === TRUE){
    header('Location: registration_success.php');
    con_close();
    die();
  }else{
    con_close();
    die("[ERROR]: Something wrong with inserting data into database.</br>".$con->errno." ".$con->error."</br>");
  }
  con_close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $title = 'Registration';
  include('header.php');
  ?>
</head>

<body>  
<?php
$active = 'registration';
include("nav.php");
?>
<main class="f-container">
  <form class="form-signup border rounded shadow-lg" action="registration.php" method="post">
    <!-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <div class="d-flex justify-content-center">
      <h1 class="h3 fw-normal">Register to continue</h1>
    </div>

    <div class="line mb-3"></div>

    <div class="d-flex">
      <div class="form-floating">
        <input type="text" class="form-control <?php echo $isfname; ?>" id="fname" name="fname" required placeholder="Enter your name" value="<?php echo $fname; ?>" >
        <label for="fname">First Name</label>
        <div class="invalid-feedback">
          <?php echo $errfname; ?>
        </div>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control <?php echo $islname; ?>" id="lname" name="lname" required placeholder="Enter your name" value="<?php echo $lname; ?>" >
        <label for="lname">Last Name</label>
        <div class="invalid-feedback">
          <?php echo $errlname; ?>
        </div>
      </div>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control <?php echo $isemail; ?>" id="email" name="email" required placeholder="Enter your email" value="<?php echo $email; ?>" >
      <label for="email">Email</label>
      <div class="invalid-feedback">
        <?php echo $erremail; ?>
      </div>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control <?php echo $ispass; ?>" id="pass" name="pass" required placeholder="Enter your password" value="<?php echo $pass; ?>" >
      <label for="pass">Password</label>
      <div class="invalid-feedback">
        <?php echo $errpass; ?>
      </div>
    </div>
    <div class="form-floating">
      <input type="password" id="confirmPass" class="form-control <?php echo $ispass; ?>" name="cpass" required placeholder="Confirm your password" value="<?php echo $cpass; ?>" >
      <label for="confirmPass">Confirm Password</label>
      <div class="invalid-feedback">
        <?php echo $errpass; ?>
      </div>
    </div>

    <div class="d-flex justify-content-center">
      <button class="f-btn rounded" type="submit" name="submit">Register</button>
    </div>
  </form>
</main>

<?php
include("footer.php");
?>
</body>
</html>